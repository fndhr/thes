<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style2.css">
    <center><h1>PINJEM-IN</h1></center>
</head>
<body>
<div class="container">
    <?php
    
    if(isset($_SESSION['error']))
{
        echo "You type a wrong password! Plese login again!";
        echo " <a href=\"index.html\">Log In</a> .<br> ";
}

    
    if(isset($_SESSION["username"]))
{
	echo "Welcome " . $_SESSION["username"] . ", You are logged in as " .$_SESSION["position"];
    echo "You cannot open the page that you are not allowed. Please Log In again!";
    echo " <a href=\"index.html\">Log In</a> ";
    session_destroy();
        
}
?>
    
</div>
    </body>
</html>