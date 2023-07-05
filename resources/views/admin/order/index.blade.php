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
<script>
  $(function () {
    $("#tablex").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#tablex_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

  <div class="bg-light">&nbsp;</div>
  <table id="table" class="table table-striped" style="width:100%">
    <thead>
      <tr>
        <th>เลขที่ใบสั่งซื้อ</th>
        <th>วันที่สั่งซื้อ</th>
        <th>จำนวนเงิน</th>
        <th>สถานะ</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    
      @foreach($orders as $order)
      <tr>
        <td style="width: 120px;">{{ $order->orderID }}</td>
        <td>{{ $order->orderDate}}</td>
        <td><span>&#3647;</span>{{ number_format($order->totalPrice) }}</td>
        <td>{{ $order->statusName }}</td>
        <td style="width: 20%;">
          <form id="frmDelete{{$order->orderID}}" action="{{ route('admin.order.destroy', $order->orderID)}}" method="post">
            @csrf
            @method('DELETE')            
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">  
              <a href="{{ route('admin.order.show',$order->orderID) }}" class="btn btn-info">แสดง</a>
              <a href="{{ route('admin.order.edit',$order->orderID) }}" class="btn btn-warning">แก้ไข</a>
              <button id="btnDelete{{$order->orderID}}" class="btn btn-danger" type="button" onclick="deleteProduct('frmDelete{{$order->orderID}}')">&nbsp;&nbsp;ยกเลิก&nbsp;&nbsp;</button>
            </div>
          </form>          
        </td>
      </tr>
      @endforeach
      
    </tbody>  
  </table>
@endsection

