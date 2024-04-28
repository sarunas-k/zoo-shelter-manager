@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 100px">
        <h2 class="mb-4 text-center bold">BUZZING ZOO</h2>
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-8 col-xl-5">
                <div class="card">
                    <div class="card-header bg-dark text-light bold">{{ !session('security-question') ? __('Login') : __('Security question') }}</div>

                    <div class="card-body">
                        @if (!session('security-question'))
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group flex-column row my-1 align-items-center">

                                    <label for="email"
                                        class="col-form-label text-start w-75">{{ __('E-Mail Address') }}</label>

                                    <div class="w-75">
                                        <input id="email" type="email"
                                            class="form-control{{ session('login-error') && isset(session('login-error')['email']) ? ' is-invalid' : '' }} border border-dark-subtle"
                                            name="email" value="{{ old('email') }}" required autofocus
                                            autocomplete="off">

                                        @if (session('login-error') && isset(session('login-error')['email']))
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ session('login-error')['email'] }}</strong>
                                            </span>
                                        @endif
                                    </div>


                                </div>

                                <div class="form-group flex-column row my-1 align-items-center">
                                    <label for="password"
                                        class="col-form-label  text-start w-75">{{ __('Password') }}</label>

                                    <div class="w-75">
                                        <input id="password" type="password"
                                            class="form-control border border-dark-subtle"
                                            name="password" required>
                                            @if (session('login-error') && isset(session('login-error')['answer']))
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ session('login-error')['answer'] }}</strong>
                                                </span>
                                            @endif

                                    </div>
                                </div>
                                <div class="form-group flex-column row my-3 align-items-center">
                                    <div class="w-75">
                                        <button type="submit" class="btn btn-primary text-white w-100">
                                            {{ __('Login') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <form>
                            @else
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group row my-1 flex-column align-items-center">
                                        <label for="security-answer"
                                            class="w-75 col-form-label text-start">{{ session('security-question') }}</label>

                                        <div class="w-75">
                                            <input type="hidden" id="email" name="email"
                                                value="{{ session('email') }}" />
                                            <input id="security-answer" type="text"
                                                class="form-control border border-dark-subtle" name="security-answer"
                                                required>
                                            @if (session('login-error') && isset(session('login-error')['password']))
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ session('login-error')['password'] }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row my-3 flex-column align-items-center">
                                        <div class="w-75">
                                            <button type="submit" class="btn btn-primary text-white w-100">
                                                {{ __('Login') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
