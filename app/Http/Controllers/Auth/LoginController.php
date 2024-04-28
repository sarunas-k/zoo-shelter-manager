<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {
	/*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

	use AuthenticatesUsers;

	/**
	 * Where to redirect users after login.
	 *
	 * @var string
	 */
	protected $redirectTo = '/';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('guest')->except('logout');
	}

	public function login(Request $request) {
		// When login form submitted
		if ($request->input('email')) {
			$user = User::where('email', $request->input('email'))->first();
			$error = [];

			if ($user === null) {
				$error['email'] = 'User with your credentials wasn\'t matched';
			} else {
				if ($request->input('password')) {
                    if (Auth::attempt($request->only(['email', 'password'])))
                        return redirect('/home');

					session([
						'security-question' => $user->question,
						'email' => $user->email,
					]);
					$error['password'] = 'Try to answer your security question';

					// If user security question submitted
				} elseif ($request->input('security-answer')) {
					// Check if user's answer and answer from input are same
					if ($user->isAnswer($request->input('security-answer'))) {
						// Login user
						Auth::login($user);
						return redirect('/home');
					} else {
						// Send incorrect security answer error
						$request->session()->flush();
						$error['answer'] =
							'Your security answer was incorrect. Log in again';
					}
				}
			}
		}
		if (count($error)) {
			session(['login-error' => $error]);
		}

		return redirect()->route('login');
	}
}
