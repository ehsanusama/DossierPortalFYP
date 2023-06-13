<?php
	include_once '../inc/functions.php';
 if(!empty($_REQUEST['email'])){
 	$user_email=base64_decode($_REQUEST['email']);
 	$q=mysqli_query($dbc,"SELECT * FROM users WHERE user_email='$user_email'");
 	if (mysqli_num_rows($q)==0) {
 		echo "<center><h3>No account found</h3></center>";
 	}else{
	 	$fetchUserData = fetchRecord($dbc,"users","user_email",base64_decode($_REQUEST['email']));
	 	if($fetchUserData['is_verify']=="yes"){
	 		echo "<center><h3>Account already verified</h3></center>";
	 		
	 	}else{
	 		if(update_data($dbc,"users",['is_verify'=>'yes'],"user_email",$user_email)){
	 			echo "<center><h3>Account has been verified</h3></center>";
	 		}else{
	 			echo "<center><h3>".mysqli_error($dbc)."</h3></center>";
	 		}
	 	}	
	 	$_SESSION['user_login']=base64_decode($_REQUEST['email']);
	 	header('refresh:2;url=../index.php');
 	}
 	
} ?>