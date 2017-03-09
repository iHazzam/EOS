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
                                <legend>Company Details</legend>
                                <div class="form-group">
                                    <label for="company_name" class="control-label">Company Name</label>

                                    <input type="text" class="form-control" id="company_name" name="company_name" placeholder="" value="{{Auth::user()->company_name}}" readonly >


                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" @click="toggleDefaultContact" checked value="">
                                        Use default company contact
                                    </label>
                                </div>
                                <div id="default_contact" v-show="defaultContact">
                                    <div class="form-group" >
                                        <label for="name_on_order" class="control-label">Order Contact Name</label>

                                        <input type="text" class="form-control" id="name_on_order" name="name_on_order" placeholder=""  value="{{ old('name_on_order') ? old('name_on_order') : Auth::user()->contact_name  }}" required="">


                                    </div>

                                    <div class="form-group" >
                                        <label for="contact_phone" class="control-label">Order Contact Phone</label>

                                        <input type="text" class="form-control" id="contact_phone" name="contact_phone" placeholder=""  value="{{ old('contact_phone') ? old('contact_phone') : Auth::user()->contact_phone  }}" required="">


                                    </div>

                                    <div class="form-group" >
                                        <label for="email" class="control-label">Order Contact Email</label>

                                        <input type="text" class="form-control" id="email" name="email" placeholder=""  value="{{ old('email') ? old('email') : Auth::user()->email  }}" required="">

                                    </div>
                                </div>
                            <legend>Order Details</legend>
                            <div class="form-group">
                                <label for="project_name" class="control-label">Project Name</label>

                                <input type="text" class="form-control" id="project_name" name="project_name" placeholder="" value="{{ old('project_name') }}"  >

                            </div>
                            <div class="form-group">
                                <label for="purchase_order_reference" class="control-label">Purchase Order Reference</label>
                                <input type="text" class="form-control" id="purchase_order_reference" name="purchase_order_reference" placeholder="" value="{{ old('purchase_order_reference') }}" >
                            </div>

                        <legend>Order Items</legend>
                        <br>
                        <div class="order">
                            <div class="typeahead">
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
                            <br>
                            <div class="quote">
                                <nav class="panel mywidth">

                                    <div class="panel-heading">
                                        Your Quote <span class="pull-right">Change Qnty.</span>
                                    </div>
                                    <div class="panel-block" v-for="(product, index) in orderedproducts.products">
                                        <article class="media">
                                            <figure class="media-left">
                                                <p class="image is-64x64">
                                                    <img :src="product.imageurl">
                                                </p>
                                            </figure>
                                            <p>
                                                <span>@{{product.quantity}} x </span><strong>@{{ product.code }}</strong> @{{product.name}} <br><del>RRP: £@{{ product.price }}</del> Your price: £@{{product.discountedprice}}

                                                <input type="hidden" name="products[]" :value="product.code">
                                                <input type="hidden" name="quantities[]" :value="product.quantity">
                                                <input type="hidden" name="prices[]" :value="product.discountedprice">
                                            </p>
                                            <p>
                                                <button type="button" class="button is-small" v-on:click="product.incrementQuantity()"><i class="fa fa-plus-square" aria-hidden="true"></i></button>
                                                <button type="button" class="button is-small" v-on:click="product.decrementQuantity()"><i class="fa fa-minus-square" aria-hidden="true"></i></button>
                                            </p>
                                        </article>
                                    </div>
                                    <div class="panel-block">
                                        <div class="columns is-fullwidth"><span class="column is-one-third">Total: <del>£@{{orderedproducts.getTotalPrice()}}</del></span>
                                            <span class="column is-offset-two-thirds">After Discount: <b> £ @{{orderedproducts.getDiscountedPrice()}} </b></span></div>
                                            <input type="hidden" name="order_total" :value="orderedproducts.getDiscountedPrice()">
                                    </div>
                                    <div class="panel-block">
                                        <button type="button" class="button is-primary is-outlined "  v-on:click="clearAll()">
                                            Clear all items
                                        </button>
                                    </div>
                                </nav>
                            </div>
                            <br>
                            <div class="form-group" >
                                <label for="custom" class="control-label">Custom details</label>

                                <input type="text" class="form-control" id="custom" name="custom" placeholder=""  value="{{ old('custom')}}">

                            </div>



                            <legend>Delivery Details</legend>


                            <div class="form-group">
                                <label for="date_of_delivery" class="control-label">Desired delivery/collection date</label>
                                <input type="text" class="form-control" id="datepicker" name="datepicker" placeholder="" value="{{ old('datepicker') }}"  >
                            </div>


                         <div class="deliverydetails">
                                <div >
                                    <label>
                                        <input type="radio" name="delivery" id="delivery1" @click="toggleDeliveryChecked" @if(old('delivery') == "delivery1") checked @endif value="delivery">
                                        Delivery
                                    </label>
                                </div>
                                <div >
                                    <label>
                                        <input type="radio" name="delivery" id="delivery2" @click="unsetDelivery" @if(old('delivery') == "delivery2") checked @endif value="collection">
                                        Collection
                                    </label>
                                </div>
                                <div >
                                    <label>
                                        <input type="radio" name="delivery" id="delivery3" @click="unsetDelivery" @if(old('delivery') == "delivery3") checked @endif value="unconfirmed">
                                        Unconfirmed
                                    </label>
                                </div>

                                <div class="checkbox" v-show="deliveryChecked">
                                    <label>
                                        <input type="checkbox" @click="toggleDefaultDelivery" checked value="">
                                        Use Default Delivery Address
                                    </label>
                                </div>
                                <div id="deliverydiv" v-show="defaultDelivery">
                                    <div class="form-group" >
                                        <label for="addr1" class="control-label">Delivery Address Line 1</label>

                                        <input type="text" class="form-control" id="addr1" name="addr1" placeholder="" value="{{ old('addr1') ? old('addr1') : Auth::user()->address_line1  }}" required="" hidden>


                                    </div>
                                    <div class="form-group">
                                        <label for="addr2" class="control-label">Delivery Address Line 2</label>

                                        <input type="text" class="form-control" id="addr2" name="addr2"  value="{{ old('addr2') ? old('addr2') : Auth::user()->address_line2  }}" placeholder="" hidden >


                                    </div>
                                    <div class="form-group">
                                        <label for="city" class="control-label">Delivery Address City</label>

                                        <input type="text" class="form-control" id="city" name="city"  value="{{ old('city') ? old('city') : Auth::user()->city  }}" placeholder="" required="" hidden>


                                    </div>
                                    <div class="form-group">
                                        <label for="postcode" class="control-label">Delivery Address Postcode</label>

                                        <input type="text" class="form-control" id="postcode" name="postcode" value="{{ old('postcode') ? old('postcode') : Auth::user()->postcode  }}" placeholder="" required="" hidden>


                                    </div>
                                    <div class="form-group">
                                        <label for="country" class="control-label">Delivery Address Country</label>

                                        <input type="text" class="form-control" id="country" name="country" value="{{ old('country') ? old('country') : Auth::user()->country  }}" placeholder="" required="" hidden>


                                    </div>
                                </div>
                            </div>

                            <legend>Other Details</legend>


                            <div class="form-group" >
                                <label for="inconterms" class="control-label">Incoterms</label>

                                <input type="text" class="form-control" id="incoterms" name="incoterms" placeholder=""  value="{{ old('incoterms')}}">

                            </div>

                        <div class="clearfix" style="height: 10px;clear: both;"></div>
                                <div class="clearfix" style="height: 10px;clear: both;"></div>

                                <div class="form-group">
                                    <div class="col-lg-10 col-lg-offset-1">
                                        <button type="submit" class="btn btn-warning">Submit</button>
                                    </div>
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