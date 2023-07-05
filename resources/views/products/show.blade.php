@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Product' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('products.product.destroy', $product->productID) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('products.product.index') }}" class="btn btn-primary" title="Show All Product">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('products.product.create') }}" class="btn btn-success" title="Create New Product">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('products.product.edit', $product->productID ) }}" class="btn btn-primary" title="Edit Product">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Product" onclick="return confirm(&quot;Click Ok to delete Product.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Product Name</dt>
            <dd>{{ $product->productName }}</dd>
            <dt>Product Detail</dt>
            <dd>{{ $product->productDetail }}</dd>
            <dt>Price</dt>
            <dd>{{ $product->price }}</dd>
            <dt>Quantity</dt>
            <dd>{{ $product->quantity }}</dd>
            <dt>Image File</dt>
            <dd>{{ $product->imageFile }}</dd>
            <dt>Type I D</dt>
            <dd>{{ $product->typeID }}</dd>

        </dl>

    </div>
</div>

@endsection