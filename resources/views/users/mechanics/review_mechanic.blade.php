@extends('users.layouts.public.master')
@section('title')
    Review Mechanic
    @parent
@endsection


@section('styles')
@endsection

@section('content')

    <div style="margin-top: 70px;"></div>
    <div class=" container">

        <div id="tour_guide" style="clear: both; margin-top: 48px;">
            <p>
            <h3 style="text-transform: uppercase;"><span>Review</span> {{$mechanic->fname}} {{$mechanic->lname}} </h3>
            <img src="{{$mechanic->image_url}}" width="170" height="170" alt="" class="img-circle styled">


            </p>
        </div>
    </div>

    <div class="container" style="text-align: center;">
        <div class="row">

            <form action="{{route('mechanics.review-mechanic-post')}}" method="post">

                {{ csrf_field() }}
            <div>
                <textarea name="comment" rows="10" cols="60"></textarea>
            </div>
            <div>

                <input type="hidden" name="id" value="{{$mechanic->id}}"/>
                <input type="hidden" name="fname" value="{{$mechanic->fname}}"/>
                <input type="hidden" name="lname" value="{{$mechanic->lname}}"/>
                <input type="submit" class="btn_1 medium" value="Add Review"/>

            </div>


            </form>

        </div>




    </div>


    <!-- end container -->

    <br>
    <br>
    <br>

@stop