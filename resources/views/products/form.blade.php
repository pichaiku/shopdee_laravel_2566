
<div class="form-group {{ $errors->has('productName') ? 'has-error' : '' }}">
    <label for="productName" class="col-md-2 control-label">Product Name</label>
    <div class="col-md-10">
        <input class="form-control" name="productName" type="text" id="productName" value="{{ old('productName', optional($product)->productName) }}" minlength="1" maxlength="200" required="true" placeholder="Enter product name here...">
        {!! $errors->first('productName', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('productDetail') ? 'has-error' : '' }}">
    <label for="productDetail" class="col-md-2 control-label">Product Detail</label>
    <div class="col-md-10">
        <input class="form-control" name="productDetail" type="text" id="productDetail" value="{{ old('productDetail', optional($product)->productDetail) }}" maxlength="500" placeholder="Enter product detail here...">
        {!! $errors->first('productDetail', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
    <label for="price" class="col-md-2 control-label">Price</label>
    <div class="col-md-10">
        <input class="form-control" name="price" type="number" id="price" value="{{ old('price', optional($product)->price) }}" min="0" max="99999999" required="true" placeholder="Enter price here..." step="any">
        {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('quantity') ? 'has-error' : '' }}">
    <label for="quantity" class="col-md-2 control-label">Quantity</label>
    <div class="col-md-10">
        <input class="form-control" name="quantity" type="text" id="quantity" value="{{ old('quantity', optional($product)->quantity) }}" min="0" max="65535" required="true" placeholder="Enter quantity here...">
        {!! $errors->first('quantity', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('imageFile') ? 'has-error' : '' }}">
    <label for="imageFile" class="col-md-2 control-label">Image File</label>
    <div class="col-md-10">
        <input class="form-control" name="imageFile" type="text" id="imageFile" value="{{ old('imageFile', optional($product)->imageFile) }}" min="1" max="100" required="true" placeholder="Enter image file here...">
        {!! $errors->first('imageFile', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('typeID') ? 'has-error' : '' }}">
    <label for="typeID" class="col-md-2 control-label">Type I D</label>
    <div class="col-md-10">
        <input class="form-control" name="typeID" type="text" id="typeID" value="{{ old('typeID', optional($product)->typeID) }}" minlength="1" min="0" required="true" placeholder="Enter type i d here...">
        {!! $errors->first('typeID', '<p class="help-block">:message</p>') !!}
    </div>
</div>

