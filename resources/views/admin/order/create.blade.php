@extends('layouts.admin')

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-auto"><a href="{{ route('admin.product.index') }}">หน้าหลัก</a></li>
    <li class="breadcrumb-item active" aria-current="page">เพิ่มข้อมูลสินค้า</li>
  </ol>
</nav>

    <div class="card">
      <div class="card-header">
      <h2>เพิ่มข้อมูลสินค้า</h2>
      </div>

      <form method="post" class="card-body" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
      @csrf
  
        <div class="mb-3">
          <label for="typeID" class="form-label">ประเภทสินค้า:</label>
          <select class="form-control @error('typeID') is-invalid @enderror" 
            id="typeID" name="typeID">
            <option value="">++ เลือกประเภทสินค้า ++</option>
            @foreach($producttypes as $type)
              <option value="{{ $type->typeID }}">{{ $type->typeName }}</option>
            @endforeach
          </select>
          <div id="invalid-typeID" class="invalid-feedback">{{ $errors->first('typeID') }}</div>
        </div>
              
        <div class="mb-3 mt-3">
          <label for="productName" class="form-label">ชื่อสินค้า:</label>
          <input type="text" class="form-control @error('productName') is-invalid @enderror" 
            id="productName"  name="productName"  value="{{old('productName')}}" placeholder="กรุณาระบุชื่อสินค้า" >
          <div id="invalid-productName" class="invalid-feedback">{{ $errors->first('productName') }}</div>
        </div>

        <div class="mb-3">
          <label for="productDetail" class="form-label">รายละเอียดสินค้า:</label>
          <input type="text" class="form-control @error('productDetail') is-invalid @enderror" 
            id="productDetail" name="productDetail" value="{{old('productDetail')}}" placeholder="กรุณาระบุรายละเอียดสินค้า"
            >
          <div id="invalid-productDetail" class="invalid-feedback">{{ $errors->first('productDetail') }}</div>
        </div>
        <div class="mb-3">
          <label for="price" class="form-label">ราคา:</label>          
          <input type="text" class="form-control @error('price') is-invalid @enderror" 
            id="price"  name="price" value="{{old('price')}}" placeholder="กรุณาระบุราคา" >
          <div id="invalid-price" class="invalid-feedback">{{ $errors->first('price') }}</div>
        </div>

        <div class="mb-3">
          <label for="quantity" class="form-label">จำนวน:</label>
          <input type="quantity" class="form-control @error('quantity') is-invalid @enderror" 
            id="quantity" name="quantity" value="{{old('quantity')}}" placeholder="กรุณาระบุจำนวน" >
          <div id="invalid-quantity" class="invalid-feedback">{{ $errors->first('quantity') }}</div>
        </div>

        <div class="mb-3">
          <label for="imageFile" class="form-label">รูปสินค้า:</label>
          <input type="file" class="form-control @error('imageFile') is-invalid @enderror" 
            id="imageFile" name="imageFile" value="{{old('imageFile')}}" placeholder="กรุณาระบุจำนวน" >
          <div id="invalid-imageFile" class="invalid-feedback">{{ $errors->first('imageFile') }}</div>
        </div>

        <button type="submit" id="submit" class="btn btn-primary mt-3">บันทึกข้อมูล</button>

      </form>
    </div>
@endsection