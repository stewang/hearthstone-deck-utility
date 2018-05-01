<?php 
	$post_data = file_get_contents("php://input");
	$data = json_decode($post_data);
	$newDeckName = (string)$data->newDeckName;

	$xml=simplexml_load_file("servlets/WebContent/WEB-INF/data/decks.xml") or die("Error: Cannot create object from XML file");
	foreach ($xml as $deck) {
		$name = (string)$deck->name;
		if ($name == $newDeckName)
			header('X-PHP-Response-Code: 400', true, 400);
	}
?>