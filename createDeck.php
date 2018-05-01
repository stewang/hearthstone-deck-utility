<?php 
	$post_data = file_get_contents("php://input");
	$data = json_decode($post_data);
	$newDeckName = (string)$data->newDeckName;

// 	Add newDeckName to the XML
// 	Below is how I read the XML in checkDeckName.php, but I don't know if the same method will work for writing
	
	$xml=simplexml_load_file("servlets/WebContent/WEB-INF/data/decks.xml") or die("Error: Cannot create object from XML file");
	foreach ($xml as $deck) {
		$name = (string)$deck->name;
		if ($name == $newDeckName)
			header('X-PHP-Response-Code: 400', true, 400);
	}
?>