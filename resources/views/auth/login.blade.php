<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

@extends('frontend.index')


@section('content')



<br><br><br>

<div class="body-content">
	<div class="container">
		<div class="sign-in-page">
			<div class="row">

				<!-- Sign-in -->
<div class="col-md-6 col-sm-6 sign-in">
	<br><br>
	<h3>Hello, Welcome to your account.</h3>






	<form method ="post" action =" {{route('login')}}"class="register-form outer-top-xs" role="form">
        @csrf
        @if(Session::has('error'))
        <div class="alert alert-danger" role="alert">
           {{Session::get('error')}}
          </div>
        @endif
		<div class="form-group">
		    <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
		    <input type="email" name="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" >
		</div>


        <div class="form-group">

        @if(Session::has('succ'))
        <div class="alert alert-success" role="alert"  timer= "5000">
            {{Session::get('succ')}} </div> @endif
        </div>

	  	<div class="form-group">
		    <label class="info-title" for="exampleInputPassword1">Password <span>*</span></label>
		    <input type="password" name="password" class="form-control unicase-form-control text-input" id="exampleInputPassword1" >
		</div>
		<div class="radio outer-xs">

		  	<a href="" class="forgot-password pull-right">Forgot your Password?</a>
		</div>
	  	<button type="submit" class="btn-upper btn btn-primary checkout-page-button">Login</button>
	</form>
</div>
<!-- Sign-in -->

<!-- create a new account -->
<div class="col-md-6 col-sm-6 create-new-account">
    <br><br>
    <h3 class="checkout-subtitle">Create your new account</h3>

	<form method="post" action ="{{route('register') }}"class="register-form outer-top-xs" role="form">
		@csrf

        @if(Session::has('error'))
        <div class="form-group">
	    	<label class="info-title" for="exampleInputEmail2">{{Session::get('error')}}</label>
	  	</div>
        @endif
        <div class="form-group">
	    	<label class="info-title" for="exampleInputEmail2" ><h6>Email Address<span>*</span> </h6></label>
	    	<input type="email"name ="email" class="form-control unicase-form-control text-input" id="exampleInputEmail2" >
	  	</div>
        <div class="form-group">
		    <label class="info-title" for="exampleInputEmail1"><h6>Name <span>*</span></h6></label>
		    <input type="text" name="name"class="form-control unicase-form-control text-input" id="exampleInputEmail1" >
		</div>

        <div class="form-group">
		    <label class="info-title" for="exampleInputEmail1"><h6>Password <span>*</span></h6></label>
		    <input type="password" name="password" class="form-control unicase-form-control text-input" id="exampleInputEmail1" >
		</div>
         <div class="form-group">
		    <label class="info-title" for="exampleInputEmail1"><h6>Confirm Password <span>*</span></h6></label>
		    <input type="password" name="password_confirmation" class="form-control unicase-form-control text-input" id="password_confirmation" >
		</div>
        <input type="radio"  name="userType" value="1">
  <label for="seller">seller</label>
 
  <input type="radio"  name="userType" value="0">
  <label for="buyer">buyer</label><br>

	  	<button type="submit" class="btn-upper btn btn-primary checkout-page-button">Sign Up</button>
	</form>

    <br><br><br><br><br>
</div>





@endsection
