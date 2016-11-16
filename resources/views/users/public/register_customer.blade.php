@extends('users.layouts.public.master')
@section('title')
    Customer Registration
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
                        <form method="POST" action="{{ route('auth.register.store') }}">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12 col-sm-12 login_social">
                                    <a href="{{route('facebook.login')}}" class="btn btn-primary btn-block"><i class="icon-facebook"></i>
                                        Sign Up with Facebook</a>
                                </div>


                            </div> <!-- end row -->
                            <div class="login-or"><hr class="hr-or"><span class="span-or">or</span></div>

                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" class=" form-control" value="{{Input::old('fname')}}" name="fname"  placeholder="Full Name">
                                {{ $errors->first('fname') }}
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" class=" form-control" value="{{Input::old('lname')}}" name="lname"  placeholder="Full Name">
                                {{ $errors->first('lname') }}
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class=" form-control" value="{{Input::old('email')}}" name="email" placeholder="Email">
                                {{ $errors->first('email') }}
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class=" form-control" name="password" id="password1" placeholder="Password">
                                {{ $errors->first('password') }}
                            </div>
                            <div class="form-group">
                                <label>Confirm password</label>
                                <input type="password" class=" form-control" name="password_confirmation" id="password2" placeholder="Confirm password">
                                {{ $errors->first('password_confirmation') }}
                            </div>
                            <div id="pass-info" class="clearfix"></div>
                            <button class="btn_full">Create an account</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('bottom_includes')
    <script>
        console.log('ssssssssss');
        document.getElementsByTagName("header")[0].removeAttribute("id");

        var edit_save = document.getElementById("logo_img");

        edit_save.src = "/img/logo.png";
    </script>
@stop