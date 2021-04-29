<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\UserCms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showForm()
    {
        return view('cms.register.register_form');
    }

    public function register(Request $request)
    {
        //faccio la validazione dei dati
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:App\Model\UserCms'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        //tutti i parametri
        $data = $request->all();

        //l'id dello shop se è la registrazione di un utente shop
        $shop_id = (isset($data['shop_id'])) ? $data['shop_id'] : null;

        $user = new UserCms();
        $user->role_id  = $data['role_id'];
        $user->shop_id  = $shop_id;
        $user->name     = $data['name'];
        $user->email    = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();

        event(new Registered($user));

        //effettuo il login
        // Auth::guard('cms')->login($user);

        //vado alla dashboard
        //return redirect()->route('admin.dashboard');
    }
}
