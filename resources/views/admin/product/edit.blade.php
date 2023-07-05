@extends('layouts.admin')

@section('content')


<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-auto"><a href="{{ route('admin.product.index') }}">หน้าหลัก</a></li>
    <li class="breadcrumb-item active" aria-current="page">แก้ไขรายละเอียดสินค้า</li>
  </ol>
</nav>


<div class="card">
  <div class="card-header">
    <h2>แก้ไขข้อมูลสินค้า</h2>
  </div>
  <div class="card-body">
      <!-- /product/<?=request()->segment(count(request()->segments())-1)?> -->      
      <form method="post" action="{{ route('admin.product.update', $product->productID) }}" enctype="multipart/form-data">
        @csrf
        
          <div class="mb-3">
            <label for="typeID" class="form-label">ประเภทสินค้า:</label>
            <select class="form-control @error('typeID') is-invalid @enderror" 
              id="typeID" name="typeID" placeholder="กรุณาระบุประเภทสินค้า" >              
              @foreach($producttypes as $type)
                <option value="{{ $type->typeID }}" {{$product->typeID==$type->typeID?"selected":""}} >{{ $type->typeName }}</option>
              @endforeach
            </select>
            <div id="invalid-typeID" class="invalid-feedback">{{ $errors->first('typeID') }}</div>
          </div>

          <div class="mb-3 mt-3">
            <label for="productName" class="form-label">ชื่อสินค้า:</label>
            <input type="text" class="form-control @error('productName') is-invalid @enderror" id="productName"  name="productName" value="{{$product->productName}}" placeholder="กรุณาระบุชื่อสินค้า" >
            <div id="invalid-productName" class="invalid-feedback">{{ $errors->first('productName') }}</div>
          </div>

          <div class="mb-3">
            <label for="productDetail" class="form-label">รายละเอียดสินค้า:</label>
            <input type="text" class="form-control @error('productDetail') is-invalid @enderror" id="productDetail" name="productDetail" value="{{$product->productDetail}}" placeholder="กรุณาระบุรายละเอียดสินค้า" >
            <div id="invalid-productDetail" class="invalid-feedback">{{ $errors->first('productDetail') }}</div>
          </div>
          
          <div class="mb-3">
            <label for="price" class="form-label">ราคา:</label>
            <input type="" class="form-control @error('price') is-invalid @enderror" id="price"  name="price" value="{{$product->price}}" placeholder="กรุณาระบุราคา" >
            <div id="invalid-price" class="invalid-feedback">{{ $errors->first('price') }}</div>
          </div>
  
          <div class="mb-3">
            <label for="quantity" class="form-label">จำนวน:</label>
            <input type="quantity" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{$product->quantity}}" placeholder="กรุณาระบุจำนวน" >
            <div id="invalid-quantity" class="invalid-feedback">{{ $errors->first('quantity') }}</div>
          </div>

          <div class="mb-3">
            <label for="imageFile" class="form-label">รูปสินค้า:</label>
            <input type="file" class="form-control @error('imageFile') is-invalid @enderror" 
              id="imageFile" name="imageFile" value="{{old('imageFile')}}" >
            <div id="invalid-imageFile" class="invalid-feedback">{{ $errors->first('imageFile') }}</div>
          </div>    
            
          <button type="submit" id="submit" class="btn btn-primary mt-3">แก้ไขข้อมูล</button>
  
        </form>
  </div>
</div>
          
@endsection