@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb" style="margin-top: 0px;margin-bottom: -10px;">
  <ol class="breadcrumb bg bg-light">
    <li class="breadcrumb-item ml-auto"><a href="{{ route('admin.province.index') }}">หน้าหลัก</a></li>
    <li class="breadcrumb-item active" aria-current="page">รายละเอียดจังหวัด</li>
  </ol>
</nav>
<div class="card">
  <div class="card-header h5">
    รายละเอียดจังหวัด
  </div>
  <div class="card-body">
    <div class="mb-3">
      <label for="provinceID" class="form-label">รหัสจังหวัด:</label>
      {{$province->provinceID}}
    </div>
    <div class="mb-3">
      <label for="provinceName" class="form-label">ชื่อจังหวัด:</label>
      {{$province->provinceName}}
    </div> 
  </div>
</div>  

@endsection