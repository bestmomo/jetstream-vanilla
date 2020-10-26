<h3 class="twoFactorDisabled">{{ __('You have enabled two factor authentication.') }}</h3>

<p>{{ __("When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone's Google Authenticator application.") }}</p> 

<div class="twoFactorEnabled">
    @empty($done)
        <p>{{ __('Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application.') }}</p>

        <p>{!! $user->twoFactorQrCodeSvg() !!}</p>
    @endempty

    <div id="codesShow" class="@isset($done) d-none @endisset">
        <p>{{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.') }}
        </p>

        <div id="codes" class="alert alert-secondary">
            @include('profile.codes')
        </div>
    </div>

    <div class="form-group row mb-0">
      <div class="col-md-12">
          <button class="btn btn-light @isset($done) d-none @endisset" id="regenerate">
              {{ __('REGENERATE RECOVERY CODES') }}
          </button>
          <button class="btn btn-light @empty($done) d-none @endempty" id="show">
              {{ __('SHOW RECOVERY CODES') }}
          </button>
          <button class="btn btn-danger" id="disable">
              {{ __('Disable') }}
          </button> 
      </div>
    </div>
</div>   

