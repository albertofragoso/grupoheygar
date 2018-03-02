<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use App\Response;
use App\Notifications\ProductMessage;
use App\Notifications\ProductUpdate;
use App\Notifications\ProductCreate;
use App\Http\Requests\CreateProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use DB;

class ProductsController extends Controller
{
  public function products(Request $request)
  {
    $notifications = $request->user()->notifications->take(5);
    $count = count($notifications);
    //$products = Product::all();
    $user = $request->user();
    $products = Product::where('owner', $user->group)->where('percentage', '<' ,100)->get();
    //$users = User::where('roll', 0)->get();
    $users = User::where('roll', 0)->where('owner', $user->group)->get();

    return view('products.list', [
      'products' => $products,
      'users' => $users,
      'notifications' => $notifications,
      'count' => $count,
    ]);
  }

  public function done(Request $request)
  {
    $notifications = $request->user()->notifications->take(5);
    $count = count($notifications);
    $user = $request->user();
    $products = Product::where('owner', $user->group)->where('percentage', 100)->get();

    $users = User::where('roll', 0)->where('owner', $user->group)->get();

    return view('products.done', [
      'products' => $products,
      'users' => $users,
      'notifications' => $notifications,
      'count' => $count,
    ]);
  }

  public function detail(Product $product, Request $request)
  {

      // Searching product for id
      // Returning product detail
      //$product = Product::find($id);
      //dd($product->responses->load('user'));
      $notifications = $request->user()->notifications->take(5);
      $count = count($notifications);

      return view('products.detail', [
        'product' => $product,
        'notifications' => $notifications,
        'count' => $count,
      ]);
  }

  public function create(CreateProductRequest $request)
  {
    $user = $request->user();
    $sucursal = $request->input('sucursal');

    $product = Product::create([
      'name' => $request->input('name'),
      'percentage' => 0,
      'done' => 0,
      'stage' => $request->input('stage'),
      'finished_at' => $request->input('finished_at'),
      'user_id' => $request->input('customer'),
      'modify_by' => $user->id,
      'owner' => $user->group,
    ]);

    if ($sucursal) {
      Product::where('id', $product->id)->update([
       'sucursal_id' => $sucursal,
      ]);
    }

    $customer = User::where('id', $product->user_id)->firstOrFail();
    $customer->notify(new ProductCreate($user, $product));

    return redirect('/products')->withSuccess('Trabajo agregado.');
  }

  /*public function update(CreateProductRequest $request)
  {
    $user = $request->user();
  }*/

  public function responses(Product $product)
  {
    return $product->responses->load('user');
  }

  public function createMessage(Request $request, Product $product)
  {
    $this->validate($request, [
        'message' => 'required'
      ], [
        'message.required' => 'Lo sentimos. Debes escribir un mensaje.'
      ]);

    $user = $request->user();
    $message = Response::create([
      'product_id' => $product->id,
      'user_id' => $user->id,
      'message' => $request->input('message'),
    ]);

    $admins = User::admins()->get();
    Notification::send($admins, new ProductMessage($user, $product));


    return redirect('/products/'.$product->id)->withSuccess('Comentario agregado.');
  }

  public function update(Product $product, Request $request) {

    $this->validate($request, [
        'message' => 'required',
        'percentage' => 'required',
      ], [
        'message.required' => 'Lo sentimos. Debes escribir un mensaje.',
        'percentage.required' => 'Lo sentimos. Debes ingresar un porcentaje.'
      ]);

    $user = $request->user();
    $customer = User::where('id', $product->user_id)->firstOrFail();

    $message = Response::create([
      'product_id' => $product->id,
      'user_id' => $user->id,
      'message' => $request->input('message'),
    ]);

    $new = Product::where('id', $product->id)->update([
     'modify_by' => $user->name,
     'percentage' => $request->input('percentage'),
     'stage' => $request->input('stage'),
     'updated_at' => date('Y-m-d H:i:s'),
     'bill' => $request->input('bill'),
     //'finished_at' => $request->input('finished_at'),
    ]);

    $customer->notify(new ProductUpdate($user, $product));

    return redirect('/products/'.$product->id)->withSuccess('Trabajo modificado.');
  }

  public function delete(Request $request, Product $product) {

    $product = Product::find($product->id);
    $product->delete();
    return redirect('/products/')->withSuccess('Trabajo eliminado.');
  }

}
