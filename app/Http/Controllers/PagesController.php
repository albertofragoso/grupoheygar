<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function customers() {
      $customers = [
        [
          'id' => 1,
          'name' => 'Cliente uno',
          'direction' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
          'created_at' => '00/00/000',
          'image' => 'http://lorempixel.com/600/338?1'
        ],
        [
          'id' => 2,
          'name' => 'Cliente dos',
          'direction' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
          'created_at' => '00/00/000',
          'image' => 'http://lorempixel.com/600/338?2'
        ],
        [
          'id' => 3,
          'name' => 'Cliente tres',
          'direction' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
          'created_at' => '00/00/000',
          'image' => 'http://lorempixel.com/600/338?3'
        ]
      ];

      return view('customers/list', [
        'customers' => $customers,
      ]);
    }

    public function home(Request $request) {
      $user = $request->user();

      $notifications = $request->user()->notifications->take(5);
      $count = count($notifications);
      $products = Product::where('owner', $user->group)->where('percentage', '<' ,100)->orderBy('created_at', 'desc')->take(10)->get();
      //$customers = User::where('roll', 0)->orderBy('created_at', 'desc')->get();
      $customers = User::where('roll', 0)->where('owner', $user->group)->orderBy('created_at', 'desc')->get();
      $admins = User::where('roll', 1)->orderBy('created_at', 'desc')->get();

      return view('welcome', [
        'notifications' => $notifications,
        'count' => count($notifications),
        'total_products' => count($products),
        'total_customers' => count($customers),
        'total_admins' => count($admins),
        'products' => $products,
        'customers' => $customers,

      ]);
    }
}
