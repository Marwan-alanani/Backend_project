<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>Document</title>
</head>
<body class="bg-light">
    <div class="ml-3 mt-4 mb-3">
        <a class="btn btn-info " href="{{ route('type.view') }}" role="button">Filter</a>
        </div>
        <a class="ml-3" href="{{ route('product.create') }}"><button type="button" class="btn btn-primary">Create new product</button></a>
    <table class="table table-dark table-bordered table-hover mt-4 text-center">
        <thead >
          <tr>
            <th scope="col">#</th>
            <th scope="col">Product Name</th>
            <th scope="col">Men/Kids/Women</th>
            <th scope="col">Price</th>
            <th scope="col">Category</th>
            <th scope="col">Show Product</th>
            @if ($Role == "Admin")
            <th scope="col">Delete</th>
            <th scope="col">Edit</th>
            @endif
          </tr>
        </thead>
        <tbody>
            @if ($Role == "Admin")
            @foreach ($products as $product)
            <tr>
              <th scope="row">{{ $product->id }}</th>
              <td>{{ $product->Product_name }}</td>
              <td>{{ $product->Main_type }}</td>
              <td>{{ $product->Price }}</td>
              <td>{{ $product->category->Category }}</td>
              <td><a href="{{ route('product.show',['id'=>$product->id]) }}"><button type="button" class="btn btn-secondary">Show</button></a></td>
              <td><a href="{{route('product.delete',['id'=>$product->id]) }}"><button type="button" class="btn btn-danger">Delete</button></a></td>
              <td><a href="{{ route('product.edit',['id'=>$product->id]) }}"><button type="button" class="btn btn-light">Edit</button></a></td>
            </tr>
            @endforeach
            @else
            @foreach ($products as $product)
            <tr>
                <th scope="row">{{ $product->id }}</th>
                <td>{{ $product->Product_name }}</td>
                <td>{{ $product->Main_type }}</td>
                <td>{{ $product->Price }}</td>
                <td>{{ $product->category->Category }}</td>
                <td><a href="{{ route('product.show',['id'=>$product->id]) }}"><button type="button" class="btn btn-secondary">Show</button></a></td>
                @endforeach
            @endif
        </tbody>
      </table>
      
      <a class="btn btn-success ml-3 mt-2 mb-5" href="{{ route('dashboard') }}" role="button">Go to Dashboard</a>
</body>
</html>