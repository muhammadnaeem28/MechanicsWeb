@extends('admin.layouts.master')

@section('content')
    <div class="container">
        This is a rendered page
    </div>
@stop
{{--
<div class="row">
    <div class="col-md-4">
        <div class="col-md-12"><label class="control-label">Brand</label></div>
        <select name="brands[]" class="selectpicker">
            @foreach($brands as $brand)
                <option value="{{$brand->id}}">{{$brand->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <div class="col-md-12"><label class="control-label">Model</label></div>
        <select name="brands[]" class="selectpicker">
            @foreach($brands as $brand)
                <option value="{{$brand->id}}">{{$brand->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <div class="col-md-12"><label class="control-label">Trim</label></div>
        <select name="brands[]" class="selectpicker">
            @foreach($brands as $brand)
                <option value="{{$brand->id}}">{{$brand->name}}</option>
            @endforeach
        </select>
    </div>



</div>--}}
