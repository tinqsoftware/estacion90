<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
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
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }


     /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->estado === 0 || $user->estado === null) {
            Auth::logout();
            return redirect()->route('login')
                ->withInput($request->only($this->username(), 'remember'))
                ->withErrors([
                    $this->username() => __('Usuario Desactivado'),
                ]);
        }
        
        return redirect()->intended($this->redirectPath());
    }

    public function loginAjax(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'Credenciales inválidas']);
    }



}
