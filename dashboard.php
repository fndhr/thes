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
    <center><h1>PINJEM-IN</h1></center>
</head>

<body>
<div class="container">
<ul>
<li><a href="#home-section" class="nav-link">Home</a></li>
<li><a href="#courses-section" class="nav-link">Pending Task</a></li>
<li><a href="#courses-section" class="nav-link">Thesis</a></li>
<li><a href="#teachers-section" class="nav-link">Defense</a></li>
<li><a href="#courses-section" class="nav-link">Documents</a></li>
<li><a href="usermanagement.php" class="nav-link">User Management</a></li>
<a href="logout.php"><button type="submit" class="btnLogOut">Log Out</button></a>
</ul>

  
<center>
<form method="post" action="register.php">
<h3>Add New User</h3>
<input class="long" name="name" required="required"
type="text" placeholder="Name" /> <br> 
<input class="long" name="id" required="required"
type="text" placeholder="ID" /> <br> 
<select name="role" size="1" placeholder="Role" id="role" onchange="myfunction()" required="required">
    <option></option>
    <option value="1"> Student </option>
    <option value="2"> Lecturer </option>
</select>
<br>
<div id="lect" style="display:none"><br>
    
    <label class="ckText">Advisor
        <input type="checkbox" name="isAdv" value="1">
        <span class="checkmark" ></span>
    </label>
    <label class="ckText">Examiner
        <input type="checkbox" name="isExm" value="1">
        <span class="checkmark"></span>
    </label> 
</div>
<div id="std" style="display:none">
    <select name="major" size="1" placeholder="Major">
    <option value="CIS"> CIS </option>
    <option value="CIT"> CIT </option>
</select><br>
</div>    
<input class="long" name="username" required="required"
type="text" placeholder="Username" /> <br> 
<input name="password" required="required" type="password"
placeholder="Password"/> <br>
<br><br>
<button type="submit" class="btnReg" name="signup" onclick="signup()">Add</button>
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
