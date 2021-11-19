<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product_edit.css') }}">
    <title>Document</title>
</head>

<body class="bg-dark">
    <div class="main bg-light min-vh-100 w-50 d-flex flex-column align-items-center">
        <div class="d-flex flex-column align-content-center">
            <form class="mt-5" action="{{ route('product.update',['id'=>$product->id]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group mt-5">
                    <label for="Product name">Product Name</label>
                    <input class="form-control" type="text" name="Product_name" placeholder="Product Name"
                        value="{{ $product->Product_name }}">
                </div>
                <div class="form-group">
                    <label for="image">Change Product's Image</label>
                    <input class="form-control-file" type="file" name="image_path" value="{{ $product->image_path }}">
                    <a class="d-block mt-3" href="{{route('product.show',['id'=>$product->id])}}">Show Current
                        Product</a>
                </div>
                <div class="form-group">
                    <label for="Price">Price</label>
                    <input class="form-control" type="number" name="Price" placeholder="Enter product price"
                        value="{{ $product->Price }}">
                </div>
                <div class="form-group">
                    <label for="Main_type">Men/Women/Kids</label>
                    <select class="form-control" name="Main_type">
                        @if ($product->Main_type == "Women")
                        <option value="Men">Men</option>
                        <option value="Women" selected>Women</option>
                        <option value="Kids">Kids</option>
                        @elseif ($product->Main_type == "Kids")
                        <option value="Men">Men</option>
                        <option value="Women">Women</option>
                        <option value="Kids" selected>Kids</option>
                        @else
                        <option value="Men">Men</option>
                        <option value="Women">Women</option>
                        <option value="Kids">Kids</option>
                        @endif
                    </select>
                </div>

                <label for="Category">Select Category</label>
                @if ($categories != '[]')
                <select class="form-control" name="category">
                    @foreach ($categories as $category)
                    @if ($category->Category == $product->category->Category)
                    <option value="{{ $category->Category }}" selected>{{ $category->Category }}</option>
                    @else
                    <option value="{{ $category->Category }}">{{ $category->Category }}</option>
                    @endif
                    @endforeach
                    {{-- Or <a class="btn btn-primary ml-3 mt-3" href=""> --}}
                </select>
                @else
                <a class="mt-4" href="">Create a category</a>
                @endif

                </select>
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary w-50 mt-3">Edit Product</button>
                </div>
            </form>
            <div class="form-group mt-2">
                <a href="{{ route('products.view') }}"><button class="btn btn-success w-75">Go to Product
                        Page</button></a>
            </div>
        </div>
    </div>
</body>

</html>
