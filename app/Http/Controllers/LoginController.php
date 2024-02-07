<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Google_Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function register(Request $request)
    {
        $user = new User();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')],
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect(route('registro'))->withErrors('Email o password incorrect');
        } else {
            $user->name = $request->input("name");
            $user->email = $request->input("email");
            $user->password = Hash::make($request->input("password"));
            $user->save();

            Auth::login($user);
            return redirect(route('privada'));
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('privada');
        } else {
            return redirect()->route('login')->withErrors(['error' => 'Email o contraseña incorrectos']);
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));
    }

    function authCallbackGit(Request $request)
    {
        // Obtiene los datos del usuario desde GitHub OAuth
        $githubUser = Socialite::driver('github')->stateless()->user();

        // Busca el usuario en la base de datos por el correo electrónico
        $user = User::where('email', $githubUser->email)->first();

        if (!$user) {
            // Si el usuario no existe, crea uno nuevo
            $user = new User();
            $user->name = $githubUser->name;
            $user->email = $githubUser->email;
            $user->password = bcrypt(Str::random(16)); // Genera una contraseña aleatoria
            $user->save();
        }

        // Inicia sesión al usuario
        Auth::login($user);

        return redirect('/privada'); // Redirige a la página /dashboard después del inicio de sesión
    }

    function handleGoogleCallback(Request $request)
    {
        // Obtiene los datos del usuario desde Google OAuth
        $googleUser = Socialite::driver('google')->stateless()->user();

        // Busca el usuario en la base de datos por el correo electrónico
        $user = User::where('email', $googleUser->email)->first();

        if (!$user) {
            // Si el usuario no existe, crea uno nuevo
            $user = new User();
            $user->name = $googleUser->name;
            $user->email = $googleUser->email;
            $user->password = bcrypt(Str::random(16)); // Genera una contraseña aleatoria
            $user->save();

            // Inicia sesión al usuario
            auth()->login($user);
        } else {
            // Si el usuario ya existe, inicia sesión directamente
            auth()->login($user);
        }

        return redirect('/privada'); // Redirige a la página /privada después del inicio de sesión
    }
};

