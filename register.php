<?php
include('connect.php');

$name =$_POST['name'];
$id =$_POST['id'];
$role =$_POST['role'];
$isAdv =!empty($_POST['isAdv'])? $_POST['isAdv'] : 0 ;
$isExm =!empty($_POST['isExm'])? $_POST['isExm'] : 0 ;
$major =!empty($_POST['major'])? $_POST['major'] : 'Undefined' ;
$username = $_POST['username'];

$password = $_POST['password'];

    $encrypted = encryptIt( $password );

	function encryptIt( $q ) {
		$encrypt_method = "AES-256-CBC";
		$secret_key = 'WS-SERVICE-KEY';
		$secret_iv = 'WS-SERVICE-VALUE';
		// hash
		$key = hash('sha256', $secret_key);
		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', $secret_iv), 0, 16);
   
		$qEncoded = base64_encode(openssl_encrypt($q, $encrypt_method, $key, 0, $iv));
		return( $qEncoded );
	}
	
	
	function decryptIt( $q ) {
		$encrypt_method = "AES-256-CBC";
		 $secret_key = 'WS-SERVICE-KEY';
		 $secret_iv = 'WS-SERVICE-VALUE';
		 // hash
		 $key = hash('sha256', $secret_key);
		 // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		 $iv = substr(hash('sha256', $secret_iv), 0, 16);
   
		$qDecoded      = openssl_decrypt(base64_decode($q), $encrypt_method, $key, 0, $iv);
		return( $qDecoded );
	}


if($role==1){
    $qry ="INSERT INTO `user` ( `username`, `password`, `isAdmin`, `isStudent`, `isLecturer`) VALUES ('$username', '$encrypted', 0, 1, 0)";
    $result= mysqli_query($con, $qry);
    if($result){
        $qry="SELECT user_id from user where username='$username'";
        $res= mysqli_query($con, $qry);
        if(mysqli_num_rows($res) > 0){
				$row = mysqli_fetch_assoc($res);
				$userid = $row['user_id'];
        }
        $qry="INSERT INTO `student` (`std_id`, `std_name`, `major`, `user_id`) VALUES ('$id', '$name', '$major', '$userid')";
        $res= mysqli_query($con, $qry);
        if($res){
            echo 'Successfully registered!';
            header("location: usermanagement.php");   
        }else {
            echo 'Registration Error!';
        }
    }else {
        echo 'Registration Error!';
    }
    
    
}else if($role==2){
    $qry ="INSERT INTO `user` ( `username`, `password`, `isAdmin`, `isStudent`, `isLecturer`) VALUES ('$username', '$encrypted', 0, 0, 1)";
    $result= mysqli_query($con, $qry);
    
    if($result){
        $qry="SELECT user_id from user where username='$username'";
        $res= mysqli_query($con, $qry);
        if(mysqli_num_rows($res) > 0){
				$row = mysqli_fetch_assoc($res);
				$userid = $row['user_id'];
        }
        $qry="INSERT INTO `lecturer` (`lec_id`, `lec_name`, `user_id`, `isAdv`, `isExm`) VALUES ('$id', '$name', '$isAdv', '$isExm', '$userid')";
        $res= mysqli_query($con, $qry);
        if($res){
            echo 'Successfully registered!';
            header("location: usermanagement.php"); 
        }else {
            echo 'Registration Error!';
        }
    }else {
        echo 'Registration Error!';
    }
}


?>