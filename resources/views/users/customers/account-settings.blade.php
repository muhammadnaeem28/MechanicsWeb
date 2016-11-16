@extends('users.layouts.customer.master')
@section('title')
    Dashboard
    @parent
    @endsection
@section('styles')
    {{--<link href="../assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />--}}
    {!! HTML::style('/admin/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') !!}
    {!! HTML::style('/admin/pages/css/profile.min.css') !!}
    {!! HTML::style('/admin/global/css/plugins-md.min.css') !!}



    <Style>
        .image-preview-input {
            position: relative;
            overflow: hidden;
            margin: 0px;
            color: #333;
            background-color: #fff;
            border-color: #ccc;

        }
        .image-preview-input input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            margin: 0;
            padding: 0;
            font-size: 20px;
            cursor: pointer;
            opacity: 0;
            filter: alpha(opacity=0);
        }
        .image-preview-input-title {
            margin-left:2px;
        }
    </Style>




    @endsection


        @section('content')

        <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="index.html">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Account Settings</span>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title">{{Auth::user()->fname}} {{Auth::user()->lname}}
            <small>Account Settings Page</small>
        </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PROFILE SIDEBAR -->
                <div class="profile-sidebar">
                    <!-- PORTLET MAIN -->
                    <div class="portlet light profile-sidebar-portlet ">
                        <!-- SIDEBAR USERPIC -->
                        <div class="profile-userpic">
                            <img src="{{Auth::user()->image_url}}" class="img-responsive" alt=""> </div>
                        <!-- END SIDEBAR USERPIC -->
                        <!-- SIDEBAR USER TITLE -->
                        <div class="profile-usertitle">
                            <div class="profile-usertitle-name"> {{Auth::user()->fname}} {{Auth::user()->lname}} </div>

                        </div>
                        <div style="padding: 0 21px 0 21px;">
                            <h4 class="profile-desc-title">About</h4>
                            <span class="profile-desc-text"> {{$user->biography}}. </span>
                        </div>
                        <br>
                        <!-- END SIDEBAR USER TITLE -->
                        <!-- SIDEBAR BUTTONS -->
                        <!-- END SIDEBAR BUTTONS -->
                        <!-- SIDEBAR MENU -->
                        {{--<div class="profile-usermenu">
                            <ul class="nav">
                                <li class="active">
                                    <a href="{{route('customer.account-settings')}}">
                                        <i class="icon-settings"></i> Account Settings </a>
                                </li>
                                <li>
                                    <a href="{{route('customer.help')}}">
                                        <i class="icon-info"></i> Help </a>
                                </li>
                            </ul>

                        </div>--}}
                        <!-- END MENU -->
                    </div>
                    <!-- END PORTLET MAIN -->
                    <!-- PORTLET MAIN -->
{{--                    <div class="portlet light ">
                        <div>
                            <h4 class="profile-desc-title">About {{Auth::user()->fname}} {{Auth::user()->lname}}</h4>
                            <span class="profile-desc-text"> Lorem ipsum dolor sit amet diam nonummy nibh dolore. </span>
                        </div>
                    </div>--}}
                    <!-- END PORTLET MAIN -->
                </div>
                <!-- END BEGIN PROFILE SIDEBAR -->
                <!-- BEGIN PROFILE CONTENT -->
                <div class="profile-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light ">
                                <div class="portlet-title tabbable-line">

                                    <ul class="nav nav-tabs" style="float: left;">
                                        <li class="active">
                                            <a href="#personal_info" data-toggle="tab">Personal Info</a>
                                        </li>
                                        <li>
                                            <a href="#profile_picture" data-toggle="tab">Profile Picture</a>
                                        </li>
{{--
                                        <li>
                                            <a href="#change_password" data-toggle="tab">Change Password</a>
                                        </li>
--}}
                                    </ul>
                                </div>
                                <div class="portlet-body">
                                    <div class="tab-content">
                                        <!-- PERSONAL INFO TAB -->
                                        <div class="tab-pane active" id="personal_info">
                                            <form role="form" action="{{route('customer.update.personal-info')}}" method="POST">
                                                {{--{{ csrf_field() }}--}}
                                                <div class="form-group">
                                                    <label class="control-label">First Name</label>
                                                    <input type="text" name="fname" value="{{$user->fname}}" class="form-control" /> </div>
                                                <div class="form-group">
                                                    <label class="control-label">Last Name</label>
                                                    <input type="text" name="lname" value="{{$user->lname}}" class="form-control" /> </div>
                                                <div class="form-group">
                                                    <label class="control-label">Phone 1</label>
                                                    <input type="text" name="phone1" value="{{$user->phone1}}" class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Phone 2</label>
                                                    <input type="text" name="phone2" value="{{$user->phone2}}" class="form-control" />
                                                    <input type="hidden" name="row_id" value="{{$user->id}}" class="form-control" />
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label">Address</label>
                                                    <input type="text" name="address" value="{{$user->address}}" class="form-control" />
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label">City</label>
                                                    <input type="text" name="city" value="{{$user->city}}" class="form-control" />
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label">Zip</label>
                                                    <input type="text" name="zip" value="{{$user->zip}}" class="form-control" />
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label">Biography</label>
                                                    <textarea class="form-control" rows="3" name="biography">{{$user->biography}}</textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label">Languages</label>
                                                    <input type="text" name="languages" value="{{$user->languages}}" class="form-control" />
                                                </div>

                                                <div class="margiv-top-10">
                                                    {{--<a href="javascript:;" class="btn green "> Save Changes </a>--}}
                                                    <input type="submit" value="Save Changes" class="btn green"/>

                                                    {{--<a href="javascript:;" class="btn default"> Cancel </a>--}}
                                                </div>
                                            </form>
                                        </div>
                                        <!-- END PERSONAL INFO TAB -->
                                        <!-- CHANGE AVATAR TAB -->

                                        <div class="tab-pane" id="profile_picture">

                                            <form action="{{route('customer.update.profile-picture')}}" method="POST" role="form" enctype="multipart/form-data">
                                                <div class="form-group">

                                                    <div>
                                                        <div class="input-group image-preview" style="width:60%">

                                                            <input type="text" class="form-control image-preview-filename" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
                                                        <span class="input-group-btn">
                                                            <!-- image-preview-clear button -->
                                                            <button type="button" class="btn btn-default image-preview-clear" style="display:none;background-color:#7e8c9e ; color: #fff;">
                                                                <i class="icon-cancel-2">Cancel</i>
                                                            </button>
                                                            <!-- image-preview-input -->
                                                            <div class="btn btn-default image-preview-input" style="background-color:#34495e ; color: #fff;" >
                                                                <i class="icon-down-open-3"></i>
                                                                <span class="image-preview-input-title">BROWSE</span>
                                                                <input type="file" accept="image/png, image/jpeg, image/gif" name="input-file-preview"/> <!-- rename it -->
                                                            </div>
                                                        </span>
                                                        </div><!-- /input-group image-preview [TO HERE]-->

                                                    </div>
                                                    <br>
                                                    <div style="width: 34%; height: 34%;">
                                                        <img src="{{$user->image_url}}" class="img-responsive">
                                                    </div>




                                                </div>
                                                <div class="margin-top-10">
                                                    {{--<a href="javascript:;" class="btn green"> Submit </a>--}}
                                                    <input type="submit" value="Submit" class="btn green"/>
                                                    {{--<a href="javascript:;" class="btn default"> Cancel </a>--}}
                                                </div>
                                            </form>
                                        </div>
                                        <!-- END CHANGE AVATAR TAB -->
                                        <!-- CHANGE PASSWORD TAB -->
                                        {{--<div class="tab-pane" id="change_password">
                                            <form action="{{route('customer.update.password')}}" method="POST">
                                                <div class="form-group">
                                                    <label class="control-label">Current Password</label>
                                                    <input type="password" name="current_password" class="form-control" />
                                                    {{$errors->first('current_password')}}
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">New Password</label>
                                                    <input type="password" name="password" class="form-control" />
                                                    {{$errors->first('password')}}
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Re-type New Password</label>
                                                    <input type="password" name="password_confirmation" class="form-control" />
                                                    {{$errors->first('password_confirmation')}}
                                                    <div class="margin-top-10">

                                                        <input type="submit" value="Change Password" class="btn green"/>


                                                    </div>
                                                </div>
                                            </form>
                                        </div>--}}
                                        <!-- END CHANGE PASSWORD TAB -->
                                        <!-- PRIVACY SETTINGS TAB -->

                                        <!-- END PRIVACY SETTINGS TAB -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END PROFILE CONTENT -->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
@endsection


@section('scripts')
    {!! HTML::script('/admin/pages/scripts/profile.min.js') !!}
    {!! HTML::script('/admin/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') !!}
    {!! HTML::script('/admin/global/plugins/jquery.sparkline.min.js') !!}

    <script>

        $(document).on('click', '#close-preview', function(){
            $('.image-preview').popover('hide');
            // Hover befor close the preview
            $('.image-preview').hover(
                    function () {
                        $('.image-preview').popover('show');
                    },
                    function () {
                        $('.image-preview').popover('hide');
                    }
            );
        });

        $(function() {
            // Create the close button
            var closebtn = $('<button/>', {
                type:"button",
                text: 'x',
                id: 'close-preview',
                style: 'font-size: initial;',
            });
            closebtn.attr("class","close pull-right");
            // Set the popover default content
            $('.image-preview').popover({
                trigger:'manual',
                html:true,
                title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
                content: "There's no image",
                placement:'bottom'
            });
            // Clear event
            $('.image-preview-clear').click(function(){
                $('.image-preview').attr("data-content","").popover('hide');
                $('.image-preview-filename').val("");
                $('.image-preview-clear').hide();
                $('.image-preview-input input:file').val("");
                $(".image-preview-input-title").text("Browse");
            });
            // Create the preview image
            $(".image-preview-input input:file").change(function (){
                var img = $('<img/>', {
                    id: 'dynamic',
                    width:250,
                    height:200
                });
                var file = this.files[0];
                var reader = new FileReader();
                // Set preview image into the popover data-content
                reader.onload = function (e) {
                    $(".image-preview-input-title").text("Change");
                    $(".image-preview-clear").show();
                    $(".image-preview-filename").val(file.name);
                    img.attr('src', e.target.result);
                    $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
                }
                reader.readAsDataURL(file);
            });
        });
    </script>

@endsection

{{--
<script src="../assets/pages/scripts/profile.min.js" type="text/javascript"></script>--}}
