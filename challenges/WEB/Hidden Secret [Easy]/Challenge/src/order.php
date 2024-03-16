<?php

   $FLAG = "CSC{HTtp_Reque5tS_m@N1PUla7ion}";

   session_start();
   if(!isset($_SESSION['id']) && !isset($_SESSION['secret']))
   {
      $_SESSION['id'] = random_int(10000000, 99999999);
      $_SESSION['secret'] = bin2hex(random_bytes(8));
   }

   if(isset($_GET["q"]) || isset($_GET['name']))
   {
      echo "<br><br><h3 style='text-align: center; color: blue'>Forms are not sent through GET !!</h3>";
   }
   else
   {
      if(isset($_POST['name']) && isset($_POST['q']) && isset($_POST['secret']))
      {
         if($_POST['secret'] === $_SESSION['secret']){
            echo "<br><br><h3 style='text-align: center; color: green'>Valid Secret !<br><br>Coffee is unavailable at the moment. But we have something better for you:</h3><br><br><h4><pre style='text-align: center' >".$FLAG."</pre></h4>";
         }
         else
         {
            echo "<br><br><h3 style='text-align: center; color: red'>Incorrect Secret</h3>";
         }
      }
      elseif (isset($_POST['name']) && isset($_POST['q'])) {
            echo "<br><br><h3 style='text-align: center; color: blue'>Where is your Secret ?!</h3>";
      }
      elseif(!isset($_POST['name']) || !isset($_POST['q']))
      {
            echo "<br><br><h3 style='text-align: center; color: red'>Missing Parameters !</h3>";         
      }

   }

?>