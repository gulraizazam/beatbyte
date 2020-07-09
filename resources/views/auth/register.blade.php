<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Beat Byte</title>
  <!-- Mobile Specific Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <!-- Font-->
  <link rel="stylesheet" type="text/css" href="{{asset('registor/css/muli-font.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('registor/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css')}}">
  <!-- datepicker -->
  <link rel="stylesheet" type="text/css" href="{{asset('registor/css/jquery-ui.min.css')}}">
  <!-- Main Style Css -->
    <link rel="stylesheet" href="{{asset('registor/css/style.css')}}"/>
</head>
<body>
  <div class="page-content" style="background-image: linear-gradient(to bottom, #3477e8 0, #000 50%);">
    <div class="wizard-v2-content">
      <div class="wizard-image">
      </div>
      <div class="wizard-form">
        <div class="row" style="display: flex; flex-wrap: wrap; justify-content: center; margin-bottom: 20px;">
            <div class="text-center logo mt-100px">
                <a href="http://beatbyte.co">
                    <img src="/public/images/beat-bytes-logo-22.png" height="100" alt="Beat Bytes Logo">
                </a>
            </div>
        </div>
        <div class="wizard-header">
          <h3>Register</h3>
          <p>Fill Out These Fields To Create Account.</p>
        </div>
            <form class="form-register" action="{{route('register')}}" method="post" id="registerform">
              @csrf
              <div id="form-total">
                <!-- SECTION 1 -->
                  <h2>1</h2>
                  <section>
                      <div class="inner">
                <div class="form-row ">
                  <div class="form-holder form-holder-2">
                    <input type="text" placeholder="Name" class="form-control" id="first_name" name="username">
                    @if ($errors->has('username'))
                    <p class=" text-danger" style="color: red">{{ $errors->first('username') }}</p>
                  @endif
                  </div>
                  
                </div>
                <div class="form-row">
                  <div class="form-holder">
                    <input type="text" placeholder="Phone Number" class="form-control" id="phone">
                  </div>
                  <div class="form-holder">
                    <input type="email" placeholder="Email" class="form-control" id="email" name="email">
                     @if ($errors->has('email'))
                    <p class=" text-danger" style="color: red">{{ $errors->first('email') }}</p>
                  @endif
                  </div>
                </div>
              </div>
                  </section>
            <!-- SECTION 2 -->
                  <h2>2</h2>
                  <section>
                      <div class="inner">
                <div class="form-row">
                  <div class="form-holder form-holder-2">
                    <input type="password" placeholder="Password" class="form-control" id="pass" name="password">
                    @if ($errors->has('password'))
                    <p class=" text-danger" style="color: red">{{ $errors->first('password') }}</p>
                  @endif
                  </div>
                </div>
               <div class="form-row">
                  <div class="form-holder form-holder-2">
                    <input type="password" placeholder="Confirm Password" class="form-control" id="pass" name="password_confirmation">
                    @if ($errors->has('password_confirmation'))
                    <p class=" text-danger" style="color: red">{{ $errors->first('password_confirmation') }}</p>
                  @endif
                  </div>
                </div>
              </div>
                  </section>
                  
              </div>
            </form>
      </div>
    </div>
  </div>
  <script src="{{asset('registor/js/jquery-3.3.1.min.js')}}"></script>
  <script src="{{asset('registor/js/jquery.steps.js')}}"></script>
  <script src="{{asset('registor/js/jquery-ui.min.js')}}"></script>
  <script src="{{asset('registor/js/main.js')}}"></script>
</body>
</html>