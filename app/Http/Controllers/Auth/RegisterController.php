<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest')->except('registerAjax');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
        'name' => $data['name'],
        'apellido' => $data['apellido'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'id_rol' => $data['id_rol'],
        'telefono' => $data['telefono'],
        'estado' => $data['estado'],
    ]);
    }

    public function registerAjax(Request $request)
    {
        try {
            $request->validate([
                'name'     => 'required|string|max:255',
                'apellido' => 'required|string|max:100',
                'email'    => 'required|string|email|max:255|unique:users',
                'telefono' => 'nullable|string|max:20',
                'password' => 'required|string|min:8',
            ]);

            if (User::where('email', $request->email)->exists()) {
                return response()->json(['success' => false, 'message' => 'El correo ya está registrado']);
            }

            $user = User::create([
                'name' => $request->name,
                'apellido' => $request->apellido,
                'email' => $request->email,
                'telefono' => $request->telefono,
                'password' => Hash::make($request->password),
                'id_rol' => 2, // Cliente
                'estado' => 1, // Activo
            ]);

            Auth::login($user);

            return response()->json(['success' => true, 'message' => 'Usuario registrado exitosamente']);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false, 
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Error en registro AJAX: ' . $e->getMessage());
            return response()->json([
                'success' => false, 
                'message' => 'Error interno del servidor: ' . $e->getMessage()
            ], 500);
        }
    }

}
