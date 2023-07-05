@extends('layouts.admin')

@section('content')


<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-auto"><a href="{{ route('admin.customer.index') }}">หน้าหลัก</a></li>
    <li class="breadcrumb-item active" aria-current="page">แก้ไขรายละเอียดลูกค้า</li>
  </ol>
</nav>


<div class="card">
  <div class="card-header">
    <h2>แก้ไขข้อมูลลูกค้า</h2>
  </div>
  <div class="card-body">
      <!-- /customer/<?=request()->segment(count(request()->segments())-1)?> -->      
      <form method="post" action="{{ route('admin.customer.update', $customer->custID) }}">
        @csrf
          <div class="mb-3 mt-3">
            <label for="firstName" class="form-label">ชื่อ:</label>
            <input type="text" class="form-control @error('firstName') is-invalid @enderror" id="firstName"  name="firstName" value="{{$customer->firstName}}" placeholder="กรุณาระบุชื่อ" >
            <div id="invalid-firstName" class="invalid-feedback">{{ $errors->first('firstName') }}</div>
          </div>

          <div class="mb-3">
            <label for="lastName" class="form-label">นามสกุล:</label>
            <input type="text" class="form-control @error('lastName') is-invalid @enderror" id="lastName" name="lastName" value="{{$customer->lastName}}" placeholder="กรุณาระบุนามสกุล" >
            <div id="invalid-lastName" class="invalid-feedback">{{ $errors->first('lastName') }}</div>
          </div>
          
          <div class="mb-3">
            <label for="username" class="form-label">ชื่อผู้ใช้:</label>
            <input type="" class="form-control @error('username') is-invalid @enderror" id="username"  name="username" value="{{$customer->username}}" placeholder="กรุณาระบุชื่อผู้ใช้" >
            <div id="invalid-username" class="invalid-feedback">{{ $errors->first('username') }}</div>
          </div>
  
          <div class="mb-3">
            <label for="password" class="form-label">รหัสผ่าน:</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{$customer->password}}" placeholder="กรุณาระบุรหัสผ่าน" >
            <div id="invalid-password" class="invalid-feedback">{{ $errors->first('password') }}</div>
          </div>
  
          <button type="submit" id="submit" class="btn btn-primary">แก้ไขข้อมูล</button>
  
        </form>
  </div>
</div>
          
@endsection