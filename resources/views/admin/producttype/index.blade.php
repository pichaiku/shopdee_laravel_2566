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
    <h2>ข้อมูลประเภทสินค้า</h2>            
  </div>

    
  <a href="{{ route('admin.producttype.create') }}" id="btnCreate" class="btn btn-success mb-3">เพิ่มข้อมูล</a>

    <table id="table" class="table table-striped" style="width:100%">
    <thead>
      <tr>
        <th>ประเภทสินค้า</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    
      @foreach($producttypes as $producttype)
      <tr>        
        <td style="width:80%;">{{ $producttype->typeName }}</td>
        <td>
          <form id="frmDelete{{$producttype->typeID}}" action="{{ route('admin.producttype.destroy', $producttype->typeID)}}" method="post">
            @csrf
            @method('DELETE')                        
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">            
              <a href="{{ route('admin.producttype.show',$producttype->typeID) }}" class="btn btn-info">แสดง</a>
              <a href="{{ route('admin.producttype.edit',$producttype->typeID) }}" class="btn btn-warning">แก้ไข</a>          
              <button id="btnDelete{{$producttype->typeID}}" class="btn btn-danger" type="button" onclick="deleteCustomer('frmDelete{{$producttype->typeID}}')">&nbsp;&nbsp;ลบ&nbsp;&nbsp;</button>            
            </div>
          </form>
        </td>
      </tr>
      @endforeach
      
    </tbody>  
  </table>
@endsection

