<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use App\Models\Persona;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        //dd($request->all());

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        event(new Registered($user));

        $newuser['user_id'] = Auth::id();
        $newuser['registro'] = Auth::id();
        $newuser['carrera'] = '187-?';
        $newuser['ci'] = Auth::id();
        $newuser['nombres'] = $user->name;
        $newuser['apellidos'] = $user->name;
        $newuser['nacimiento'] = now()->toDateString();;
        $newuser['direccion'] = 'B. El Trompillo';
        $newuser['email'] = $user->email;
        $newuser['celular'] = '70012345';
        $newuser['foto'] = 'mifoto.jpg';
        //dd($newuser);
        $persona=Persona::create($newuser);

        return  redirect()->route('persona.edit',$persona);

        //return redirect(RouteServiceProvider::HOME);
    }
}
