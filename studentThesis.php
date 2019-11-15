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
    
<?php
$id=$_SESSION['ID'];
$sql="SELECT a.title, b.lec_name from thesis A LEFT JOIN lecturer B on A.lec_id=B.lec_id where a.std_id='$id'";
$res=mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($res);
$title = $row['title'];
$lecturer= $row['lec_name'];

?>

<h3> Full Name : <?php echo $_SESSION['name']; ?></h3>
<h3> Major : <?php echo $_SESSION['major'];  ?></h3>
<h3> Thesis Title : <?php echo $title; ?></h3>
<h3> Thesis Advisor : <?php echo $lecturer; ?></h3>

<a href="studentReqThesis.php"><button type="submit" class="btnReg">Propose Thesis Title and Advisor</button></a>
    
    
    <h1>Proposed Title</h1>
    <table>
        <tr>
            <th>Title</th>
        </tr>
        <?php
            $sql="SELECT * from title_request where std_id='$id'";
            $res=mysqli_query($con,$sql);
            while($r=mysqli_fetch_assoc($res)){
        ?>  
        <tr>
        <td><?php echo $r['title']?></td>
        </tr>
        <?php 
		}
		?>
    </table>
    <h1>Proposed Advisor</h1>
     <table>
        <tr>
            <th>Title</th>
        </tr>
        <?php
            $sql="SELECT * from adv_request JOIN lecturer on adv_id=lec_id where std_id='$id'";
            $res=mysqli_query($con,$sql);
            while($r=mysqli_fetch_assoc($res)){
        ?>  
        <tr>
        <td><?php echo $r['lec_name']?></td>
        </tr>
         <?php 
		}
		?>
    </table>
    
</div>
</body>
</html> 