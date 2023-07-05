@extends('layouts.admin')

@section('content')


<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-auto"><a href="{{ route('admin.producttype.index') }}">หน้าหลัก</a></li>
    <li class="breadcrumb-item active" aria-current="page">แก้ไขรายละเอียดประเภทสินค้า</li>
  </ol>
</nav>


<div class="card">
  <div class="card-header">
    <h2>แก้ไขข้อมูลประเภทสินค้า</h2>
  </div>
  <div class="card-body">
      <!-- /producttype/<?=request()->segment(count(request()->segments())-1)?> -->      
      <form method="post" action="{{ route('admin.producttype.update', $producttype->typeID) }}">
        @csrf
          <div class="mb-3 mt-3">
            <label for="typeName" class="form-label">ประเภทสินค้า:</label>
            <input type="text" class="form-control @error('typeName') is-invalid @enderror" id="typeName"  name="typeName" 
              value="{{$producttype->typeName}}" placeholder="กรุณาระบุประเภทสินค้า" maxlength="200">
            <div id="invalid-typeName" class="invalid-feedback">{{ $errors->first('typeName') }}</div>
          </div>

          <button type="submit" id="submit" class="btn btn-primary">แก้ไขข้อมูล</button>
  
        </form>
  </div>
</div>
          
@endsection