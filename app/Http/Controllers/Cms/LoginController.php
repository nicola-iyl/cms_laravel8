<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    protected $maxAttempts = 5; // massimi tentativi di login
    protected $decayMinutes = 5; // lasso di tempo dopo il blocco

    // mostra la vista con il FORM LOGIN
    public function showForm()
    {
        return view('cms.login.login_form');
    }

    //esegue il login
    public function login(Request $request)
    {
        //faccio la validazione dei dati in arrivo
        $request->validate(['email' => 'required|string','password' => 'required|string']);

        //se checkato laravel creerà un token nel campo remember_token della tabella users_cms per mantenere l'utente sempre loggato
        $remember = $request->get('remember',false);

        //prendo le credenziali che arrivano dal form
        $credentials = $request->only('email', 'password');

        //controllo che non abbia effettuato troppi tentativi di login
        if($this->hasTooManyLoginAttempts($request))
        {
            $this->fireLockoutEvent($request);
            $seconds = $this->limiter()->availableIn($this->throttleKey($request));

            throw ValidationException::withMessages(['password' => [trans('auth.throttle', ['seconds' => $seconds])] ])->status(Response::HTTP_TOO_MANY_REQUESTS);
        }

        //chiamo il metodo per verificare le credenziali ed effettuare LOGIN
        if (Auth::guard('cms')->attempt($credentials, $remember))
        {
            $request->session()->regenerate();
            //pulisco i tentativi di accesso
            $this->limiter()->clear($this->throttleKey($request));

            //se credenziali giuste vado alla route di atterraggio
            if(Auth::guard('cms')->user()->role->name == 'admin')
            {
                return redirect()->route('admin.dashboard');
            }
            else
            {
                return redirect()->route('dashboard');
            }

        }

        //incremento i tentativi di access
        $this->incrementLoginAttempts($request);

        //torno alla pagina di login con il messaggio di errore
        return back()->withErrors(['password' => trans('auth.failed')]);
    }

    public function logout(Request $request)
    {
        Auth::guard('cms')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    //mostra la vista con il form per RECUPERO PASSWORD
    public function forgot_password()
    {
        return view('cms.login.forgot_password_form');
    }

    //metodo che crea un link con token per reimpostare la password e lo invia per email
    public function email_password(Request $request)
    {
        //controllo che il dato sia corretto
        $request->validate(['email' => 'required|email']);

        //invia la notifica con il link per il reset della password all'indirizzo email
        //attenzione il Password::sendResetLink funziona in base configurazione in auth.php delle opzioni password
        $status = Password::sendResetLink($request->only('email'));

        //torna indietro con il risultato dell'invio dell'url per il reset
        return ($status === Password::RESET_LINK_SENT) ? back()->with(['success' => __($status)]) : back()->withErrors(['email' => __($status)]);

    }

    //restituisce la viste con il form REIMPOSTA PASSWORD
    public function reset_password(Request $request, $token)
    {
        if(!$token)
        {
            return redirect()->route('login');
        }
        return view('cms.login.reset_password_form',['token' => $token]);
    }

    //metodo per reimpostare la password
    public function update_password(Request $request)
    {
        $request->validate([
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $credentials = $request->only('email', 'password', 'password_confirmation', 'token');
        $status = Password::reset(
            $credentials,
            function ($user, $password) use ($request)
            {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status == Password::PASSWORD_RESET ? redirect()->route('login')->with('success', __($status)) : back()->withErrors(['email' => [__($status)]]);
    }

    //controlla se ha effettuato troppi tentativi di login
    protected function hasTooManyLoginAttempts(Request $request)
    {
        return $this->limiter()->tooManyAttempts($this->throttleKey($request), $this->maxAttempts);
    }

    protected function limiter()
    {
        return app(RateLimiter::class);
    }

    protected function throttleKey(Request $request)
    {
        return Str::lower($request->input('email')).'|'.$request->ip();
    }

    protected function fireLockoutEvent(Request $request)
    {
        event(new Lockout($request));
    }

    //incrementa il numero di tentativi di login effettuati
    protected function incrementLoginAttempts(Request $request)
    {
        $this->limiter()->hit($this->throttleKey($request), $this->decayMinutes * 60);
    }
}
