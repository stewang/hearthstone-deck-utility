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
        <li style="float:right"><a href="logout.php">Log Out (<?php echo $_SESSION['user']?>)</a></li>
        <li style="float:right"><a href="#" class="active">Statistics</a></li>
        <li style="float:right"><a href="deck-builder.php">Decks</a></li>
    </ul>
    <div class="container">
    <h2>Statistics Tracker</h2>
        <div class="navbar dropdown">
            <button class="dropbtn" id="dropbtn">Dropdown</button>
            <div class="dropdown-content">
                <a href="#" onclick="showCharts()">Charts</a>
                <a href="#" onclick="showCardStats()">Card Stats</a>
                <a href="#" onclick="showWinLoss()">Win/Loss</a>
            </div>
        </div>

        <div class="content" id="content"></div>

    </div>

    <script>

        function showCharts() {
            var content = document.getElementById("content");
            var url = "http://localhost:8080/servlets/charts-forwarder.jsp"
            content.innerHTML = "<a href=\"" + url + "\">View Win/Loss Chart</a>"

            document.getElementById("dropbtn").innerHTML = "Charts"
        }

        function showCardStats() {
            var content = document.getElementById("content");
            content.innerHTML = "Holy flipping pattycakes look at these cards!"

            document.getElementById("dropbtn").innerHTML = "Card Stats"
        }

        function showWinLoss() {
            var content = document.getElementById("content");
            var url = "http://localhost:8080/servlets/WinLossServlet"
            content.innerHTML = "<a href=\"" + url + "?action=win\">Add Win</a> <a href=\"" + url + "?action=loss\">Add Loss</a>"

            document.getElementById("dropbtn").innerHTML = "Win/Loss"
        }

    </script>

</body>
</html>