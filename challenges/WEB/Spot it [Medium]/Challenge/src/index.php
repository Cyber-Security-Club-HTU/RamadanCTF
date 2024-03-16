<?php

if(isset($_GET))
{
	if (isset($_GET['file']))
	{
		$input = $_GET['file'];

		if(preg_match("/flag|filter|base|data|\.\.\/|resource/i", $input))
		{
			echo "<br><br><h3 style='text-align: center; color: red'>Hacker Detected !!</h3>";

			$input = preg_replace("/flag|filter|base|http|\.\.\/|data|resource/i", "", $input);
		}

		echo file_get_contents($input);
		echo "<br><br>";

	}
}
else
{
	echo "Only GET requests are allowed here";
}

highlight_file("index.php");

?>