<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    //vista del login
    public function index()
    {
        return view('login');
    }
    //vista del registro
    public function registro()
    {
        return view('register');
    }
    //aqui ta la logica del registro
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if (!$user) {
            return view('auth/register')->withErrors(['message' => 'Error al crear el usuario']);
        }

        return redirect()->route('login.view');
    }
    //aqui ta la logica del login
    //https://laravel.com/docs/11.x/authentication#authenticating-users
    public function login(LoginRequest $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('tasks');
        }
 
        return back()->withErrors([
            'message' => 'Credenciales inválidas'
        ]);
    }
    /**
     * Log the user out of the application.
     * esto es para hacer el cierre de sesion
     * https://laravel.com/docs/11.x/authentication#logging-out
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}