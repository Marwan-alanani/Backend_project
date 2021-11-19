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
  <table class="table table-striped table-bordered table-light mt-5 text-center">
    <tr>
      <td></td>
      <th scope="col">Users</th>
      <th scope="col">Products</th>
      <th scope="col">Categories</th>
    </tr>
    <tr>
      <th scope="row">No. of </th>
      <td>{{$NoUsers}}</td>
      <td>{{$NoProducts}}</td>
      <td>{{$NoCategories}}</td>
    </tr>
    <tr>
      <th scope="row">Controllers</th>
      <td><a href="{{ route('users.view') }}"><button type="button" class="btn btn-info">User Page</button></a></td>
      <td><a href="{{ route('products.view') }}"><button type="button" class="btn btn-info">Product Page</button></a></td>
      <td><a href="{{ route('categories.view') }}"><button type="button" class="btn btn-info">Category Page</button></a></td>
    </tr>
  </table>
<a class="ml-3 mt-2" href="{{route('home')}}"><button type="button" class="btn btn-success">Return Home</button></a>
</body>
</html>
