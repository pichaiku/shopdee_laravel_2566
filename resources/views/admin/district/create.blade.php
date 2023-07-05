@extends('layouts.admin')

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-auto"><a href="{{ route('admin.district.index') }}">หน้าหลัก</a></li>
    <li class="breadcrumb-item active" aria-current="page">เพิ่มข้อมูลอำเภอ</li>
  </ol>
</nav>

    <div class="card">
      <div class="card-header">
      <h2>เพิ่มข้อมูลอำเภอ</h2>
      </div>

      <form method="post" class="card-body" action="{{ route('admin.district.store') }}">
      @csrf
        <div class="mb-3 mt-3">
          <label for="districtID" class="form-label">รหัสอำเภอ:</label>
          <input type="text" class="form-control @error('districtID') is-invalid @enderror" 
            id="districtID"  name="districtID"  value="{{old('districtID')}}" placeholder="กรุณาระบุรหัสอำเภอ" >
          <div id="invalid-districtID" class="invalid-feedback">{{ $errors->first('districtID') }}</div>
        </div>
        
        <div class="mb-3 mt-3">
          <label for="districtName" class="form-label">ชื่ออำเภอ:</label>
          <input type="text" class="form-control @error('districtName') is-invalid @enderror" 
            id="districtName"  name="districtName"  value="{{old('districtName')}}" placeholder="กรุณาระบุชื่ออำเภอ" >
          <div id="invalid-districtName" class="invalid-feedback">{{ $errors->first('districtName') }}</div>
        </div>

        <div class="mb-3">
          <label for="provinceID" class="form-label">จังหวัด:</label>
          <select class="form-select @error('provinceID') is-invalid @enderror" 
            id="provinceID" name="provinceID" placeholder="กรุณาระบุจังหวัด" >
            @foreach($types as $type)
              <option value="{{ $type->provinceID }}">{{ $type->provinceName }}</option>
            @endforeach
          </select>
          <div id="invalid-provinceID" class="invalid-feedback">{{ $errors->first('provinceID') }}</div>
        </div>

        <button type="submit" id="submit" class="btn btn-primary">บันทึกข้อมูล</button>

      </form>
    </div>
@endsection