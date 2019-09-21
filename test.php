<?php
	$name_array = array(
		array("first_name" => "First Name", "last_name" => array("Last Name 1", array("-"), "Last Name 2")),
		 "school", "major", "credits"
	);

	$halls = array(
		array("Williams", array("Neighbourhood" => "North")),
		array("Holden", array("Neighbourhood" => "South")),
		array("Hubbard", array("Neighbourhood" => "East")),
		array("Brody", array("Neighbourhood" => "Brody"))
	);

	$schools = array("MSU" => $halls, "Other" => "Some halls");
	
	//php_dump function accepts two arguments - name of variable(required) and label(optional)
	php_dump($halls);
	echo "<br>";
	php_dump($schools);
	echo "<br>";
	php_dump($name_array);
	echo "<br>";
	php_dump($_SERVER, "Server");
	echo "<br>";
	php_dump($_REQUEST, "Request");
?>
