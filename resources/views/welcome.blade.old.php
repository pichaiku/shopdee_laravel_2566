@extends('layouts.site')

@section('content')
<ul class="row">
<?php 
$i=0;
foreach($products as $prod){
?>
 <div class="col-md-3 col-6">
     <div class="card" style="width :120px">
        <img src="<?=URL::to('/')?>/assets/product/<?=$prod->imageFile==''?'avatar.png':$prod->imageFile?>" 
        class="rounded" alt="ไฟล์รูปภาพ" style="width:120px;height:120px">
    </div>
    <div class="col-md-12">
        <div class="row">
            <span class="badge"><?=$prod->productName?></span>
            <input type="hidden" id="hdnProductID[]" name="hdnProductID[]" value="<?=$prod->productID?>"/>
        </div>
    </div>
    <div class="col-md-12 mb-1">
        <div class="row">
            <span class="badge bg-danger"><?=$prod->price?></span>
            <input type="hidden" id="hdnPrice[]" name="hdnPrice[]" value="<?=$prod->price?>"/>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="btn-group text-right">
                <button type="button" id="btnMinus[]" name="btnMinus[]" value="<?=$i;?>" class="btn btn-secondary btn-xs" style="width:24px;">-</button>
                <input type="number" id="txtQuantity[]" name="txtQuantity[]" value="1" class="text-sm-center p-1" style="width:42px;height:24px;"/>
                <button type="button" id="btnPlus[]" name="btnPlus[]" value="<?=$i;?>" class="btn btn-secondary btn-xs" style="width:24px;">+</button>
            </div>
            <button type="button" id="btnOrder[]" name="btnOrder[]" class="btn btn-primary btn-xs ml-2" style="width:24px;">
                <i class="fas fa-shopping-cart"></i>
            </button>
        </div>
        <div class="row mb-4"></div>
    </div>

</div>
<?php
    $i=$i+1;
}?>
</ul>
<ul class="row">
    <div class="col-md-12">
        ค้นพบทั้งหมด <?=count($products)?> รายการ</br>
        
    </div>
</ul>

<form action="order/create" method="post" name="orderFrm" id="orderFrm">
    <input type="hidden" id="productID" name="productID">
    <input type="hidden" id="price" name="price">
    <input type="hidden" id="quantity" name="quantity">
</form>
<script>
$('button[name^="btnMinus"]').each(function(index,field) {

    $(this).on('click', function() {
        $('input[name^="txtQuantity"]').each(function(index2,field2) {
      
            if(index==index2){
                var quantity = $(this).val()*1 - 1;
                if(quantity==0) quantity = 1;
                $(this).val(quantity);  
            }
        });    
    });  
});

$('button[name^="btnPlus"]').each(function(index,field) {

    $(this).on('click', function() {
        $('input[name^="txtQuantity"]').each(function(index2,field2) {
    
            if(index==index2){
                var quantity = $(this).val()*1 + 1;
                if(quantity==101) quantity = 100;
                $(this).val(quantity);  
            }
        });    
    });  
});

$('button[name^="btnOrder"]').each(function(index,field) {

    $(this).on('click', function() {
        var productID=null;
        $('input[name^="hdnProductID"]').each(function(index2,field) {
            if(index==index2){
                productID = $(this).val();
            }
        }); 

        var price=null;
        $('input[name^="hdnPrice"]').each(function(index2,field) {
            if(index==index2){
                price = $(this).val();
            }
        }); 

        var quantity=null;
        $('input[name^="txtQuantity"]').each(function(index2,field2) {

            if(index==index2){
                quantity = $(this).val();
            }
        });    

        $("#productID").val(productID);
        $("#price").val(price);
        $("#quantity").val(quantity);
        $("#orderFrm").submit();
    });  
});
</script>
 
@endsection  