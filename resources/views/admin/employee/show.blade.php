@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-auto"><a href="{{ route('admin.employee.index') }}">หน้าหลัก</a></li>
    <li class="breadcrumb-item active" aria-current="page">รายละเอียดพนักงาน</li>
  </ol>
</nav>
<div class="card">
  <div class="card-header">
    <h2>รายละเอียดพนักงาน</h2>
  </div>
  <div class="card-body">
    <div class="mb-3">
      <label for="username" class="form-label">ชื่อผู้ใช้:</label>
      {{$employee->username}}
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">รหัสผ่าน:</label>
      {{$employee->password}}
    </div>

    <div class="mb-3 mt-3">
      <label for="firstName" class="form-label">ชื่อ:</label>
      {{$employee->firstName}}
    </div>

    <div class="mb-3">
      <label for="lastName" class="form-label">นามสกุล:</label>
      {{$employee->lastName}}
    </div>    
  </div>
</div>  

@endsection