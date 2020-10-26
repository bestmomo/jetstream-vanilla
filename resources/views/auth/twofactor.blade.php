@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('two-factor-challenge') }}">
                        @csrf

                        <p id="authenticationText">{{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}</p>

                        <p id="recoveryText" class="d-none">{{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}</p>

                        <div id="authenticationInput" class="form-group row">
                            <label for="code" class="col-md-4 col-form-label text-md-right">{{ __('Code') }}</label>

                            <div class="col-md-6">
                                <input id="code" type="text" class="form-control" name="code"  autocomplete="one-time-code">
                            </div>
                        </div>

                        <div id="recoveryInput" class="form-group row d-none">
                            <label for="recovery_code" class="col-md-4 col-form-label text-md-right">{{ __('Recovery code') }}</label>

                            <div class="col-md-6">
                                <input id="recovery_code" type="text" class="form-control" name="recovery_code"  autocomplete="one-time-code">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                <a id="recovery" class="btn btn-link">
                                    {{ __('Use a recovery code') }}
                                </a>
                                <a id="authentication" class="btn btn-link d-none">
                                    {{ __('Use an authentication code') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        const toggle = () => {
            document.querySelector('#recovery').classList.toggle('d-none');
            document.querySelector('#recoveryInput').classList.toggle('d-none');
            document.querySelector('#recoveryText').classList.toggle('d-none');
            document.querySelector('#authentication').classList.toggle('d-none');
            document.querySelector('#authenticationInput').classList.toggle('d-none');
            document.querySelector('#authenticationText').classList.toggle('d-none');
        }

        window.addEventListener('DOMContentLoaded', e => {
            document.querySelector('#recovery').addEventListener('click', toggle);
            document.querySelector('#authentication').addEventListener('click', toggle);
        })
    </script>
@endsection
