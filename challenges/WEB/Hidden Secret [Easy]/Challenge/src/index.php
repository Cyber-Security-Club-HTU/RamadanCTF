<?php
   session_start();
   if(!isset($_SESSION['id']) && !isset($_SESSION['secret']))
   {
      $_SESSION['id'] = random_int(10000000, 99999999);
      $_SESSION['secret'] = bin2hex(random_bytes(8));
   }

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
      <!-- Responsive-->
      <link rel="stylesheet" href="css/responsive.css">
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
         <!-- banner section start --> 
         <div class="banner_section layout_padding">
            <div class="container">
               <div id="banner_slider" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="row">
              <div class="col-md-6">
                <div class="banner_img"><img src="images/banner-img.png" alt="website template image"></div>
              </div>
              <div class="col-md-6">
                <div class="banner_taital_main">
                  <h1 class="banner_taital">coffee</h1>
                  <h5 class="tasty_text">Tasty Of HTU Cafe</h5>
                  <p class="banner_text">more-or-less normal distribution of letters, as opposed to using</p>
                  <div class="btn_main">
                    <div class="about_bt"><a href="#">About Us</a></div>
                    <div class="callnow_bt active"><a href="#">Call Now</a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="row">
              <div class="col-md-6">
                <div class="banner_img"><img src="images/banner-img.png" alt="website template image"></div>
              </div>
              <div class="col-md-6">
                <div class="banner_taital_main">
                  <h1 class="banner_taital">coffee</h1>
                  <h5 class="tasty_text">Tasty Of HTU Cafe</h5>
                  <p class="banner_text">more-or-less normal distribution of letters, as opposed to using</p>
                  <div class="btn_main">
                    <div class="about_bt"><a href="#">About Us</a></div>
                    <div class="callnow_bt active"><a href="#">Call Now</a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="row">
              <div class="col-md-6">
                <div class="banner_img"><img src="images/banner-img.png" alt="website template image"></div>
              </div>
              <div class="col-md-6">
                <div class="banner_taital_main">
                  <h1 class="banner_taital">coffee</h1>
                  <h5 class="tasty_text">Tasty Of HTU Cafe</h5>
                  <p class="banner_text">more-or-less normal distribution of letters, as opposed to using</p>
                  <div class="btn_main">
                    <div class="about_bt"><a href="#">About Us</a></div>
                    <div class="callnow_bt active"><a href="#">Call Now</a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
               </div>
            </div>
         </div>
         <!-- banner section end -->
      </div>
      <!-- header section end -->
      <!-- coffee section start -->
      <div class="coffee_section layout_padding">
         <div class="container">
            <div class="row">
               <h1 class="coffee_taital">OUR Coffee OFFER</h1>
               <div class="bulit_icon"><img src="images/bulit-icon.png"></div>
            </div>
         </div>
         <div class="coffee_section_2">
            <div id="main_slider" class="carousel slide" data-ride="carousel">
               <div class="carousel-inner">
                  <div class="carousel-item active">
                     <div class="container-fluid">
                        <div class="row">
                           <div class="col-lg-3 col-md-6">
                              <div class="coffee_img"><img src="images/img-1.png"></div>
                              <h3 class="types_text">TYPES OF COFFEE</h3>
                              <p class="looking_text">looking at its layout. The point of</p>
                              <div class="read_bt"><a href="order.php?name=coffee1&q=1">Order</a></div>
                           </div>
                           <div class="col-lg-3 col-md-6">
                              <div class="coffee_img"><img src="images/img-2.png"></div>
                              <h3 class="types_text">BEAN VARIETIES</h3>
                              <p class="looking_text">looking at its layout. The point of</p>
                              <div class="read_bt"><a href="order.php?name=coffee2&q=1">Order</a></div>
                           </div>
                           <div class="col-lg-3 col-md-6">
                              <div class="coffee_img"><img src="images/img-3.png"></div>
                              <h3 class="types_text">COFFEE & PASTRY</h3>
                              <p class="looking_text">looking at its layout. The point of</p>
                              <div class="read_bt"><a href="order.php?name=coffee3&q=1">Order</a></div>
                           </div>
                           <div class="col-lg-3 col-md-6">
                              <div class="coffee_img"><img src="images/img-4.png"></div>
                              <h3 class="types_text">COFFEE TO GO</h3>
                              <p class="looking_text">looking at its layout. The point of</p>
                              <div class="read_bt"><a href="order.php?name=coffee4&q=1">Order</a></div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- coffee section end -->
      <!-- contact section start -->
      <div class="contact_section layout_padding">
         <div class="container">
            <div class="row">
               <div class="col-sm-12">
                  <h1 class="contact_taital">Get In Touch</h1>
                  <div class="bulit_icon"><img src="images/bulit-icon.png"></div>
               </div>
            </div>
         </div>
         <div class="container-fluid">
            <div class="contact_section_2">
               <div class="row">
                  <div class="col-md-12">
                     <div class="mail_section_1">
                        <input type="text" class="mail_text" placeholder="Your Name" name="Your Name">
                        <input type="text" class="mail_text" placeholder="Your Email" name="Your Email">
                        <input type="text" class="mail_text" placeholder="Your Phone" name="Your Phone">
                        <textarea class="massage-bt" placeholder="Massage" rows="5" id="comment" name="Massage"></textarea>
                        <div class="send_bt"><a href="#">SEND</a></div>
                        <br><br><br><br>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- contact section end -->
      <!-- footer section start -->
      <div class="footer_section layout_padding">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <h1 class="address_text">Address</h1>
                  <p class="footer_text">here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use </p>
                  <div class="location_text">
                     <ul>
                        <li>
                           <a href="#">
                           <i class="fa fa-phone" aria-hidden="true"></i><span class="padding_left_10">+01 1234567890</span>
                           </a>
                        </li>
                        <li>
                           <a href="#">
                           <i class="fa fa-envelope" aria-hidden="true"></i><span class="padding_left_10">demo@gmail.com</span>
                           </a>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- footer section end -->
      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <script src="js/plugin.js"></script>
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
   </body>
</html>