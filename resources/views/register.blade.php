<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
@if ($errors->any())
    <div class="alert alert-danger" id="errors">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
<form id="myForm">
    @csrf
    <div>Name:<input type="text" name="name"></div>
    <div>Email:<input type="email" name="email"></div>
    <div>Password:<input type="password" name="password"></div>
    <div>Re-type Password:<input type="password" name="password_confirmation"></div>
    <div><input type="submit" name="Submit" id="submit"></div>
</form>

<div id="users">
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="{{asset('assets/js/ajax.js')}}"></script>
</html>