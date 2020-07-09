@extends('frontend.layouts.default')
@section('content')
    <div class="container">

        <div class="row">
            <div class="text-center logo mt-100px">
                <a href="{{route('index')}}">
                    <img src="{{asset('images/beat-bytes-logo-2.png')}}" height=100 alt="Beat Bytes Logo" />
                </a>
            </div>
            <div class="signup-title text-center">
               
                <h4 class="text-center text-white mt-3">Log in to continue</h4>
                 @if(session()->has('success'))
                    <p class="text text-success">{{ session()->get('success') }}</p>
                    <?php
                    Session::forget('success');
                    ?>
                @endif
            </div>
        </div>
        
        <div class="row">
            <div class="form-content">
                <form method="POST" action="{{route('postlogin')}}">
                    @csrf
                    <div class="form-group login-form-group">
                        <label class="input-label mb-0">Email </label>
                        <input type="email" name="email" id="input-username" placeholder="Type your username or email"
                            class="login-input-text" style="border: 1px solid rgb(216, 216, 216)" />
                             @if(session()->has('error'))
                                <p class="text text-danger">{{ session()->get('error') }}</p>
                                <?php
                                Session::forget('error');
                                ?>
                            @endif
                            @if(session()->has('status'))
                                <p class="text text-danger">{{ session()->get('status') }}</p>
                               
                            @endif
                        @if ($errors->has('email'))
                            <p class=" text-danger" >{{ $errors->first('email') }}</p>
                        @endif
                    </div>
                    <div class="form-group login-form-group">
                        <a href="{{ route('password.request') }}" class="forgot-password-text">Forgot Password?</a>
                        <label class="input-label mb-0">Password</label>
                        <input type="password" name="password" id="input-password" placeholder="Type your password" class="login-input-text"
                            style="border: 1px solid rgb(216, 216, 216)" />
                        @if ($errors->has('password'))
                            <p class=" text-danger" >{{ $errors->first('password') }}</p>
                        @endif
                    </div>
                    <button class="login-button" type="submit">Login</button>
                </form>
                <div class="form-footer">
                    Don't have an account? <span style="color: red"><a href="{{url('signup')}}">Sign up</a></span>
                </div>
            </div>
            </di>
        </div>
    </div>
@stop
    