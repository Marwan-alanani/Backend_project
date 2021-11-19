<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
    <title>Cart</title>
</head>
<body>
    
    <div class="container">
    <h1 style="font-weight:300">{{ auth()->user()->name }}'s Cart</h1>
  <div class="cart-table ">
  <!-- cart-row-->
    @foreach ($Cart as $item)
        
    <div class="row cart-row">
        <div class="col-xs-12 col-md-2">
            <img src="{{ asset($item->product->relative_path) }}" width="100%">
        </div>
        <div class="col-md-6">
            <div class="product-articlenr">#{{ $item->product->id }}</div>
            <div class="product-name">{{ $item->product->Product_name }}</div>
            <div class="product-options mt-4"><span>Gender:</span> {{ $item->product->Main_type }}</div>
        </div>
        <div class="col-md-3 cart-actions">
            <div class="product-price-total">${{ $item->product->Price }}</div>
            <div class="product-delete">
            <a href="{{ route('DeleteCart',['id'=>$item->id]) }}"><button type="button" data-toggle="tooltip" title="Remove" class="delete"><i class="fas fa-times-circle"></i></i></button></a>
            </div>
        </div>
    </div>
        @endforeach
<!-- cart-row-->
    
   
  <div class="row cart-special-holder">
    <div class="col-md-12">
  <div class="cart-special"><div class="cart-special-content">Total: ${{ $Total }}</div></div>
    </div>
    
  </div>
    <div class="back mb-4">
        <a href="{{ route('home') }}"><i class="fas fa-long-arrow-alt-left"></i>Go back</a>
    </div>
  </div>
</body>
</html>