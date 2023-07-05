@extends('layouts.app')

@section('content')
<style>
    .uper {
        margin-top: 40px;
    }
</style>
<div class="card uper mb-3 ml-3 mr-3" style="">
    <div class="card-header">
        รายละเอียดข้อมูลพนักงาน
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

        <div class="row">
            <div class=" col-md-8 mb-3">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">ชื่อ:</label>
                        {{$employee->firstName}}
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">นามสกุล:</label>
                        {{$employee->lastName}}
                    </div>
                </div> 
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="positionID">ตำแหน่ง:</label>
                        {{$employee->positionName}}
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email">อีเมล:</label>
                        {{$employee->email}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="username">ชื่อผู้ใช้:</label>
                        {{$employee->username}}
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password">รหัสผ่าน:</label>
                        {{$employee->password}}
                    </div>
                </div>
            </div>
            <div class=" col-md-4 mb-3">
                <div class="card" style="width:120px">
                    <img src="/assets/employee/<?=$employee->imageFile==''?'avatar.png':$employee->imageFile?>" 
                    class="rounded" alt="ไฟล์รูปภาพ" style="width:120px;height:120px">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="address">บ้านเลขที่:</label>
                {{$employee->address}}
            </div>
            <div class="col-md-4 mb-3">
                <label for="villageNo">หมู่ที่:</label>                
            </div>
            <div class="col-md-4 mb-3">
                <label for="road">ถนน:</label>                
            </div>  
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="provinceID">จังหวัด:</label>
                {{$employee->provinceName}}
            </div>
            <div class="col-md-4 mb-3">
                <label for="districtID">อำเภอ:</label>
                {{$employee->districtName}}
            </div>
            <div class="col-md-4 mb-3">
                <label for="subdistrictID">ตำบล:</label>
                {{ $employee->subdistrictName}}
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="zipcode">รหัสไปรษณีย์:</label>
                {{$employee->zipcode}}
            </div>
            <div class="col-md-4 mb-3">
                <label for="mobilePhone">โทรศัพท์บ้าน:</label>
                {{$employee->homePhone}}
            </div>
            <div class="col-md-4 mb-3">
                <label for="mobilePhone">โทรศัพท์เคลื่อนที่:</label>
                {{$employee->mobilePhone}}
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="birthDate">วันเกิด:</label>
                {{$employee->birthDate}}
            </div>
            <div class="col-md-4 mb-3">
                <label for="gender">เพศ:</label>
                <?=$employee->gender=='0'?'ชาย':'หญิง'?>
            </div>
            <div class="col-md-4 mb-3">
                <label for="isActive">นำไปใช้งาน:</label>
                <?=$employee->isActive=='1'?'ใช่':'ไม่ใช่'?>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('employee.index')}}">
                <button type="button" class="btn btn-secondary" style="width:100px;margin-top:5px">ย้อนกลับ</button>
            </a>
        </div>
    </div>
    
</div>
@endsection