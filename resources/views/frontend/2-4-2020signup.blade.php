@extends('frontend.layouts.default_black')
@section('content')

<div class="container">
        <div class="row">
            <div class="text-center logo mt-5">
                <a href="index.html">
                    <img src="{{asset('images/beat-bytes-logo-2.png')}}" height=100 alt="Beat Bytes Logo" />
                </a>
            </div>
            <div class="signup-title text-center">
                <h4 class="text-center mt-3 text-white">Complete sign up</h4>
            </div>
        </div>
        <div class="row">
            <div class="form-content">
                <form action="{{route('user.getRegister')}}" method="post">
                	@csrf
                    <div class="form-group login-form-group mb-0">
                        <label class="input-label mb-0">Your username</label>
                        <input type="text" id="input-username" name="username" placeholder="Set a username for your profile" class="login-input-text" style="border: 1px solid rgb(216, 216, 216)" />
                        @if ($errors->has('username'))
		                    <p class=" text-danger" >{{ $errors->first('username') }}</p>
		                 @endif
                    </div>
                    <div class="form-group login-form-group mb-0">
                        <label class="input-label mb-0">Your e-mail</label>
                        <input type="text" name="email" id="input-email" placeholder="Type your e-mail" class="login-input-text"
                            style="border: 1px solid rgb(216, 216, 216)" />
                        @if ($errors->has('email'))
		                    <p class=" text-danger" >{{ $errors->first('email') }}</p>
		                @endif
                    </div>
                    <div class="form-group login-form-group mb-0">
                        <label class="input-label mb-0">Password</label>
                        <input type="password" name="password" id="input-password" placeholder="Type your password"
                            class="login-input-text" style="border: 1px solid rgb(216, 216, 216)" />
                             @if(session()->has('error'))
                                <p class="text text-danger">{{ session()->get('error') }}</p>
                            @endif
                        @if ($errors->has('password'))
		                    <p class=" text-danger" >{{ $errors->first('password') }}</p>
		                @endif
                    </div>
                    <div class="form-group login-form-group mb-0">
                        <label class="input-label mb-0">Confirm Password</label>
                        <input type="password" name="confirmpassword" id="input-confirm-password" placeholder="Type your password again"
                            class="login-input-text" style="border: 1px solid rgb(216, 216, 216)" />
                             @if(session()->has('error'))
                                <p class="text text-danger">{{ session()->get('error') }}</p>
                            @endif
                        @if ($errors->has('confirmpassword'))
		                    <p class=" text-danger" >{{ $errors->first('confirmpassword') }}</p>
		                @endif
                    </div>
                    <input type="hidden" name="uniqueid" value="{{$unique}}">
                    <button class="login-button centered-aligned" type="submit">Sign Up</button>
                    <div class="policy-text max-width-340 centered-aligned">
                        By signing up, you agree to our <a href="#">Terms & Services</a></br>& <a href="#">Privacy
                            Policy</a>.
                    </div>
                </form>
            </div>
            </di>
        </div>
    </div>
    @stop