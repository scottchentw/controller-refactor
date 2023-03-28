<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="/user" method="post">
@csrf
name: <input type="text" name="name" value="{{ old('name') }}"><br>
email: <input type="email" name="email" value="{{ old('email') }}"><br>
password: <input type="password" name="password"><br>
password_confirmation: <input type="password" name="password_confirmation"><br>
<input type="submit">
</form>
</body>
</html>