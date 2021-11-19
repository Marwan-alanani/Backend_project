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
    <div class="container">
        <div class="d-flex  flex-column min-vh-100 justify-content-center align-items-center flex-wrap">
            <a class="d-block w-100 mb-3" href="{{ route('type.show',['Main_type'=>'Men']) }}"><button type="button" class="btn btn-primary btn-lg btn-block">Men</button></a>
            <a class="d-block w-100 mb-3" href="{{ route('type.show',['Main_type'=>'Women']) }}"><button type="button" class="btn btn-primary btn-lg btn-block">Women</button></a>
            <a class="d-block w-100 mb-3" href="{{ route('type.show',['Main_type'=>'Kids']) }}"><button type="button" class="btn btn-primary btn-lg btn-block">Kids</button></a>
            <a class="d-block w-100 mb-3" href="{{ route('products.view') }}"><button type="button" class="btn btn-outline-info btn-lg btn-block">View All Products</button></a>
            <a class="d-block w-100" href="{{ route('dashboard') }}"><button type="button" class="btn btn-success btn-lg btn-block">Return to Dashboard</button></a>
    </div>
</div>
</body>
</html>