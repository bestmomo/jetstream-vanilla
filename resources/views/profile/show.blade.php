@extends('layouts.app')

@section('content')

<div class="modal fade" id="passwordConfirmation" tabindex="-1" aria-labelledby="passwordConfirmation" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="passwordConfirmation">{{ __('Confirm Password') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="confirmPassword">{{ __('For your security, please confirm your password to continue.') }}</label>
          <input id="confirmPassword" name="password" type="password" placeholder="Password" class="form-control">
          <span class="invalid-feedback"  role="alert">
              <div id="errorPassword"></div>
          </span>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('NEVERMIND') }}</button>
        <button id="confirm" type="button" class="btn btn-primary">{{ __('CONFIRM') }}</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteAccount" tabindex="-1" aria-labelledby="deleteAccount" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="passwordConfirmation">{{ __('Delete Account') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="deletePassword">{{ __('Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}</label>
          <input id="deletePassword" name="deletePassword" type="password" placeholder="Password" class="form-control">
          <span class="invalid-feedback"  role="alert">
              <div id="deletePasswordError"></div>
          </span>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('NEVERMIND') }}</button>
        <button id="confirmDelete" type="button" class="btn btn-danger">{{ __('DELETE ACCOUNT') }}</button>
      </div>
    </div>
  </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updateProfileInformation()))
              <div class="card">
                  <div class="card-header">{{ __('Profile Information') }}</div>

                  <div class="card-body">
                      <form id="informations">

                          <div class="form-group row">
                              <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                              <div class="col-md-6">
                                  <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>
                                  <span class="invalid-feedback" role="alert">
                                      <div id="nameError"></div>
                                  </span>
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                              <div class="col-md-6">
                                  <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required autocomplete="email">
                                  <span class="invalid-feedback" role="alert">
                                      <div id="nameError"></div>
                                  </span>
                              </div>
                          </div>


                          <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">                                
                                <button id="informationsSubmit" type="submit" class="btn btn-primary float-right">
                                    {{ __('Save') }}
                                </button>
                            </div>
                          </div>
                      </form>
                  </div> 
              </div>
            @endif

            <br>
            
            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
              <div class="card">
                  <div class="card-header">{{ __('Update Password') }}</div>
              
                  <div class="card-body">
                    <form id="passwords">

                        <div class="form-group row">
                            <label for="current_password" class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}</label>
                            <div class="col-md-6">
                                <input id="current_password" type="password" class="form-control" name="current_password" required>
                                <span class="invalid-feedback" role="alert">
                                  <div id="current_passwordError"></div>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                                <span class="invalid-feedback" role="alert">
                                  <div id="passwordError"></div>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                          <div class="col-md-6 offset-md-4">
                              <button id="passwordsSubmit" type="submit" class="btn btn-primary float-right">
                                  {{ __('Save') }}
                              </button>
                          </div>
                        </div>
                    </form>
                  </div> 
              </div>
            @endif

            <br>

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
              <div class="card">

                  <div id="towFactorContent" class="card-body">
                      @if(empty($user->two_factor_secret))
                          @include('profile.disabled')
                      @else
                          @include('profile.enabled', ['done' => true])
                      @endif
                  </div> 

              </div>

              <br>
            @endif

            <div class="card">
              <div class="card-header">{{ __('Two Factor Authentication') }}</div>

              <div id="towFactorContent" class="card-body">
                  <p>{{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}</p>
                  <div class="form-group row mb-0">
                      <div class="col-md-6">                                  
                          <button class="btn btn-danger" id="delete">
                              {{ __('DELETE ACCOUNT') }}
                          </button>                                   
                      </div>
                  </div>
              </div>

           </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>

        // Variables
        let intended = null;

        // Show errors
        const showErrors = (data) => {
          for (let item in data.errors) {
              document.querySelector('#' + item).classList.add('is-invalid');
              document.querySelector('#' + item + 'Error').textContent = data.errors[item][0];
          }
        }

        // Headers
        const headers = () => { 
            return { 
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            };
        }

        // Form submission
        const formSubmission = async (e, form, url) => {
            e.preventDefault();

            // Get all inputs names and values and clean errors
            let datas = {};            
            document.querySelectorAll('#' + form + ' input').forEach(function(input) { 
                let element = input.getAttribute('id');
                document.querySelector('#' + element).classList.remove('is-invalid');
                datas[element] = document.querySelector('#' + element).value;
            });

            // Send request
            let response = await fetch(url, { 
                method: 'PUT',
                headers: headers(),
                body: JSON.stringify(datas)
            });

            // Wait for response
            let data = await response.json();

            // Manage response
            if(response.status == 422) {
                showErrors(data);
            } else {
                document.querySelector('#' + form + 'Submit').textContent = "{{ __('Saved !') }}";
                setTimeout(() => document.querySelector('#' + form + 'Submit').textContent = "{{ __('Save') }}", 1000)
            }         
        }

        // Confirm password submission
        const confirmSubmission = async () => {  
            // Send request          
            const response = await fetch('{{ url("user/confirm-password") }}', { 
                method: 'POST',
                headers: headers(),
                body: JSON.stringify({ 
                    password: document.querySelector('#confirmPassword').value, 
                })
            });

            // Wait for response
            const data = await response.json();

            // Manage response
            if(response.status == 422) {
                document.querySelector('#confirmPassword').classList.add('is-invalid');
                document.querySelector('#errorPassword').textContent = data.errors.password;
            } else {
                $('#passwordConfirmation').modal('hide');
                // Manage intended
                switch(intended) {
                  case 'enable': 
                    enable2factor();
                    break;
                  case 'disable': 
                    disable2factor();
                    break;
                  case 'regenerate':
                    regenerate();
                    break;
              }
            }   
        }

        // Enable 2 factor
        const enable2factor = async () => {
          // Check password confirmation
          const confirmed = await passwordConfirmation('enable');

          // If OK
          if(confirmed)
          {
            // Send request
            const response = await fetch('{{ route("profile.enabletwofactors") }}', { 
              method: 'PUT',
              headers: headers()
            });

            // Wait for response
            const data = await response.json();

            // Manage DOM and events
            document.querySelector('#towFactorContent').innerHTML = data.view;
            document.querySelector('#disable').addEventListener('click', disable2factor);            
            document.querySelector('#regenerate').addEventListener('click', regenerateCodes);
          }             
        }

        // Disable 2 factor
        const disable2factor = async () => {
          // Check password confirmation
          let confirmed = await passwordConfirmation('disable');

          // If OK
          if(confirmed)
          {
            // Send request
            let response = await fetch('{{ route("profile.disabletwofactors") }}', { 
              method: 'PUT',
              headers: headers()
            });

            // Wait for response
            let data = await response.json();

            // Manage DOM and events
            document.querySelector('#towFactorContent').innerHTML = data.view;
            document.querySelector('#enable').addEventListener('click', enable2factor);
          }             
        }

        // Codes regeneration
        const regenerateCodes = async () => {
          // Check password confirmation
          const confirmed = await passwordConfirmation('regenerate');

          // If OK
          if(confirmed) {
            // Send request
            const response = await fetch('{{ route("profile.generateNewRecoveryCodes") }}', { 
                method: 'PUT',
                headers: headers()
            });

            // Wait for response
            const data = await response.json();

            // Manage DOM
            document.querySelector('#codes').innerHTML = data.view;
          }
        };

        // Check password confirmation
        const passwordConfirmation = async (referer) => {
            intended = referer;
            const response = await fetch('{{ route("password.confirmation") }}');
            const data = await response.json();
            if(data.confirmed) {              
                return true;
            } else {
                document.querySelector('#confirmPassword').classList.remove('is-invalid');
                $('#passwordConfirmation').modal();
                return false;
            }           
        }

        // Show 2 factor codes
        const showCodes = () => {
            document.querySelector('#codesShow').classList.toggle('d-none');
            document.querySelector('#show').classList.toggle('d-none');
            document.querySelector('#regenerate').classList.toggle('d-none');
        };

        // Install click events
        const setClickEvent = (id, callback) => {
            let button = document.querySelector(id);
            if(button !== null) button.addEventListener('click', callback);          
        }

        // Delete account
        const deleteAccount = async () => {

            // Send request
            const response = await fetch('{{ route("profile.deleteAccount") }}', { 
                method: 'PUT',
                headers: headers(),
                body: JSON.stringify({
                    deletePassword: document.querySelector('#deletePassword').value
                })
            });

            // Wait for response
            const data = await response.json();

            // Manage response
            if(response.status == 422) {
                showErrors(data);
            } else {
                document.location.href='{{ url('/') }}';
            }
        }

        window.addEventListener('DOMContentLoaded', e => {

            document.querySelector('#informations').addEventListener('submit', e => formSubmission(
              e,
              'informations', 
              '{{ route("user-profile-information.update") }}'
            ), false);

            document.querySelector('#passwords').addEventListener('submit', e => formSubmission(
              e,
              'passwords', 
              '{{ route("user-password.update") }}'              
            ), false);

            setClickEvent('#confirm', confirmSubmission);
            setClickEvent('#confirmDelete', deleteAccount);
            setClickEvent('#enable', enable2factor);
            setClickEvent('#disable', disable2factor);
            setClickEvent('#regenerate', regenerateCodes);
            setClickEvent('#show', showCodes);
            setClickEvent('#delete', () => $('#deleteAccount').modal());
        })
    </script>
@endsection