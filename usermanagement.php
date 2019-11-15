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
    <center><h1>PRESIDENT UNIVERSITY</h1></center>
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

    <a href="dashboard.php"><button type="submit" class="btnReg">Add User</button></a>
    
    
    <h1>Student List</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Major</th>
            <th>Username</th>
        </tr>
        <?php
        $query="SELECT a.user_id, a.username, b.std_id, b.std_name, b.major FROM user A JOIN student B on A.user_id=b.user_id;";
        $res=mysqli_query($con, $query);
        while($r=mysqli_fetch_assoc($res)){
        ?>
        <tr>
            <td><?php echo $r['std_id']?></td>
            <td><?php echo $r['std_name']?></td>         
            <td><?php echo $r['major']?></td>
            <td><?php echo $r['username']?></td>
        </tr>
        <?php 
		}
		?>
    </table>
    
    <h1>Lecturer List</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Advisor</th>
            <th>Examiner</th>
            <th>Username</th>
        </tr>
        <?php
        $sql="CALL GetLecturer()";
        $result=mysqli_query($con, $sql);
        while($d=mysqli_fetch_assoc($result)){
        ?>
        <tr>
            <td><?php echo $d['lec_id']?></td>
            <td><?php echo $d['lec_name']?></td>         
            <td><?php echo $d['isAdv']?></td>
            <td><?php echo $d['isExm']?></td>
            <td><?php echo $d['username']?></td>
        </tr>
        <?php 
		}
		?>
    </table>
    


</div>
</body>
</html> 
