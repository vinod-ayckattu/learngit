@if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
<form action="" method="POST">
    @csrf
    <div>Email:<input type="email" name="email"></div>
    <div>Password:<input type="password" name="password"></div>
    <div><input type="submit" name="Submit"></div>
</form>