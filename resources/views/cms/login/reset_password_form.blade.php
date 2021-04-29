@extends('layouts.login_layout')

@section('content')
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div><h1 class="logo-name" style="font-size:140px">DIYL</h1></div>
            <h3>Imposta nuova password</h3>

            <form class="m-t" role="form" method="POST" action="{{ route('password.update') }}">

                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{$token}}" />
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email" class="form-control" placeholder="E-Mail" name="email" value="{{ old('email') }}" required autofocus >
                    @if ($errors->has('email'))<span class="help-block text-danger"><strong>{{ $errors->first('email') }}</strong></span>@endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                    @if ($errors->has('password'))<span class="help-block text-danger"><strong>{{ $errors->first('password') }}</strong></span>@endif
                </div>

                <div class="form-group{{ $errors->has('confirm_password') ? ' has-error' : '' }}">
                    <input type="password" class="form-control" placeholder="Conferma Password" name="password_confirmation" required>
                    @if ($errors->has('password_confirmation'))<span class="help-block text-danger"><strong>{{ $errors->first('password_confirmation') }}</strong></span>@endif
                </div>


                <button type="submit" class="btn btn-primary block full-width m-b">Reset</button>
            </form>
            <p class="m-t">
                <small>InYourLife &copy; {{ date('Y') }}</small>
            </p>
        </div>
    </div>
@endsection
