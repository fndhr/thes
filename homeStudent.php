<?php
session_start();

if(!isset($_SESSION['login']))
{
        echo "You need to login first!";
		header('Location: index.php');
}

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style2.css">
    <center><h1>PRESIDENT UNIVERSITY</h1></center>
</head>
<body>
<div class="container">
<ul>
<li><a href="#home-section" class="nav-link">Home</a></li>
<li><a href="studentThesis.php" class="nav-link">Thesis</a></li>
<li><a href="#teachers-section" class="nav-link">Consultation</a></li>
<li><a href="#courses-section" class="nav-link">Defense</a></li>
<li><a href="usermanagement.php" class="nav-link">Document</a></li>
<a href="logout.php"><button type="submit" class="btnLogOut">Log Out</button></a>
</ul>
    <?php
    
    if(isset($_SESSION["username"]))
{
	echo "Welcome " . $_SESSION["username"];
}

    
?>
        <img class="struct" src="image/struct.png">
  
    


</div>
</body>
</html> 
