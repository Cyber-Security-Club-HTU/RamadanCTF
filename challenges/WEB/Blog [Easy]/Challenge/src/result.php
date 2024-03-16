<?php

$FLAG = "HTU{ENUmR4T10n_!S_E5SeN7IaL}";

if(isset($_POST['username']) && isset($_POST['pass']))
{
	$username = $_POST['username'];
	$pass = $_POST['pass'];

	if ($username === "admin" && $pass === "wItH_GaZa321"){
		if(isset($_COOKIE['session']) && json_decode(base64_decode($_COOKIE['session']), true)["isAdmin"] === 0)
		{
			echo "<br><br><h3 style='text-align: center; color: blue'>Not smart enought :)</h3>";
		}
		elseif(isset($_COOKIE['session']) && json_decode(base64_decode($_COOKIE['session']), true)["isAdmin"] === 1) {
			echo "<br><br><h3 style='text-align: center; color: green'>Welcome back Admin !!</h3><br><br><h4><pre style='text-align: center' >".$FLAG."</pre></h4>";
		}
		else
		{
			echo "<br><br><h3 style='text-align: center; color: red'>Bad cookies manipulation</h3>";			
		}
	}
	else
	{
		if ($username === "admin") {
			echo "<br><br><h3 style='text-align: center; color: red'>Incorrect Password</h3>";
		}
		else{
			echo "<br><br><h3 style='text-align: center; color: red'>Only 'admin' users are accepted here!</h3>";
		}
	}
}

?>