@extends('users.layouts.public.master')
@section('title')
    Customer Login
    @parent
@endsection


@section('content')
    <section id="hero" class="login">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                    <div id="login">
                        <div class="text-center"><img src="/img/logo-2.png" alt="" data-retina="true" ></div>
                        <hr>
                        <form action="{{route('auth.login')}}" method="POST">
                            {{ csrf_field() }}

                            <div class="row">
                                <div class="col-md-12 col-sm-12 login_social">
                                    <a href="{{route('facebook.login')}}" class="btn btn-primary btn-block"><i class="icon-facebook"></i> Facebook</a>
                                </div>


                            </div> <!-- end row -->
                            <div class="login-or"><hr class="hr-or"><span class="span-or">
                                or</span></div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" value="{{Input::old('email')}}" class="form-control" placeholder="email">
                                {{$errors->first('email')}}
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="password">
                                {{$errors->first('password')}}
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="1" name="remember">remember me
                                </label>
                            </div>
                            <input type="submit" name="" value="Submit" id="Sign_in" class="btn_full">
                            {{--<a href="#" class="btn_full">Sign in</a>--}}
                            <a href="{{route('auth.register.index')}}" class="btn_full_outline">New User?</a>
                            <p class="small">
                                <a href="#">Forget Password?</a>
                            </p>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
