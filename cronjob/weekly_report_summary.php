<?php 

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	session_start();
	date_default_timezone_set("Indian/Maldives");
	/* Define Constants */
	define('DB_NAME', 'quicktoolweb00_attendezz');
	define('DB_USER', 'quicktoolweb00_cgit');
	define('DB_PASSWORD', 'developer@cgit.pk');
	define('DB_HOST', 'localhost');
	define("BACKUP_DIR", 'backup');

	/* Data base connection */
	@$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$dbc) {
		echo mysqli_connect_error();
		exit();
	}
	mysqli_set_charset($dbc, "utf8");
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
	# Common Headers 
	$headers .= 'From: Attendezz <noreply@attendezz.com>';
	@$days_array = ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'];
	function fetchRecord($dbc, $table, $fld, $data)
	{
		return  mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM $table WHERE $fld='$data'"));
	}
	function countWhen($dbc, $table, $fld, $data)
	{
		return  mysqli_num_rows(mysqli_query($dbc, "SELECT * FROM $table WHERE $fld='$data'"));
	}
	function getStartAndEndDate($week, $year)
	{
		$dateTime = new DateTime();
		$dateTime->setISODate($year, $week);
		$result['start_date'] = $dateTime->format('d-M-Y');
		$dateTime->modify('+6 days');
		$result['end_date'] = $dateTime->format('d-M-Y');
		return $result;
	}
	if (!function_exists('base_url')) {
	function base_url($atRoot = FALSE, $atCore = FALSE, $parse = FALSE)
		{
			if (isset($_SERVER['HTTP_HOST'])) {
				$http = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
				$hostname = $_SERVER['HTTP_HOST'];
				$dir =  str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

				$core = preg_split('@/@', str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath(dirname(__FILE__))), NULL, PREG_SPLIT_NO_EMPTY);
				$core = $core[0];

				$tmplt = $atRoot ? ($atCore ? "%s://%s/%s/" : "%s://%s/") : ($atCore ? "%s://%s/%s/" : "%s://%s%s");
				$end = $atRoot ? ($atCore ? $core : $hostname) : ($atCore ? $core : $dir);
				$base_url = sprintf($tmplt, $http, $hostname, $end);
			} else $base_url = 'http://localhost/';

			if ($parse) {
				$base_url = parse_url($base_url);
				if (isset($base_url['path'])) if ($base_url['path'] == '/') $base_url['path'] = '';
			}

			return $base_url;
		}
	}
	function dateRange($first, $last, $step = '+1 day', $format = 'Y-m-d')
	{
		$dates = [];
		$current = strtotime($first);
		$last = strtotime($last);

		while ($current <= $last) {

			$dates[] = date($format, $current);
			$current = strtotime($step, $current);
		}

		return $dates;
	}
	function differenceInHours($startdate, $enddate)
	{
		$starttimestamp = strtotime($startdate);
		$endtimestamp = strtotime($enddate);
		$difference = abs($endtimestamp - $starttimestamp) / 3600;
		return $difference;
	}

	$server_address =  str_replace("cronjob/", "", base_url());
	$site_url="http://attendezz.com/dashboard/";

	
    $getBusinessD = mysqli_query($dbc,"SELECT * FROM business WHERE weekly_promotion='yes' AND ( business_status='active' OR business_status='enable')");

    while($fetchBusinessD=mysqli_fetch_assoc($getBusinessD)):
    $email_body='';
    $business_id=$fetchBusinessD['business_id'];
	$fetchBusinessData=fetchRecord($dbc,"business","business_id",$business_id); 
	$show_date=$_REQUEST['dated']=date('d-M-Y');
	$getEmployee=mysqli_query($dbc,"SELECT * FROM assign_business WHERE business_id='$business_id'");
					while($fetchEmployee=mysqli_fetch_assoc($getEmployee)):
						
						if(countWhen($dbc,"users","user_id",$fetchEmployee['user_id'])==0){
							continue;
						}
						$fetchEmployeeData=fetchRecord($dbc,"users","user_id",$fetchEmployee['user_id']);
						if($fetchEmployeeData['user_status']!="enable"){
							continue;
						}
						$_REQUEST['emp_id']=$fetchEmployeeData['user_id'];
						$email_body = '<center><div style="padding:50px;background:#fff;border:1px solid #eee;box-shadow:10px 10px 10px gray;width:90%"><img src="http://attendezz.com/img/logo.png" width="80" height="80" alt=""> <h3>Attendezz <small>QR Attendance System</small></h3>';
						$email_body.='<center><h2>Weekly Attendance Report</h2></center>';

	$date_array=getStartAndEndDate(date('W',strtotime($_REQUEST['dated'])),date('Y',strtotime($_REQUEST['dated'])));
	$fetchEmployeeData=fetchRecord($dbc,"users","user_id",$_REQUEST['emp_id']);
	 if(!empty($fetchEmployeeData['user_pic'])){$pic=$fetchEmployeeData['user_pic']; }else{$pic="default.png"; } 
	$email_body.='<span id="photo" style="padding: 15px">
		<div class="card card-body" style="padding: 15px">
			<div class="row">
				<div class="col-sm-12" style="">
					<center>
						<img src="'.$site_url.'img/staff/'.$pic.'" style="border-radius:100%;margin-right:20px" width="120" height="120" hspace="10"><br>
						<strong>ID#: '.strtoupper($fetchEmployeeData['user_id']).' </strong> <br>
						<strong>'.strtoupper($fetchEmployeeData['user_first_name']).' '.strtoupper($fetchEmployeeData['user_last_name']).'</strong> <br>
						
						<strong>Designation: </strong>'.$fetchEmployeeData['designation'].' <br>
						<strong>Email: </strong><a href="mailto:'.$fetchEmployeeData['user_email'].'">'.$fetchEmployeeData['user_email'].'</a><br>
						<strong>Business Name: </strong>'.strtoupper($fetchBusinessD['business_name']).'<br>
					</center>
				</div><!-- col -->
			</div><!-- row -->';

	
	$email_body.='<div style="clear:both"></div><hr><center>
			<h3>'.date('d-M-Y',strtotime($date_array['start_date'])).' - '.date('d-M-Y',strtotime($date_array['end_date'])).'</h3>
		</center>
		<table class="table table-bordered table-condensed" style="font-size: 12px">';
		 $i=0;
		$grand_totalHrs=0;
	              foreach(dateRange($date_array['start_date'],$date_array['end_date']) as $d):
	              	$dated=date('Y-m-d',strtotime($d));
	              	
	              	$getTimeOff=mysqli_query($dbc,"SELECT * FROM emp_attendance WHERE emp_id='$_REQUEST[emp_id]' AND business_id='$business_id' AND att_date='$dated' AND status='leave'");
	              	if(mysqli_num_rows($getTimeOff)>=1){
	              		$fetchTimeOff=mysqli_fetch_assoc($getTimeOff);
	              	}
	              	$day=date('l',strtotime($d));
	              	@$getStartShift=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM emp_attendance WHERE att_date='$dated' AND shift='start_shift' AND emp_id='$_REQUEST[emp_id]' AND business_id='$business_id'"));
	              	@$getEndShift=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM emp_attendance WHERE att_date='$dated' AND shift='end_shift' AND emp_id='$_REQUEST[emp_id]' AND business_id='$business_id'"));
	              	@$getStartBreak=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM emp_attendance WHERE att_date='$dated' AND shift='start_break' AND emp_id='$_REQUEST[emp_id]' AND business_id='$business_id'"));
	              	@$getEndBreak=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM emp_attendance WHERE att_date='$dated' AND shift='end_break' AND emp_id='$_REQUEST[emp_id]' AND business_id='$business_id'"));
	              	@$getDeviceStart=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM emp_attendance WHERE att_date='$dated' AND  emp_id='$_REQUEST[emp_id]' AND business_id='$business_id' AND shift='start_shift'"));
	              	@$getDeviceEnd=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM emp_attendance WHERE att_date='$dated' AND  emp_id='$_REQUEST[emp_id]' AND business_id='$business_id' AND shift='end_shift'"));
	              	@$getTracking=(mysqli_query($dbc,"SELECT * FROM tracking WHERE dated='$dated' AND  user_id='$_REQUEST[emp_id]' AND business_id='$business_id'"));
	              	$hour_shift=$hour_break='';
	              	$icons=[
	              		'card_scan'=>"id-card",
	              		"phone_scan"=>"mobile",
	              		"nfc"=>"nfc",
	              	];
	              	if(!empty($getStartShift['att_time'] ) AND !empty($getEndShift['att_time'])){
								$hour_shift= number_format(differenceInHours($getStartShift['att_time'],$getEndShift['att_time']),2);
							}
							if(!empty($getStartBreak['att_time'] ) AND !empty($getEndBreak['att_time'])){
								 $hour_break= number_format(differenceInHours($getStartBreak['att_time'],$getEndBreak['att_time']),2);
							}
	              	
					 if($i==0): 
						$email_body.='<tr class="text-center" style="background: #fff;color: #000;border-color: #eee !important;">
										<th>Days</th>
										<th width="12%">Start/CheckIn time</th> 
										<th width="12%">Break Start</th>
										<th width="12%">Break End</th>
										<th width="12%">End/CheckOut Time</th>
										<th width="12%">Total Break Time</th>
										<th width="12%">Total (Hours minus unpaid breaks)</th>
									</tr>';
					 endif; 
					$email_body.='<tr align="center"> <th>'.$day.'<br><i style="font-size: 11px">'.date('d-M-Y',strtotime($d)).'</i>
						</th>';
						 if(!empty($fetchTimeOff) AND mysqli_num_rows($getTimeOff)>=1): 
						$email_body.='<th colspan="13" class="text-center bg-warning">
							Time Off <br>
							Reason: '.(@strtoupper($fetchTimeOff['reason'])).'
						</th>';
						 else: 
						$email_body.='<th>';
						 if(!empty($getStartShift['att_time'])){$email_body.=  date('h:i A',strtotime($getStartShift['att_time']));
						@$email_body.= "<br><span class='fa fa-".$icons[$getDeviceStart['device']]."'></span>";
					}else{$email_body.=  "-";}
							
						$email_body.='</th>';
						$email_body.='<th>';
						 if(!empty($getStartBreak['att_time'])){$email_body.=  date('h:i A',strtotime($getStartBreak['att_time']));}else{$email_body.=  "-";}
						 $email_body.='</th>';
						$email_body.='<th>';
						 if(!empty($getEndBreak['att_time'])){$email_body.=  date('h:i A',strtotime($getEndBreak['att_time']));}else{$email_body.=  "-";}
						 $email_body.='</th>';
					
						$email_body.='<th>';
						if(!empty($getEndShift['att_time'])){$email_body.=  date('h:i A',strtotime($getEndShift['att_time']));
							@$email_body.= "<br><span class='fa fa-".$icons[$getDeviceEnd['device']]."'></span>";
						}else{$email_body.=  "-";}
					$email_body.='</th>';
						
						$email_body.='<th>'; if(!empty($hour_break)){$email_body.=  $hour_break." hr(s)";}else{$email_body.=  "-";} $email_body.='</th>';
						
							
							if(!empty($getStartShift['att_time'] ) AND !empty($getEndShift['att_time']) OR (!empty($getStartBreak['att_time'] ) AND !empty($getEndBreak['att_time']))){
								@$totalHrs=($hour_shift-$hour_break);
								if($totalHrs<0){
									$email_body.='<th>';
									$email_body.=  "Not Checked In/Checked out";
									$email_body.='</th>';
								}else{
									$email_body.='<th>';
									@$grand_totalHrs=$grand_totalHrs+($hour_shift-$hour_break);
									$email_body.=  @($hour_shift-$hour_break)." hr(s)";
									$email_body.='</th>';
								}
							}
							
					 endif; 
					$email_body.='</tr>';
	 $i++; endforeach;
	 $email_body.='
	<tr>
	  	<th colspan="6" class="text-right" align="right">Total Hour(s)</th>
	  	<td>'.$grand_totalHrs.' hr(s)</td>
	  </tr>
	</table>
	</div>
</span>';
 		$email_body .= '</div></center>';
 		mail($fetchEmployeeData['user_email'],"Weekly Attendance Report: ".(date('d-M-Y',strtotime($date_array['start_date'])).' - '.date('d-M-Y',strtotime($date_array['end_date']))),$email_body,$headers);
 		// echo $email_body;
 		// echo "<hr>";
 		
 endwhile;  endwhile; ?>