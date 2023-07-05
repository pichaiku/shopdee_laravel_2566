@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-auto"><a href="{{ route('admin.subdistrict.index') }}">หน้าหลัก</a></li>
    <li class="breadcrumb-item active" aria-current="page">รายละเอียดตำบล</li>
  </ol>
</nav>
<div class="card">
  <div class="card-header">
    <h2>รายละเอียดตำบล</h2>
  </div>
  <div class="card-body">
    <div class="mb-3">
      <label for="subdistrictID" class="form-label">รหัสตำบล:</label>
      {{$subdistrict->subdistrictID}}
    </div>
    <div class="mb-3">
      <label for="subdistrictName" class="form-label">ชื่อตำบล:</label>
      {{$subdistrict->subdistrictName}}
    </div> 
    <div class="mb-3">
      <label for="districtName" class="form-label">อำเภอ:</label>
      {{$subdistrict->districtName}}
    </div> 
    <div class="mb-3">
      <label for="provinceName" class="form-label">จังหวัด:</label>
      {{$subdistrict->provinceName}}
    </div>     
  </div>
</div>  

@endsection