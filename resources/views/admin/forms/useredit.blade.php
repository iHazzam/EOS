<legend>Company Details</legend>
<div class="row">
    <div class="form-group  col-xs-4">
        <label for="sage_uid" class="control-label">Playdale Sage UID</label>
        <input type="text" class="form-control" id="sage_uid" name="sage_uid" value="{{$user->sage_uid}}" required>
    </div>
</div>
<div class="row">
    <div class="form-group  col-xs-6">
        <label for="company_name" class="control-label">Company Name</label>
        <input type="text" class="form-control" id="company_name" name="company_name" value="{{$user->company_name}}"  required="">
    </div>
    <div class="form-group  col-xs-6" >
        <label for="contact_name" class="contact_name">Contact Name</label>
        <input type="text" class="form-control" id="contact_name" name="contact_name" value="{{$user->contact_name}}"  required="">
    </div>
</div>
<div class="row">
    <div class="form-group  col-xs-6" >
        <label for="contact_phone" class="control-label">Contact Phone</label>
        <input type="text" class="form-control" id="contact_phone" name="contact_phone" value="{{$user->contact_phone}}" required="">
    </div>

    <div class="form-group  col-xs-6" >
        <label for="email" class="control-label">Contact Email</label>
        <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}" required="">
    </div>
</div>

<legend>Billing Details</legend>
<div class="row">
    <div class="form-group  col-xs-6" >
        <label for="address_line1" class="control-label">Billing Address Line 1</label>

        <input type="text" class="form-control" id="address_line1" name="address_line1" value="{{$user->address_line1}}"  required="" >

    </div>
    <div class="form-group  col-xs-6">
        <label for="address_line2" class="control-label">Billing Address Line 2</label>

        <input type="text" class="form-control" id="address_line2" name="address_line2" value="{{$user->address_line2}}">

    </div>
    <div class="form-group  col-xs-6">
        <label for="city" class="control-label">Billing Address City</label>

        <input type="text" class="form-control" id="city" name="city"  value="{{$user->city}}" required="">


    </div>
    <div class="form-group  col-xs-6">
        <label for="postcode" class="control-label">Billing Address Postcode</label>

        <input type="text" class="form-control" id="postcode" name="postcode"  value="{{$user->postcode}}" required="" >


    </div>
    <div class="form-group  col-xs-6">
        <label for="country" class="control-label">Billing Address Country</label>

        <input type="text" class="form-control" id="country" name="country" value="{{$user->country}}" required="">
    </div>
</div>
<div class="row">
    <div class="form-group  col-xs-4">
        <label for="shipping_percent" class="control-label">Default Shipping Percent</label>
        <input type="number" min="0" max="100" class="form-control" id="shipping_percent" name="shipping_percent" value="{{$user->shipping_percent}}">
    </div>
    <div class="form-group  col-xs-4">
        <label for="shipping_flat" class="control-label">Default Shipping Flat Fee</label>
        <input type="number" class="form-control" id="shipping_flat" name="shipping_flat" value="{{$user->shipping_flat}}" >
    </div>
    <div class="form-group  col-xs-4">
        <br>
        <label for="default_currency" class="control-label">Default Currency</label>
        <br>
        <select id="default_currency" name="default_currency" required>
            <option value="gbp" @if($user->default_currency == "gbp") selected @endif  >GBP</option>
            <option value="eur" @if($user->default_currency == "eur") selected @endif >Euro</option>
            <option value="usd" @if($user->default_currency == "usd") selected @endif  >USD</option>
        </select>
    </div>
</div>