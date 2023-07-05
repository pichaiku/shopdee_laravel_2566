@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-auto"><a href="{{ route('admin.producttype.index') }}">หน้าหลัก</a></li>
    <li class="breadcrumb-item active" aria-current="page">รายละเอียดประเภทสินค้า</li>
  </ol>
</nav>
<div class="card">
  <div class="card-header">
    <h2>รายละเอียดประเภทสินค้า</h2>
  </div>
  <div class="card-body">
    <div class="mb-3">
      <label for="username" class="form-label">ประเภทสินค้า:</label>
      {{$producttype->typeName}}
    </div>
 
  </div>
</div>  

@endsection