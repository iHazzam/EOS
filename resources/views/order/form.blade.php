@extends('layout')

@section('header')
    <section class="content-header">
        <h1>
            Playdale Export Order System<small>Place a new playground order! </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
            <li class="active">New Order</li>
        </ol>
    </section>

@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">New Order</div>
                </div>

                <div class="box-body">
                    <form name="basicform" id="basicform" method="post" action="{{url('/order/create/post')}}" >
                        {!! csrf_field() !!}
                        @include('admin/forms/orderform')

                        <div class="clearfix" style="height: 10px;clear: both;"></div>
                                <div class="clearfix" style="height: 10px;clear: both;"></div>

                                <div class="form-group">
                                    <div class="col-lg-10 col-lg-offset-1">
                                        <button type="submit" class="btn btn-warning">Submit</button>
                                    </div>
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('after_scripts')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script>
        $( function() {
            $( "#datepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });
        } );
    </script>
@endsection