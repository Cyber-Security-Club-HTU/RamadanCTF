<?php
   session_start();
   if(!isset($_SESSION['id']) && !isset($_SESSION['secret']))
   {
      $_SESSION['id'] = random_int(10000000, 99999999);
      $_SESSION['secret'] = bin2hex(random_bytes(8));
   }

   header("Secret: ".$_SESSION['secret'])

?>

<!DOCTYPE html>
<html>
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>HTU Cafe</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <!-- fevicon -->
      <link rel="icon" href="images/fevicon.png" type="image/gif" />
      <!-- font css -->
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
   </head>
   <body>
       <div class="header_section">
         <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
               <a class="navbar-brand"href="index.html"><img src="images/logo.png"></a>
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav ml-auto">
                     <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home</a>
                     </li>
                     <li class="nav-item active">
                        <a class="nav-link" href="#">Coffees</a>
                     </li>
                     <li class="nav-item active">
                        <a class="nav-link" href="#">Contact</a>
                     </li>
                  </ul>
                  <form class="form-inline my-2 my-lg-0">
                     <div class="login_bt">
                        <ul>
                           <li><a href="profile.php"><span class="user_icon"><i class="fa fa-user" aria-hidden="true"></i></span>User</a></li>
                        </ul>
                     </div>
                  </form>
               </div>
            </nav>
         </div>

         <div class="client_taital_main">
        <div class="client_left">
          <div class="client_img"><img src="https://static.thenounproject.com/png/3278830-200.png"></div>
        </div>
        <div class="client_right">
          <h3 class="moark_text">ID</h3>
          <p class="client_text"><?php echo($_SESSION['id']) ?></p>
          <br>
          <h3 class="moark_text">Name</h3>
          <p class="client_text">CTF Player</p>
        </div>
      </div>
   </body>
</html>