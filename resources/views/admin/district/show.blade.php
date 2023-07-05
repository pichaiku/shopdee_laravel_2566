@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-auto"><a href="{{ route('admin.district.index') }}">หน้าหลัก</a></li>
    <li class="breadcrumb-item active" aria-current="page">รายละเอียดอำเภอ</li>
  </ol>
</nav>
<div class="card">
  <div class="card-header">
    <h2>รายละเอียดอำเภอ</h2>
  </div>
  <div class="card-body">
    <div class="mb-3">
      <label for="districtID" class="form-label">รหัสอำเภอ:</label>
      {{$district->districtID}}
    </div>
    <div class="mb-3">
      <label for="districtName" class="form-label">ชื่ออำเภอ:</label>
      {{$district->districtName}}
    </div> 
    <div class="mb-3">
      <label for="provinceName" class="form-label">จังหวัด:</label>
      {{$district->provinceName}}
    </div>     
  </div>
</div>  

@endsection