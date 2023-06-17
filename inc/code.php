<?php
@$fetchBranchData = fetchRecord($dbc, "branch", "branch_id", $fetchUser['user_branch']);
@$getRoleAdmin = mysqli_num_rows(mysqli_query($dbc, "SELECT * FROM assign_user_role WHERE LOWER(user_role)='administrator' AND user_id='$fetchUser[user_id]'"));
@$getRoleEmployee = mysqli_num_rows(mysqli_query($dbc, "SELECT * FROM assign_user_role WHERE LOWER(user_role)='employee' AND user_id='$fetchUser[user_id]'"));
@$global_business = base64_decode($_REQUEST['business']);
@$fetchBusinessData = fetchRecord($dbc, "business", "business_id", $global_business);
$user_permission = array();
$files = array();
$parents = array();
$getUserRole = mysqli_query($dbc, "SELECT * FROM assign_user_role WHERE user_id='" . $fetchUser['user_id'] . "'");
while ($fetchUserRole = mysqli_fetch_assoc($getUserRole)) {
	$user_permission[] = $fetchUserRole['user_role'];
	foreach ($permissions[$fetchUserRole['user_role']] as $value) {
		$p = explode('.', $value);
		$files[] = $p[0];
		$getParent = fetchRecord($dbc, "menus", "page", $value);
		$parents[] = $getParent['parent_id'];
	}
}
$files = array_unique($files);
@$_SESSION['business'] = $_REQUEST['business'];
$attendance_status = ['absent', 'leave', 'vocation', 'present', 'national holiday'];
/*
	Call Pages
	*/
if (!empty($_REQUEST['nav'])) {
	if (in_array(base64_decode($_REQUEST['nav']), $files) or (($_REQUEST['nav'] == base64_encode('developer_mode')) or ($_REQUEST['nav'] == base64_encode('profile')))) {
		$page = "pages/" . base64_decode($_REQUEST['nav']) . ".php";
	} else {
		$page = "pages/404.php";
	}
} else {
	$page = "pages/home.php";
}

/*
	User Role Module
	*/
if (isset($_REQUEST['add_role'])) {
	$data = [
		'user_role_name' => $_REQUEST['user_role_name'],
		'user_role_status' => $_REQUEST['user_role_status'],
	];
	if (insert_data($dbc, "user_roles", $data)) {
		$msg = "User Role Added Successfully";
		$sts = "success";
		redirectCurrentURL(800);
	} else {
		$msg = mysqli_error($dbc);
		$sts = "danger";
	}
}
if (!empty($_REQUEST['edit_user_role_id'])) {
	$fetchUserRoleData = fetchRecord($dbc, "user_roles", "user_role_id", base64_decode($_REQUEST['edit_user_role_id']));
	$user_role_btn = '<button class="btn btn-primary" name="update_role">Edit Role</button>';
} else {
	$user_role_btn = '<button class="btn btn-success" name="add_role">Add Role</button>';
}
if (isset($_REQUEST['update_role'])) {
	$data = [
		'user_role_name' => $_REQUEST['user_role_name'],
		'user_role_status' => $_REQUEST['user_role_status'],
	];
	if (update_data($dbc, "user_roles", $data, "user_role_id", base64_decode($_REQUEST['edit_user_role_id']))) {
		$msg = "User Role Updated Successfully";
		$sts = "info";
		redirectCurrentURL(800);
	} else {
		$msg = mysqli_error($dbc);
		$sts = "danger";
	}
}


/*
	User Role Module
	*/
if (isset($_REQUEST['add_user'])) {
	if ($_FILES['f']['tmp_name']) {
		upload_pic($_FILES['f'], "img/uploads/");
		$user_pic = $_SESSION['pic_name'];
	} else {
		$user_pic = $_REQUEST['user_pic'];
	}
	$data = [
		'user_fullname' => $_REQUEST['user_fullname'],
		'username' => strtolower(str_replace(" ", "_", $_REQUEST['user_fullname']) . rand(1000, 9999)),
		'user_email' => $_REQUEST['user_email'],
		'user_password' => md5($_REQUEST['user_password']),
		'user_address' => $_REQUEST['user_address'],
		'user_branch' => $_REQUEST['user_branch'],
		'user_cnic' => $_REQUEST['user_cnic'],
		'user_phone' => $_REQUEST['user_phone'],
		'user_created_id' => $fetchUser['user_id'],
		'user_status' => $_REQUEST['user_status'],
		'designation' => strtolower($_REQUEST['designation']),
		'user_pic' => $user_pic,
		'device_id' => $_REQUEST['device_id'],
		'allow_multiple_login' => @(($_REQUEST['allow_multiple_login'] == "yes") ? "yes" : "no"),
	];
	if (insert_data($dbc, "users", $data)) {
		# code...
		$msg = "User Added Successfully";
		$sts = "success";
		insert_data($dbc, "assign_user_role", ["user_id" => mysqli_insert_id($dbc), "user_role" => "employee"]);
		redirectCurrentURL(800);
	} else {
		$msg = mysqli_error($dbc);
		$sts = "danger";
	}
} //insert
if (!empty($_REQUEST['edit_user_id'])) {
	# code...
	$fetchUserData = fetchRecord($dbc, "users", "user_id", base64_decode($_REQUEST['edit_user_id']));
	$user_btn = '<button class="btn btn-primary" name="update_user">Edit User</button>';
} else {
	$user_btn = '<button type="submit" class="btn btn-success" name="add_user">Add User</button>';
}
if (isset($_REQUEST['update_user'])) {
	$user_id = base64_decode($_REQUEST['edit_user_id']);
	$data = [
		'user_email' => $_REQUEST['user_email'],
		'user_fullname' => $_REQUEST['user_fullname'],
		'username' => $_REQUEST['username'],
		'user_address' => $_REQUEST['user_address'],
		'user_branch' => $_REQUEST['user_branch'],
		'user_cnic' => $_REQUEST['user_cnic'],
		'user_phone' => $_REQUEST['user_phone'],
		'user_created_id' => $fetchUser['user_id'],
		'user_status' => $_REQUEST['user_status'],
		'designation' => strtolower($_REQUEST['designation']),
		'device_id' => $_REQUEST['device_id'],
		'allow_multiple_login' => @(($_REQUEST['allow_multiple_login'] == "yes") ? "yes" : "no"),


	];
	if ($_FILES['f']['tmp_name']) {
		upload_pic($_FILES['f'], "img/uploads/");
		$data['user_pic'] = $_SESSION['pic_name'];
	}
	if (mysqli_num_rows(mysqli_query($dbc, "SELECT * FROM users WHERE user_password='$_REQUEST[user_password]' AND user_id='$user_id'")) == 0) {
		$data["user_password"] = md5($_REQUEST['user_password']);
	}
	if (update_data($dbc, "users", $data, "user_id", base64_decode($_REQUEST['edit_user_id']))) {
		# code...
		$msg = "User Updated Successfully";
		$sts = "info";
		redirectCurrentURL(800);
	} else {
		$msg = mysqli_error($dbc);
		$sts = "danger";
	}
} //update

/*
	Menu Moudle
	*/
if (isset($_REQUEST['add_menu'])) {
	$data = [
		'title' => $_REQUEST['title'],
		'page' => $_REQUEST['page'],
		'parent_id' => $_REQUEST['parent_id'],
		'icon' => 'fa ' . $_REQUEST['icon'],
	];
	if (insert_data($dbc, "menus", $data)) {
		/*$txt='<div class="panel panel-default panel-body" style="padding: 20px">\n <div class="row">\n <div class="col-sm-8 pull-right">\n </div><!-- col -->\n <div class="col-sm-4 panel panel-default panel-body">\n </div><!-- col -->\n</div><!-- row --> </div><!-- box -->'; 
			$myfile = fopen("pages/".$_REQUEST['page'], "w") or die("Unable to open file!");
				fwrite($myfile, $txt);
				fclose($myfile);*/
		$msg = "Menu Added Successfully";
		$sts = "success";
		redirectCurrentURL(800);
	} else {
		$msg = mysqli_error($dbc);
		$sts = "danger";
	}
}
if (!empty($_REQUEST['edit_menu_id'])) {
	$fetchMenu = fetchRecord($dbc, "menus", "id", base64_decode($_REQUEST['edit_menu_id']));
	$menu_btn = '<button class="btn btn-primary" name="update_menu">Edit Menu</button>';
} else {
	$menu_btn = '<button type="submit" class="btn btn-success" name="add_menu">Add Menu</button>';
}
if (isset($_REQUEST['update_menu'])) {
	$data = [
		'title' => $_REQUEST['title'],
		'page' => $_REQUEST['page'],
		'parent_id' => $_REQUEST['parent_id'],
		'icon' => 'fa ' . $_REQUEST['icon'],
	];
	if (update_data($dbc, "menus", $data, "id", base64_decode($_REQUEST['edit_menu_id']))) {
		$msg = "Menu Updated Successfully";
		$sts = "info";
		redirectCurrentURL(800);
	} else {
		$msg = mysqli_error($dbc);
		$sts = "danger";
	}
}
/*
	Add Branch
	*/
if (isset($_REQUEST['add_branch'])) {

	if ($_FILES['f']['tmp_name']) {
		$dir = "img/uploads/";
		upload_pic($_FILES['f'], $dir);
		$user_pic = $_SESSION['pic_name'];
	} else {
		$user_pic = 'user_default.png';
	}
	$arr = [];
	for ($i = 0; $i < count($_REQUEST['days']); $i++) {
		$arr[] = [
			$_REQUEST['days'][$i] =>
			[
				"opening_time" => (empty($_REQUEST['opening_time'][$i])) ? "" : date('H:i:s', strtotime($_REQUEST['opening_time'][$i])),
				"closing_time" => (empty($_REQUEST['closing_time'][$i])) ? "" : date('H:i:s', strtotime($_REQUEST['closing_time'][$i]))
			]
		];
	}



	$data = [
		'branch_name' => $_REQUEST['branch_name'],
		'branch_logo' => $user_pic,
		'branch_location' => $_REQUEST['branch_location'],
		'branch_timing' => json_encode($arr),
		'minute_allowed' => $_REQUEST['minute_allowed'],
	];

	if (insert_data($dbc, "branch", $data)) {
		$msg = "Branch Added";
		$sts = "success";
		redirectCurrentURL(800);
	} else {
		$msg = mysqli_error($dbc);
		$sts = "danger";
	}
}
if (!empty($_REQUEST['edit_branch_id'])) {
	$fetchBranchData = fetchRecord($dbc, "branch", "branch_id", base64_decode($_REQUEST['edit_branch_id']));
	$branch_btn = '<button class="btn btn-primary" name="update_branch">Edit Branch</button>';
} else {
	$branch_btn = '<button class="btn btn-success" name="add_branch">Add Branch</button>';
}
/*
	Update user Button
	*/
if (isset($_REQUEST['update_branch'])) {
	for ($i = 0; $i < count($_REQUEST['days']); $i++) {
		$arr[] = [
			$_REQUEST['days'][$i] =>
			[
				"opening_time" => (empty($_REQUEST['opening_time'][$i])) ? "" : date('H:i:s', strtotime($_REQUEST['opening_time'][$i])),
				"closing_time" => (empty($_REQUEST['closing_time'][$i])) ? "" : date('H:i:s', strtotime($_REQUEST['closing_time'][$i]))
			]
		];
	}
	@$data = [
		'branch_name' => $_REQUEST['branch_name'],
		'branch_location' => $_REQUEST['branch_location'],
		'distance' => $_REQUEST['distance'],
		'branch_timing' => json_encode($arr),
		'minute_allowed' => $_REQUEST['minute_allowed'],

	];
	if ($_FILES['f']['tmp_name']) {
		$dir = "img/uploads/";
		upload_pic($_FILES['f'], $dir);
		$user_pic = $_SESSION['pic_name'];
		$data['branch_logo'] = $user_pic;
	} else {
		$user_pic = 'user_default.png';
	}


	if (update_data($dbc, "branch", $data, "branch_id", base64_decode($_REQUEST['edit_branch_id']))) {
		$msg = "Branch Updated";
		$sts = "success";
		redirectCurrentURL(800);
	} else {
		$msg = mysqli_error($dbc);
		$sts = "danger";
	}
}
/*
	Reset Password
	*/
if (isset($_REQUEST['reset_password'])) {
	$new_password = md5($_REQUEST['new_password']);
	$confirm_password = md5($_REQUEST['confirm_password']);
	if ($new_password == $confirm_password) {
		$data = [
			"user_password" => $new_password
		];
		if (update_data($dbc, "users", $data, "user_email", base64_decode($_REQUEST['email']))) {
			$msg = "Password has been reset. Redirecting....";
			$sts = "success";
			session_destroy();
			redirect('login.php', 2000);
		}
	} else {
		$msg = "New or Confirm Password Not Matched";
		$sts = "danger";
	}
}

/* System Settings */
if (!empty($_REQUEST['action']) and $_REQUEST['action'] == "change_settings") {
	mysqli_query($dbc, "UPDATE settings SET status='deactivate'");
	if (update_data($dbc, "settings", ["status" => $_REQUEST['check']], "id", $_REQUEST['id'])) {
		$msg = "Settings Changed";
		$sts = "success";
		redirectCurrentURL(500);
	} else {
		$msg = mysqli_error($dbc);
		$sts = "danger";
	}
}
if (!empty($_REQUEST['setting_id'])) {
	$fetchSettings = fetchRecord($dbc, "settings", "id", $_REQUEST['setting_id']);
}
if (isset($_REQUEST['setting_btn'])) {
	$data = [
		'company_name' => $_REQUEST['company_name'],
		'title' => $_REQUEST['title'],
		'email' => $_REQUEST['email'],
		'phone' => $_REQUEST['phone'],
		'distance' => $_REQUEST['distance'],
		'location' => $_REQUEST['location'],
		'status' => $_REQUEST['status'],
		'open_hour' => $_REQUEST['open_hour'],
		'close_hour' => $_REQUEST['close_hour'],
		'minute_allowed' => $_REQUEST['minute_allowed'],
	];

	if ($_FILES['f']['tmp_name']) {
		upload_pic($_FILES['f'], "img/uploads/");
		$data["logo"] = $_SESSION['pic_name'];
	}

	if ($_REQUEST['setting_btn'] == "add") {
		$q = insert_data($dbc, "settings", $data);
	} else {
		$q = update_data($dbc, "settings", $data, "id", $_REQUEST['id']);
	}
	if ($q) {
		$msg = "Settings Changed";
		$sts = "success";
		redirectCurrentURL(500);
	} else {
		$msg = mysqli_error($dbc);
		$sts = "danger";
	}
}
/*Salary Module*/
if (!empty($_REQUEST['edit_salary_id'])) {
	$fetchSalary = fetchRecord($dbc, "salary", "id", base64_decode($_REQUEST['edit_salary_id']));
}
if (isset($_REQUEST['salary_btn'])) {
	# code...
	$data = [
		'emp_id' => $_REQUEST['emp_id'],
		'amount' => $_REQUEST['amount'],
		'remarks' => $_REQUEST['remarks'],
		'dated' => $_REQUEST['dated'],
		'user_id' => $fetchUser['user_id']
	];
	if ($_REQUEST['salary_btn'] == "add") {
		$q = insert_data($dbc, "salary", $data);
	} else {
		$q = update_data($dbc, "salary", $data, "id", base64_decode($_REQUEST['edit_salary_id']));
	}
	if ($q) {
		$msg = "Data Submitted";
		$sts = "success";
		redirectCurrentURL(500);
	} else {
		$msg = mysqli_error($dbc);
		$sts = "danger";
	}
}

if (isset($_REQUEST['leave_btn'])) {
	$from = date_create(date('Y-m-d', strtotime($_REQUEST['from'])));
	$to = date_create(date('Y-m-d', strtotime($_REQUEST['to'])));
	$diff = date_diff($from, $to);
	$days = $diff->format("%d");

	for ($i = 1; $i <= $days; $i++) {
		$data = [
			'emp_id' => @$_REQUEST['emp_id'],
			'description' => @$_REQUEST['description'],
			'att_date' => @date('Y-m-' . $i, strtotime($_REQUEST['from'])),
			'admin_id' => @$fetchUser['user_id'],
			'in_time' => @date('H:i:s', strtotime($_REQUEST['in_time'])),
			'out_time' => @date('H:i:s', strtotime($_REQUEST['out_time'])),
			'att_sts' => 'l'
		];
		$q = insert_data($dbc, "emp_attendance", $data);
	}
	if ($q) {
		$msg = "Data Submitted";
		$sts = "success";
		redirectCurrentURL(500);
	} else {
		$msg = mysqli_error($dbc);
		$sts = "danger";
	}
}
/*Delete Backup file Code*/
if (!empty($_REQUEST['delete_file'])) {
	$msg = '<form action="" method="post">
					    <div class="radio">
					      <label for="">Do you want to delete this backup?</label>
					      <br>
					      <label>
					        <input type="radio" name="choice" value="yes"> Yes
					      </label>
					      <br>
					      <label>
					        <input type="radio" name="choice" value="no"> No
					      </label>
					    </div>
					    <button class="btn btn-danger" type="submit" name="delete_btn">Confirm</button>
					  </form>';
	$sts = "warning";
	if (!empty($_REQUEST['choice']) and $_REQUEST['choice'] == "yes") {
		if (unlink("backup/" . $_REQUEST['delete_file'])) {
			$msg = "Backup has been deleted";
			$sts = "success";
			redirect('index.php?nav=' . $_REQUEST['nav'] . "&business=" . $_REQUEST['business'], 1500);
		} else {
			$msg = "Something went wrong";
			$sts = "danger";
		}
	}
	if (!empty($_REQUEST['choice']) and $_REQUEST['choice'] == "no") {
		redirect('index.php?nav=' . $_REQUEST['nav'] . "&business=" . $_REQUEST['business'], 0);
	}
}
/* Configuration Delete */
if (!empty($_REQUEST['delete_research']) and !empty($_REQUEST['table']) and !empty($_REQUEST['field'])) {
	$id = $_REQUEST['delete_research'];
	$delConfig = mysqli_query($dbc, "DELETE FROM $_REQUEST[table] WHERE $_REQUEST[field]='$id' and  user_id ='$fetchUser[user_id]'");
	if ($delConfig) {
		$msg = "Data Deleted";
		$sts = "success";
		redirect('index.php?nav=' . $_REQUEST['nav'], 2000);
	} else {
		$msg = mysqli_error($dbc);
		$sts = "danger";
	}
}
