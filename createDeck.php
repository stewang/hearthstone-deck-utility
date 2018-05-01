<?php 
	$post_data = file_get_contents("php://input");
	$data = json_decode($post_data);
	$newDeckName = (string)$data->newDeckName;
	
	$path = "servlets/WebContent/WEB-INF/data/decks.xml";
	$xml = new DOMDocument();
	$xml->preserveWhiteSpace = false;
	$xml->formatOutput = true;
	$xml->load($path);
	$decks = $xml->childNodes[0];
	
	$newDeck = $xml->createElement("deck");
	$newText = $xml->createElement("name", $newDeckName);
	$newDeck->appendChild($newText);
	$decks->appendChild($newDeck);
	
	$xml->save($path);
?>