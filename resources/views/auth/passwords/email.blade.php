<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="{{ asset('img/logo.png') }}" type="image/ico" />

    <title>Eagles Membership Management System</title>

    <!-- Bootstrap -->
    <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="{{ asset('vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{ asset('vendors/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('build/css/custom.min.css') }}" rel="stylesheet">
  </head>

  <body class="login">
  <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
          <img src="{{ asset('img/logo.png') }}" alt="" style="width:150px;">
		  <form method="POST" action="{{ route('password.email') }}">
          @csrf	
			  <h1>Reset Password</h1>
			  
			  {{ csrf_field() }}
			@if (session('error'))
				
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    {{ session('error') }}
                  </div>
			@endif
            @if ($errors->has('email'))
                        <div class="alert alert-danger alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <strong>{{ $errors->first('email') }}</strong>
                        </div>
                    @endif
              <div>
              
			  <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                    
              </div>
             
              <div>
			  <button class="btn btn-default submit" type="submit">Send Password Reset Link</button>
                <!-- <a class="reset_pass" href="#">Lost your password?</a> -->
              </div>

              

              <div class="clearfix"></div>

              <div class="separator">
               

                <div class="clearfix"></div>
                <br />

                <div>
                 
                  <p>© 2019 All Rights Reserved. </p>
                </div>
              </div>
            </form>
          </section>
        </div>	
</div>



<script src="{{ asset('js/jquery-1.7.2.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>

<script src="{{ asset('js/signin.js') }}"></script>

</body>

</html>


