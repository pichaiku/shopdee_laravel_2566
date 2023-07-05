@extends('layouts.admin')

@section('content')

    <nav aria-label="breadcrumb" style="margin-top: 0px;margin-bottom: -10px;">
      <ol class="breadcrumb bg bg-light">
        <li class="breadcrumb-item ml-auto"><a href="{{ route('admin.province.index') }}">หน้าหลัก</a></li>
        <li class="breadcrumb-item active" aria-current="page">เพิ่มข้อมูลจังหวัด</li>
      </ol>
    </nav>

    <div class="card">
      <div class="card-header h5">
        เพิ่มข้อมูลจังหวัด
      </div>

      <form method="post" class="card-body" action="{{ route('admin.province.store') }}">
      @csrf
        <div class="mb-3 mt-3">
          <label for="provinceID" class="form-label">รหัสจังหวัด:</label>
          <input type="text" class="form-control @error('provinceID') is-invalid @enderror" 
            id="provinceID"  name="provinceID"  value="{{old('provinceID')}}" placeholder="กรุณาระบุรหัสจังหวัด" >
          <div id="invalid-provinceID" class="invalid-feedback">{{ $errors->first('provinceID') }}</div>
        </div>
        
        <div class="mb-3 mt-3">
          <label for="provinceName" class="form-label">ชื่อจังหวัด:</label>
          <input type="text" class="form-control @error('provinceName') is-invalid @enderror" 
            id="provinceName"  name="provinceName"  value="{{old('provinceName')}}" placeholder="กรุณาระบุชื่อจังหวัด" >
          <div id="invalid-provinceName" class="invalid-feedback">{{ $errors->first('provinceName') }}</div>
        </div>

        <button type="submit" id="submit" class="btn btn-primary">บันทึกข้อมูล</button>

      </form>
    </div>
@endsection