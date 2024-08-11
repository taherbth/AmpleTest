@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h4>{{ __('Login') }}</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="/login">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3" x-data="{ show: false }">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <div class="input-group">
                                <input :type="show ? 'text' : 'password'" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                <button type="button" class="btn btn-outline-secondary" @click="show = !show">
                                    <span x-show="!show">Show</span>
                                    <span x-show="show">Hide</span>
                                </button>
                                @error('password')
                                    <div class="invalid-feedback d-block">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                        </div>
                    </form>

                    <div class="mt-3">
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
