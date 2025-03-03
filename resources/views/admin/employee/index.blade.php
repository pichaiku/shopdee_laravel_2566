@extends('layouts.admin')

@section('content')
<script>
  $(document).ready(function() {
      $('#table').DataTable(
        {
          oLanguage: {"sSearch": "ค้นหา:"},          
        });
      
    } 
  );
</script>

@if(session()->get('success'))
  <script>    
    Swal.fire(
      'บันทึกข้อมูลเรียบร้อยแล้ว',
      '',
      'success'
    )
  </script>
@endif

@if(session()->get('delete'))
  <script>    
    Swal.fire(
      'คุณได้ทำการลบช้อมูลเรียบร้อยแล้ว',
      '',
      'success'
    )
  </script>
@endif

<script>
  function deleteCustomer(form){
    Swal.fire({
    title: 'คุณต้องการลบข้อมูลรายการนี้ใช่หรือไม่?',
    text: '',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',    
    confirmButtonText: 'ใช่',
    cancelButtonText: "ไม่ใช่"    
    }).then((result) => {
      if (result.isConfirmed) {    
        $("#"+form).submit();        
      }
    })    
  }
</script>


  <div class="alert alert-secondary">
    <h2>ข้อมูลพนักงาน</h2>            
  </div>
  
  <!-- @if(session()->get('success'))
  <div class="alert alert-success">
    {{ session()->get('success') }}  
  </div><br />
  @endif -->
    
  <a href="{{ route('admin.employee.create') }}" id="btnCreate" class="btn btn-success mb-3">เพิ่มข้อมูล</a>

    <table id="table" class="table table-striped" style="width:100%">
    <thead>
      <tr>
        <th>ชื่อผู้ใช้</th>
        <th>ชื่อ</th>
        <th>นามสกุล</th>
        <th>อีเมล</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    
      @foreach($employees as $employee)
      <tr>
        <td>{{ $employee->username }}</td>
        <td>{{ $employee->firstName }}</td>
        <td>{{ $employee->lastName }}</td>
        <td>{{ $employee->email }}</td>
        <td style="width: 20%;">

          <form id="frmDelete{{$employee->empID}}" action="{{ route('admin.employee.destroy', $employee->empID)}}" method="post">
            @csrf
            @method('DELETE')  
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">                                 
              <a href="{{ route('admin.employee.show',$employee->empID) }}" class="btn btn-info">แสดง</a>
              <a href="{{ route('admin.employee.edit',$employee->empID) }}" class="btn btn-warning">แก้ไข</a>
              <button id="btnDelete{{$employee->empID}}" class="btn btn-danger" type="button" onclick="deleteCustomer('frmDelete{{$employee->empID}}')">&nbsp;&nbsp;ลบ&nbsp;&nbsp;</button>
            </div>
          </form>
          
        </td>
      </tr>
      @endforeach
      
    </tbody>  
  </table>
@endsection

