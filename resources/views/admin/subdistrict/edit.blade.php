@extends('layouts.admin')

@section('content')


<nav aria-label="breadcrumb" style="margin-top: 0px;margin-bottom: -10px;">
  <ol class="breadcrumb bg bg-light">
    <li class="breadcrumb-item ml-auto"><a href="{{ route('admin.subdistrict.index') }}">หน้าหลัก</a></li>
    <li class="breadcrumb-item active" aria-current="page">แก้ไขรายละเอียดตำบล</li>
  </ol>
</nav>


<div class="card">
  <div class="card-header h5">
    แก้ไขข้อมูลตำบล
  </div>
  <div class="card-body">
      <!-- /subdistrict/<?=request()->segment(count(request()->segments())-1)?> -->      
      <form method="post" action="{{ route('admin.subdistrict.update', $subdistrict->subdistrictID) }}">
        @csrf
          <div class="mb-3">
            <label for="provinceID" class="form-label">จังหวัด:</label>
            <select class="form-control @error('provinceID') is-invalid @enderror" 
              id="provinceID" name="provinceID">
              <option value=""></option>
              @foreach($provinces as $province)
                <option value="{{ $province->provinceID }}" {{$province->provinceID==$subdistrict->provinceID?"selected":""}} >{{ $province->provinceName }}</option>
              @endforeach
            </select>
            <div id="invalid-provinceID" class="invalid-feedback">{{ $errors->first('provinceID') }}</div>
          </div>

          <div class="mb-3">
            <label for="districtID" class="form-label">อำเภอ:</label>
            <select class="form-control @error('districtID') is-invalid @enderror" 
              id="districtID" name="districtID">
              <option value=""></option>
              @foreach($districts as $district)
                <option value="{{ $district->districtID }}" {{$district->districtID==$subdistrict->districtID?"selected":""}} >{{ $district->districtName }}</option>
              @endforeach
            </select>
            <div id="invalid-districtID" class="invalid-feedback">{{ $errors->first('districtID') }}</div>
          </div>       
           
          <div class="mb-3 mt-3">
            <label for="subdistrictID" class="form-label">รหัสตำบล:</label>
            <input type="text" class="form-control @error('subdistrictID') is-invalid @enderror" 
              id="subdistrictID"  name="subdistrictID"  value="{{$subdistrict->subdistrictID}}" placeholder="กรุณาระบุรหัสตำบล" >
            <div id="invalid-subdistrictID" class="invalid-feedback">{{ $errors->first('subdistrictID') }}</div>
          </div>

          <div class="mb-3 mt-3">
            <label for="subdistrictName" class="form-label">ชื่อตำบล:</label>
            <input type="text" class="form-control @error('subdistrictName') is-invalid @enderror" id="subdistrictName"  name="subdistrictName" value="{{$subdistrict->subdistrictName}}" placeholder="กรุณาระบุชื่อตำบล" >
            <div id="invalid-subdistrictName" class="invalid-feedback">{{ $errors->first('subdistrictName') }}</div>
          </div>
                    
          <button type="submit" id="submit" class="btn btn-primary">แก้ไขข้อมูล</button>
  
        </form>
  </div>
</div>

<script type="text/javascript">
  $('#provinceID').on('change', function() {   

    $('#districtID').empty();
    
    if($('#provinceID').val()!=""){
      var url = '<?=URL::to('/');?>/admin/district/province/' + $('#provinceID').val();

      $('#districtID').html('<option selected="selected" value="">Loading...</option>');

      $.ajax({
          url: url,
          type: "GET",
          dataType: "json",
          success:function(data) {
              //console.log(data);
              $('#districtID').html('<option selected="selected" value=""></option>');
              $.each(data, function(key, value) {
                  $('#districtID').append('<option value="'+data[key].districtID+'">'+data[key].districtName+'</option>');
              });

          }
      });

    }//if
  });
</script>              
@endsection