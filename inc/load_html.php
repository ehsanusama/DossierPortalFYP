<?php
include_once 'functions.php';
if (!empty($_REQUEST['action'])) : ?>
	<?php if ($_REQUEST['action'] == "load_business_form") :
		$fetchBusiness = (!empty($_REQUEST['field'])) ? fetchRecord($dbc, "business", "business_id", $_REQUEST['field']) : "";
		@$btn_value = (empty($fetchBusiness)) ? "add" : "update";
	?>
		<form action="api/index.php" method="post" class="ajax-form-with-file" enctype="multipart/form-data">
			<input type="hidden" name="business_id" value="<?= @$fetchBusiness['business_id'] ?>">
			<input type="hidden" name="user_id" value="<?= @$fetchUser['user_id'] ?>">
			<input type="hidden" name="action" value="business_module">
			<input type="hidden" name="operation" value="<?= @$btn_value ?>">
			<center>
				<?php if (!empty($fetchBusiness['business_logo'])) : ?>
					<img src="img/<?= $fetchBusiness['business_logo'] ?>" class="img img-responsive center-block" width="70" height="70" alt="" id="aImgShow">
				<?php else : ?>
					<img src="img/default.png" class="img img-responsive center-block" width="120" height="120" alt="" id="aImgShow">
				<?php endif; ?>
				<div class="form-group">
					<input type="file" id="img" class="center-block" onchange="uploadImage(this)" data-target="#aImgShow" name="f">
					<p class="text-muted text-center" style="font-size: 11px">
						Only .png , .jpg , .gif and .jpeg files are allowed
					</p>
				</div><!-- group -->
			</center>
			<div class="form-group">
				<label for="">Business Name</label>
				<input type="text" placeholder="Business Name" required class="form-control" name="business_name" value="<?= @$fetchBusiness['business_name'] ?>">
			</div><!-- group -->
			<div class="form-group">
				<label for="">Email</label>
				<input type="email" placeholder="Email Address" required class="form-control" name="business_email" value="<?= @$fetchBusiness['business_email'] ?>">
			</div><!-- business_email -->
			<div class="form-group">
				<label for="">Phone (optional)</label>
				<input type="text" placeholder="e.g. +923226224202" class="form-control" name="business_phone" value="<?= @$fetchBusiness['business_phone'] ?>">
			</div><!-- group -->
			<div class="form-group">
				<label for="">Location</label>
				<div class="input-group">
					<input type="text" class="form-control" id="latlong" placeholder="Location" name="business_location" required value="<?= @$fetchBusiness['business_location'] ?>">
					<span class="input-group-btn">
						<button type="button" onclick="getLocation()" class="btn btn-warning">Get Location</button>
					</span>
				</div>
				<p class="text-danger" style="font-size:12px;">Only use the Get Location button to get your business latitude and longitude. Do not write any address</p>
			</div><!-- group -->
			<div class="form-group">
				<label for="">Distance (meters)</label>
				<input type="number" class="form-control" autocomplete="off" placeholder="Distance" name="business_distance" value="<?= @$fetchBusiness['business_distance'] ?>" required>
			</div><!-- group -->

			<button class="btn btn-primary" type="submit">Submit</button>
		</form>
		<br>
		<?php if ($getRoleAdmin == 1) : ?>
			<div class="form-group">
				<?php @$checked = (strtolower($fetchBusiness['is_tracking']) == "yes") ? "checked" : ""; ?>
				<label for="">GPS Tracking on Mobile Application: </label>
				<label class="switch">
					<input title="business_tracking|<?= $fetchBusiness['business_id'] ?>" type="checkbox" class="switch-btn" name="is_tracking" value="yes" <?= @$checked ?>>
					<span class="slider round"></span>
				</label>
			</div><!-- form group -->
			<div class="form-group">
				<?php @$checkedWeekly = (strtolower($fetchBusiness['weekly_promotion']) == "yes") ? "checked" : ""; ?>
				<label for="">Send Weekly Attendance Report to Employee/Staff: </label>
				<label class="switch">
					<input title="business_weekly_promotion|<?= $fetchBusiness['business_id'] ?>" type="checkbox" class="switch-btn" name="weekly_promotion" value="yes" <?= @$checkedWeekly ?>>
					<span class="slider round"></span>
				</label>
			</div><!-- form group -->
		<?php endif; ?>
	<?php endif; ?>

	<?php
	/*Forgot Password*/
	if ($_REQUEST['action'] == "load_forget_password_module") :

	?>
		<form action="api/index.php" method="post" class="ajax-form">
			<span class="response"></span>
			<input type="hidden" name="user_email" value="<?= @$_REQUEST['field'] ?>">
			<input type="hidden" name="action" value="forgot_password_module">
			<div class="form-group">
				<label for="">Enter Email Address</label>
				<input type="email" placeholder="Email Address" required class="form-control" name="user_email">
			</div><!-- business_email -->
			<button class="btn btn-primary" type="submit">Request new password</button>
		</form>
	<?php endif; ?>


	<?php
	/*Signup or register*/
	if ($_REQUEST['action'] == "load_register_module") :

	?>
		<form action="api/index.php" method="post" class="ajax-form">
			<h3 class="page-header">Create an account</h3>
			<hr>
			<span class="response"></span>
			<input type="hidden" name="action" value="register_module">
			<input type="hidden" name="user_role" value="manager">
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label for="">First Name</label>
						<input type="text" placeholder="First Name" required class="form-control" name="user_first_name" autocomplete="off">
					</div><!-- form-group -->

				</div><!-- col -->
				<div class="col-sm-6">
					<div class="form-group">
						<label for="">Last Name</label>
						<input type="text" placeholder="Last Name" class="form-control" name="user_last_name" autocomplete="off">
					</div><!-- form-group -->
				</div><!-- col -->
			</div><!-- row -->
			<div class="form-group">
				<label for="">Enter Email Address</label>
				<input type="email" placeholder="Email Address" required class="form-control" name="user_email" autocomplete="off">
			</div><!-- form-group -->
			<div class="form-group">
				<label for="">Password</label>
				<input type="password" placeholder="********" required class="form-control" name="user_password" autocomplete="off">
			</div><!-- form-group -->
			<div class="form-group hidden">
				<label for="">Business Name</label>
				<input type="text" placeholder="Business Name" class="form-control" name="user_business" autocomplete="off">
			</div><!-- group -->
			<div class="row hidden">
				<div class="col-sm-6">
					<div class="form-group">
						<label for="">Contact No. (optional)</label>
						<input type="text" placeholder="Contact No." class="form-control" name="user_phone" autocomplete="off">
					</div><!-- group -->
				</div><!-- col -->
				<div class="col-sm-6">
					<div class="form-group">
						<label for="">ABN No. (optional)</label>
						<input type="text" placeholder="ABN No." class="form-control" name="user_abn" autocomplete="off">
					</div><!-- group -->
				</div><!-- col -->
			</div><!-- row -->
			<button class="btn btn-primary" type="submit">Create an Account</button>
			<button class="btn btn-danger" data-dismiss="modal">Close</button>
		</form>
	<?php endif; ?>
	<?php
	/*Load Business Shift*/
	if ($_REQUEST['action'] == "load_user_business_shift") :

	?>
		<form action="api/index.php" method="post" class="ajax-form">
			<h3>Business List</h3>
			<input type="hidden" name="user_id" value="<?= @$_REQUEST['field'] ?>">
			<input type="hidden" name="action" value="user_business_shift">
			<span class="response"></span>
			<?php $getBusinesss = mysqli_query($dbc, "SELECT * FROM business WHERE (business_status='active' OR business_status='enable') AND user_id='$fetchUser[user_id]'");
			while ($fetchBusiness = mysqli_fetch_assoc($getBusinesss)) :
				$count = mysqli_num_rows(mysqli_query($dbc, "SELECT * FROM assign_business WHERE user_id='$_REQUEST[field]' AND business_id='$fetchBusiness[business_id]'"));
			?>
				<label style="width: 100%;display: block;">
					<div class="card card-body">
						<span><input type="checkbox" name="business_id[]" value="<?= $fetchBusiness['business_id'] ?>" <?php if ($count != 0) {
																															echo "checked";
																														} ?> /> <?= strtoupper($fetchBusiness['business_name']) ?></span>
						<span> Email: <a href="mailto:<?= strtolower($fetchBusiness['business_email']) ?>"><?= strtolower($fetchBusiness['business_email']) ?></a></span>
						<span> Phone: <a href="tel:<?= strtolower($fetchBusiness['business_phone']) ?>"><?= strtolower($fetchBusiness['business_phone']) ?></a>
						</span>
					</div><!-- checkbox -->
				</label>
			<?php endwhile; ?>
			<button class="btn btn-primary" type="submit">Submit</button>
		</form>
	<?php endif; ?>
	<?php
	/*Load Business Shift*/
	if ($_REQUEST['action'] == "load_user_roles") :

	?>
		<form action="api/index.php" method="post" class="ajax-form">
			<h3>User Role</h3>
			<input type="hidden" name="user_id" value="<?= @$_REQUEST['field'] ?>">
			<input type="hidden" name="action" value="assign_user_roles">
			<span class="response"></span>
			<?php $getUserRole = mysqli_query($dbc, "SELECT * FROM user_roles WHERE user_role_status='enable'");
			while ($fetchUserRole = mysqli_fetch_assoc($getUserRole)) :
				$user_role_name = strtolower($fetchUserRole['user_role_name']);
				$count = mysqli_num_rows(mysqli_query($dbc, "SELECT * FROM assign_user_role WHERE user_id='$_REQUEST[field]' AND lower(user_role)='$user_role_name'"));
				if ($getRoleAdmin == 0 and $user_role_name == 'administrator') {
					continue;
				}
			?>

				<label style="width: 100%;display: block;">
					<div class="card card-body">
						<span><input type="checkbox" name="role_list[]" value="<?= strtolower($fetchUserRole['user_role_name']) ?>" <?php if ($count != 0) {
																																		echo "checked";
																																	} ?> /> <?= strtoupper($fetchUserRole['user_role_name']) ?></span>

					</div><!-- checkbox -->
				</label>
			<?php endwhile; ?>
			<button class="btn btn-primary" type="submit">Submit</button>
		</form>
	<?php endif; ?>

	<?php
	/*Load Business Shift*/
	if ($_REQUEST['action'] == "load_staff_form") :
		@$fetchStaff = (!empty($_REQUEST['field'])) ? fetchRecord($dbc, "users", "user_id", $_REQUEST['field']) : "";
		@$fetchStaffExtra = (array) json_decode($fetchStaff['user_extra']);
		@$btn_value = (empty($fetchStaff)) ? "add" : "update";
	?>
		<ul class="nav nav-pills nav-fill">
			<li class="nav-item"><a class="nav-link active" href="#basic" data-toggle="tab">Basic Information</a></li>
		</ul>
		<hr>
		<div class="tab-content">
			<div class="tab-pane active" id="basic">
				<h4 class="page-header">Register Staff/Employee</h4>

				<form action="api/index.php" method="post" class="ajax-form-with-file" enctype="multipart/form-data">
					<hr>
					<span class="response"></span>
					<input type="hidden" name="action" value="register_staff_module">
					<input type="hidden" name="user_role" value="user">
					<input type="hidden" name="user_id" value="<?= @$fetchStaff['user_id'] ?>">
					<input type="hidden" name="operation" value="<?= @$btn_value ?>">
					<center>
						<?php if (!empty($fetchStaff['user_pic'])) : ?>
							<img src="img/staff/<?= $fetchStaff['user_pic'] ?>" class="img img-responsive center-block" width="70" height="70" alt="" id="aImgShow">
						<?php else : ?>
							<img src="img/default.png" class="img img-responsive center-block" width="120" height="120" alt="" id="aImgShow">
						<?php endif; ?>
						<div class="form-group">
							<input type="file" id="img" class="center-block" onchange="uploadImage(this)" data-target="#aImgShow" name="f">
							<p class="text-muted text-center" style="font-size: 11px">
								Only .png , .jpg , .gif and .jpeg files are allowed
							</p>
						</div><!-- group -->
					</center>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="">First Name</label>
								<input type="text" placeholder="First Name" required class="form-control" name="user_first_name" autocomplete="off" value="<?= @$fetchStaff['user_first_name'] ?>">
							</div><!-- form-group -->

						</div><!-- col -->
						<div class="col-sm-6">
							<div class="form-group">
								<label for="">Last Name</label>
								<input type="text" placeholder="Last Name" class="form-control" name="user_last_name" autocomplete="off" value="<?= @$fetchStaff['user_last_name'] ?>">
							</div><!-- form-group -->
						</div><!-- col -->
					</div><!-- row -->
					<div class="form-group">
						<label for="">Enter Email Address</label>
						<input type="email" placeholder="Email Address" required class="form-control" name="user_email" autocomplete="off" value="<?= @$fetchStaff['user_email'] ?>">
					</div><!-- form-group -->
					<div class="form-group">
						<label for="">Password</label>
						<input type="password" placeholder="********" required class="form-control" name="user_password" autocomplete="off" value="<?= @$fetchStaff['user_password'] ?>">
					</div><!-- form-group -->
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label for="">Phone No. (optional)</label>
								<input type="text" placeholder="Phone No." class="form-control" name="user_phone" autocomplete="off" value="<?= @$fetchStaff['user_phone'] ?>">
							</div><!-- group -->
						</div><!-- col -->

					</div><!-- row -->

					<?php if ($btn_value == "add") : ?>
						<div class="row">
							<div class="col-sm-12">
								<div class="" style="background: #17A2B8;padding: 10px;margin: 4px 0px;color: #fff;border: none;border-radius: 5px">
									<label>
										<input type="checkbox" name="send_email" value="yes"> <strong>Send invitation email</strong> <br>
										<small>
											This will send the staff member an email invitation to create their own account. Invited staff members can log in to view their schedules.
										</small>
									</label>
								</div>
							</div><!-- col -->
						</div><!-- row -->
					<?php endif; ?>
					<?php if ($btn_value == "update") : ?>
						<div class="row">
							<div class="col-sm-12">
								<div class="" style="background: #FFC107;padding: 10px;margin: 4px 0px;color: #fff;border: none;border-radius: 5px">
									<label>
										<input type="checkbox" name="send_password" value="yes"> <strong>Send password information</strong> <br>
										<small>
											This will send the staff member an email to update them for new password.
										</small>
									</label>
								</div>
							</div><!-- col -->
						</div><!-- row -->
					<?php endif; ?>
					<button class="btn btn-primary" type="submit">Submit</button>
				</form>
			</div><!-- basic -->

		</div><!-- tab content -->

	<?php endif; ?>
	<?php
	/*Load Employee Schedule*/
	if ($_REQUEST['action'] == "load_employee_schedule_view") :
		$business_id = base64_decode($_REQUEST['business_id']);
		$dated = $_REQUEST['dated'];
		$date_array = getStartAndEndDate(date('W', strtotime($dated)), date('Y', strtotime($dated)));
	?>
		<table class="table text-center table-bordered myTable table-condensed">
			<thead>
				<tr style="font-size:12px;">
					<th>Staff</th>
					<?php foreach (dateRange($date_array['start_date'], $date_array['end_date']) as $d) :
					?>
						<th>
							<?= date('l', strtotime($d)) ?> <br>
							<?= date('d-M-Y', strtotime($d)) ?>
						</th>
					<?php endforeach; ?>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php $getEmployee = mysqli_query($dbc, "SELECT * FROM assign_business WHERE business_id='$business_id'");
				while ($fetchEmployee = mysqli_fetch_assoc($getEmployee)) :
					if (countWhen($dbc, "users", "user_id", $fetchEmployee['user_id']) == 0) {
						continue;
					}
					$fetchEmployeeData = fetchRecord($dbc, "users", "user_id", $fetchEmployee['user_id']);
				?>
					<tr style="font-size: 12px;">
						<td style="font-size: 12px">
							<strong>Staff ID#: </strong> <?= $fetchEmployeeData['user_id'] ?>
							<br>
							<?= strtoupper($fetchEmployeeData['user_first_name']) ?> <?= strtoupper($fetchEmployeeData['user_last_name']) ?>
							<br>
							<a data-toggle="tooltip" title="<?= strtolower($fetchEmployeeData['user_email']) ?>" href="mailto:<?= strtolower($fetchEmployeeData['user_email']) ?>"><?= strtolower(substr($fetchEmployeeData['user_email'], 0, 12)) ?>...</a>
						</td>
						<form action="api/index.php" method="post" class="ajax-form">
							<input type="hidden" value="<?= $fetchEmployeeData['user_id'] ?>" name="emp_id">
							<input type="hidden" value="<?= $business_id ?>" name="business_id">
							<input type="hidden" name="action" value="employee_roaster">
							<?php $i = 0;
							foreach (dateRange($date_array['start_date'], $date_array['end_date']) as $d) :
								$dated = date('Y-m-d', strtotime($d));
								$query = mysqli_query($dbc, "SELECT * FROM roaster WHERE emp_id='$fetchEmployeeData[user_id]' AND business_id='$business_id' AND dated='$dated'");
								$count = mysqli_num_rows($query);
								if ($count == 0) {
									$fetchRoasterData = [];
								} else {
									$fetchRoasterData = mysqli_fetch_assoc($query);
									@$times = json_decode($fetchRoasterData['times']);
								}
							?>
								<td>
									<input type="hidden" value="<?= date('Y-m-d', strtotime($d)) ?>" name="days[]">
									<input type="hidden" value="<?= @$dated ?>" name="dated[]">
									<input style="border: none;border-bottom: 1px solid #eee" type="time" name="opening_time[]" value="<?= @$times->opening_time ?>"><br>
									<input style="border: none;border-bottom: 1px solid #eee" type="time" name="closing_time[]" value="<?= @$times->closing_time ?>">
								</td>
							<?php $i++;
							endforeach; ?>
							<td>
								<button class="btn btn-success btn-sm" type="submit"><span class="fa fa-floppy-o"></span></button>
							</td>
						</form>
					</tr>
				<?php endwhile; ?>
			</tbody>
		</table><!-- table -->
	<?php endif; ?>
	<?php
	/* User Billing Notification */
	if ($_REQUEST['action'] == "load_billing_form") :

	?>
		<form action="api/index.php" method="post" class="ajax-form">
			<?php
			$fetchSubscription = (!empty($_REQUEST['field'])) ? fetchRecord($dbc, "subscription", "id", $_REQUEST['field']) : "";
			$fetchUserData = fetchRecord($dbc, "users", "user_id", $fetchSubscription['user_id']);

			$body = 'Hello, ' . strtoupper($fetchUserData['user_first_name']) . "\nWe are sending reminder for the renewal of your account for attendezz.com\nYou account will be disabled or deactivate at " . date('d-M-Y', strtotime($fetchSubscription['end_date']));
			?>
			<span class="response"></span>
			<input type="hidden" name="id" value="<?= @$_REQUEST['field'] ?>">
			<input type="hidden" name="action" value="send_billing_notification">
			<input type="hidden" name="user_email" value="<?= $fetchUserData['user_email'] ?>">
			<input type="hidden" name="user_id" value="<?= $fetchUserData['user_id'] ?>">
			<div class="form-group">
				<label for="">Email Body</label>
				<textarea required name="email_body" placeholder="Email" class="form-control" cols="30" rows="10"><?= @$body ?></textarea>
			</div><!-- business_email -->
			<button class="btn btn-warning" type="submit"><span class="fa fa-bell"></span> Send Notification</button>
		</form>
	<?php endif; ?>

	<?php
	/* User Renewal Billing form */
	if ($_REQUEST['action'] == "load_renew_billing_form") :

	?>
		<form action="api/index.php" method="post" class="ajax-form">
			<?php
			$fetchSubscription = (!empty($_REQUEST['field'])) ? fetchRecord($dbc, "subscription", "id", $_REQUEST['field']) : "";
			$fetchUserData = fetchRecord($dbc, "users", "user_id", $fetchSubscription['user_id']);
			?>
			<span class="response"></span>
			<input type="hidden" name="id" value="<?= @$_REQUEST['field'] ?>">
			<input type="hidden" name="action" value="renew_subscription">
			<input type="hidden" name="user_email" value="<?= $fetchUserData['user_email'] ?>">
			<input type="hidden" name="user_id" value="<?= $fetchUserData['user_id'] ?>">
			<div class="form-group">
				<label for="">Start Date</label>
				<input type="text" name="start_date" class="form-control dateField" autocomplete="off" placeholder="Started Date" required value="<?= $fetchSubscription['start_date'] ?>">
			</div><!-- start_date -->
			<div class="form-group">
				<label for="">End Date</label>
				<input type="text" name="end_date" class="form-control dateField" autocomplete="off" placeholder="Expiry Date" required value="<?= $fetchSubscription['end_date'] ?>">
			</div><!-- end_date -->
			<div class="row">
				<div class="col-sm-12">
					<div class="" style="background: #17A2B8;padding: 10px;margin: 4px 0px;color: #fff;border: none;border-radius: 5px">
						<label>
							<input type="checkbox" name="send_email" value="yes"> <strong>Send email</strong> <br>
							<small>
								This will send the staff member an email notification for their renewal subscription.
							</small>
						</label>
					</div>
				</div><!-- col -->
			</div><!-- row -->
			<button class="btn btn-primary" type="submit"><span class="fa fa-refresh"></span> Renew Subscription</button>
		</form>
		<script>
			$(".dateField").datepicker({
				changeMonth: true,
				changeYear: true,
				yearRange: '1945:' + (new Date).getFullYear(),
				dateFormat: 'dd-M-yy',
				showWeek: true,
				firstDay: 1

			});
		</script>
	<?php endif; ?>
	<?php
	/* User Billing Cancel */
	if ($_REQUEST['action'] == "load_cancel_billing_form") :

	?>
		<form action="api/index.php" method="post" class="ajax-form">
			<?php
			$fetchSubscription = (!empty($_REQUEST['field'])) ? fetchRecord($dbc, "subscription", "id", $_REQUEST['field']) : "";
			$fetchUserData = fetchRecord($dbc, "users", "user_id", $fetchSubscription['user_id']);
			?>
			<span class="response"></span>
			<input type="hidden" name="id" value="<?= @$_REQUEST['field'] ?>">
			<input type="hidden" name="action" value="cancel_billing">
			<input type="hidden" name="user_email" value="<?= $fetchUserData['user_email'] ?>">
			<input type="hidden" name="user_id" value="<?= $fetchUserData['user_id'] ?>">
			<div class="form-group">
				<label for="">Describe Reason</label>
				<textarea required name="reason" placeholder="Describe the reason to cancel" class="form-control" cols="30" rows="5"></textarea>
			</div><!-- business_email -->
			<button class="btn btn-danger" type="submit"><span class="fa fa-remove"></span> Cancel Subscription</button>
		</form>
	<?php endif; ?>

	<?php
	/* Load Leave Management */
	if ($_REQUEST['action'] == "load_leave_management") :
		@$from = date('Y-m-d', strtotime($_REQUEST['from_date']));
		@$to = date('Y-m-d', strtotime($_REQUEST['to_date']));
		@$emp_id = $_REQUEST['emp_id'];
		@include_once 'code.php';
	?>
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Staff</th>
						<th>Dated</th>
						<th>Status</th>
						<th>Description</th>
						<th>Action</th>

					</tr>
				</thead>
				<tbody>
					<?php if (!empty($_REQUEST['emp_id'])) {
						$getLeave = mysqli_query($dbc, "SELECT * FROM emp_attendance WHERE emp_id='$emp_id' AND (att_date BETWEEN '$from' AND '$to') AND status='leave' ORDER BY att_date DESC");
					} else {
						$getLeave = mysqli_query($dbc, "SELECT * FROM emp_attendance WHERE (att_date BETWEEN '$from' AND '$to') AND status='leave' ORDER BY att_date DESC");
					}
					while ($fetchLeave = mysqli_fetch_assoc($getLeave)) :
						$fetchEmployeeData = fetchRecord($dbc, "users", "user_id", $fetchLeave['emp_id']);
					?>
						<tr>
							<td><?= $fetchLeave['att_id'] ?></td>
							<td style="font-size: 12px">
								<strong>Staff ID#: </strong> <?= $fetchEmployeeData['user_id'] ?>
								<br>
								<?= strtoupper($fetchEmployeeData['user_first_name']) ?> <?= strtoupper($fetchEmployeeData['user_last_name']) ?>
								<br>
								<a data-toggle="tooltip" title="<?= strtolower($fetchEmployeeData['user_email']) ?>" href="mailto:<?= strtolower($fetchEmployeeData['user_email']) ?>"><?= strtolower(substr($fetchEmployeeData['user_email'], 0, 12)) ?>...</a>
							</td>
							<td><?= date('D, d-M-Y', strtotime($fetchLeave['att_date'])) ?></td>
							<td><?= $fetchLeave['status'] ?></td>
							<td><?= $fetchLeave['description'] ?></td>
							<td>
								<a href="#" onclick="deleteData('emp_attendance','att_id',<?= $fetchLeave['att_id'] ?>,'#',this)" class="text-danger">Delete</a>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	<?php endif; ?>

	<?php if ($_REQUEST['action'] == "load_add_time_off_form") :
		$business_id = $_REQUEST['field'];
		$time_off_type = ['public holiday', 'vacation', 'loa', 'maternity', 'personal', 'rdo', 'sick leave', 'study leave', 'training', 'unavailable', 'al', 'absent'];

	?>
		<h4>Add Time Off</h4>

		<form method="post" action="api/index.php" class="ajax-form">
			<span class="response"></span>
			<input type="hidden" name="action" value="add_time_off">
			<input type="hidden" name="business_id" value="<?= $business_id ?>">
			<div class="form-group">
				<label for="">Staff Members:</label>
				<select required name="emp_id" id="" class="form-control">
					<?php
					$getEmployee = mysqli_query($dbc, "SELECT * FROM assign_business WHERE business_id='$business_id'");
					while ($fetchEmployee = mysqli_fetch_assoc($getEmployee)) :
						if (countWhen($dbc, "users", "user_id", $fetchEmployee['user_id']) == 0) {
							continue;
						}
						$fetchEmployeeData = fetchRecord($dbc, "users", "user_id", $fetchEmployee['user_id']);
						if ($fetchEmployeeData['user_status'] == "disabled") {
							continue;
						}
					?>
						<option value="<?= @$fetchEmployeeData['user_id'] ?>"> <?= strtoupper($fetchEmployeeData['user_first_name']) ?> <?= strtoupper($fetchEmployeeData['user_last_name']) ?></option>
					<?php endwhile; ?>
				</select>
			</div><!-- group -->
			<div class="form-group">
				<label for="">Type of Time Off:</label>
				<select required name="reason" id="" class="form-control">
					<?php foreach ($time_off_type as $time_off) : ?>
						<option value="<?= $time_off ?>"><?= strtoupper($time_off) ?></option>
					<?php endforeach; ?>
				</select>
			</div><!-- group -->

			<div class="form-group">
				<label for="">Note</label>
				<textarea name="note" id="" cols="30" rows="2" class="form-control"></textarea>
			</div><!-- group -->
			<div class="form-group">
				<label for="">First Day off:</label>
				<input required type="text" class="form-control" name="from" placeholder="First Day off" id="from">
			</div><!-- group -->
			<div class="form-group">
				<label for="">Last Day off:</label>
				<input required type="text" class="form-control" name="to" placeholder="Last Day off" id="to">
			</div><!-- group -->
			<div class="form-group">
				<button type="submit" name="save_time_off" class="btn btn-success">Submit</button>
			</div><!-- group -->

		</form>
	<?php endif; ?>
	<?php if ($_REQUEST['action'] == "load_view_time_off_form") :
		@$att_id = $_REQUEST['field'];
		$fetchTimeOff = fetchRecord($dbc, "emp_attendance", "att_id", $_REQUEST['field']);
	?>
		<h4>View Time Off</h4>
		<div class="well">
			<strong>Dated: </strong> <?= date('l, d-M-Y', strtotime($fetchTimeOff['att_date'])) ?> <br>
			<strong>Note: </strong> <?= @nl2br($fetchTimeOff['description']) ?> <br>
			<strong>Reason: </strong> <?= @strtoupper($fetchTimeOff['reason']) ?> <br>
		</div>
	<?php endif; ?>

<?php endif;  /*action not empty*/ ?>

<?php
/*Load Business Shift*/
if ($_REQUEST['action'] == "load_screen_shots") :
	$labels = ['end_shift' => "checked out", "start_shift" => "checked in", "no_shift" => "already marked"];
	$class = ['end_shift' => "danger", "start_shift" => "success", "no_shift" => "warning"];
	$table = $_REQUEST['table'];
	$emp_id = $_REQUEST['emp_id'];
	$business_id = $_REQUEST['business_id'];
	$dated = $_REQUEST['dated'];
	@$getDistinctTracking = (mysqli_query($dbc, "SELECT DISTINCT(shift) FROM tracking WHERE dated='$dated' AND  user_id='$emp_id' AND business_id='$business_id'"));
	while ($fetchDistinct = mysqli_fetch_assoc($getDistinctTracking)) :
		$shift = $fetchDistinct['shift'];

		echo "<h2>" . strtoupper($labels[$fetchDistinct['shift']]) . "</h2><hr>";
		@$getTracking = (mysqli_query($dbc, "SELECT * FROM tracking WHERE dated='$dated' AND  user_id='$emp_id' AND business_id='$business_id' AND shift='$shift'"));
		while ($fetchTracking = mysqli_fetch_assoc($getTracking)) :
?>

			<a href="img/uploads/<?= $fetchTracking['pic_name'] ?>" target="_blank">
				<img hspace="10" src="img/uploads/<?= $fetchTracking['pic_name'] ?>" class="img img-responsive pull-left img-thumbnail" width="200" height="200" alt="">
			</a>

		<?php endwhile; ?>
		<br>
	<?php endwhile; ?>
<?php endif; ?>

<?php
/********Summary Form*********/
if ($_REQUEST['action'] == "load_summary_form") :
	@$fetchExecutiveSummary = (!empty($_REQUEST['field'])) ? fetchRecord($dbc, "executive_summary", 'id', $_REQUEST['field']) : "";
	@$btn_value = (empty($fetchExecutiveSummary)) ? "Add" : "Update";
?>
	<div class="bg-dar w-100 text-center p-2 mt-5 ">
		<h1 class=''>(1.1) Executive Summary</h1>
	</div>
	<form action="api/index.php" method="post" class="ajax-form" style='box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;padding:2%' id=''>
		<input type="hidden" name="action" value="executive_summary">
		<input type="hidden" name="id" value="<?= @$fetchExecutiveSummary['id'] ?>">
		<div class="form-group">
			<label for="email">Summary</label>
			<br>
			<textarea name="summary" class="form-control smsMessage" placeholder="Enter Your Message" id="" cols="30" rows="3"><?= @$fetchExecutiveSummary['summary'] ?></textarea>
		</div>

		<!-- Row -->
		<div class='row'>
			<button type="submit" class="btn btn-primary ml-2 "><?= $btn_value ?></button>
		</div>
	</form>
	</div>
<?php endif;
/******** Research interests Form *********/
if ($_REQUEST['action'] == "load_research_interests_form") :
	@$fetchresearchinterests = (!empty($_REQUEST['field'])) ? fetchRecord($dbc, "research_interests", 'id', $_REQUEST['field']) : "";
	@$btn_value = (empty($fetchresearchinterests)) ? "Add" : "Update";
?>
	<div class="bg-dar w-100 text-center p-2 mt-5 ">
		<h2>(1.2)1 Research interests</h2>
	</div>
	<form action="api/index.php" method="post" class="ajax-form" style='box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;padding:2%' id=''>
		<input type="hidden" name="action" value="research_interests">
		<input type="hidden" name="id" value="<?= @$fetchresearchinterests['id'] ?>">
		<div class="form-group">
			<label for="email">Research interests</label>
			<br>
			<textarea name="research_interests" class="form-control smsMessage" placeholder="Enter Your Message" id="" cols="30" rows="3"><?= @$fetchresearchinterests['research_interests'] ?></textarea>
		</div>

		<!-- Row -->
		<div class='row'>
			<button type="submit" class="btn btn-primary ml-2 "><?= $btn_value ?></button>
		</div>
	</form>
	</div>
<?php endif;
/******** Personal Mission *********/
if ($_REQUEST['action'] == "load_mission_form") :
	@$fetchresearchinterests = (!empty($_REQUEST['field'])) ? fetchRecord($dbc, "personal_mission", 'id', $_REQUEST['field']) : "";
	@$btn_value = (empty($fetchresearchinterests)) ? "Add" : "Update";
?>
	<div class="bg-dar w-100 text-center p-2 mt-5 ">
		<h2>(2) Personal Mission</h2>
	</div>
	<form action="api/index.php" method="post" class="ajax-form" style='box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;padding:2%' id=''>
		<input type="hidden" name="action" value="personal_mission">
		<input type="hidden" name="id" value="<?= @$fetchresearchinterests['id'] ?>">
		<div class="form-group">
			<textarea name="personal_mission_text" class="form-control smsMessage" placeholder="Enter Your Message" id="" cols="30" rows="3"><?= @$fetchresearchinterests['summary'] ?></textarea>
		</div>
		<!-- Row -->
		<div class='row'>
			<button type="submit" class="btn btn-primary ml-2 "><?= $btn_value ?></button>
		</div>
	</form>
	</div>
<?php endif;
/******** Personal Mission *********/
if ($_REQUEST['action'] == "statement_teaching_form") :
	@$fetchresearchinterests = (!empty($_REQUEST['field'])) ? fetchRecord($dbc, "statement_teaching", 'id', $_REQUEST['field']) : "";
	@$btn_value = (empty($fetchresearchinterests)) ? "Add" : "Update";
?>
	<div class="bg-dar w-100 text-center p-2 mt-5 ">
		<h2>(2) Personal Mission</h2>
	</div>
	<form action="api/index.php" method="post" class="ajax-form" style='box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;padding:2%' id='' method="dialog">
		<input type="hidden" name="action" value="statement_teaching">
		<input type="hidden" name="id" value="<?= @$fetchresearchinterests['id'] ?>">
		<div class="form-group">
			<textarea name="statement_teaching_text" class="form-control smsMessage" placeholder="Enter Your Message" id="" cols="30" rows="3"><?= @$fetchresearchinterests['statement_teaching_text'] ?></textarea>
		</div>
		<!-- Row -->
		<div class='row'>
			<button type="submit" class="btn btn-primary ml-2 "><?= $btn_value ?></button>
		</div>
	</form>
	</div>
<?php endif;

?>
<script>
	/*Date Picker*/
	var dateFormat = "dd-M-yy",
		from = $("#from,.from")
		.datepicker({
			defaultDate: "1w",
			changeMonth: true,
			numberOfMonths: 1
		})
		.on("change", function() {
			to.datepicker("option", "minDate", getDate(this));
		}),
		to = $("#to,.to").datepicker({
			defaultDate: "1w",
			changeMonth: true,
			numberOfMonths: 1
		})
		.on("change", function() {
			from.datepicker("option", "maxDate", getDate(this));
		});

	$(function() {
		//simple dates
		$(".dateField").datepicker({
			changeMonth: true,
			changeYear: true,
			yearRange: '1945:' + (new Date).getFullYear(),
			dateFormat: 'dd-M-yy',
			showWeek: true,
			firstDay: 1

		});

		$(".monthDateField").datepicker({
			changeMonth: true,
			changeYear: true,
			yearRange: '1945:' + (new Date).getFullYear(),
			dateFormat: 'yy-mm'
		});
	})
</script>