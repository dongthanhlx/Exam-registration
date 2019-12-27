@extends('layouts.student')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <!-- <div class="panel-heading">Login</div> -->
                <div class="panel-body float-right ">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label style="width:200px" for="email" class="col-md-5 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input style="width:350px" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input style="width:350px" id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group mb-2">
                            <div class="row">
                                <div class="col mb-2">
                                    <a class="btn btn-link ml-1" href="{{ route('password.request') }}">
                                            Forgot Your Password?
                                    </a>
                                </div>
                                <div class="col pt-2">
                
                                    <span class="ml-3 mr-1 " style="margin-left:35px">Remember me</span><input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="form-group float-right">
                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary mr-3">
                                        Login
                                    </button>
                                </div>

                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
