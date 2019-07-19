@extends('layouts.authlayouts')

@section('content')
<form action="{{ route('userLogin') }}" method="post">
          @csrf	
			  <h1>Portal Login</h1>
			  
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
              
			  <input id="username" type="text" class="form-control{{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') ?: old('email') }}" required autofocus>
                    
              </div>
              <div>
              

			  <input type="password" id="password" name="password" value="" placeholder="Password" class="login password-field form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" required/>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
              </div>
              <div>
			  <button class="btn btn-default submit" type="submit">Sign In</button>
                <!-- <a class="reset_pass" href="#">Lost your password?</a> -->
              </div>

              <div class="form-group row">
                    <div class="col-md-6 ">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-8 ">
        
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-0">
                    
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
@endsection
