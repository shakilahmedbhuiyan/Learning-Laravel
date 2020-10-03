@extends('layouts.user')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('User Dashboard') }}</div>

                    <div class="card-body">

                        <!-- Success message -->
                        @if(Session::has('success'))
                            <div class="alert alert-success">
                                {{Session::get('success')}}
                            </div>
                        @endif
                        <!-- Error message -->
                        @if(Session::has('error'))
                            <div class="alert alert-success">
                                {{Session::get('error')}}
                            </div>
                        @endif


                        <div class="row">

                            <!--   Image update form -->
                            <div class="col-md-3 mx-2 my-2 card-body border-right border-info">
                                <form method="post" action="{{ route('editProfileImage.user') }}"
                                      enctype="multipart/form-data">
                                    @csrf

                                    <img src=" @if(Auth::user()->avatar)
                                    {{ Storage::url( Auth::user()->avatar)}}
                                    @else
                                    {{ Storage::url('user/avatarDefault.png') }}
                                    @endif "
                                         id="avatar" alt="{{__('user Image')}}"
                                         class="img-fluid" width="200px"/>

                                    <div class="form-group">

                                        <div class="custom-file">
                                            <input type="file"
                                                   class="custom-file-input @error('avatar') is-invalid @enderror"
                                                   name="avatar" required id="profile-img"
                                                   accept="image/jpeg, image/png"
                                                   onchange="previewImage(this,'avatar')">
                                            <label class="custom-file-label" for="inputGroupFile03">Choose file</label>
                                        </div>
                                        @error('avatar')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group ">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Change Image') }}
                                            </button>
                                    </div>


                                </form>
                            </div>


                            <!--  Profile update form -->
                            <form class="form-horizontal col-md" method="post" action="{{ route('editProfile.user') }}"
                                  enctype="multipart/form-data">
                            @csrf

                                <div class="form-group row">
                                    <label for="name"
                                           class="col-md-3 col-form-label text-md-right">{{ __('Name') }}</label>

                                    <div class="col-md-8">
                                        <input id="name" type="text"
                                               class="form-control @error('name') is-invalid @enderror" name="name"
                                               value="{{ Auth::user()->name }}" required autocomplete="name"
                                               autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email"
                                           class="col-md-3 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-8">
                                        <input id="email" type="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               name="email"
                                               value="{{ Auth::user()->email }}" required autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Update') }}
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
