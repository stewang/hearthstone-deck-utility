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

</head>

<body>
	<?php
		if (!isset($_SESSION['user'])) {
			header('Location: login.php');
		}
	?>

    <ul>
        <li><span>Hearthstone Deck Utility</span></li>
        <li style="float:right"><a href="logout.php">Log Out (<?php echo $_SESSION['user']?>) </a></li>
        <li style="float:right"><a href="tracker.php">Statistics</a></li>
        <li style="float:right"><a href="#" class="active">Decks</a></li>
    </ul>
    <div class="container">
    <h2>Deck Builder</h2>
        <div class="navbar vertical-menu" id = "deckmenu">
            <a href= "#d1" id = "deck1" class="active" onclick = "click1()">Deck 1</a>
            <a href="#d2" id = "deck2" onclick = "click2()">Deck 2</a>
            <a href="#d3" id = "deck3" onclick = "click3()">Deck 3</a>
            <br>
        </div>
        <div class="content">
			<div class = "deckpadding">
				<img class = "deckpng" alt="Pack" src="images/deck.png" style="height: 300px;" onclick="pop()">
				<div class = "popupDeckName">
					<form class = "popuptext" id = "myPopup">
						Enter Deck Name: <input type = "text">
						<button type="submit" onclick = "closepop()">Create Deck</button>
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
			function click1()
			{
				document.getElementById("deck1").className='active';
				document.getElementById("deck2").className='';
				document.getElementById("deck3").className='';
			}
			function click2()
			{
				document.getElementById("deck2").className='active';
				document.getElementById("deck1").className='';
				document.getElementById("deck3").className='';
			}
			function click3()
			{
				document.getElementById("deck3").className='active';
				document.getElementById("deck2").className='';
				document.getElementById("deck1").className='';
			}
			</script>
        </div>
    </div>
</body>
</html>