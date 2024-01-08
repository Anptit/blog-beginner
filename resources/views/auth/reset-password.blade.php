<!DOCTYPE html>
<html>

<head>
    @include('header')
</head>

<body>
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="{{ route('auth.login') }}">
                    <img src="{{ asset('frontend/vendors/images/deskapp-logo.svg') }}" alt="" />
                </a>
            </div>
        </div>
    </div>
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="{{ asset('frontend/vendors/images/forgot-password.png') }}" alt="" />
                </div>
                <div class="col-md-6">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-primary">Reset Password</h2>
                        </div>
                        <h6 class="mb-20">Enter your new password, confirm and submit</h6>
                        @include('alert.alert')
                        <form action="{{ route('auth.reset_password_handle', ['user' => $user]) }}" method="POST">
                            @csrf
                            <div class="input-group custom">
                                <input type="password" name="old_password" class="form-control form-control-lg"
                                    placeholder="Old Password" />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                            </div>
                            @error('old_password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="input-group custom">
                                <input type="password" name="new_password" class="form-control form-control-lg"
                                    placeholder="New Password" />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                            </div>
                            @error('new_password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="input-group custom">
                                <input type="password" name="new_password_confirmation"
                                    class="form-control form-control-lg" placeholder="Confirm New Password" />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                            </div>
                            @error('new_password_confirmation')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="row align-items-center">
                                <div class="col-5">
                                    <div class="input-group mb-0">
                                        <input class="btn btn-primary btn-lg btn-block" type="submit" value="Submit">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('footer')
</body>

</html>
