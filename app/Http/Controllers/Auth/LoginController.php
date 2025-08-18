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
        
        
    }
public function redirectPath()
    {
        if (Auth::check()) {
            $userRole = Auth::user()->id_rol;
            
            switch ($userRole) {
                case 1: // ADMIN
                    return '/menuSemanal';
                case 2: // CLIENTE
                    return '/inicio';
                case 3: // REPARTIDOR
                    return '/motorizado/moto';
                case 4: // CHEF
                    return '/cocina';
                case 5: // CHEF
                    return '/banners';
                case 6: // IMPRESION
                    return '/impresiones';
                default:
                    return '/menuSemanal';
            }
        }
        
        return '/';
    }

    public function loginAjax(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            // Verificar si el usuario está activo
            if ($user->estado === 0 || $user->estado === null) {
                Auth::logout();
                return response()->json([
                    'success' => false,
                    'message' => 'Usuario desactivado'
                ], 401);
            }
            
            $request->session()->regenerate();
            
            // Usar el mismo método de redirección
            $redirectUrl = $this->redirectPath();
            
            return response()->json([
                'success' => true,
                'message' => 'Login exitoso',
                'redirect' => $redirectUrl,
                'user' => $user
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Las credenciales no coinciden con nuestros registros.'
        ], 401);
    }



}