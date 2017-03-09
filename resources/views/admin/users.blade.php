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
    <div id="users-app">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <div class="box-title">Site Users </div><div class="pull-right"><a href="/admin/create/user" class="btn btn-info " role="button">New User</a></div>
                    </div>

                    <div class="box-body">
                        @if($users->first())
                            <table class="table table-striped task-table">

                                <!-- Table Headings -->
                                <thead>
                                <th>Company Name</th>
                                <th>Contact Name</th>
                                <th>No. Orders placed</th>
                                <th>Latest order date</th>
                                <th>Full Details/Edit</th>
                                <th>Delete</th>
                                </thead>

                                <!-- Table Body -->
                                <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <!-- Name -->
                                        <td class="table-text">
                                            <div>{{ $user->company_name }}</div>
                                        </td>
                                        <!-- Contact -->
                                        <td class="table-text">
                                            <div>{{ $user->contact_name }}</div>
                                        </td>
                                        {{--Number of orders placed--}}
                                        <td class="table-text">
                                            <div>{{ $user->order()->count()}}</div>
                                        </td>
                                        <!-- latest order-->
                                        <td class="table-text">
                                            @if($user->order()->count() != 0)
                                            <div>{{ $user->order()->first()->created_at->diffForHumans() }}</div>
                                            @else
                                            <div>No orders found</div>
                                            @endif
                                        </td>
                                        <td class="table-text">
                                            <button type="button" class="btn btn-link white_" data-toggle="modal" data-target="#modal{{$user->id}}">Edit/Full info <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </button>
                                        </td>
                                        <td>
                                            <form action="{{ url('admin/delete/user/'.$user->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" id="delete-event-{{ $user->id }}" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i>Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                    @foreach ($users as $user)
                        <div id="modal{{$user->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;  </button>
                                        <h4 class="modal-title" id="myModalLabel">{{$user->company_name }} Full Details/Edit</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{url('admin/edit/user/'. $user->id)}}" method="POST">
                                            {{ csrf_field() }}

                                            @include('admin/forms/useredit')






                                            <button type="submit" id="edit-{{ $user->id }}" class="btn btn-warning">
                                                <i class="fa fa-btn fa-pencil-square-o "></i>Edit
                                            </button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection
