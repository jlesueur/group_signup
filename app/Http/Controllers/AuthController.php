<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Config;


class AuthController extends Controller {
	/**
	 *
	 * @return Response
	 */
	public function login() {
		$providerKey = Config::get('services.google');

		return Socialite::driver('google')
				->scopes(['https://www.googleapis.com/auth/userinfo.profile', 'https://www.googleapis.com/auth/userinfo.email'])
				->with(['hd' => 'jordandistrict.org'])
				->redirect();
	}

	/**
	 *
	 * @return Response
	 */
	public function auth() {
		$providerKey = \Config::get('services.google');
		$googleUser = Socialite::driver('google')->user();
		$dbUser = User::query()->where(['email' => $googleUser->email])->first();
		if ($dbUser == null) {
			$dbUser = User::create([
				'email' => $googleUser->email,
				'name' => $googleUser->name,
				'password' => bcrypt('x'),
			]);
		}
		if (Auth::attempt(['email' => $googleUser->email, 'password' => 'x'])) {
			return redirect()->intended('home');
		} else {
			die("no worky?");
		}
	}
}
