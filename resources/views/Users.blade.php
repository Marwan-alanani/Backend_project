<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>Users</title>
</head>
<body class="bg-light">
    <table class="table table-dark table-bordered table-hover mt-4 text-center ">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">Show</th>
            @if (auth()->user()->Role == "Admin")
            <th scope="col">Delete</th>
            <th scope="col">Edit</th>
            @endif
          </tr>
        </thead>
        <tbody>
            @if (auth()->user()->Role == "Admin")
            @foreach ($users as $user)
            <tr>
            <th scope="row">{{ $user->id }}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->Role }}</td>
            <td><a href="{{ route('user.show',['id'=>$user->id]) }}"><button type="button" class="btn btn-secondary">Show</button></a></td>
            <td><a href="{{route('user.delete',['id'=>$user->id]) }}"><button type="button" class="btn btn-danger">Delete</button></a></td>
            <td><a href="{{ route('user.edit',['id'=>$user->id]) }}"><button type="button" class="btn btn-light">Edit</button></a></td>
          </tr>
          @endforeach
          @else
          @foreach ($users as $user)
          <tr>
            <th scope="row">{{ $user->id }}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->Role }}</td>
            <td><a href="{{ route('user.show',['id'=>$user->id]) }}"><button type="button" class="btn btn-secondary">Show</button></a></td>
          </tr>
          @endforeach
            @endif
        </tbody>
      </table>
      <div class="ml-3 mt-4">
        <a href="{{ route('user.create') }}"><button type="button" class="btn btn-primary">Create new User</button></a>
    </div>
    <a class="btn btn-success ml-3 mt-3" href="{{ route('dashboard') }}" role="button">Go to Dashboard</a>
</body>
</html>
