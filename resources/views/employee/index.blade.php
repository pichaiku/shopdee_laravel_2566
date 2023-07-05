@extends('layouts.site')
@section('content')
<script>
  
</script>
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif

  <form method="get" action="" class="mb-3 ml-3 mr-3">
  {{csrf_field()}}
    <div class="row">
        <div class=" col-md-6 mb-3">
          <a href="{{ route('employee.add')}}" class="btn btn-success">
          เพิ่มข้อมูลพนักงาน
          </a>
        </div>
        <div class=" col-md-6 mb-3">
          <div style="float: right !important" class="form-inline">
            <label for="search" class="mr-2">ค้นหา:</label>
            <input type="text" name="search" value="{{ request()->search }}" placeholder="กรุณาระบุคำค้น" class="form-control mb-2 mr-2" >
          </div>
        </div>
    </div>



    <table class="table table-striped">
      <thead>
          <tr>
            <td>รหัสพนักงาน</td>
            <td>ชื่อ</td>
            <td>นามสกุล</td>
            <td>ชื่อผู้ใช้</td>
            <td>รหัสผ่าน</td>
            <td colspan="3">Action</td>
          </tr>
      </thead>
      <tbody>
          @foreach($employees as $emp)
          <tr>
              <td>{{$emp->empID}}</td>
              <td>{{$emp->firstName}}</td>
              <td>{{$emp->lastName}}</td>
              <td>{{$emp->username}}</td>
              <td>{{$emp->password}}</td>
              <td><a href="{{ route('employee.view',$emp->empID)}}" class="btn btn-primary">แสดง</a></td>
              <td><a href="{{ route('employee.edit',$emp->empID)}}" class="btn btn-warning">แก้ไข</a></td>
              <td>
                  <!--
                  <form action="{{ route('employee.delete', $emp->empID)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">ลบ</button>
                  </form>
                  -->
                  <a class="btn btn-danger" onclick="return confirm('คุณต้องการลบข้อมูลรายการนี้?')" href="{{ route('employee.delete', $emp->empID)}}">
                  ลบ
                  </a>

              </td>
          </tr>
          @endforeach
      </tbody>
      <tfoot>
        <tr>
          <td colspan="8">
          <!-- ค้นพบทั้งหมด {{$employees->total()}} รายการ
          {{ $employees->appends(\Request::except('_token'))->render() }} -->
          </td>
        </tr>
      </tfoot>
    </table>
  </form>
<div>
@endsection