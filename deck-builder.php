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
        		$activeDeck = $_SESSION['activeDeck'];
        		foreach ($xml as $deck) {
        			$name = (string)$deck->name;
        			if ($name == $activeDeck)
        				echo "<a href=\"\" id=\"{$name}\" class=\"active\" onclick=\"setDeck(this)\">{$name}</a>\n";
        			else
        				echo "<a href=\"\" id=\"{$name}\" onclick=\"setDeck(this)\">{$name}</a>\n";
        		}
        	?>
            <br>
        </div>
        <div class="content">
			<img class = "deckpng" alt="Pack" src="images/deck.png" style="height: 250px;">
			<div class = "popupDeckName">
				<form>
				<p>Enter Deck Name: <input type="text" name="newDeckName"
											ng-model="newDeckName" ng-keyup="checkName()"/></p>
				<p>{{message}}</p>
				<button type="submit" id="createDeckButton" ng-click="createDeck()" disabled>Create Deck</button>
				</form>
			</div>
			<script>
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
		function deckExists(deckName) {
// 			http://www.dummies.com/web-design-development/html/how-to-load-xml-with-javascript-on-an-html5-page/

			var connect = new XMLHttpRequest();
			connect.open("GET", "servlets/WebContent/WEB-INF/data/decks.xml", false);
			connect.setRequestHeader("Content-Type", "text/xml");
			connect.send(null);
			var xml = connect.responseXML;
			var decks = xml.childNodes[0];
			for (var i = 0; i < decks.children.length; i++)
			{
			   var deck = decks.children[i];
			   var name = deck.getElementsByTagName("name");

			   if (name == deckName)
				   return true;
			}
			return false;
		}
    </script>
    
    <script>
		var deckApp = angular.module('deckApp', []);
	
		deckApp.controller("deckController", function ($scope, $http) 
		{
			$scope.message = "";

			var onSuccess = function (data, status, headers, config)
			{
				$scope.message = "Name is OK.";
				document.getElementById("createDeckButton").disabled = false;
			};

			var onError = function (data, status, headers, config)
			{
				$scope.message = "A deck with that name already exists!";
				document.getElementById("createDeckButton").disabled = true;
			};
			
			$scope.checkName = function() {
				var newDeckName = $scope.newDeckName;
				if (newDeckName == "") {
					$scope.message = "";
					document.getElementById("createDeckButton").disabled = true;
				}
				else {
					var promise = $http.post("checkDeckName.php", {"newDeckName": newDeckName});
					promise.success(onSuccess);
					promise.error(onError);
				}
			}  

			$scope.createDeck = function() {
				console.log('yay');
				$http.post("createDeck.php", {"newDeckName": $scope.newDeckName});
				location.reload();
			}  
		});
    </script>
    
</body>
</html>