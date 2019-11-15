<?php
include('connect.php');

    $login = $_POST['username'];
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

    $sql = "SELECT * from user where username='$login' and password='$encrypted'";
	$res = mysqli_query($con,$sql);
	if(mysqli_num_rows($res) > 0){
        $pos= mysqli_fetch_assoc($res);
        $userid = $pos['user_id'];
        session_start();
        $_SESSION['login']=1;
        if(($pos['isAdmin'])==1){
            $_SESSION['admin']=1;
            header("location: homeAdmin.php");
        }else if(($pos['isStudent'])==1){
            $_SESSION['student']=1;
            $sqli="SELECT * FROM STUDENT where user_id ='$userid'";
            $resulti=mysqli_query($con,$sqli);
            $col= mysqli_fetch_assoc($resulti);
            $_SESSION['ID']=$col['std_id'];
            $_SESSION['name']=$col['std_name'];
            $_SESSION['major']=$col['major'];
            header("location: homeStudent.php");            
        }else if(($pos['isLecturer'])==1){
            $_SESSION['lecturer']=1;
             $sqli="SELECT * FROM LECTURER where user_id ='$userid'";
            $resulti=mysqli_query($con,$sqli);
            $col= mysqli_fetch_assoc($resulti);
            $_SESSION['ID']=$col['std_id'];
            $_SESSION['name']=$col['std_name'];            
            $_SESSION['adv']=$col['isAdv'];
            $_SESSION['exm']=$col['isExm'];
            header("location: homeLecturer.php");            
        }
        
    }else{
        session_start();
		$_SESSION['error']=1;
        header("location: error.php");
    }


?>