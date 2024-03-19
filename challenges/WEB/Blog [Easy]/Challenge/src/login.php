<?php

if(!isset($_COOKIE['session'])){
  // $cookie = base64_encode('{"isAdmin":0}');
  $cookie = "eyJpc0FkbWluIjowfQ";
  setcookie("session", $cookie);
}

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
/*form {border: 3px solid #f1f1f1;}*/

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}


.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

</style>
</head>
<body>
<div class="wrapper row1">
  <section class="hoc clear"> 
    <nav id="mainav">
      <ul class="clear">
        <li><a href="index.php">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Contact</a></li>
        <li class="active"><a href="login.php">Login</a></li>
      </ul>
    </nav>
  </section>
</div>

<br><br>
<h2>Login Form</h2>

<form action="result.php" method="post">

  <div class="container">
    <label for="username"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" required>
<br><br>
    <label for="pass"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="pass" required>
        
    <button type="submit">Login</button>

  </div>

</form>

</body>
</html>
