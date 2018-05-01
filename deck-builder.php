<?php
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Hearthstone Deck Utility</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Richard Li, Steven Wang">
    <link rel="stylesheet" type="text/css" href="css/main.css">
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.16/angular.min.js"></script>
</head>

<body ng-app="deckApp">
	<?php
		if (!isset($_SESSION['user'])) {
			header('Location: login.php');
		}
		
		$xml=simplexml_load_file("servlets/WebContent/WEB-INF/data/decks.xml") or die("Error: Cannot create object from XML file");
		
		
		if (!isset($_SESSION['activeDeck'])) {
			$_SESSION['activeDeck'] = (string)$xml->deck[0]->name;
		}
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if (isset($_POST['activeDeck']))
				$_SESSION['activeDeck'] = $_POST['activeDeck'];
		}
	?>

    <ul>
        <li><span>Hearthstone Deck Utility</span></li>
        <li style="float:right"><a href="logout.php">Log Out (<?php echo $_SESSION['user']?>) </a></li>
        <li style="float:right"><a href="tracker.php">Statistics</a></li>
        <li style="float:right"><a href="#" class="active">Decks</a></li>
    </ul>
    <div class="container" ng-controller="deckController">
    <h2>Deck Builder</h2>
        <div class="navbar vertical-menu" id="deckmenu">
        	<?php 
        		foreach ($xml as $deck) {
        			$name = (string)$deck->name;
        			$activeDeck = $_SESSION['activeDeck'];
        			if ($name == $activeDeck)
        				echo "<a href=\"\" id=\"{$name}\" class=\"active\" onclick=\"setDeck(this)\">{$name}</a>\n";
        			else
        				echo "<a href=\"\" id=\"{$name}\" onclick=\"setDeck(this)\">{$name}</a>\n";
        		}
        	?>
            <br>
        </div>
        <div class="content">
			<div class = "deckpadding">
				<img class = "deckpng" alt="Pack" src="images/deck.png" style="height: 250px;" onclick="pop()">
				<div class = "popupDeckName">
					<form class = "popuptext" id = "myPopup">
						<p>Enter Deck Name: <input type="text" name="newDeckName"
												ng-model="newDeckName" ng-keyup="checkName()"/></p>
						<p>{{message}}</p>
						<button type="submit" onclick="closepop()">Create Deck</button>
					</form>
				</div>
			</div>
			<script>
			function pop() 
			{
				var p = document.getElementById('myPopup');
				p.classList.toggle('show');
			}
			function closepop()
			{
				var p = document.getElementById('myPopup');
				p.classList.toggle('show');
				alert("Deck Creation not yet supported");
				p.reset();
			}
			function setDeck(deck)
			{
// 				https://stackoverflow.com/questions/133925/javascript-post-request-like-a-form-submit

				method = "post";
				params = {activeDeck: deck.id};
				path = "";

			    var form = document.createElement("form");
			    form.setAttribute("method", method);
			    form.setAttribute("action", path);

			    for(var key in params) {
			        if(params.hasOwnProperty(key)) {
			            var hiddenField = document.createElement("input");
			            hiddenField.setAttribute("type", "hidden");
			            hiddenField.setAttribute("name", key);
			            hiddenField.setAttribute("value", params[key]);

			            form.appendChild(hiddenField);
			        }
			    }

			    document.body.appendChild(form);
			    form.submit();
			}
			</script>
        </div>
    </div>
    
    <script>
		var deckApp = angular.module('deckApp', []);
	
		deckApp.controller("deckController", function ($scope, $http) 
		{
			$scope.message = "";

			$scope.checkName = function() {
// 				In the future this function can check the name against all existing decks in the XML
				var newDeckName = $scope.newDeckName;
				if (newDeckName == "")
					$scope.message = "";
				else if (newDeckName == "Deck 1" || newDeckName == "Deck 2" || newDeckName == "Deck 3")
					$scope.message = "A deck with that name already exists!";
				else
					$scope.message = "Name is OK.";
			}  

// 			We can add another function here to actually submit the deck to our XML
			
		});
    </script>
    
</body>
</html>