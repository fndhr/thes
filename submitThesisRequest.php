<?php
session_start();
include('connect.php');
$id=$_SESSION['ID'];
$title1 =$_POST['title1'];
$title2 =$_POST['title2'];
$title3 =$_POST['title3'];
$lect1 =$_POST['lect1'];
$lect2 =$_POST['lect2'];
$lect3 =$_POST['lect3'];
//$lect2 =!empty($_POST['lect2'])? $_POST['lect2'] : 0 ;
//$lect3 =!empty($_POST['lect3'])? $_POST['lect2'] : 0 ;

//$lectArr=array($lect1,$lect2,$lect3);
//$advisor =implode(",",$lectArr);

//$qry="INSERT INTO `thesis_req` ( `std_id`, `adv1`, `adv2`, `adv3`, `title1`, `title2`, `title3`) VALUES ( '$id', '$lect1', '$lect2', '$lect3', '$title1', '$title2', '$title3')";
//$result= mysqli_query($con, $qry);


//add title1
$qry="INSERT INTO `title_request` ( `std_id`, `title`) VALUES ( '$id', '$title1')";
$result= mysqli_query($con, $qry);

//add adv1
$qry="INSERT INTO `adv_request` ( `std_id`, `adv_id`) VALUES ( '$id', '$lect1')";
$result= mysqli_query($con, $qry);

if(!empty($_POST['title2'])){
    $title2 =$_POST['title2'];
    $qry="INSERT INTO `title_request` ( `std_id`, `title`) VALUES ( '$id', '$title2')";
    $result= mysqli_query($con, $qry);
}


if(!empty($_POST['title3'])){
    $title3 =$_POST['title3'];
    $qry="INSERT INTO `title_request` ( `std_id`, `title`) VALUES ( '$id', '$title3')";
    $result= mysqli_query($con, $qry);
}

if(!empty($_POST['lect2'])){
    $lect2 =$_POST['lect2'];
   $qry="INSERT INTO `adv_request` ( `std_id`, `adv_id`) VALUES ( '$id', '$lect2')";
    $result= mysqli_query($con, $qry);
}

if(!empty($_POST['lect3'])){
    $lect2 =$_POST['lect3'];
   $qry="INSERT INTO `adv_request` ( `std_id`, `adv_id`) VALUES ( '$id', '$lect2')";
    $result= mysqli_query($con, $qry);
}


/*if(!empty($_POST['title2'])){
    $title2 =$_POST['title2'];
    $qry="INSERT INTO `thesis_req` ( `std_id`, `lec_id`, `title`,      `status`) VALUES ( '$id', '$advisor', '$title2',               'REQUESTED')";
    $result= mysqli_query($con, $qry);
   
}

if(!empty($_POST['title3'])){
    $title2 =$_POST['title2'];
    $qry="INSERT INTO `thesis_req` ( `std_id`, `lec_id`, `title`,      `status`) VALUES ( '$id', '$advisor', '$title2',               'REQUESTED')";
    $result= mysqli_query($con, $qry);
}*/

 header("location: studentThesis.php");   

?>
