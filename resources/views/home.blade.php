<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
@auth
    <p>Welcome to Page</p>
    <form action="/logout" method="POST">
        @csrf
       {{ csrf_field() }} 
        <button>Logout</button>
    </form>

  <div style="border: 3px solid black;">
    <h2>Create a New Post</h2>
    <form action="/create-post" method="POST">
      @csrf
       {{ csrf_field() }} 
      <input type="text" name="title" placeholder="title">
      <textarea  name="body" placeholder="text"></textarea>
     
      <button>Create Post</button>
    </form>
  </div>
@else
<div style="border: 3px solid black;">
    <h2>Register</h2>
    <form action="/register" method="POST">
      @csrf
       {{ csrf_field() }} 
      <input type="text" name="name" placeholder="name">
      <input type="text" name="email" placeholder="email">
      <input type="password" name="password" placeholder="password">
      <button>Register</button>
    </form>
  </div>
<div style="border: 3px solid black;">
    <h2>Login</h2>
    <form action="/login" method="POST">
      @csrf
       {{ csrf_field() }} 
      <input type="text" name="login_name" placeholder="name">     
      <input type="password" name="login_password" placeholder="password">
      <button>Login</button>
    </form>
  </div>
@endauth

  
</body>

</html>