<legend>Company Details</legend>
<div class="form-group">
    <label for="company_name" class="control-label">Company Name</label>

    <input type="text" class="form-control" id="company_name" name="company_name" placeholder="" value="{{$order->user()->first()->company_name }}" readonly >


</div>
<div id="default_contact">
    <div class="form-group" >
        <label for="name_on_order" class="control-label">Order Contact Name</label>

        <input type="text" class="form-control" id="name_on_order" name="name_on_order" placeholder=""  value="{{$order->contact_name}}" required="">

    </div>

    <div class="form-group" >
        <label for="contact_phone" class="control-label">Order Contact Phone</label>

        <input type="text" class="form-control" id="contact_phone" name="contact_phone" placeholder=""  value="{{$order->phone}}" required="">


    </div>

    <div class="form-group" >
        <label for="email" class="control-label">Order Contact Email</label>

        <input type="text" class="form-control" id="email" name="email" placeholder=""  value="{{$order->email}}" required="">

    </div>
</div>
<legend>Order Details</legend>
<div class="form-group">
    <label for="project_name" class="control-label">Project Name</label>

    <input type="text" class="form-control" id="project_name" name="project_name" placeholder="" value="{{$order->project_name}}"  >

</div>
<div class="form-group">
    <label for="purchase_order_reference" class="control-label">Purchase Order Reference</label>
    <input type="text" class="form-control" id="purchase_order_reference" name="purchase_order_reference" placeholder="" value="{{$order->purchase_order_reference}}" >
</div>

<legend>Order Items</legend>
<br>

    <table class="table">
        <thead>
            <tr>
                <th>Product Code</th>
                <th>Quantity</th>
                <th>Export price</th>
                <th>Currency</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->order_product()->get() as $item)
                <tr id="tr-{{$item->id}}">
                    <td><input  name="products[]" value="{{$item->product_code}}" class="smallinput"></td>
                    <td><input  name="quantities[]" value="{{$item->quantity}}" class="smallinput"></td>
                    <td><input  name="prices[]" value="{{$item->price}}" class="smallinput"></td>
                    <td>
                        <select>
                            <option value="eur" @if($item->currency == "eur") selected @endif> EUR </option>
                            <option value="gbp" @if($item->currency == "gbp") selected @endif> GBP </option>
                            <option value="usd" @if($item->currency == "usd") selected @endif> USD </option>
                        </select>
                    </td>
                    <td>
                        <button type="button" class="button is-small" v-on:click="removeRow()"><i class="fa fa-times" aria-hidden="true"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>



    <br>
    <div class="form-group" >
        <label for="custom" class="control-label">Custom details</label>

        <input type="text" class="form-control" id="custom" name="custom" placeholder=""  value="{{$order->custom}}">

    </div>



    <legend>Delivery Details</legend>


    <div class="form-group">
        <label for="date_of_delivery" class="control-label">Desired delivery/collection date</label>
        <input type="text" class="form-control" id="datepicker" name="datepicker" placeholder="" value="{{$order->delivery_date}}"  >
    </div>


    <div class="deliverydetails">
        <div >
            <label>
                <input type="radio" name="delivery" id="delivery1" @click="toggleDeliveryChecked" @if($order->delivery == "delivery") checked @endif value="delivery">
                Delivery
            </label>
        </div>
        <div >
            <label>
                <input type="radio" name="delivery" id="delivery2" @click="unsetDelivery" @if($order->delivery == "collection") checked @endif value="collection">
                Collection
            </label>
        </div>
        <div >
            <label>
                <input type="radio" name="delivery" id="delivery3" @click="unsetDelivery" @if($order->delivery == "unconfirmed") checked @endif value="unconfirmed">
                Unconfirmed
            </label>
        </div>
        <div id="deliverydiv">
            <div class="form-group" >
                <label for="addr1" class="control-label">Delivery Address Line 1</label>

                <input type="text" class="form-control" id="addr1" name="addr1" placeholder="" value="{{$order->address_line1}}" required="" hidden>


            </div>
            <div class="form-group">
                <label for="addr2" class="control-label">Delivery Address Line 2</label>

                <input type="text" class="form-control" id="addr2" name="addr2"  value="{{$order->address_line2}}" placeholder="" hidden >


            </div>
            <div class="form-group">
                <label for="city" class="control-label">Delivery Address City</label>

                <input type="text" class="form-control" id="city" name="city"  value="{{$order->city  }}" placeholder="" required="" hidden>


            </div>
            <div class="form-group">
                <label for="postcode" class="control-label">Delivery Address Postcode</label>

                <input type="text" class="form-control" id="postcode" name="postcode" value="{{ $order->postcode  }}" placeholder="" required="" hidden>


            </div>
            <div class="form-group">
                <label for="country" class="control-label">Delivery Address Country</label>

                <input type="text" class="form-control" id="country" name="country" value="{{ $order->country  }}" placeholder="" required="" hidden>


            </div>
        </div>
    </div>

    <legend>Other Details</legend>


    <div class="form-group" >
        <label for="inconterms" class="control-label">Incoterms</label>

        <input type="text" class="form-control" id="incoterms" name="incoterms" placeholder=""  value="{{$order->incoterms}}">

    </div>
