<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product_edit.css') }}">
    <title>Create Product</title>
</head>

<body class="bg-dark">
    <div class="main bg-light min-vh-100 w-50 d-flex flex-column align-items-center">
        <div class="d-flex flex-column align-content-center">
            <form class="mt-5" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mt-5">
                    <label for="Product name">Product Name</label>
                    <input class="form-control" type="text" name="Product_name" placeholder="Product Name">
                </div>
                <div class="form-group">
                    @if (isset($Error))
                    <div class="alert alert-danger" role="alert">
                        {{$Error}}
                    </div>
                    @else
                    <label for="image">Upload an Image</label>
                    @endif
                    <input class="form-control-file" type="file" name="image_path">
                </div>
                <div class="form-group">
                    <label for="Price">Price</label>
                    <input class="form-control" type="number" name="Price" placeholder="Enter product price">
                </div>
                <div class="form-group">
                    <label for="Main_type">Men/Women/Kids</label>
                    <select class="form-control" name="Main_type">
                        <option value="Men">Men</option>
                        <option value="Women">Women</option>
                        <option value="Kids">Kids</option>
                    </select>
                </div>

                <label for="Category">Select Category</label>
                @if ($categories != '[]')
                <select class="form-control" name="category" >
                    @foreach ($categories as $category)
                    <option value="{{ $category->Category }}">{{ $category->Category }}</option>
                    @endforeach
                    {{-- Or <a class="btn btn-primary ml-3 mt-3" href=""> --}}
                </select>
                @else
                <a class="mt-4" href="">Create a category</a>
                @endif

                </select>
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary">Create Product</button>
                </div>
            </form>
            <div class="align-self-start mb-3">
                <a href="{{ route('category.create') }}"><button class="btn btn-info w-100 ">Create a new category</button></a>
            </div>
            <div class="align-self-start">
                <a href="{{ route('products.view') }}"><button class="btn btn-success w-100 ">Go to Product Page</button></a>
            </div>
        </div>
    </div>
</body>

</html>
