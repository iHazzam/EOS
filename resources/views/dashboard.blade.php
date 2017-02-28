@extends('layout')

@section('header')
    <section class="content-header">
        <h1>
            Playdale Export Order System<small>Place new orders and see existing orders for your playgrounds!</small>
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
                    <div class="box-title">Placed Orders</div>
                </div>

                <div class="box-body">
                    @if(Auth::user()->order()->first() !== null)
                        <table class="table table-striped task-table">

                            <!-- Table Headings -->
                            <thead>
                                <th>Project Name</th>
                                <th>Purchase Order Ref</th>
                                <th>Order Date</th>
                                <th>Delivery Date</th>
                                <th>Delivery Method</th>
                                <th>Order Total</th>
                                <th>Shipping Total</th>
                            </thead>

                            <!-- Table Body -->
                            <tbody>
                            @foreach (Auth::user()->order()->get() as $order)
                                <tr>
                                    <!-- Name -->
                                    <td class="table-text">
                                        <div>{{ $order->project_name }}</div>
                                    </td>
                                    <!-- po#-->
                                    <td class="table-text">
                                        <div>{{ $order->purchase_order_reference }}</div>
                                    </td>
                                    <!-- Order Date -->
                                    <td class="table-text">
                                        <div>{{ $order->created_at->diffForHumans()}}</div>
                                    </td>
                                    <!-- Delivery Date -->
                                    <td class="table-text">
                                        <div>{{ $order->delivery_date }}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{ ucfirst($order->delivery) }}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>£{{ $order->order_total }}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>£{{ $order->shipping_total }}</div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @else
                            <p>
                                No placed orders! Why not <a href={{url('/order/create')}}>place an order</a> now?
                            </p>

                        @endif

                </div>

                </div>
            </div>
        </div>
    </div>
@endsection
