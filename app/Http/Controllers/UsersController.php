<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use App\Sucursal;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
  public function users(Request $request)
  {
    $user = $request->user();

    $users = User::where('roll', 0)->where('owner', $user->group)->get();

    $notifications = $request->user()->notifications->take(5);
    $count = count($notifications);

    return view('users.list', [
      'users' => $users,
      'notifications' => $notifications,
      'count' => $count,
    ]);
  }

  public function detail(User $user, Request $request)
  {
    //$user = Customer::find($id);
    $notifications = $request->user()->notifications->take(5);
    $count = count($notifications);

    return view('users.detail', [
      'user' => $user,
      'notifications' => $notifications,
      'count' => $count,
    ]);
  }

  public function create(CreateUserRequest $request)
  {
    $usuario = $request->user();

    $user = User::create([
      'name' => $request->input('name'),
      'address' => $request->input('address'),
      'email' => $request->input('email'),
      'phone' => $request->input('phone'),
      'image' => 'http://grupoheygar.com/wp-content/uploads/2017/03/cropped-LOG.fw_-192x192.png',
      'password' => Hash::make(env('APP_PASSWORD')),
      'owner' => $usuario->group,
    ]);

    $sucursales = $request->input('sucursales');

    if($sucursales) {
      foreach ($sucursales as $sucursal) {
        Sucursal::create([
          'name' => $sucursal,
          'user_id' => $user->id,
        ]);
      }
    }

    return redirect('/customers')->withSuccess('Cliente agregado.');
  }

  public function update (Request $request, User $user) {

    User::where('id', $user->id)->update([
     'name' => $user->name,
     'address' => $request->input('address'),
     'email' => $request->input('email'),
     'phone' => $request->input('phone'),
     'updated_at' => date('Y-m-d H:i:s'),
    ]);

    $sucursales = $request->input('sucursales');

    $arethere = Sucursal::where('user_id', $user->id);

    if($arethere) {
      $arethere->delete();
    }

    if($sucursales) {
      foreach ($sucursales as $sucursal) {
        Sucursal::create([
          'name' => $sucursal,
          'user_id' => $user->id,
        ]);
      }
    }

    return redirect('/customers/'.$user->id)->withSuccess('Cliente modificado.');
  }

  public function notifications(Request $request) {

    $notifications = $request->user()->notifications;
    $count = count($notifications);

    return view('users.notifications', [
      'notifications' => $notifications,
      'count' => $count,
    ]);
  }

  public function sucursales(Request $request, $id) {

    if($request->ajax()) {
      $sucursales = Sucursal::sucursales($id);
      return response()->json($sucursales);
    }

  }

}
