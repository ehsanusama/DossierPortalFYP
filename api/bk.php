<?php include_once '../inc/functions.php'; 
include_once '../mailerClass/PHPMailerAutoload.php';
	$response=[];
	if (!empty($_REQUEST['action'])) {
		/* Distance Based QR Attendance */
		if (!empty($_REQUEST['business_id']) AND $_REQUEST['action']=="mark_attendance_geolocation" AND !empty($_REQUEST['emp_id']) AND !empty($_REQUEST['lat']) AND !empty($_REQUEST['lon'])) {
			@$fetchBusiness=fetchRecord($dbc,"business","business_id",$_REQUEST['business_id']);
			$img='';
			$att_date = date('Y-m-d');
			$att_time = date('H:i:s');
			$att_sts = 'p';
			$business_id=$fetchBusiness['business_id'];
			$shift=$_REQUEST['shift'];
			@$emp_id= $_REQUEST['emp_id'];
			@$lat=doubleval($_REQUEST['lat']);
	    	@$lon =doubleval( $_REQUEST['lon']);
	    	$loc = explode(",",$fetchBusiness['business_location']);
			$lat2=$loc[0];
			$lon2=$loc[1];
			$shift = $_REQUEST['shift'];
			@$location = $_REQUEST['lat'].",".$_REQUEST['lon'];
			$description = 'Attendace Marked by QR Scan at '.date('D, d-M-Y h:i:s a');
			$dist= distance($lat, $lon, $lat2, $lon2, 'K');
			$limit =$fetchBusiness['business_distance']/1000;
			if($dist>$limit){
				 $response = [
				        'msg'=>"Not allowed to mark attendance. Geolocation error",
				        "sts"=>"success",
				        "icon"=>"warning",
				        "code"=>"201",
				        "action"=>$_REQUEST['action']
			 		   ];
			}else{
				if(mysqli_num_rows(mysqli_query($dbc,"SELECT * FROM assign_business WHERE business_id='$business_id' AND user_id='$emp_id'"))==0){
					$response = [
				        'msg'=>"Employee not allowed to scan this QR code ",
				        "sts"=>"success",
				        "icon"=>'warning',
				        "code"=>"201",
						"action"=>$_REQUEST['action']
			 		   ];
				}else{
					$att_data=[
						'att_date'=>$att_date,
						'att_time'=>$att_time,
						'shift'=>$shift,
						'business_id'=>$business_id,
						'emp_id'=>$emp_id,
						'description'=>'Attendace marked by QR scan.',
						'location'=>$lat.",".$lon,
					];
					if(mysqli_num_rows(mysqli_query($dbc,"SELECT * FROM emp_attendance WHERE business_id='$business_id' AND emp_id='$emp_id' AND shift='$shift'"))==0){
						if (insert_data($dbc,"emp_attendance",$att_data)) {
							$response=[
								"msg" =>"Attendace has been marked",
								"sts" =>"success",
								'icon'=>"success",
								"action"=>$_REQUEST['action']
							];
						}else{
							$response=[
								"msg" => mysqli_error($dbc),
								"sts" =>"danger",
								'icon'=>"error",
								"action"=>$_REQUEST['action']
							];
						}
					}else{
						$response = [
					        'msg'=>"Employee has already marked attendance for ".$shift,
					        "sts"=>"warning",
					        "icon"=>'warning',
					        "code"=>"201"
			 		   ];
					}
				}
			}/*distance coding*/
	}/*atendance mark action*/
		if ($_REQUEST['action']=="login") {
			/* Login Process */
			$user_email = validate_data($dbc,$_REQUEST['user_email']);
			$user_password = md5($_REQUEST['user_password']);
			$q = mysqli_query($dbc,"SELECT * FROM users WHERE (user_email='$user_email' OR username='$user_email') AND user_password='$user_password'");
			$count=mysqli_num_rows($q);
			if ($count==1) {
				$_SESSION['user_login']=$user_email;
			setcookie("user_login", $user_email, time() + (86400 * 30), "/"); /* 86400 = 1 */

			$response=[
						"msg" => "Logging...",
						"sts" =>"success",
						"action"=>$_REQUEST['action']
					];
			
			}else{
				$response=[
						"msg" => "Invalid Email or Password",
						"sts" =>"danger",
						"action"=>$_REQUEST['action']
					];
			}
		}
		/* Update User Profile */ 

		 elseif ($_REQUEST['action']=='update_user_profile') {

		 	$data = [
				'user_first_name'=>$_REQUEST['user_first_name'],
				'user_last_name'=>$_REQUEST['user_last_name'],
				'user_phone'=>$_REQUEST['user_phone'],
			];
			if (update_data($dbc,"users",$data,"user_id",$fetchUser['user_id'])) {
				$response=[
						"msg" => "Profile Updated",
						"sts" =>"success",
						"action"=>$_REQUEST['action']
					];
			}else{
				$response=[
						"msg" => mysqli_error($dbc),
						"sts" =>"danger",
						"action"=>$_REQUEST['action']
					];
			}
		}
			/* Change User Password */
		elseif ($_REQUEST['action']=='update_password') {
		 	$msg="";
		 	$old_password=md5($_REQUEST['old_password']);
		 	$new_password=md5($_REQUEST['new_password']);
		 	$confirm_password=md5($_REQUEST['confirm_password']);
			if (!empty($old_password)) {
					if (@mysqli_num_rows(mysqli_query($dbc,"SELECT * FROM users WHERE user_id='$fetchUser[user_id]' AND user_password='$old_password'"))==1) {
						if ($new_password==$confirm_password) {
							$data=['user_password'=>$new_password];
							if (update_data($dbc,"users",$data,'user_id',$fetchUser['user_id'])) {
								$response=[
									"msg" => "Password Updated <i class='glyphicon glyphicon-ok'></i>",
									"sts" =>"success",
									"action"=>$_REQUEST['action']
								];
							}else{
								$response=[
									"msg" => mysqli_error($dbc),
									"sts" =>"danger",
									"action"=>$_REQUEST['action']
								];
							}
						}else{
							$response=[
									"msg" => "New or Confimed Password not Matched...",
									"sts" =>"info",
									"action"=>$_REQUEST['action']
								];
						}

					}else{
						$response=[
								"msg" => "Old Password not Matched...",
								"sts" =>"warning",
								"action"=>$_REQUEST['action']
							];
					}
			 	} 	
		 
		 	}elseif($_REQUEST['action']=="business_module"){	
		 		$data=[
		 			'business_name'=>$_REQUEST['business_name'],
					'business_email'=>$_REQUEST['business_email'],
					'business_phone'=>$_REQUEST['business_phone'],
					'business_location'=>$_REQUEST['business_location'],
					'business_distance'=>$_REQUEST['business_distance'],
					'user_id'=>$_REQUEST['user_id'],
		 		];
		 		if ($_REQUEST['operation']=="add") {
		 			if (insert_data($dbc,"business",$data)) {
		 				$response=[
							"msg" =>"Business has been added",
							"sts" =>"success",
							"action"=>$_REQUEST['action']
						];
		 			}else{
		 				$response=[
							"msg" => mysqli_error($dbc),
							"sts" =>"danger",
							"action"=>$_REQUEST['action']
						];
		 			}
		 		}else{
		 			if (update_data($dbc,"business",$data,"business_id",$_REQUEST['business_id'])) {
		 				$response=[
							"msg" =>"Business has been updated",
							"sts" =>"success",
							"action"=>$_REQUEST['action']
						];
		 			}else{
		 				$response=[
							"msg" => mysqli_error($dbc),
							"sts" =>"danger",
							"action"=>$_REQUEST['action']
						];
		 			}
		 		}
		 	}elseif($_REQUEST['action']=="forgot_password_module"){
		 		
		 		$user_email=$_REQUEST['user_email'];
		 		$fetchUserData=fetchRecord($dbc,"users","user_email",$user_email);
		 		if(countWhen($dbc,"users","user_email",$user_email)==0){
		 			$response=[
								"msg" => "'".$user_email."' is not found in our system",
								"sts" =>"danger",
								"action"=>$_REQUEST['action']
							];
		 		}else{
		 			$new_password=substr(uniqid(), 0,6);
			 		$email_body='Hello, '.strtoupper($fetchUserData['user_first_name']).'<br>
					Your temporary password is: <b>'.$new_password.'</b><br>
					For security reasons, we advise you to change your password after logging in.';
			 		if($server=='localhost'){
			 			$mail_response=send_email($user_email,"Staffx - Your new password",$email_body);
			 		}else{
			 			$mail_response=mail($user_email,"Staffx - Your new password",$email_body,$headers);
			 		}
			 		
			 		if($mail_response){
			 			if(update_data($dbc,"users",["user_password"=>md5($new_password)],"user_email",$user_email)){
			 				$response=[
								"msg" => "We've sent you an email. Please find enclosed your new temporary password.",
								"sts" =>"success",
								"action"=>$_REQUEST['action']
							];
			 			}else{
			 				$response=[
								"msg" => mysqli_error($dbc),
								"sts" =>"danger",
								"action"=>$_REQUEST['action']
							];
			 			}
			 			
			 		}else{
			 			$response=[
							"msg" => "Error in sending email",
							"sts" =>"danger",
							"action"=>$_REQUEST['action']
						];
			 		}
		 		}
		 	}elseif($_REQUEST['action']=="register_module"){
		 		
		 		$max_hour_per_week=(!empty($_REQUEST['max_hour_per_week'])?$_REQUEST['max_hour_per_week']:'');
		 		$max_hour_per_day=(!empty($_REQUEST['max_hour_per_day'])?$_REQUEST['max_hour_per_day']:'');
		 				@$user_extra=[
		 					'user_business'=>$_REQUEST['user_business'],
							'user_abn'=>$_REQUEST['user_abn'],
							'max_hour_per_week'=>$max_hour_per_week,
							'max_hour_per_day'=>$max_hour_per_day,
		 				];
						
							@$data=[
								'user_first_name'=>strtolower($_REQUEST['user_first_name']),
								'username'=>strtolower($_REQUEST['user_first_name'])."_".substr(uniqid(),0,5),
								'user_last_name'=>strtolower($_REQUEST['user_last_name']),
								'user_email'=>strtolower($_REQUEST['user_email']),
								'user_password'=>md5($_REQUEST['user_password']),
								'user_phone'=>$_REQUEST['user_phone'],
								'user_extra'=>json_encode($user_extra),
							];
							$email_body='<h1>Welcome, '.strtoupper($data['user_first_name']).'</h1><br>
										Congratulations, you’re all set to start your Staffx <br> account. Your offer is 14 day free trial. After this, your <br>subscription plan is:  <br>

										
										<h2 style="color:#273c75">Basic</h2>
											$1/User <br>
											Monthly <br>
										 <br>

										<h1>WHAT HAPPENS NEXT?</h1>
										Your first payment for Staffx will be on <span style="color:red">'.date('d/m/Y',strtotime('+14 day', strtotime(date("Y-m-d")))).'</span> and you will <br> receive an invoice on your Staffx account email address for <br>payment. <br> 
										To make updates or change anything on your Staffx account, <br>Contact support. <br>

										You will shortly receive tutorials, videos, templates for ,<br>understanding how Staffx works. <br><br>

									<i style="font-size:10px">This email has been sent to '.$data['user_email'].' as part of your Staffx account.</i>';
									
		 			if($server=="localhost"){
		 				$mail_response=send_email($data['user_email'],"Welcome, - ".strtoupper($data['user_first_name']),$email_body);
		 			}else{
		 				$mail_response=mail($data['user_email'],"Welcome, - ".strtoupper($data['user_first_name']),$email_body,$headers);
		 			}
		 			if($mail_response){
		 				if(insert_data($dbc,"users",$data)){
		 			/*Sending Email*/
		 			$lastId=mysqli_insert_id($dbc);
		 			$data_assign_role=[
		 				'user_id'=>$lastId,
		 				'user_role'=>(!empty($_REQUEST['user_role']))?$_REQUEST['user_role']:'user',
		 				'assign_user_role_remarks'=>'Self registration'
		 			];
		 				$data_billing=[
								'user_id'=>$lastId,
								'start_date'=>date('Y-m-d'),
								'end_date'=>date('Y-m-d',strtotime('+14 day', strtotime(date("Y-m-d")))),
								'description'=>'User registration Free Trial till '.date('d/m/Y',strtotime('+14 day', strtotime(date("Y-m-d"))))
							];
		 			insert_data($dbc,"assign_user_role",$data_assign_role);
		 			insert_data($dbc,"subscription",$data_billing);
		 			$_SESSION['user_login']=$data['user_email'];
					setcookie("user_login", $data['user_email'], time() + (86400 * 30), "/"); /* 86400 = 1 */

		 				$response=[
							"msg" => "Account has been created successfully. Check your inbox to verify your account",
							"sts" =>"success",
							"action"=>'login'
						];
					}else{
		 				$response=[
							"msg" => mysqli_error($dbc),
							"sts" =>"danger",
							"action"=>$_REQUEST['action']
						];
		 			}
		 			}else{
		 					$response=[
							"msg" => "Error in sending email, Something went wrong try submit again",
							"sts" =>"danger",
								"action"=>$_REQUEST['action']
							];
				 		}
		 				
		 			
		 		}elseif($_REQUEST['action']=="verify_link"){
		 			
		 			$user_email=base64_decode($_REQUEST['email']);
		 			$fetchUserData=fetchRecord($dbc,"users","user_email",$user_email);
		 				
							$email_body='Hi '.strtoupper($fetchUserData['user_first_name']).', <br>
										Welcome to Staffx! <br>
										Please verify your Staffx account by clicking the link below. <br>
										<a style="background:#ee5253;padding:5px;float:left;color:#fff;font-size:1.2em;text-decoration:none" href="'.base_url().'verify.php?email='.base64_encode($user_email).'">VERIFY MY EMAIL</a> <br>
										<br>This link expires in three days to maintain your security. If you<br> received this email by accident, feel free to ignore it. <br><br>
										Thanks, from team Staffx
										<br><br>
									<i style="font-size:10px">This email has been sent to '.$user_email.' as part of your Staffx account.</i>';
					if($server=="localhost"){
		 				$mail_response=send_email($user_email,"Staffx - Time to verify your email",$email_body);
		 			}else{
		 				$mail_response=mail($user_email,"Staffx - Time to verify your email",$email_body,$headers);
		 			}
					if($mail_response){
		 				$response=[
							"msg" => "Check your inbox to verify your account",
							"sts" =>"success",
							"action"=>'login'
						];
		 			}else{
		 					$response=[
							"msg" => "Error in sending email, Something went wrong try submit again",
							"sts" =>"danger",
								"action"=>$_REQUEST['action']
							];
				 		}
		 				
		 			
		 		}elseif ($_REQUEST['action']=='update_user_role_rights') {
		 			if (isset($_REQUEST['user_role_name'])) {
						if (mysqli_query($dbc,"DELETE FROM assign_module WHERE user_role='$_REQUEST[user_role_name]'")) {
						
						foreach($_REQUEST['user_role_page'] as $page):
						$data = [
							'user_role'=>$_REQUEST['user_role_name'],
							'menu_page'=>$page,
						];
						$q=insert_data($dbc,"assign_module",$data);
						
						endforeach;
							if (@$q) {
								$response=[
									"msg" =>"User Rights Updated",
									"sts" =>"success",
									"action"=>$_REQUEST['action']
								];
							}
							else{
								$response=[
									"msg" => mysqli_error($dbc),
									"sts" =>"danger",
									"action"=>$_REQUEST['action']
								];
							}
						}
						else{
							$response=[
								"msg" => mysqli_error($dbc),
								"sts" =>"danger",
								"action"=>$_REQUEST['action']
							];
						}
					}
		 		}/*Delete Table Data*/
		 		else if (!empty($_REQUEST['id']) AND $_REQUEST['action']=="delete_data") {
				 	$id=$_REQUEST['id'];
				 	$table=$_REQUEST['table'];
				 	$fld=$_REQUEST['fld'];
				 	if(mysqli_query($dbc,"DELETE FROM $table WHERE $fld='$id'")){
				 		$response=[
							"msg" => "Data has been deleted",
							"sts" =>"danger",
							"action"=>$_REQUEST['action']
						];
				 	}else{
				 			$response=[
							"msg" => mysqli_error($dbc),
							"sts" =>"danger",
							"action"=>$_REQUEST['action']
						];
				 	}
			 		
				 }elseif($_REQUEST['action']=='user_business_shift'){
				 	if (mysqli_query($dbc,"DELETE FROM assign_business WHERE user_id='$_REQUEST[user_id]'")) {
					foreach($_REQUEST['business_id'] as $business_id):
					@$data = [
						'user_id'=>$_REQUEST['user_id'],
						'business_id'=>$business_id,
						'manager_id'=>$_SESSION['user_login'],
					];
					$q=insert_data($dbc,"assign_business",$data);
					
					endforeach;
						if (@$q) {
							$response=[
							"msg" => "Business shift as been assigned",
							"sts" =>"success",
							"action"=>$_REQUEST['action']
						];
						}
						else{
							$response=[
								"msg" => mysqli_error($dbc),
								"sts" =>"danger",
								"action"=>$_REQUEST['action']
							];
						}
					}
					else{
						$response=[
							"msg" => mysqli_error($dbc),
							"sts" =>"danger",
							"action"=>$_REQUEST['action']
						];
					}
				 }elseif($_REQUEST['action']=="assign_user_roles"){
				 	if (mysqli_query($dbc,"DELETE FROM assign_user_role WHERE user_id='$_REQUEST[user_id]'")) {
						
						foreach($_REQUEST['role_list'] as $role):
						$data = [
							'user_id'=>$_REQUEST['user_id'],
							'user_role'=>strtolower($role),
							'assign_user_role_remarks'=>"Assign by User: ".$_SESSION['user_login'],
						];
						$q=insert_data($dbc,"assign_user_role",$data);
						
						endforeach;
							if (@$q) {
								$response=[
									"msg" => "User Role Updated",
									"sts" =>"success",
									"action"=>$_REQUEST['action']
								];
							}
							else{
								$response=[
									"msg" => mysqli_error($dbc),
									"sts" =>"danger",
									"action"=>$_REQUEST['action']
								];
							}
						}
						else{
							$response=[
								"msg" => mysqli_error($dbc),
								"sts" =>"danger",
								"action"=>$_REQUEST['action']
							];
						}
				 }
				 /*Register Staff Module*/
				 elseif($_REQUEST['action']=="register_staff_module"){
		 		
		 				@$max_hour_per_week=(!empty($_REQUEST['max_hour_per_week'])?$_REQUEST['max_hour_per_week']:'');
		 				@$max_hour_per_day=(!empty($_REQUEST['max_hour_per_day'])?$_REQUEST['max_hour_per_day']:'');
		 				@$user_extra=[
		 					'user_business'=>(!empty($_REQUEST['user_business']))?$_REQUEST['user_business']:'',
							'user_abn'=>(!empty($_REQUEST['user_abn']))?$_REQUEST['user_abn']:'',
							'max_hour_per_week'=>@$max_hour_per_week,
							'max_hour_per_day'=>@$max_hour_per_day,
		 				];

						
							@$data=[
								'user_first_name'=>strtolower($_REQUEST['user_first_name']),
								'user_last_name'=>strtolower($_REQUEST['user_last_name']),
								'user_email'=>strtolower($_REQUEST['user_email']),
								'user_phone'=>$_REQUEST['user_phone'],
								'user_extra'=>json_encode($user_extra),
							];
							if($_REQUEST['operation']=="add"){
										$data['username']=strtolower($_REQUEST['user_first_name'])."_".substr(uniqid(),0,5);
										$data['user_password']=md5($_REQUEST['user_password']);
										$data['user_created_id']=$fetchUser['user_id'];
										$email_body='You have been invited by user '.$fetchUser['user_email'].' to join an account on Staffx! <br>
												Please click the link below to login and set your account password. <br>
												Your temporary password is: '.$_REQUEST['user_password'].'

												<br><br>Thank you!<br>

												Staffx Team

												 <br><br>

											<i style="font-size:10px">This email has been sent to '.$fetchUser['user_email'].' as part of your Staffx account.</i>';
											if(!empty($_REQUEST['send_email']) AND $_REQUEST['send_email']=="yes"){
									if($server=="localhost"){
					 				$mail_response=send_email($data['user_email'],"Welcome, - ".strtoupper($data['user_first_name']),$email_body);
						 			}else{
						 				$mail_response=mail($data['user_email'],"Welcome, - ".strtoupper($data['user_first_name']),$email_body,$headers);
						 			}
								}else{
									$mail_response=true;
								}	
					 			
				 			if($mail_response){
				 				if(insert_data($dbc,"users",$data)){
				 			/*Sending Email*/
				 			$lastId=mysqli_insert_id($dbc);
				 			$data_assign_role=[
				 				'user_id'=>$lastId,
				 				'user_role'=>(!empty($_REQUEST['user_role']))?$_REQUEST['user_role']:'user',
				 				'assign_user_role_remarks'=>'Manager registration by '.$fetchUser['user_email']
				 			];
				 			insert_data($dbc,"assign_user_role",$data_assign_role);
				 				$response=[
									"msg" => "Account has been created successfully.",
									"sts" =>"success",
									"action"=>$_REQUEST['action'],
								];
								if(!empty($_SESSION['business'])){
									insert_data($dbc,"assign_business",['business_id'=>base64_decode($_SESSION['business']),"user_id"=>$lastId,"manager_id"=>$fetchUser['user_id']]);
								}
							}else{
				 				$response=[
									"msg" => mysqli_error($dbc),
									"sts" =>"danger",
									"action"=>$_REQUEST['action']
								];
				 			}
				 			}else{
				 					$response=[
									"msg" => "Error in sending email, Something went wrong try submit again",
									"sts" =>"danger",
										"action"=>$_REQUEST['action']
									];
						 		}
							}
							/*Update Code*/
							else{
								$fetchUserData=fetchRecord($dbc,"users","user_id",$_REQUEST['user_id']);
								if(mysqli_num_rows(mysqli_query($dbc,"SELECT * FROM users WHERE user_password='$_REQUEST[user_password]' AND user_id='$_REQUEST[user_id]'"))==0){
								$data["user_password"]=md5($_REQUEST['user_password']);
							}
							if(update_data($dbc,"users",$data,"user_id",$_REQUEST['user_id'])){
								$email_body='Hello, '.strtoupper($fetchUserData['user_first_name']).'<br>
											Your temporary password is: <b>'.$_REQUEST['user_password'].'</b><br>
											For security reasons, we advise you to change your password after logging in.';
									if(!empty($_REQUEST['send_password']) AND $_REQUEST['send_password']=="yes"){
										if($server=="localhost"){
						 				$mail_response=send_email($data['user_email'],"Staffx - New Password",$email_body);
							 			}else{
							 				$mail_response=mail($data['user_email'],"Staffx - New Password",$email_body,$headers);
							 			}
							 		}
								$response=[
										"msg" => "Profile Updated",
										"sts" =>"success",
										"action"=>$_REQUEST['action']
										];
							}else{
								$response=[
									"msg" => mysqli_error($dbc),
									"sts" =>"danger",
									"action"=>$_REQUEST['action']
								];
							}
									
						}
		 			
		 		}
		 		/*Update Account Status*/
		 		elseif($_REQUEST['action']=="change_account_status"){
		 			if($_REQUEST['table']=="users"){
		 				$q=update_data($dbc,"users",["user_status"=>$_REQUEST['status']],'user_id',$_REQUEST['id']);
		 			}elseif($_REQUEST['table']=="business"){
		 				$q=update_data($dbc,"business",["business_status"=>$_REQUEST['status']],'business_id',$_REQUEST['id']);
		 			}else{

		 			}
		 			if ($q) {
		 					$response=[
									"msg" => strtoupper($_REQUEST['table'])." Account status changed to ".strtoupper($_REQUEST['status']),
									"sts" =>"success",
										"action"=>$_REQUEST['action']
									];
		 			}else{
	 					$response=[
								"msg" => mysqli_error($dbc),
								"sts" =>"danger",
								"action"=>$_REQUEST['action']
							];
		 			}
		 		}
		 		/*Employee Schedule*/
		 		elseif($_REQUEST['action']=="employee_schedule"){
						$arr=[];
						for ($i=0; $i <count($_REQUEST['days']) ; $i++) { 
								$arr[]=[
								$_REQUEST['days'][$i]=>
									[
										"opening_time"=>(empty($_REQUEST['opening_time'][$i]))?"":date('H:i:s',strtotime($_REQUEST['opening_time'][$i])),
										"closing_time"=>(empty($_REQUEST['closing_time'][$i]))?"":date('H:i:s',strtotime($_REQUEST['closing_time'][$i]))
									]
							];

						}
						
					$data=['user_timing'=>json_encode($arr), ];

 					if(update_data($dbc,"users",$data,"user_id",$_REQUEST['user_id'])){
						$response=[
							"msg" => "Staff ID# ".$_REQUEST['user_id']." has been Scheduled",
							"sts" =>"success",
							"action"=>$_REQUEST['action']
							];
 					}else{
	 					$response=[
							"msg" => mysqli_error($dbc),
							"sts" =>"danger",
							"action"=>$_REQUEST['action']
						];
 					}
		 		}
		 		elseif($_REQUEST['action']=="employee_roaster"){
		 			$msg="";
		 			$arr=[];
						for ($i=0; $i <count($_REQUEST['days']) ; $i++) { 
								$times=['opening_time'=>$_REQUEST['opening_time'][$i],'closing_time'=>$_REQUEST['closing_time'][$i]];
								$data=[
										'emp_id'=>$_REQUEST['emp_id'],
										'business_id'=>$_REQUEST['business_id'],
										'remarks'=>"Added by ".$fetchUser['user_email'],
										'work_assigned'=>$_REQUEST['work_assigned'][$i],
										'times'=>json_encode($times),
										'dated'=>date('Y-m-d',strtotime($_REQUEST['dated'][$i])),
										'user_id'=>$fetchUser['user_id'],
									];

								$query_checker=mysqli_query($dbc,"SELECT * FROM roaster WHERE emp_id='$_REQUEST[emp_id]' AND dated='$data[dated]'");
								if(mysqli_num_rows($query_checker)>=1){

									while($fetchChecker=mysqli_fetch_assoc($query_checker)){
										$query=mysqli_query($dbc,"SELECT * FROM roaster WHERE emp_id='$_REQUEST[emp_id]' AND business_id='$fetchChecker[business_id]' AND dated='$data[dated]'");
										$count=mysqli_num_rows($query);
										if ($count==0) {
											$q=insert_data($dbc,"roaster",$data);
											$msg="Roaster has been inserted";
										}else{
											$fetchRoasterData=mysqli_fetch_assoc($query);
											$fetchTimes=(Array) json_decode($fetchRoasterData['times']);
											$opening_time = strtotime($fetchTimes['opening_time']);
											$closing_time =  strtotime($fetchTimes['closing_time']);
											if (TimeIsBetweenTwoTimes($times['opening_time'], $opening_time, $closing_time)){
												$msg.="<br>Not allowed for time between ".$times['opening_time']." and ".$times['closing_time'];
											}else{
												$q=update_data($dbc,"roaster",$data,"id",$fetchRoasterData['id']);
												$msg.="<br>Roaster has been updated: ".json_encode($fetchChecker);
											}
										
										}
									}/*While Loop*/
								}/*Query Checker*/
								else{
									$query=mysqli_query($dbc,"SELECT * FROM roaster WHERE emp_id='$_REQUEST[emp_id]' AND business_id='$_REQUEST[business_id]' AND dated='$data[dated]'");
									$count=mysqli_num_rows($query);
									if ($count==0) {
										$q=insert_data($dbc,"roaster",$data);
										$msg.="<br>Roaster has been saved";
									}else{
										$fetchRoasterData=mysqli_fetch_assoc($query);
										if(update_data($dbc,"roaster",$data,"id",$fetchRoasterData['id'])){
											$msg.="<br>Roaster has been saved";
										}
										
									}
								}								
							}/*For Loop*/
							if (@$q) {
								$response=[
									"msg" =>$msg,
									"sts" =>"success",
									"action"=>$_REQUEST['action']
								];
							}else{
								$response=[
									"msg" => $msg,
									"sts" =>"danger",
									"action"=>$_REQUEST['action']
								];
							}
							
		 		}elseif($_REQUEST['action']=="send_billing_notification"){
		 			
		 				@$data=[
								'user_id'=>strtolower($_REQUEST['user_id']),
								'text'=>nl2br(mysqli_real_escape_string($dbc,$_REQUEST['email_body'])),
								'manager_id'=>$fetchUser['user_id'],
								'type'=>"subscription renewal reminder",
								'subscription_id'=>$_REQUEST['id'],
							];
							$email_body=str_replace(['\r','\n'], '<br>',$data['text']);
					if($server=="localhost"){
	 				$mail_response=send_email($_REQUEST['user_email'],"Subscription Reminder - Staffx",$email_body);
		 			}else{
		 				$mail_response=mail($_REQUEST['user_email'],"Subscription Reminder - Staffx",$email_body,$headers);
		 			}
		 			if($mail_response){
		 				if (insert_data($dbc,"notifications",$data)) {
		 					$response=[
									"msg" =>"Notification Email has been sent",
									"sts" =>"success",
									"action"=>$_REQUEST['action']
								];
		 				}else{
		 					$response=[
									"msg" => mysqli_error($dbc),
									"sts" =>"danger",
									"action"=>$_REQUEST['action']
								];
		 				}
		 			}else{
		 				$response=[
							"msg" => "Error in sending email",
							"sts" =>"danger",
							"action"=>$_REQUEST['action']
						];
		 			}
		 		}
		 		/*Renewal Subscription*/
		 		elseif($_REQUEST['action']=="renew_subscription"){
		 			
		 			$data=[
		 				'start_date'=>date('Y-m-d',strtotime($_REQUEST['start_date'])),
		 				'end_date'=>date('Y-m-d',strtotime($_REQUEST['end_date'])),
		 				'user_id'=>$_REQUEST['user_id'],
		 				'description'=>"Renewal of account from ".date('d-M-Y',strtotime($_REQUEST['start_date']))." to ".date('d-M-Y',strtotime($_REQUEST['end_date'])),
		 			];
		 			$email_body='Congratulations, Your subscription has been renewed and you can use this from '.$data['start_date']." to ".$data['end_date'];
				if(!empty($_REQUEST['send_email']) AND $_REQUEST['send_email']=="yes"){
						if($server=="localhost"){
		 				$mail_response=send_email($_REQUEST['user_email'],"Renewal Subscription, Staffx",$email_body);
			 			}else{
			 				$mail_response=mail($_REQUEST['user_email'],"Renewal Subscription, Staffx",$email_body,$headers);
			 			}
					}else{
						$mail_response=true;
					}	
					if ($mail_response) {
						if (insert_data($dbc,"subscription",$data)) {
							$lastId=mysqli_insert_id($dbc);
		 					$response=[
									"msg" =>"Subscription has been renewed",
									"sts" =>"success",
									"action"=>$_REQUEST['action']
								];
								insert_data($dbc,"notifications",["type"=>"renew subscription","user_id",$_REQUEST['user_id'],"manager_id"=>$fetchUser['user_id'],"subscription_id"=>$lastId,"text"=>$data['description']]);
		 				}else{
		 					$response=[
									"msg" => mysqli_error($dbc),
									"sts" =>"danger",
									"action"=>$_REQUEST['action']
								];
		 				}
					}else{
		 				$response=[
							"msg" => "Error in sending email",
							"sts" =>"danger",
							"action"=>$_REQUEST['action']
						];
		 			}
				}
				/*Cancel Billing*/
				elseif($_REQUEST['action']=="cancel_billing"){
					$data=[
		 				'status'=>'cancelled'
		 			];
					$email_body='Your subscription has been cancelled. You can contact us for more information.<br><a href="http://staffx.com.au/">Visit our site</a>.';
						if($server=="localhost"){
		 				$mail_response=send_email($_REQUEST['user_email'],"Cancel Subscription, Staffx",$email_body);
			 			}else{
			 				$mail_response=mail($_REQUEST['user_email'],"Cancel Subscription, Staffx",$email_body,$headers);
			 			}
			 		if($mail_response){
			 			if (update_data($dbc,"subscription",$data,"id",$_REQUEST['id'])) {
			 				$response=[
									"msg" =>"Subscription has been cancelled",
									"sts" =>"success",
									"action"=>$_REQUEST['action']
								];
								insert_data($dbc,"notifications",["type"=>"cancel subscription","user_id",$_REQUEST['user_id'],"manager_id"=>$fetchUser['user_id'],"subscription_id"=>$_REQUEST['id'],"text"=>$_REQUEST['reason']]);
			 			}
			 		}else{
		 				$response=[
							"msg" => "Error in sending email",
							"sts" =>"danger",
							"action"=>$_REQUEST['action']
						];
		 			}	
				}
		 	 else{}
	}/*Action not empty*/
	if (empty($response)) {
		$response=[
			"msg"=>"invalid api call",
			'sts'=>"danger",
			"action"=>''
		];
	}
	echo json_encode($response);


?>