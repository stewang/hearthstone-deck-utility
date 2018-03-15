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

    // Define a function to handle failed validation attempts 
    function reject($entry)
    {
       echo 'Invalid input. Please <a href="login.php">try again</a>.';
       exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if (isset($_POST['user']))
        {
            $user = trim($_POST['user']);
            if (!ctype_alnum($user))   // ctype_alnum() check if the values contain only alphanumeric data
                reject('User Name');
           
            if (isset($_POST['pwd']))
            {
                $pwd = trim($_POST['pwd']);
                if (!ctype_alnum($pwd))
                    reject('Password');
                else
                {
                    $_SESSION['user'] = $user;
                    $_SESSION['pwd'] = $pwd;
                    
                    header('Location: deck-builder.php');
                }
            }
        }
    }

    ?>

    <ul>
        <li><span>Hearthstone Deck Utility</span></li>
        <li style="float:right"><a class="active" href="#">Log In</a></li>
        <li style="float:right"><a href="signup.html">Sign Up</a></li>
    </ul>

    <div class="container" align="center">
        <h2>Welcome!</h2>
        <form class="login" action="" method="post">
            <div class="imgcontainer">
                <img src="images/login_logo.png" alt="Logo" class="logo">
            </div>

            <div class="container">
                <label for="user"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="user" required>

                <label for="pwd"><b>Password</b></label>
                <input type="password" id="pwd" placeholder="Enter Password" name="pwd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
            
                <button type="submit">Login</button>
                
                <input type="checkbox" checked="checked" name="remember"> Remember me
                <span class="psw"><a href="#">Forgot password?</a></span>
            </div>
        </form>
    </div>    

</body>
</html>