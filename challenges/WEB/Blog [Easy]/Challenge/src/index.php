<?php

if(!isset($_COOKIE['session'])){
  // $cookie = base64_encode('{"isAdmin":0}');
  $cookie = "eyJpc0FkbWluIjowfQ";
  setcookie("session", $cookie);
}

?>

<!DOCTYPE html>

<html lang="">

<head>
<title>Wavefire</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
</head>
<body id="top">

<div class="wrapper row1">
  <section class="hoc clear"> 
    <!-- ################################################################################################ -->
    <nav id="mainav">
      <ul class="clear">
        <li class="active"><a href="index.php">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="login.php">Login</a></li>
      </ul>
    </nav>
  </section>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper bgded overlay" style="background-image:url('https://c0.wallpaperflare.com/preview/639/306/330/aerial-background-blog-cafe.jpg');">
  <div id="pageintro" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <article>
      <p>Sharing my latest discovries</p>
      <h3 class="heading">Welcome to my Blog</h3>
      <footer><a class="btn" href="#">Read more <i class="fas fa-angle-right"></i></a></footer>
    </article>
    <!-- ################################################################################################ -->
  </div>
</div>
</body>
</html>