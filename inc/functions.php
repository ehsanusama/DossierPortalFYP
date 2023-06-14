<?php
session_start();
date_default_timezone_set("Indian/Maldives");
/*
		Data base connection
	*/
/*
	Define Constants
	*/

define('DB_NAME', 'dossier-porta-fyp');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');
define("BACKUP_DIR", 'backup');


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

@$server = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "" : "") . "$_SERVER[HTTP_HOST]";

@$fetchUser = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM users WHERE user_email='$_COOKIE[user_login]' OR username='$_COOKIE[user_login]'"));
@$getRoleAdmin = mysqli_num_rows(mysqli_query($dbc, "SELECT * FROM assign_user_role WHERE LOWER(user_role)='administrator' AND user_id='$fetchUser[user_id]'"));
@$getRoleEmployee = mysqli_num_rows(mysqli_query($dbc, "SELECT * FROM assign_user_role WHERE LOWER(user_role)='employee' AND user_id='$fetchUser[user_id]'"));
@$getRoleManager = mysqli_num_rows(mysqli_query($dbc, "SELECT * FROM assign_user_role WHERE LOWER(user_role)='manager' AND user_id='$fetchUser[user_id]'"));
/*
	Make functions to add  \\ and strip html tags
	*/
function validate_data($dbc, $data)
{
	return mysqli_real_escape_string($dbc, strip_tags($data));
}
/*
	Make function for diplaying messages
	*/
function getMessage($msg, $sts)
{
	echo '<div class="alert alert-' . $sts . '">' . $msg . '</div>';
}

@$server = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "" : "") . "$_SERVER[HTTP_HOST]";

/*
	Admin Role
	*/
$permissions = array();
$getUserRolesPermission = mysqli_query($dbc, "SELECT * FROM user_roles");
while ($fetchUserRolesPermission = mysqli_fetch_assoc($getUserRolesPermission)) {
	$permissions[$fetchUserRolesPermission['user_role_name']] = array();
	$fetchUserRolesPermissionVar = strtolower($fetchUserRolesPermission['user_role_name']);

	$getUserRoleRights = mysqli_query($dbc, "SELECT * FROM assign_module WHERE LOWER(user_role)='$fetchUserRolesPermissionVar'");
	while ($fetchUserRoleRights = mysqli_fetch_assoc($getUserRoleRights)) {
		$permissions[$fetchUserRolesPermission['user_role_name']][] = $fetchUserRoleRights['menu_page'];
	}
}

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
	$ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
	$ip = $_SERVER['REMOTE_ADDR'];
}
define('IP', $ip);

function debug_mode($array)
{
	echo "<pre>";
	print_r($array);
	exit();
}
function getNull($data)
{
	return (empty($data)) ? "" : $data;
}
function getYesNo($data)
{
	// return ($data==1)?'Yes':'No';
	if ($data == 0) {
		# code...
		return 'No';
	} elseif ($data == 1) {
		return 'Yes';
	} else {
		return "Defaulter";
	}
}
function getEnDis($data)
{
	// return ($data==1)?'Yes':'No';
	if ($data == "enable") {
		# code...
		return '<label class="badge  badge-success">Enable</label>';
	} else {
		return '<label class="badge  badge-danger">disabled</label>';
	}
}
function getDateFormat($format, $data)
{
	return date($format, strtotime($data));
}
function get($dbc, $table)
{
	return mysqli_query($dbc, "SELECT * FROM $table");
}
function getFetch($dbc, $table)
{
	return mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM $table"));
}
function getSelectTag($data, $text)
{
	if (!empty($data)) {
		# code...
		echo "<option value='" . $data . "'>" . $data . "</option>";
	} else {
		echo "<option value=''>" . $text . "</option>";
	}
}
function countIf($dbc, $arr)
{
	echo (mysqli_num_rows($arr) == 0) ? "No Found" : '';
}
function get2($dbc, $table1, $table2, $order = "ASC")
{
	return mysqli_query($dbc, "SELECT $table1.user_name, $table2.feed_id, $table2.comment FROM $table1, $table2 WHERE $table1.user_id=$table2.user_id ORDER BY feed_id $order");
}
function deleteFromTable($dbc, $table, $fld = "", $id)
{
	global $sts;
	global $msg;
	$id = base64_decode($id);
	if (mysqli_query($dbc, "DELETE FROM $table WHERE $fld='$id'")) {
		# code...
		$msg =  "Deleted ....";
		$sts = "danger";
	} else {
		$msg = mysqli_error($dbc);
		$sts = "danger";
	}
}
function redirect($url, $time = 0)
{
?>
	<script>
		setTimeout(function() {
			window.location = "<?= $url ?>";
		}, <?= $time ?>);
	</script>
<?php
}
function redirectCurrentURL($time = 0)
{
?>
	<script>
		setTimeout(function() {
			window.location = window.location.href;
		}, <?= $time ?>);
	</script>
<?php
}
function delete_all($dbc, $table, $array, $fld)
{
	global $sts;
	global $msg;
	if (!empty($array)) :
		foreach ($array as $data) {
			# code...
			$q = mysqli_query($dbc, "DELETE FROM $table WHERE $fld='$data'");
		}
		if ($q) {
			# code...
			$msg = "Data Deleted";
			$sts = "danger";
		} else {
			$msg = mysqli_error($dbc);
			$sts = "danger";
		}
	endif;
}
function fetchRecord($dbc, $table, $fld, $data)
{
	return  mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM $table WHERE $fld='$data'"));
}
function insert_data($dbc, $table, $data)
{
	global $msg;
	global $sts;
	$fld = $values = "";
	$i = 0;
	$comma = ",";
	$count = count($data);
	foreach ($data as $index => $value) {
		# code...
		if (($count - 1) == $i) {
			$comma = "";
		}
		$fld = $fld . $index . $comma;
		if ($index = !"post_body") {
			# code...
			$val = validate_data($dbc, $value);
		} else {
			$val = $value;
		}
		@$values = $values . "'" . $val . "'" . $comma;
		$i++;
	}
	return mysqli_query($dbc, "INSERT INTO $table($fld) VALUES($values)");
}
function update_data($dbc, $table, $data, $col, $val)
{
	$set_data = "";
	$i = 0;
	$comma = ",";
	$count = count($data);
	//debug_mode($data);
	foreach ($data as $index => $value) {
		# code...
		if (($count - 1) == $i) {
			$comma = "";
		}
		$set_data = $set_data . $index . "='" . validate_data($dbc, $value) . "'" . $comma;
		$i++;
	}
	return mysqli_query($dbc, "UPDATE $table SET $set_data WHERE $col='$val'");
}


function countAll($dbc, $table)
{
	return mysqli_num_rows(mysqli_query($dbc, "SELECT * FROM $table"));
}

// Count When
function countWhen($dbc, $table, $fld, $data)
{
	return  mysqli_num_rows(mysqli_query($dbc, "SELECT * FROM $table WHERE $fld='$data'"));
}
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
	$ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
	$ip = $_SERVER['REMOTE_ADDR'];
}
function upload_pic($file, $url)
{
	global $sts;
	global $msg;
	global $size;
	global $pic;
	// @$file= $_FILES['f'];
	$file_name = $file['name'];
	$temp_name = $file['tmp_name'];
	$size = $file['size'];
	// $type = $file['type'];
	$errors = $file['error'];
	$type = explode('.', $file_name);
	$type = $type[count($type) - 1];
	$pic = uniqid(rand()) . '.' . $type;
	$_SESSION['pic_name'] = $pic;
	$url = $url . $pic;
	if (!$temp_name) {
		# code...
		$sts = "info";
		$msg = "Please Choose a File Before Clicking";
	} elseif ($size > 500000) {
		$sts = "info";
		$msg = "Not Allowed more than 5 MB file size";
		unlink($temp_name);
		// exit();
	} elseif (!preg_match("/\.(gif|jpg|png|jpeg|JPG|PNG|JPEG|GIF)$/i", $file_name)) {
		$sts = "info";
		$msg = "Only .jpg , .png and .gif file types are allowed";
		unlink($temp_name);
		// exit();
	} elseif ($errors == 1) {
		$sts = "info";
		$msg = "Error while uploading....";
		unlink($temp_name);
		// exit();
	} elseif (move_uploaded_file($temp_name, $url)) {
		return true;
	} else {
		$sts = "info";
		$msg = "Not Uploaded...";
		@unlink($temp_name);
		//exit();
	}
}
function upload_file($file, $url)
{
	global $sts;
	global $msg;
	global $size;
	global $pic;
	// @$file= $_FILES['f'];
	$file_name = $file['name'];
	$temp_name = $file['tmp_name'];
	$size = $file['size'];
	// $type = $file['type'];
	$errors = $file['error'];
	$type = explode('.', $file_name);
	$type = $type[count($type) - 1];
	$pic = uniqid(rand()) . '.' . $type;
	$_SESSION['file_name'] = $pic;
	$url = $url . $pic;
	if (!$temp_name) {
		# code...
		$sts = "info";
		$msg = "Please Choose a File Before Clicking";
	} elseif ($size > 500000) {
		$sts = "info";
		$msg = "Not Allowed more than 5 MB file size";
		unlink($temp_name);
		// exit();
	} elseif (!preg_match("/\.(doc|docx|xls|pdf)$/i", $file_name)) {
		$sts = "info";
		$msg = "Only .doc , .docx, .pdf and .xls file types are allowed";
		unlink($temp_name);
		// exit();
	} elseif ($errors == 1) {
		$sts = "info";
		$msg = "Error while uploading....";
		unlink($temp_name);
		// exit();
	}
	if (move_uploaded_file($temp_name, $url)) {
		return true;
	} else {
		$sts = "info";
		$msg = "Not Uploaded...";
		@unlink($temp_name);
		//exit();
	}
}
/*
	Get Login User Roles and Make File Access
*/

/*
	Making dynamic Menu and Generating Multiple Level
	*/
function show_menu($dbc)
{
	$menus = '';
	$menus .= generate_multilevel_menu($dbc);
	return $menus;
}
function generate_multilevel_menu($dbc, $parent_id = NULL)
{
	@$_SESSION['fetchUser'] = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM users WHERE user_email='$_SESSION[user_login]' OR username='$_SESSION[user_login]'"));
	$per = array();
	$getUserRolesPermission = mysqli_query($dbc, "SELECT * FROM user_roles");
	while ($fetchUserRolesPermission = mysqli_fetch_assoc($getUserRolesPermission)) {
		$per[$fetchUserRolesPermission['user_role_name']] = array();
		$getUserRoleRights = mysqli_query($dbc, "SELECT * FROM assign_module WHERE user_role='$fetchUserRolesPermission[user_role_name]'");
		while ($fetchUserRoleRights = mysqli_fetch_assoc($getUserRoleRights)) {
			$per[$fetchUserRolesPermission['user_role_name']][] = $fetchUserRoleRights['menu_page'];
		}
	}
	$u_p = [];
	$files = array();

	$getUserRole = mysqli_query($dbc, "SELECT * FROM assign_user_role WHERE user_id='" . $_SESSION['fetchUser']['user_id'] . "'");
	while ($fetchUserRole = mysqli_fetch_assoc($getUserRole)) {
		$u_p[] = $fetchUserRole['user_role'];
		foreach ($per[$fetchUserRole['user_role']] as $value) {
			$p = explode('.', $value);
			$files[] = $p[0];
		}
	}

	$menu = '';
	$q = '';
	if (is_null($parent_id)) {
		$q = mysqli_query($dbc, "SELECT * FROM menus WHERE parent_id IS NULL OR parent_id=0");
	} else {
		$q = mysqli_query($dbc, "SELECT * FROM menus WHERE parent_id='$parent_id'");
	}
	while ($r = mysqli_fetch_assoc($q)) {

		if (!empty($r['page'])) {
			# code...
			$page = explode(".", $r['page']);
			if (in_array($page[0], $files)) {
			}
			$menu .= '<li  title="' . ucwords($r['title']) . '"  class="treeview"><a ondblclick="redirectURL(`index.php?nav=' . base64_encode($page[0]) . '`)" href="index.php?nav=' . base64_encode($page[0]) . '">
            <i class="' . $r['icon'] . '"></i> <span>' . ucwords($r['title']) . '</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>';
		} else {
			$menu .= '<li  title="' . ucwords($r['title']) . '" class="treeview"><a href="#">
            <i class="' . $r['icon'] . '"></i> <span>' . ucwords($r['title']) . '</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>';
		}
		$menu .= '<ul class="treeview-menu">' . generate_multilevel_menu($dbc, $r['id']) . '</ul>';
		$menu .= '</li>';
	} //loop
	return $menu;
} //end

/*
	Get Last ID
	*/
function getLastId($dbc, $table, $fld)
{
	$q = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM $table ORDER BY $fld DESC LIMIT 1"));
	return $q[$fld];
}
/*
	Email SMTP
	*/
function send_email($email_address, $subject, $email_body)
{
	global $sts;
	global $msg;
	$mail = new PHPMailer;
	//Tell PHPMailer to use SMTP
	$mail->isSMTP();

	//Enable SMTP debugging
	// 0 = off (for production use)
	// 1 = client messages
	// 2 = client and server messages
	$mail->SMTPDebug = 0;

	//Ask for HTML-friendly debug output
	$mail->Debugoutput = 'html';

	//Set the hostname of the mail server
	$mail->Host = 'smtp.gmail.com';

	//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
	$mail->Port = 587;

	//Set the encryption system to use - ssl (deprecated) or tls
	$mail->SMTPSecure = 'tls';

	//Whether to use SMTP authentication
	$mail->SMTPAuth = true;

	//Username to use for SMTP authentication - use full email address for gmail
	$mail->Username = "cgit4202@gmail.com";

	//Password to use for SMTP authentication
	$mail->Password = "3593ab59Moiz123";

	//Set who the message is to be sent from
	$mail->setFrom('cgit4202@gmail.com', 'Staffx');

	//Set an alternative reply-to address
	//$mail->addReplyTo('replyto@example.com', 'First Last');

	//Set who the message is to be sent to
	$mail->addAddress($email_address, $subject);

	//Set the subject line
	$mail->Subject = $subject;

	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));

	$body = $email_body;
	$mail->Body = $body;

	//Replace the plain text body with one created manually
	$mail->AltBody = 'This is a plain-text message body';
	$mail->isHTML(true);
	//Attach an image file
	//$mail->addAttachment('images/phpmailer_mini.png');

	//send the message, check for errors
	if (!$mail->send()) {
		$msg = "Mailer Error: " . $mail->ErrorInfo;
		$sts = "danger";
		return false;
	} else {
		$msg = "Email Sent Successfully...";
		$sts = "success";
		return true;
	}
	// echo $msg;
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
/*function distance($lat1=31.4304978, $lon1=73.0669109, $lat2, $lon2, $unit) {
		  $radlat1 = M_PI * $lat1/180;
		  $radlat2 = M_PI * $lat2/180;
		  $theta = $lon1-$lon2;
		  $radtheta = M_PI * $theta/180;
		  $dist = sin($radlat1) * sin($radlat2) + cos($radlat1) * cos($radlat2) * cos($radtheta);
		  if ($dist > 1) {
		    $dist = 1;
		  }
		  $dist = acos($dist);
		  $dist = $dist * 180/M_PI;
		  $dist = $dist * 60 * 1.1515;
		  if ($unit=="K") { $dist = $dist * 1.609344; }
		  if ($unit=="N") { $dist = $dist * 0.8684; }
		  return $dist;
	}*/
/*function distance($lat1, $lon1, $lat2, $lon2,$unit) {

	    $pi80 = M_PI / 180;
	    $lat1 *= $pi80;
	    $lon1 *= $pi80;
	    $lat2 *= $pi80;
	    $lon2 *= $pi80;

	    $r = 6372.797; // mean radius of Earth in km
	    $dlat = $lat2 - $lat1;
	    $dlon = $lon2 - $lon1;
	    $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2);
	    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
	    $km = $r * $c;

	    //echo '<br/>'.$km;
	    return $km;
	}*/
function distance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $unit)
{
	$rad = M_PI / 180;
	//Calculate distance from latitude and longitude
	$theta = $longitudeFrom - $longitudeTo;
	$dist = sin($latitudeFrom * $rad)
		* sin($latitudeTo * $rad) +  cos($latitudeFrom * $rad)
		* cos($latitudeTo * $rad) * cos($theta * $rad);

	return acos($dist) / $rad * 60 *  1.853;
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
function datePercentage($start, $end)
{

	$start = strtotime($start);
	$end = strtotime($end);
	if (!$end || !$start) {
		throw new Exception('Invalid dates.');
	} else if ($start > $end) {
		throw new Exception('Start date is larger than end date.');
	}

	$diff = $end - $start;

	$current = time();
	$cdiff = $current - $start;

	if ($cdiff > $diff) {
		$percentage = 1.0;
	} else if ($current < $start) {
		$percentage = 0.0;
	} else {
		$percentage = $cdiff / $diff;
	}

	return round($percentage * 100);
}
function TimeIsBetweenTwoTimes($from, $till, $input)
{
	$f = DateTime::createFromFormat('H:i:s', $from);
	$t = DateTime::createFromFormat('H:i:s', $till);
	$i = DateTime::createFromFormat('H:i:s', $input);
	if ($f > $t) $t->modify('+1 day');
	return ($f <= $i && $i <= $t) || ($f <= $i->modify('+1 day') && $i <= $t);
}
function getBusinessEmployee($dbc, $business_id)
{
	$q = mysqli_query($dbc, "SELECT * FROM users INNER JOIN assign_user_role WHERE users.user_id=assign_user_role.user_id AND LOWER(assign_user_role.user_role)='employee'");
	$arr = [];
	while ($r = mysqli_fetch_assoc($q)) {
		@$fetchUserExtra = json_decode($r['user_extra']);
		if (!empty($business_id) and $business_id != "all") {
			if (mysqli_num_rows(mysqli_query($dbc, "SELECT * FROM assign_business WHERE user_id='$r[user_id]' AND business_id='$business_id'")) == 0) {
				continue;
			}
		}
		$arr[] = $r;
	}
	return $arr;
}
function getDatesFromRange($start, $end)
{
	$dates = array($start);
	while (end($dates) < $end) {
		$dates[] = date('Y-m-d', strtotime(end($dates) . ' +1 day'));
	}
	return $dates;
}
function getUserByBusiness($dbc, $business_id)
{
	$getEmployee = mysqli_query($dbc, "SELECT * FROM assign_business WHERE business_id='$business_id'");
	while ($fetchEmployee = mysqli_fetch_assoc($getEmployee)) :
		if (countWhen($dbc, "users", "user_id", $fetchEmployee['user_id']) == 0) {
			continue;
		}
		$fetchEmployeeData = fetchRecord($dbc, "users", "user_id", $fetchEmployee['user_id']);
		if ($fetchEmployeeData['user_status'] != "enable") {
			continue;
		}
		$data[] = $fetchEmployeeData;
	endwhile;
	return $data;
}

$researchData = [
	"Research articles as",
	"Presentation in Conferences",
	"Books Published",
	"No. of Patents",
	"Book Chapters Published",
	"Technologies Licensed",
	"Research funding (Rs. Million)",
	"Research Supervision (As Supervisor)",
	"Research Supervision (As Co-Supervisor)",
	"BS Supervision"
];

$academicData = [
	"No. of courses (unique) Taught",
	"Courses (New) Designed/ Modified ",
	"Course Books Published ",
];

$otherContributions = [
	"MOUs/ Collaborations",
	"Organization of trainings/workshops/seminars/conferences",
	"Peer review of journal articles (Number) ",
	"External Examiner",
	"Administrative/non-academic departmental duties/Teachers evaluations",
];


@include_once 'inc/code.php';
// ip_details($ip);

?>