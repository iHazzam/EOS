<legend>Company Details</legend>
<div class="row">
    <div class="form-group  col-xs-2">
        <label for="sage_uid" class="control-label">Playdale Sage UID</label>
        <input type="text" class="form-control" id="sage_uid" name="sage_uid" required>
    </div>
</div>
<div class="row">
    <div class="form-group  col-xs-4">
        <label for="company_name" class="control-label">Company Name</label>

        <input type="text" class="form-control" id="company_name" name="company_name" placeholder=""  required="">

    </div>
    <div class="form-group  col-xs-4" >
        <label for="contact_name" class="contact_name">Contact Name</label>

        <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder=""  required="">

    </div>

    <div class="form-group  col-xs-4" >
        <label for="contact_phone" class="control-label">Contact Phone</label>

        <input type="text" class="form-control" id="contact_phone" name="contact_phone" placeholder="" required="">
    </div>

    <div class="form-group  col-xs-4" >
        <label for="email" class="control-label">Contact Email</label>

        <input type="text" class="form-control" id="email" name="email" placeholder="" required="">

    </div>

</div>

<legend>Delivery Details</legend>
<div class="row">
    <div class="form-group  col-xs-4" >
        <label for="address_line1" class="control-label">Delivery Address Line 1</label>

        <input type="text" class="form-control" id="address_line1" name="address_line1" placeholder=""  required="" >

    </div>
    <div class="form-group  col-xs-4">
        <label for="address_line2" class="control-label">Delivery Address Line 2</label>

        <input type="text" class="form-control" id="address_line2" name="address_line2" placeholder="">

    </div>
    <div class="form-group  col-xs-4">
        <label for="city" class="control-label">Delivery Address City</label>

        <input type="text" class="form-control" id="city" name="city"  placeholder="" required="">


    </div>
    <div class="form-group  col-xs-4">
        <label for="postcode" class="control-label">Delivery Address Postcode</label>

        <input type="text" class="form-control" id="postcode" name="postcode"  placeholder="" required="" >


    </div>
    <div class="form-group  col-xs-4">
        <label for="country" class="control-label">Delivery Address Country</label>

        <input type="text" class="form-control" id="country" name="country" placeholder="" required="">
    </div>
</div>
<div class="row">
    <div class="form-group  col-xs-2">
        <label for="shipping_percent" class="control-label">Default Shipping Percent</label>
        <input type="number" min="0" max="100" class="form-control" id="shipping_percent" name="shipping_percent" value="0" placeholder="">
    </div>
    <div class="form-group  col-xs-2">
        <label for="shipping_flat" class="control-label">Default Shipping Flat Fee</label>
        <input type="number" class="form-control" id="shipping_flat" name="shipping_flat" value="0" placeholder="">
    </div>
    <div class="form-group  col-xs-2">
        <label for="default_currency" class="control-label">Default Currency</label>
        <br>
        <select id="default_currency" name="default_currency" required>
            <option value="gbp" selected  >GBP</option>
            <option value="eur">Euro</option>
            <option value="usd">USD</option>
        </select>
    </div>
</div>