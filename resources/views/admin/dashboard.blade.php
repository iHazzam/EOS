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
                    <div class="box-title">Welcome, PlaydaleAdmin</div>
                </div>

                <div class="box-body">


                </div>

            </div>
        </div>
    </div>
@endsection
