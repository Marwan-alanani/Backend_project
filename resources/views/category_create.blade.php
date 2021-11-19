<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product_edit.css') }}">
    <title>Create Category</title>
</head>

<body class="bg-dark">
    <div class="main bg-light min-vh-100 w-50 d-flex flex-column align-items-center justify-content-center">
        <div class="d-flex flex-column align-content-center">
            <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mt-5">
                    <label for="Category">Category Name</label>
                    <input class="form-control" type="text" name="Category" placeholder="Category Name">
                </div>
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary">Create Category</button>
                </div>
            </form>
            <div class="mb-3">
                <a href="{{route('product.create')}}"><button class="btn btn-info">Create new product</button></a>
            </div>
            <div>
                <a href="{{route('categories.view')}}"><button class="btn btn-success">Return To Category Page</button></a>
            </div>
        </div>
    </div>
</body>
</html>