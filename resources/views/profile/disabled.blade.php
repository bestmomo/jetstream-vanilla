<h3 class="twoFactorEnabled">{{ __('You have not enabled two factor authentication.') }}</h3>

<p>{{ __("When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone's Google Authenticator application.") }}</p> 

<div class="form-group row mb-0 twoFactorDisabled">
    <div class="col-md-6">                                  
        <button class="btn btn-primary" id="enable">
            {{ __('Enable') }}
        </button>                                   
    </div>
</div>

