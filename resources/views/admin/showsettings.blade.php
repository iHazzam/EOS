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
                    <div class="box-title">Product image file upload</div>
                </div>

                <div class="box-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                        <img src="/storage/images{{ Session::get('path') }}">
                    @endif

                    <form action="{{ url('admin/settings/image') }}" enctype="multipart/form-data" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                <input type="file" name="image" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group" >
                                    <label for="filename" class="control-label">Filename</label>

                                    <input type="text" class="form-control" id="filename" name="filename" placeholder="" value="{{ old('filename')}}" required>


                                </div>
                                <div class="form-group">
                                    <label for="product_code" class="control-label">Product Code</label>

                                    <input type="text" class="form-control" id="product_code" name="product_code" placeholder="" value="{{ old('product_code')}}" required>


                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success">Upload</button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
@endsection
