@extends('layouts.user')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <span class="text-left float-lg-left">{{ __('User Dashboard') }}</span>
                        <a class="btn btn-outline-primary float-right" href="{{ route('editProfile.user') }}"><i
                                class="fas fa-user-edit"></i></a>
                    </div>

                    <div class="card-body">
                        <!-- Success message -->
                        @if(Session::has('success'))
                            <div class="alert alert-success">
                                {{Session::get('success')}}
                            </div>
                        @endif
                        <div class="row mx-2 my-2 d-flex">

                            <div class="col-md-3 ">
                                <img src=" @if(Auth::user()->avatar)
                                {{ Storage::url( Auth::user()->avatar)}}
                                @else
                                {{ Storage::url('user/avatarDefault.png') }}
                                @endif "
                                     alt="{{__('user Image')}}" class="img-fluid  justify-content-center" width="200px"/>
                            </div>
                            <div class="col-md text-left">
                                <div class="col-sm-12">
                                    <label>Name:</label>
                                    <span>{{Auth::user()->name}}</span>
                                </div>
                                <div class="col-sm-12">
                                    <label>Email:</label>
                                    <span>{{Auth::user()->email}}</span>
                                </div>
                                <div class="col-sm-12">
                                    <label>Profile Crated:</label>
                                    <span>{{Auth::user()->created_at}}</span>
                                </div>
                                <div class="col-sm-12">
                                    <label>Last Update:</label>
                                    <span>{{Auth::user()->updated_at}}</span>
                                </div>

                                <div class="col-sm-12 mt-2">
                                    <a type="button" href="{{ route('password.user') }}" class="btn btn-outline-info">
                                        {{ __('Change Password') }} <i class="fas fa-key"></i>
                                    </a>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
