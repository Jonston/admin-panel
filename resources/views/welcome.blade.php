@extends('layouts.login')

@section('content')
    <div class="login-box">
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form action="{!! route('login') !!}" method="post">
                @csrf
                <div class="form-group @if($errors->has('email')) has-error @endif">
                    <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
                    @error('email')
                    <span class="help-block">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group @if($errors->has('email')) has-error @endif">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    @error('password')
                    <span class="help-block">{{ $message }}</span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.login-box-body -->
    </div>
@endsection