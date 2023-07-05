@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-auto"><a href="{{ route('admin.product.index') }}">หน้าหลัก</a></li>
    <li class="breadcrumb-item active" aria-current="page">รายละเอียดสินค้า</li>
  </ol>
</nav>
<div class="card">
  <div class="card-header">
    <h2>รายละเอียดสินค้า</h2>
  </div>
  <div class="card-body">
        
    <div class="mb-3">
      <label for="quantity" class="form-label">ประเภทสินค้า:</label>
      {{$product->typeName}}
    </div>    
    
    <div class="mb-3 mt-3">
      <label for="productName" class="form-label">ชื่อสินค้า:</label>
      {{$product->productName}}
    </div>

    <div class="mb-3">
      <label for="productDetail" class="form-label">รายละเอียดสินค้า:</label>
      {{$product->productDetail}}
    </div> 
    
    <div class="mb-3">
      <label for="price" class="form-label">ราคา:</label>
      {{$product->price}}
    </div>

    <div class="mb-3">
      <label for="quantity" class="form-label">จำนวน:</label>
      {{$product->quantity}}
    </div>

    <div class="mb-3">
      <label for="imageFile" class="form-label">รูปสินค้า:</label>
      <div>
        <img src="{{URL::to('/').'/assets/product/'.$product->imageFile}}" 
             class="rounded" alt="รูปสินค้า" style="width: 288px;">      
      </div>
    </div>
   
  </div>
</div>  

@endsection