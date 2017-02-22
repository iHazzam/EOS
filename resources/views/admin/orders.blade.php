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
                        <div class="box-title">Site Users (</div>
                    </div>

                    <div class="box-body">
                        <table class="table table-striped task-table">

                            <!-- Table Headings -->
                            <thead>
                            <th>Order ID</th>
                            <th>Purchase Order Ref#</th>
                            <th>Company placed</th>
                            <th>Project Name</th>
                            <th>Order cost</th>
                            <th>Shipping method</th>
                            <th>Delivery date</th>
                            <th>Shipping cost</th>
                            <th>Total cost</th>
                            <th>Full Details/Edit</th>
                            <th>Delete</th>
                            </thead>

                            <!-- Table Body -->
                            <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <!-- Name -->
                                    <td class="table-text">
                                        <div>{{ $order->id}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{ $order->purchase_order_reference}}</div>
                                    </td>
                                    <!-- Contact -->
                                    {{--Number of orders placed--}}
                                    <td class="table-text">
                                        <div>{{ $order->project_name;}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{ $order->user()->company_name }}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{ $order->order_total;}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{ $order->orders()->delivery_date->diffForHumans() }}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{ $order->delivery;}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{ $order->shipping_total;}}</div>
                                    </td>
                                    <!-- latest order-->
                                    <td class="table-text">
                                        <div>{{ $order->shipping_total + $order->order_total}}</div>
                                    </td>
                                    <td class="table-text">
                                        <button type="button" class="btn btn-link white_" data-toggle="modal" data-target="#modal{{$order->id}}">Edit/Full info <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </button>
                                    </td>
                                    <td>
                                        <form action="{{ url('admin/delete/user/'.$order->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button type="submit" id="delete-event-{{ $order->id }}" class="btn btn-danger">
                                                <i class="fa fa-btn fa-trash"></i>Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @foreach ($orders as $order)
                        <div id="modal{{$order->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;  </button>
                                        <h4 class="modal-title" id="myModalLabel">{{$order->company_name }} Full Details/Edit</h4>
                                    </div>
                                    <div class="modal-body">
                                        <editinfo></editinfo> <!-- vue component to make -->
                                    </div>
                                    <div class="modal-footer">
                                        <button id="{{$order->id}}" class="btn btn-warning">Save Changes!</button>
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
