@extends('layouts.app')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper mb-3 ml-3 mr-3">
  <div class="card-header">
    แก้ไขข้อมูลพนักงาน
  </div>
    <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
    <form method="post" action="{{ route('employee.update', $employee->employeeID) }}" enctype="multipart/form-data">
    @method('PUT')
    @csrf
      <div class="row">
        <div class=" col-md-8 mb-3">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="firstName">ชื่อ:</label>
                    <input type="text" class="form-control" name="firstName" value="{{$employee->firstName}}" maxlength="100" required/>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="lastName">นามสกุล:</label>
                    <input type="text" class="form-control" name="lastName" value="{{$employee->lastName}}" maxlength="100" required/>
                </div>
            </div> 
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="positionID">ตำแหน่ง:</label>
                    <select class="custom-select d-block w-100" id="positionID" name="positionID" required="">
                      <option value=""></option>
                        @foreach($emptypes as $emptype)
                            <option value="{{ $emptype->positionID}}" <?=$emptype->positionID==$employee->positionID?'selected':''?>>
                            {{ $emptype->positionName}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email">อีเมล:</label>
                    <input type="email" class="form-control" name="email" value="{{$employee->email}}" maxlength="100" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="username">ชื่อผู้ใช้:</label>
                    <input type="text" class="form-control" name="username" value="{{$employee->username}}" maxlength="20" required/>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="password">รหัสผ่าน:</label>
                    <input type="password" class="form-control" name="password" value="{{$employee->password}}" maxlength="100" required/>
                </div>
            </div>
        </div>
        <div class=" col-md-4 mb-3">
            <label for="file">รูปภาพ:</label>
            <div class="card" style="width:180px">
                <img src="/assets/employee/<?=$employee->imageFileName==''?'avatar.png':$employee->imageFileName?>" 
                    class="rounded" alt="ไฟล์รูปภาพ" style="width:180px;height:180px">
                <input type="file" name="file"/>
            </div>
            
        </div>
      </div>

      <div class="row">
          <div class="col-md-4 mb-3">
              <label for="houseNo">บ้านเลขที่:</label>
              <input type="text" class="form-control" name="houseNo" value="{{$employee->houseNo}}" maxlength="10"/>
          </div>
          <div class="col-md-4 mb-3">
              <label for="villageNo">หมู่ที่:</label>
              <input type="number" class="form-control" name="villageNo" value="{{$employee->villageNo}}" min="1" max="20" step="1"/>
          </div>
          <div class="col-md-4 mb-3">
              <label for="road">ถนน:</label>
              <input type="text" class="form-control" name="road" value="{{$employee->road}}" maxlength="100"/>
          </div>  
      </div>

      <div class="row">
          <div class="col-md-4 mb-3">
              <label for="provinceID">จังหวัด:</label>
              <select class="custom-select d-block w-100" id="provinceID" name="provinceID" required="">
                  <option value=""></option>
                  @foreach($provinces as $province)
                      <option value="{{ $province->provinceID}}" <?=$province->provinceID==$employee->provinceID?'selected':''?>>
                      {{ $province->provinceName}}
                      </option>
                  @endforeach
              </select>
          </div>
          <div class="col-md-4 mb-3">
              <label for="districtID">อำเภอ:</label>
              <select class="custom-select d-block w-100" id="districtID" name="districtID" required="">
                  <option value=""></option>
                  @foreach($districts as $district)
                      <option value="{{ $district->districtID}}" <?=$district->districtID==$employee->districtID?'selected':''?>>
                      {{ $district->districtName}}
                      </option>
                  @endforeach
              </select>
          </div>
          <div class="col-md-4 mb-3">
              <label for="subdistrictID">ตำบล:</label>
              <select class="custom-select d-block w-100" id="subdistrictID" name="subdistrictID" required="">
                  <option value=""></option>
                  @foreach($subdistricts as $subdistrict)
                      <option value="{{ $subdistrict->subdistrictID}}" <?=$subdistrict->subdistrictID==$employee->subdistrictID?'selected':''?>>
                      {{ $subdistrict->subdistrictName}}
                      </option>
                  @endforeach
              </select>
          </div>
      </div>

      <div class="row">
          <div class="col-md-4 mb-3">
              <label for="zipcode">รหัสไปรษณีย์:</label>
              <input type="number" class="form-control" name="zipcode" value="{{$employee->zipcode}}" min="10000" max="99999"/>
          </div>
          <div class="col-md-4 mb-3">
                    <label for="homePhone">โทรศัพท์บ้าน:</label>
                    <input type="tel" class="form-control"  value="{{$employee->homePhone}}" name="homePhone" placeholder="0 5324 6829" 
                            pattern="[0-9]{1} [0-9]{4} [0-9]{4}" required/>
                </div>
          <div class="col-md-4 mb-3">
              <label for="mobilePhone">โทรศัพท์เคลื่อนที่:</label>
              <input type="tel" class="form-control" name="mobilePhone" value="{{$employee->mobilePhone}}" placeholder="08 9579 2385" 
                      pattern="[0-9]{2} [0-9]{4} [0-9]{4}" required/>
          </div>
      </div>

      <div class="row">
          <div class="col-md-4 mb-3">
              <label for="birthDate">วันเกิด:</label>
              <input type="date" class="form-control" name="birthDate" value="{{$employee->birthDate}}" min="1920-12-31" max="<?=date('Y-m-d')?>"/>
          </div>
          <div class="col-md-4 mb-3">
              <label for="gender">เพศ:</label>
              <div class="form-group">
              <input type="radio" id="male" name="gender" value="0" <?=$employee->gender=='0'?'checked':''?>>
              <label for="male">ชาย</label>
              <input type="radio" id="female" name="gender" value="1" <?=$employee->gender=='1'?'checked':''?>>
              <label for="female">หญิง</label>
              </div>
          </div>
          <div class="col-md-4 mb-3">
              <label for="isActive">นำไปใช้งาน:</label>
              <div class="form-group">
              <input type="radio" id="active_yes" name="isActive" value="1" <?=$employee->isActive=='1'?'checked':''?>>
              <label for="active_yes">ใช่</label>
              <input type="radio" id="active_no" name="isActive" value="0" <?=$employee->isActive=='0'?'checked':''?>>
              <label for="active_no">ไม่ใช่</label>
              </div>
          </div>
      </div>

      <button type="submit" class="btn btn-primary mb-3" style="width:100px">บันทึก</button>
      <button type="reset" class="btn btn-danger mb-3" style="width:100px">ยกเลิก</button>
      <a href="{{ route('employee.index')}}">
        <button type="button" class="btn btn-secondary mb-3" style="width:100px">ย้อนกลับ</button>
      </a>
    </form>
    </div>
</div></br>

<script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
<script type="text/javascript">
  $('#provinceID').on('change', function() {
      var url = '/employee/district/' + $('#provinceID').val();
      $('#districtID').empty();
      $('#subdistrictID').empty();
      $('#districtID').html('<option selected="selected" value="">Loading...</option>');

      $.ajax({
          url: url,
          type: "GET",
          dataType: "json",
          success:function(data) {
              //console.log(data);
              $('#districtID').html('<option selected="selected" value=""></option>');
              $.each(data, function(key, value) {
                  $('#districtID').append('<option value="'+key+'">'+value+'</option>');
              });

          }
      });
  });

  $('#districtID').on('change', function() {
      var url = '/employee/subdistrict/' + $('#districtID').val();
      $('#subdistrictID').empty();
      $('#subdistrictID').html('<option selected="selected" value="">Loading...</option>');

      $.ajax({
          url: url,
          type: "GET",
          dataType: "json",
          success:function(data) {
              //console.log(data);
              $('#subdistrictID').html('<option selected="selected" value=""></option>');
              $.each(data, function(key, value) {
                  $('#subdistrictID').append('<option value="'+key+'">'+value+'</option>');
              });

          }
      });
  });
</script>
@endsection