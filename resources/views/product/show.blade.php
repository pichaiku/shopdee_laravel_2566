@extends('layouts.app')

@section('content')
  <h2>Bordered Table</h2>
  <p>The .table-bordered class adds borders to a table:</p>            
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
      </tr>
      <tr>
        <td>Mary</td>
        <td>Moe</td>
        <td>mary@example.com</td>
      </tr>
      <tr>
        <td>July</td>
        <td>Dooley</td>
        <td>july@example.com</td>
      </tr>
    </tbody>
  </table>
</div>

    <table class="table table-striped">
        <thead>
            <tr>
            <td>รหัสสินค้า</td>
            <td>ชื่อสินค้า</td>
            <td>รายละเอียด</td>
        </thead>
        <tbody>
            @foreach($product as $pro)
            <tr>
                <td>{{$pro->productID}}</td>
                <td>{{$pro->productName}}</td>
                <td>{{$pro->productDetail}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection