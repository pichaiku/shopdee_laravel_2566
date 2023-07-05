@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb" style="margin-top: 0px;margin-bottom: -10px;">
  <ol class="breadcrumb bg bg-light">
    <li class="breadcrumb-item ml-auto"><a href="{{ route('admin.order.index') }}">รายการสั่งซื้อ</a></li>
    <li class="breadcrumb-item active" aria-current="page">รายละเอียดใบสั่งซื้อ</li>
  </ol>
</nav>


<div class="card mb-3 ml-3 mr-3">
  <div class="card-body">
         
    <div class="row">
        <div class="col-md-6">
            <strong>ที่อยู่ผู้ขาย</strong></br>
            <address>
                บริษัทสมมุติ จำกัด มหาชน</br>
                58 ถนนวิภาวดีรังสิต แขวงรัชดาภิเษก</br>
                เขตดินแดง กรุงเทพฯ 10400</br>
                เบอร์โทรศัพท์ : 0-2692-2360</br>
                อีเมล : pichai.j@cpc.ac.th
                  
            </address>
        </div>
        <div class="col-md-6">
            <strong>เลขที่ใบสั่งซื้อ : </strong> <?=$order->orderID;?></br>
            <strong>วันที่สั่งซื้อ : </strong> <?=$order->orderDate;?></br>
            <strong>ชื่อลูกค้า : </strong> <?=$order->firstName;?> <?=$order->lastName;?></br>
            <strong>ที่อยู่ : </strong> </br>
            <address>
                <?php
                if($order->provinceName=="กรุงเทพมหานคร"){
                  $subdistrict="แขวง";
                  $district="เขต";
                  $province="";
                }else{
                  $subdistrict="ตำบล";
                  $district="อำเภอ";
                  $province="จังหวัด";
                }
                ?>
                <?=$order->address==""?"":$order->address." ";?><br>
                <?=$subdistrict.$order->subdistrictName;?> <?=$district.$order->districtName;?><br>
                <?=$province.$order->provinceName;?> <?=$order->zipcode;?><br>
                เบอร์โทรศัพท์ : <?=$order->mobilePhone;?><br>
            </address>
        </div>
    </div>
      <!-- Table row -->
      <div class="row">
        <div class="col-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>ลำดับ</th>
              <th>รายการสินค้า</th>
              <th>จำนวน</th>
              <th>ราคาต่อหน่วย</th>
              <th>ราคารวม</th>
            </tr>
            </thead>
            <tbody>
            <?php
              $itemNo=1;
              $totalPrice=0;
              foreach($orderDetail as $ord){
                $totalPriceOfEach=$ord->quantity*$ord->price;
                $totalPrice=$totalPrice+$totalPriceOfEach;
            ?>
            <tr>
              <td class=""><?=$itemNo;?></td>
              <td class=""><?=$ord->productName;?></td>
              <td class="text-center"><?=$ord->quantity;?></td>
              <td class="text-center"><span>&#3647;</span><?=number_format($ord->price);?></td>
              <td class="text-center"><span>&#3647;</span><?=number_format($totalPriceOfEach);?></td>
            </tr>
            <?php
              $itemNo=$itemNo+1;
              }
            ?>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-6">
            
        </div>
        <div class="col-6">
        <div class="table-responsive">
            <table class="table">
              <tr>
                <th>ยอดรวม : </th>
                <td><span>&#3647;</span><?=number_format($totalPrice);?></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      
  </div>
</div>
@endsection