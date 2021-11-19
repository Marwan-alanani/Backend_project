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
    <table class="table table-dark table-bordered table-hover mt-4 text-center ">
        <caption><div class="alert alert-warning" role="alert">Deleting a category will DELETE all related products</div></caption>
        <caption><div class="alert alert-warning" role="alert">
            Changing a category will CHANGE all related products categories
          </div></caption>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Related Products</th>
                @if (auth()->user()->Role == "Admin")
                <th scope="col">Delete</th>
                <th scope="col">Edit</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @if (auth()->user()->Role == "Admin")
            @foreach ($categories as $category)
            <tr>
                <th scope="row">{{ $category->id }}</th>
                <td>{{ $category->Category }}</td>
                <td><a href="{{ route('category.show',['id'=>$category->id]) }}"><button type="button"
                            class="btn btn-secondary">Show</button></a></td>
                <td><a href="{{ route('category.delete',['id'=>$category->id]) }}"><button type="button"
                            class="btn btn-danger">Delete</button></a></td>
                <td><a href="{{ route('category.edit',['id'=>$category->id]) }}"><button type="button"
                            class="btn btn-light">Edit</button></a></td>
            </tr>
            @endforeach
            @else
            @foreach ($categories as $category)
            <tr>
                <th scope="row">{{ $category->id }}</th>
                <td>{{ $category->Category }}</td>
                <td>{{ $category->products->id }}</td>
                <td><a href="{{ route('category.show',['id'=>$category->id]) }}"><button type="button"
                            class="btn btn-secondary">Show</button></a></td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    <div class="ml-3 mt-4">
        <a href="{{ route('category.create') }}"><button type="button" class="btn btn-primary">Create new
                Category</button></a>
    </div>
    <a class="btn btn-info ml-3 mt-3" href="{{ route('product.create') }}" role="button">Create a new product</a><br>
    <a class="btn btn-success ml-3 mt-3" href="{{ route('dashboard') }}" role="button">Go to Dashboard</a>
</body>

</html>
