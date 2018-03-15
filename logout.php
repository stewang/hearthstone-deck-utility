<?php
session_start();     // always make session available when dealing session object  
?>

<?php

$_SESSION = array();
session_destroy();

header('Location: login.php');

?>