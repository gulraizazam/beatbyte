@extends('frontend.layouts.default')
@section('content')
<style type="text/css">
    #regForm {
  background-color: #24519e;
  margin: 50px auto;
  padding: 40px;
  width: 70%;
  min-width: 300px;
}

/* Style the input fields */
input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

/* Mark the active step: */
.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
}
.form-col label {
  color: white;
  margin-bottom: 7px;
  display: block; 
}

.form-content {
    max-width: 645px;
    width: 100%;
    margin: 30px auto;
}

.previous {
    width: 40%;
}

.next {
    width: 40%;
    margin-right: 20px;
}

.btn-warning:not(:disabled):not(.disabled).active, .btn-warning:not(:disabled):not(.disabled):active, .show>.btn-warning.dropdown-toggle {
    color: #fff;
    background-color: #0062cc;
    border-color: #005cbf;
}

.form-control-part {
    width: 50%;
}

input#form2Gender1 {
    margin-right: 10px !important;
    margin-top: 5px;
}

input#form2Gender2 {
    margin-right: 10px !important;
    margin-top: 5px;
}
.form-content {
    max-width: 645px;
    width: 100%;
    margin: unset;
}
section.signup-container {
    position: relative;
    overflow: hidden;
    width: 757px;
    height: 500px;
    margin: 80px auto;
    background-color: #1c407c;
    -moz-box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 30px;
    -webkit-box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 30px;
    box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 30px;
}
.signup-container .half {
    float: left;
    width: 50%;
    height: 100%;
    padding: 0px;
}
section.signup-container .half.bg {
    background-image: url(https://images.pexels.com/photos/3756856/pexels-photo-3756856.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940);
    background-size: 410px;
    background-repeat: no-repeat;
}
#regForm {
    background-color: unset;
    padding: 0px 40px;
    width: 100%;
    min-width: 300px;
}
</style>
<div class="container">
    <div class="row">
        <div class="text-center logo mt-5">
            <a href="#">
                <img src="{{asset('images/beat-bytes-logo-2.png')}}" height=100 alt="Beat Bytes Logo" />
            </a>
        </div>
        <div class="signup-title text-center">
                <h4 class="text-center mt-3 text-white">Complete sign up</h4>
            </div>
    </div>
    <section class="signup-container">
    	<article class="half">
    	<div class="form-content">
		    <form id="regForm" action="{{route('register')}}"  method="post" id="wizard">
		        @csrf
		        
		        <div class="form-group form-row-group tab">
	                <label for=""> Name</label>
	                <input type="text" class="login-input-text" name="name" placeholder="Enter Your Name"style="border: 1px solid rgb(216, 216, 216);">
	                 @if ($errors->has('name'))
	                    <p class=" text-danger" >{{ $errors->first('name') }}</p>
	                 @endif
	            </div>
	            <div class="form-group form-row-group tab" style="display: block;">
	                <label for=""> Email</label>
	                <input type="email" class="login-input-text" name="email" placeholder="Enter Your Email" style="border: 1px solid rgb(216, 216, 216);">
	                 @if ($errors->has('email'))
	                    <p class=" text-danger" >{{ $errors->first('email') }}</p>
	                 @endif
		        </div>
		        
		        <div class="form-group form-row-group tab" style="display: block;">
	                <label for=""> Password</label>
	                <input type="password" class="login-input-text" name="password" placeholder="Enter Your Password" style="border: 1px solid rgb(216, 216, 216);">
	                 @if ($errors->has('password'))
	                    <p class=" text-danger" >{{ $errors->first('password') }}</p>
	                 @endif
	            </div>
	            <div class="form-group form-row-group tab">
		            <label for="" style="color: white">Confirm Password</label>
		            <input type="password" class="login-input-text" name="password_confirmation" placeholder="Confirm Password" style="border: 1px solid rgb(216, 216, 216);">
		        </div>

		        <div class="form-group form-row-group tab">
                    <label for="">Date of Birth</label><input type="date" class="login-input-text" name="date" placeholder="DD" style="border: 1px solid rgb(216, 216, 216);">
                </div>

		        <div class="form-group form-row-group tab">
					<label for="form2Gender">Gender</label>
					<div class="form-control d-flex" id="form2Gender">
						<div class="form-control-part d-flex">
							<input id="form2Gender1" type="radio" val="male" name="gender">
							<label for="form2Gender1">Male</label>
						</div>
						<div class="form-control-part">
							<input id="form2Gender2" type="radio" val="female" name="gender">
							<label for="form2Gender2">Female</label>
						</div>
					</div>
				</div>
		        
		        <div style="overflow:auto;">
		          <div class="form-group d-flex" style="text-align: center">
		            <button type="button"  class="login-button previous btn btn-warning" id="prevBtn" onclick="nextPrev(-1)" style="margin-top: 10px;margin-right: 10px;">Previous</button>
		            <button type="button" class="login-button next btn btn-primary" id="nextBtn" onclick="nextPrev(1)" style="margin-top: 10px;">Next</button>
		          </div>
		        </div>
		        <!-- Circles which indicates the steps of the form: -->
		        <div style="text-align:center;margin-top:40px;">
		          <span class="step"></span>
		          <span class="step"></span>
		          <span class="step"></span>
		          
		        </div>
		    </form>
	    </article>
	    <div class="half bg" style="background-position: -32.2px -29.8889px;"></div>
    </section>
</div>
    @stop
    @section('scripts')
    <script type="text/javascript">
        var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
      // This function will display the specified tab of the form ...
      var x = document.getElementsByClassName("tab");
      x[n].style.display = "block";
      // ... and fix the Previous/Next buttons:
      if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
      } else {
        document.getElementById("prevBtn").style.display = "inline";
      }
      if (n == (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "Submit";
      } else {
        document.getElementById("nextBtn").innerHTML = "Next";
      }
      // ... and run a function that displays the correct step indicator:
      fixStepIndicator(n)
    }

    function nextPrev(n) {
      // This function will figure out which tab to display
      var x = document.getElementsByClassName("tab");
      // Exit the function if any field in the current tab is invalid:
      if (n == 1 && !validateForm()) return false;
      // Hide the current tab:
      x[currentTab].style.display = "none";
      // Increase or decrease the current tab by 1:
      currentTab = currentTab + n;
      // if you have reached the end of the form... :
      if (currentTab >= x.length) {
        //...the form gets submitted:
        document.getElementById("regForm").submit();
        return false;
      }
      // Otherwise, display the correct tab:
      showTab(currentTab);
    }

    function validateForm() {
      // This function deals with validation of the form fields
      var x, y, i, valid = true;
      x = document.getElementsByClassName("tab");
      y = x[currentTab].getElementsByTagName("input");
      // A loop that checks every input field in the current tab:
      for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
          // add an "invalid" class to the field:
          y[i].className += " invalid";
          // and set the current valid status to false:
          valid = false;
        }
      }
      // If the valid status is true, mark the step as finished and valid:
      if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
      }
      return valid; // return the valid status
    }

    function fixStepIndicator(n) {
      // This function removes the "active" class of all steps...
      var i, x = document.getElementsByClassName("step");
      for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
      }
      //... and adds the "active" class to the current step:
      x[n].className += " active";
    }
    </script>
    @endsection