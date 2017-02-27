@extends('layout')

@section('header')
    <section class="content-header" xmlns:v-on="http://www.w3.org/1999/xhtml" xmlns:v-on="http://www.w3.org/1999/xhtml"
             xmlns:v-on="http://www.w3.org/1999/xhtml">
        <h1>
            Playdale Export Order System<small>Place a new playground order! </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
            <li class="active">New Order</li>
        </ol>
    </section>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.3.1/css/bulma.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">TEST</div>
                </div>

                <div class="box-body">
                    <span class="twitter-typeahead">
                        <p class="control has-icon has-icon-right">
                                <vue-typeahead
                                        v-model="value"
                                        prefetch="{{url('/api/products/get')}}"
                                        :default-suggestion="false"
                                        display-key='code'
                                        :suggestion-template="myTemplate"
                                        classes="form-control "
                                        v-on:selected="done">


                                </vue-typeahead>
                        </p>
                    </span>
                </div>
                <nav class="panel mywidth">

                    <div class="panel-heading">
                        Your Quote
                    </div>
                    <div class="panel-block" v-for="product in orderedproducts.products">
                        <article class="media">
                            <figure class="media-left">
                                <p class="image is-64x64">
                                    <img :src="product.imageurl">
                                </p>
                            </figure>
                            <p>
                                <span>@{{product.quantity}} x </span><strong>@{{ product.code }}</strong> @{{product.name}} <br><del>RRP: £@{{ product.price }}</del> Your price: £@{{product.discountedprice}}
                            </p>
                            <p>
                                <button class="button is-small is-success" v-on:click="product.incrementQuantity()"><i class="fa fa-plus-square" aria-hidden="true"></i></button>
                                <button class="button is-small is-danger" v-on:click="product.decrementQuantity()"><i class="fa fa-minus-square" aria-hidden="true"></i></button>
                            </p>
                        </article>
                    </div>
                    <div class="panel-block">
                        <div class="columns is-fullwidth"><span class="column is-one-third">Total: <del>£@{{orderedproducts.getTotalPrice()}}</del></span>
                            <span class="column is-offset-two-thirds">After Discount: <b> £ @{{orderedproducts.getDiscountedPrice()}} </b></span></div>
                    </div>
                    <div class="panel-block">
                        <button class="button is-primary is-outlined "  v-on:click="clearAll()">
                            Clear all items
                        </button>
                    </div>
                </nav>

            </div>
        </div>
    </div>
@endsection
@section('after scripts')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script>
        $( function() {
            $( "#datepicker" ).datepicker();
        } );
    </script>
@endsection