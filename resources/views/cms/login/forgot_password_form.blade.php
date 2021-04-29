@extends('layouts.login_layout')

@section('content')
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div><h1 class="logo-name" style="font-size:140px">DIYL</h1></div>
            <h3>Recupera password</h3>
            <small>Inserisci il tuo indirizzo email per recuperare la password</small>
            <form class="m-t" role="form" method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email" class="form-control" placeholder="E-Mail" name="email" value="{{ old('email') }}" required autofocus >
                    @if ($errors->has('email'))<span class="help-block text-danger"><strong>{{ $errors->first('email') }}</strong></span>@endif
                </div>

                <button type="submit" class="btn btn-primary block full-width m-b">Invia</button>
            </form>
            <div>
                @include('layouts.flash_message')
            </div>
        </div>
    </div>
@endsection
