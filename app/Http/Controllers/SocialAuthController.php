<?php

namespace App\Http\Controllers;

use App\User;
use App\SocialProfile;
use Illuminate\Http\Request;
use Socialite;

class SocialAuthController extends Controller
{
    public function facebook()
    {
      return Socialite::driver('facebook')->redirect();
    }

    public function callback()
    {
      $user = Socialite::driver('facebook')->user();

      $existing = User::whereHas('socialProfiles', function($query) use ($user){
        $query->where('social_id', $user->id);
      })->first();

      if($existing !== null) {

        auth()->login($existing);

        return redirect('/customers/'.$existing->id);
      }

      $profile = SocialProfile::create([
    		'social_id' => $data->id,
        'user_id' =>$customer_id,
    		//'user_id' => $user->id,
        'image' => $data->avatar,
  		]);

      $user = $this->findById($customer_id);

  		auth()->login($user);

  		//return redirect('/admin');
      //$data = session('facebookUser');
      return back()->withInput();
      //session()->flash('facebookUser', $user); // Save data before ends session.

      /*return view('users.facebook', [
        'user' => $user,
      ]);*/
    }

    public function register(Request $request)
    {
      $data = session('facebookUser');
      //Update
      /*$user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'image' => $data->avatar,
        'password' => str_random(16),
      ]);*/
      /*
        Buscar la forma de hacer query mandando el id del cliente a traves de los formularios para asociarlo con cuenta de facebook del solicitante.
      */
      $customer_id = $request->input('customer_id');

      $profile = SocialProfile::create([
    		'social_id' => $data->id,
        'user_id' =>$customer_id,
    		//'user_id' => $user->id,
        'image' => $data->avatar,
  		]);

      $user = $this->findById($customer_id);

  		auth()->login($user);

  		//return redirect('/admin');
      //$data = session('facebookUser');
      return back()->withInput();

    }

    private function findById($id)
    {
    	return User::where('id', $id)->first();
    }

}
