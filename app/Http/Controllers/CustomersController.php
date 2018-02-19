<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Product;
use App\Http\Requests\CreateCustomerRequest;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function customers(Request $request)
    {
      $notifications = $request->user()->notifications->take(5);
      $count = count($notifications);
      $customers = Customer::all();

      return view('customers.list', [
        'customers' => $customers,
        'notifications' => $notifications,
        'count' => $count,
      ]);
    }

    public function detail(Customer $customer, Request $request)
    {
      //$customer = Customer::find($id);
      $notifications = $request->user()->notifications->take(5);
      $count = count($notifications);

      return view('customers.detail', [
        'customer' => $customer,
        'notifications' => $notifications,
        'count' => $count,
      ]);
    }

    public function create(CreateCustomerRequest $request)
    {
      $customer = Customer::create([
        'name' => $request->input('name'),
        'address' => $request->input('address'),
        'email' => $request->input('email'),
        'phone' => $request->input('phone'),
        'image' => 'http://lorempixel.com/600/338?'.mt_rand(0,1000),
      ]);

      return redirect('/customers')->withSuccess('Cliente agregado.');
    }
}
