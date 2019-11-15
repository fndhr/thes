<?php
session_start();
include('connect.php');
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
    <center><h1>PINJEM-IN</h1></center>
</head>

<body>
<div class="container">
<ul>
<li><a href="#home-section" class="nav-link">Home</a></li>
<li><a href="#courses-section" class="nav-link">Thesis</a></li>
<li><a href="#teachers-section" class="nav-link">Consultation</a></li>
<li><a href="#courses-section" class="nav-link">Defense</a></li>
<li><a href="usermanagement.php" class="nav-link">Document</a></li>
<a href="logout.php"><button type="submit" class="btnLogOut">Log Out</button></a>
</ul>

<center>
<form method="post" action="submitThesisRequest.php">
<h3>Add New User</h3>
<input class="long" name="title1" required="required"
type="text" placeholder="Title 1" /> <br> 
<input class="long" name="title2"
type="text" placeholder="Title 2" /> <br>
<input class="long" name="title3"
type="text" placeholder="Title 3" /> <br>

<select name='lect1' required="required">
    <option selected="false"></option>
    <?php 
        $sql="SELECT * from lecturer where isAdv=1";
        $res=mysqli_query($con,$sql);
        while($row=mysqli_fetch_assoc($res)){
        $lecid=$row['lec_id'];
        echo "<option value=\"$lecid\">" . $row['lec_name'] . "</option>";
    }
    ?>
</select><br>
<select name='lect2'>
    <option></option>
    <?php 
        $sql="SELECT * from lecturer where isAdv=1";
        $res=mysqli_query($con,$sql);
        while($row=mysqli_fetch_assoc($res)){
        $lecid=$row['lec_id'];
        echo "<option value=\"$lecid\">" . $row['lec_name'] . "</option>";
    }
    ?>
</select><br>
<select name='lect3'>
    <option></option>
    <?php 
        $sql="SELECT * from lecturer where isAdv=1";
        $res=mysqli_query($con,$sql);
        while($row=mysqli_fetch_assoc($res)){
        $lecid=$row['lec_id'];
        echo "<option value=\"$lecid\">" . $row['lec_name'] . "</option>";
    }
    ?>
</select>
<br>
<button type="submit" class="btnReg" name="signup" onclick="signup()">Submit</button>
</form>
</center>
</div>
<script>
    function myfunction()
    {
        var selected= document.getElementById("role").value;
        var x=document.getElementById("lect");
        var y=document.getElementById("std");
        if(selected==1){
            y.style.display="block";
            x.style.display="none";
        }else if(selected==2){
            x.style.display="block";
            y.style.display="none";
        }else{
            x.style.display="none";
            y.style.display="none";
        }
    }
</script>
</body>
</html> 
