<?php
include_once 'inc/functions.php';
// new filename
$filename = 'pic_'.date('YmdHis') . '.jpeg';

$url = '';
if( move_uploaded_file($_FILES['webcam']['tmp_name'],'img/uploads/'.$filename) ){
	$url = $filename;
	if(!empty($_REQUEST['emp_id'])){
		@$data=[
			'user_id'=>$_REQUEST['emp_id'],
			'business_id'=>$_REQUEST['business_id'],
			'pic_name'=>$filename,
			'dated'=>date('Y-m-d'),
			'shift'=>$_REQUEST['shift'],
		];
		if(insert_data($dbc,"tracking",$data)){
			echo $filename;
		}else{
			echo mysqli_error($dbc);
		}
	}
	echo $filename;
}

// Return image url
