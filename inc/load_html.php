<?php
include_once 'functions.php';
if (!empty($_REQUEST['action'])) : ?>
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
	/******** Personal Mission *********/
	if ($_REQUEST['action'] == "research_profile_form") :
		@$fetchResearchProfile = (!empty($_REQUEST['field'])) ? fetchRecord($dbc, "research_profile", 'id', $_REQUEST['field']) : "";
		@$btn_value = (empty($fetchResearchProfile)) ? "Add" : "Update";
	?>
		<div class='portlet light'>
			<form action="api/index.php" method="post" class="ajax-form" style='box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;padding:2%' id='' method="dialog">
				<input type="hidden" name="action" value="research_profile">
				<input type="hidden" name="id" value="<?= @$fetchResearchProfile['id'] ?>">
				<label for="">(6) Research Profile</label>
				<div class="form-group">
					<textarea name="summary" class="form-control smsMessage" placeholder="Enter Your summary" id="" cols="30" rows="3"><?= @$fetchResearchProfile['summary'] ?></textarea>
				</div>
				<label for="">(6.1) Research statement</label>
				<div class="form-group">
					<textarea name="statement" class="form-control smsMessage" placeholder="Enter Your statement" id="" cols="30" rows="3"><?= @$fetchResearchProfile['statement'] ?></textarea>
				</div>
				<!-- Row -->
				<div class='row'>
					<button type="submit" class="btn btn-primary ml-2 "><?= $btn_value ?></button>
				</div>
			</form>
		</div>
	<?php endif;

	/******** Personal Mission *********/
	if ($_REQUEST['action'] == "initiatives_taken_form") :
		@$fetchResearchProfile = (!empty($_REQUEST['field'])) ? fetchRecord($dbc, "initiatives_taken", 'id', $_REQUEST['field']) : "";
		@$btn_value = (empty($fetchResearchProfile)) ? "Add" : "Update";
	?>
		<div class='portlet light'>
			<form action="api/index.php" method="post" class="ajax-form" style='box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;padding:2%' id='' method="dialog">
				<input type="hidden" name="action" value="initiatives_taken">
				<input type="hidden" name="id" value="<?= @$fetchResearchProfile['id'] ?>">
				<label for="">(7.2) Initiatives Taken </label>
				<div class="form-group">
					<textarea name="summary" class="form-control smsMessage" placeholder="Enter Your summary" id="" cols="30" rows="3"><?= @$fetchResearchProfile['summary'] ?></textarea>
				</div>

				<!-- Row -->
				<div class='row'>
					<button type="submit" class="btn btn-primary ml-2 "><?= $btn_value ?></button>
				</div>
			</form>
		</div>
	<?php endif;
	/******** Personal Mission *********/
	if ($_REQUEST['action'] == "member_conference_form") :
		@$fetchResearchProfile = (!empty($_REQUEST['field'])) ? fetchRecord($dbc, "member_conference", 'id', $_REQUEST['field']) : "";
		@$btn_value = (empty($fetchResearchProfile)) ? "Add" : "Update";
	?>
		<div class='portlet light'>
			<form action="api/index.php" method="post" class="ajax-form" style='box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;padding:2%' id='' method="dialog">
				<input type="hidden" name="action" value="member_conference">
				<input type="hidden" name="id" value="<?= @$fetchResearchProfile['id'] ?>">
				<label for="">(7.4) Member technical committee of international conference </label>
				<div class="form-group">
					<textarea name="summary" class="form-control smsMessage" placeholder="Enter Your summary" id="" cols="30" rows="3"><?= @$fetchResearchProfile['summary'] ?></textarea>
				</div>

				<!-- Row -->
				<div class='row'>
					<button type="submit" class="btn btn-primary ml-2 "><?= $btn_value ?></button>
				</div>
			</form>
		</div>
	<?php endif;
	/******** Personal Mission *********/
	if ($_REQUEST['action'] == "professional_training_form") :
		@$fetchResearchProfile = (!empty($_REQUEST['field'])) ? fetchRecord($dbc, "professional_training", 'id', $_REQUEST['field']) : "";
		@$btn_value = (empty($fetchResearchProfile)) ? "Add" : "Update";
	?>
		<div class='portlet light'>
			<form action="api/index.php" method="post" class="ajax-form" style='box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;padding:2%' id='' method="dialog">
				<input type="hidden" name="action" value="professional_training">
				<input type="hidden" name="id" value="<?= @$fetchResearchProfile['id'] ?>">
				<label for="">(7.6) Professional trainings Conducted for Industry </label>
				<div class="form-group">
					<textarea name="summary" class="form-control smsMessage" placeholder="Enter Your summary" id="" cols="30" rows="3"><?= @$fetchResearchProfile['summary'] ?></textarea>
				</div>

				<!-- Row -->
				<div class='row'>
					<button type="submit" class="btn btn-primary ml-2 "><?= $btn_value ?></button>
				</div>
			</form>
		</div>
<?php endif;
endif;
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