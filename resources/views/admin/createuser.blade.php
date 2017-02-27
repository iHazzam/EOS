@extends('admin.adminlayout')

@section('header')
    <section class="content-header">
        <h1>
            Playdale Export Order System<small>Admin Panel </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
            <li class="active">{{ trans('backpack::base.dashboard') }}</li>
        </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">Create Site User</div>
                </div>

                <div class="box-body">
                    <form name="basicform" id="basicform" method="post" action="{{url('/admin/create/user/post')}}" >
                        {!! csrf_field() !!}

                        @include('admin.forms.userform')



                        <div class="clearfix" style="height: 10px;clear: both;"></div>
                        <div class="clearfix" style="height: 10px;clear: both;"></div>

                        <div class="form-group  col-xs-4">
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
