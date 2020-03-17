@extends('layouts.app')
@section('content')
<div class="container">
    <section class="section">
        <div class="columns justify-content-center">
            <div class="column is-half is-offset-one-quarter">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="field">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                    <input id="email" type="email" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="has-text-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                            </div>

                            <div class="field">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    @error('password')
                                        <span class="has-text-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                            </div>

                            <div class="field">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="button is-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="button is-white is-pulled-right" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
        </div>
    </section>
</div>
@endsection
