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




    <x-auth-session-status class="mb-4" :status="session('status')" />


	<form method ="post" action ="{{ route('login') }}"class="register-form outer-top-xs" >
        @csrf
        @if(Session::has('error'))
        <div class="alert alert-danger" role="alert">
           {{Session::get('error')}}
          </div>
        @endif



        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>





        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>


        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif


        </div>


	  	<button type="submit" class="btn-upper btn btn-primary checkout-page-button"> loginn </button>
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
        @if(Session::has('succ'))
        <div class="alert alert-success" role="alert"  timer= "5000">
            {{Session::get('succ')}} </div> @endif
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
