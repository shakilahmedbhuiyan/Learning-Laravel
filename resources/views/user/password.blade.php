@extends('layouts.user')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <span class="float-left">
                             {{ __('User Dashboard') }}
                        </span>
                        <span class="float-right">
                            <a href="{{ url()->previous()}}" class="btn btn-outline-primary"><i class="fas fa-undo"></i></a>
                        </span>
                    </div>

                    <div class="card-body">
                        <div class="card-title border-bottom border-warning">
                            <p class="text-center test-strong">
                                {{ __('Password Update') }}
                            </p>
                        </div>
                        <!-- Success message -->
                        @if(Session::has('success'))
                            <div class="alert alert-success">
                                {{Session::get('success')}}
                            </div>
                        @endif
                    <!-- Error message -->
                        @if(Session::has('error'))
                            <div class="alert alert-warning">
                                {{Session::get('error')}}
                            </div>
                        @endif


                        <div class="row">

                            <!--  Profile update form -->
                            <form class="password-strength form-horizontal col-md" method="post"
                                  action="{{ route('passwordUpdate.user') }}"
                                  enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row">
                                    <label for="oldPassword"
                                           class="col-md-3 col-form-label text-md-right">{{ __('Old Password') }}</label>

                                    <div class="col-md-8">
                                        <input id="oldPassword" type="password"
                                               class="form-control @error('oldPassword') is-invalid @enderror"
                                               name="oldPassword"
                                               required autocomplete="password"
                                               autofocus placeholder="Current Password">

                                        @error('oldPassword')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="newPassword"
                                           class="col-md-3 col-form-label text-md-right">{{ __('New Password') }}</label>

                                    <div class="col-md-8 input-group">

                                        <input
                                            class="password-strength__input form-control @error('newPassword') is-invalid @enderror"
                                            type="password" id="newPassword"
                                            aria-describedby="passwordHelp" placeholder="Enter New password"
                                            name="newPassword" required autocomplete="new-password"/>

                                        <div class="input-group-append">
                                            <button
                                                class="password-strength__visibility border-left-0 btn btn-outline-secondary"
                                                type="button">
                                                <span class="password-strength__visibility-icon"
                                                      data-visible="hidden">
                                                    <i class="fas fa-eye-slash"></i></span>
                                                <span class="password-strength__visibility-icon js-hidden"
                                                      data-visible="visible">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                            </button>
                                        </div>

                                        <div>
                                            <!-- password strength indicator -->
                                            <small class="password-strength__error text-danger js-hidden">
                                                This symbol is not allowed!
                                            </small>
                                            <small class="form-text text-muted mt-2" id="passwordHelp">
                                                Add 9 characters or more, lowercase letters, uppercase letters, numbers
                                                and symbols to make the password really strong!
                                            </small>

                                            <div class="password-strength__bar-block progress mb-4">
                                                <div class="password-strength__bar progress-bar bg-danger"
                                                     role="progressbar"
                                                     aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>

                                        </div>
                                        @error('newPassword')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>

                                <!-- ------------------------------- -->

                                <div class="form-group row">
                                    <label for="confirmPassword"
                                           class="col-md-3 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                    <div class="col-md-8">
                                        <input id="confirmPassword" type="password"
                                               class="form-control @error('confirmPassword') is-invalid @enderror"
                                               name="confirmPassword" required autocomplete="new-password"
                                               placeholder="Retype New Password">

                                        @error('confirmPassword')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit"
                                                class="password-strength__submit btn btn-primary d-flex m-auto"
                                                disabled="disabled">
                                            {{ __('Change Password') }}
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
