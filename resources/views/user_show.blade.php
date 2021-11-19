<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>Document</title>
</head>
<body>
    <body class="bg-dark">
        <div class="container bg-light min-vh-100 d-flex flex-column align-items-center">
        <div class="table">
            <table class="mt-4 table table-dark">
                <thead>
                    <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Cart</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">{{$product->id}}</th>
                <td>{{$product->name}}</td>
                <td>{{$product->email}}</td>
                <td>{{$product->Role}}</td>
                <td>{{}}</td>
              </tr>
            </tbody>
          </table>
        </div>
        @if (auth()->user()->Role == "Admin")
        <a class="align-self-start mt-1" href="{{ route('product.edit',['id'=>$product->id]) }}"><button type="button" class="btn btn-secondary">Edit product</button></a>
        <a class="align-self-start mt-3" href="{{ route('product.delete',['id'=>$product->id]) }}"><button type="button" class="btn btn-danger">Delete Product</button></a>
        @endif
        <div class="mt-4 img">
            <img src="{{asset($product->relative_path)}}" alt="">
        </div>
        <a class="align-self-start mt-3" href="{{ route('products.view') }}"><button type="button" class="btn btn-success">Return to Product Page</button></a>
    </div>
</body>
</html>
