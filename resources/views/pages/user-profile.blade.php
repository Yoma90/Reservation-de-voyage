@extends('layouts.user_type.auth')

@section('content')
<div>
    <div class="container-fluid">
        <div class="page-header min-height-250 border-radius-xl mt-4" style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
            <span class="mask bg-gradient-primary opacity-6"></span>
        </div>
        <div class="card card-body blur shadow-blur mx-4 mt-n6">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <style>
                            #letter {
                                color: black;
                                font-weight: bold;
                                font-size: 40px;
                                font-style: italic;
                                margin: 0;
                                padding: 0;
                            }
                        </style>
                        <div class="initials-letter">
                            <span id="letter" class="letter-{{ auth()->user()->first_name[0] }}">
                                {{ strtoupper(auth()->user()->first_name[0]) }}
                            </span>
                            <span id="letter" class="letter-{{ auth()->user()->last_name[0] }}">
                                {{ strtoupper(auth()->user()->last_name[0]) }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ (auth()->user()->first_name) }} {{ (auth()->user()->last_name) }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            {{ (auth()->user()->role->name) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Profile Information') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="/user-profile" method="POST" role="form text-left">
                    @csrf
                    @if ($errors->any())
                    <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                        <span class="alert-text text-white">
                            {{ $errors->first() }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <i class="fa fa-close" aria-hidden="true">qezedze</i>
                        </button>
                    </div>
                    @endif
                    @if (session('success'))
                    <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                        <span class="alert-text text-white">
                            {{ session('success') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <i class="fa fa-close" aria-hidden="true"></i>
                        </button>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-name" class="form-control-label">{{ __('First Name') }}</label>
                                <div class="@error('user.name')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ auth()->user()->first_name }}" type="text" placeholder="First Name" id="first-name" name="first_name">
                                    @error('name')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-name" class="form-control-label">{{ __('Last Name') }}</label>
                                <div class="@error('user.name')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ auth()->user()->last_name }}" type="text" placeholder="Last Name" id="last-name" name="last_name">
                                    @error('name')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-email" class="form-control-label">{{ __('Email') }}</label>
                                <div class="@error('email')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ auth()->user()->email }}" type="email" placeholder="@example.com" id="user-email" name="email" disabled>
                                    @error('email')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-name" class="form-control-label">{{ __('Role') }}</label>
                                <div class="@error('user.name')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="System administrator" type="text" id="user-role" name="role" placeholder="Role" disabled>
                                    @error('role')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user.phone" class="form-control-label">{{ __('Phone') }}</label>
                                <div class="@error('user.phone')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="tel" id="number" name="phone" value="{{ auth()->user()->phone }}">
                                    @error('phone')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user.location" class="form-control-label">{{ __('Location') }}</label>
                                <div class="@error('user.location') border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="Location" id="name" name="location" value="{{ auth()->user()->location }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Save Changes' }}</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Change password') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">

                <form action="/change-password" method="POST" role="form text-left">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="old-password" class="form-control-label">{{ __('Old password') }}</label>
                                <div class="('old-password')border border-danger rounded-3 ">
                                    <input class="form-control" value="" type="password" required placeholder="Enter old password" id="old-password" name="old_password">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="new-password" class="form-control-label">{{ __('New password') }}</label>
                                <div class="('new-password')border border-danger rounded-3 ">
                                    <input class="form-control" value="" type="password" required minlength="8" placeholder="Enter new password" id="new-password" name="new_password">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="confirm-password" class="form-control-label">{{ __('Confirm password') }}</label>
                                <div class="('confirm-password')border border-danger rounded-3 ">
                                    <input class="form-control" value="" type="password" required placeholder="confirm password" id="confirm-password" name="c_password">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Change password' }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
