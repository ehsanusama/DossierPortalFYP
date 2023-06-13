<?php $business_id = base64_decode($_REQUEST['business']);
$fetchBusinessData = fetchRecord($dbc, "business", "business_id", $business_id);
$show_date = (empty($_REQUEST['dated'])) ? date('d-M-Y') : $_REQUEST['dated'];
?>
<style>
	table tr:nth-child(2) th,
	td {
		background: #202020;
		color: #fff;
		border-color: #202020 !important;
		text-align: center;
		align-content: center;
	}

	@media print {

		table tr:nth-child(2) th,
		td {
			background: #fff;
			color: #000;
			border-color: #eee !important;
		}

	}

	table th {
		text-align: center !important;
	}

	.fadeTr:hover {
		opacity: 1 !important;
	}

	.attendance_delete_btn {
		width: 50px;
		height: 20px;
		font-size: 9px;
		margin-left: 5px;
	}
</style>
<div class="portlet light">
	<h2 class="hidden-print">Manual Attendance</h2>
	<a href="#" id="download_link"></a>

	<form action="" method="post" class="hidden-print">
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<label for="">Employee Name</label>
				<select name="emp_id" id="" class="form-control select2">
					<?php 
					$getEmployee=mysqli_query($dbc,"SELECT * FROM assign_business WHERE business_id='$business_id'");
					while($fetchEmployee=mysqli_fetch_assoc($getEmployee)):
						if(countWhen($dbc,"users","user_id",$fetchEmployee['user_id'])==0){
							continue;
						}
						$fetchEmployeeData=fetchRecord($dbc,"users","user_id",$fetchEmployee['user_id']);
						if($fetchEmployeeData['user_status']!="enable"){
							continue;
						}
					 ?>
					 <option <?php if(!empty($_REQUEST['emp_id']) AND $_REQUEST['emp_id']==$fetchEmployee['user_id']){echo "selected";} ?> value="<?=@$fetchEmployeeData['user_id']?>"><?=strtoupper($fetchEmployeeData['user_first_name'])?> <?=strtoupper($fetchEmployeeData['user_last_name'])?></option>
					<?php endwhile; ?>
				</select>
			</div><!-- group -->
		</div><!-- col -->
		<div class="col-sm-6">
			<div class="form-group">
				<label for="">Select Month</label>
				<input type="month" readonly autocomplete="off" class="form-control monthDateField"  name="dated" placeholder="Month" value="<?=@$show_date?>">
			</div><!-- group -->
		</div><!-- col -->
		<div class="col-sm-12">
			<div class="form-group">
				<button class="btn btn-success" type="submit" name="report_btn">Submit</button>
			</div><!-- form-group -->
		</div>
	</div><!-- row -->
</form>
	<?php if (isset($_REQUEST['report_btn'])) :
		$date_array = getStartAndEndDate(date('W', strtotime($_REQUEST['dated'])), date('Y', strtotime($_REQUEST['dated'])));
		$date_month = date('m', strtotime($_REQUEST['dated']));
		$date_year = date('Y', strtotime($_REQUEST['dated']));
		$date_total_days = date('t', strtotime($_REQUEST['dated']));
		$fetchEmployeeData = fetchRecord($dbc, "users", "user_id", $_REQUEST['emp_id']);
		if (!empty($fetchEmployeeData['user_pic'])) {
			$pic = $fetchEmployeeData['user_pic'];
		} else {
			$pic = "default.png";
		}


	?>
		<span id="photo" style="padding: 15px">
			<div class="portlet-body" style="padding: 15px">
				<div class="row">
					<div class="col-sm-6">
						<a style="color: black" href="#modal-id" data-toggle="modal" title="load_staff_form|user_id|<?= @$fetchEmployeeData['user_id'] ?>" class="modal-action">
							<img src="img/staff/<?= $pic ?>" class="img img-responsive img-circle" width="80" height="80" align="left" hspace="10">
							<strong>ID#: <?= strtoupper($fetchEmployeeData['user_id']) ?> </strong> <br>
							<strong><?= strtoupper($fetchEmployeeData['user_first_name']) ?> <?= strtoupper($fetchEmployeeData['user_last_name']) ?></strong> <br>

							<strong>Designation: </strong><?= $fetchEmployeeData['designation'] ?> <br>
							<strong>Email: </strong><a href="mailto:<?= $fetchEmployeeData['user_email'] ?>"><?= $fetchEmployeeData['user_email'] ?></a><br><br>
						</a>
					</div><!-- col -->
					<div class="col-sm-6">
						<h3><?= date('F-Y', strtotime($_REQUEST['dated'])) ?></h3>
					</div><!-- col -->


				</div><!-- row -->
				<div class="table-responsive panel panel-default panel-body">
					<table class="table table-bordered table-condensed myTable" style="font-size: 12px">
						<?php $i = 0;
						$grand_totalHrs = 0;
						for ($j = 1; $j <= $date_total_days; $j++) :
							$d = $date_year . "-" . $date_month . "-" . $j;
							$dated = date('Y-m-d', strtotime($d));
							$fetchEmployeeData = fetchRecord($dbc, "users", "user_id", $_REQUEST['emp_id']);
							$getTimeOff = mysqli_query($dbc, "SELECT * FROM emp_attendance WHERE emp_id='$_REQUEST[emp_id]' AND business_id='$business_id' AND att_date='$dated' AND status='leave'");
							if (mysqli_num_rows($getTimeOff) >= 1) {
								$fetchTimeOff = mysqli_fetch_assoc($getTimeOff);
							}
							$day = date('l', strtotime($d));
							@$getStartShift = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM emp_attendance WHERE att_date='$dated' AND shift='start_shift' AND emp_id='$_REQUEST[emp_id]' AND business_id='$business_id'"));
							@$getEndShift = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM emp_attendance WHERE att_date='$dated' AND shift='end_shift' AND emp_id='$_REQUEST[emp_id]' AND business_id='$business_id'"));
							@$getStartBreak = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM emp_attendance WHERE att_date='$dated' AND shift='start_break' AND emp_id='$_REQUEST[emp_id]' AND business_id='$business_id'"));
							@$getEndBreak = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM emp_attendance WHERE att_date='$dated' AND shift='end_break' AND emp_id='$_REQUEST[emp_id]' AND business_id='$business_id'"));
							@$getDeviceStart = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM emp_attendance WHERE att_date='$dated' AND  emp_id='$_REQUEST[emp_id]' AND business_id='$business_id' AND shift='start_shift'"));
							@$getDeviceEnd = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM emp_attendance WHERE att_date='$dated' AND  emp_id='$_REQUEST[emp_id]' AND business_id='$business_id' AND shift='end_shift'"));
							@$getTracking = (mysqli_query($dbc, "SELECT * FROM tracking WHERE dated='$dated' AND  user_id='$_REQUEST[emp_id]' AND business_id='$business_id'"));
							$hour_shift = $hour_break = '';
							$icons = [
								'card_scan' => "id-card",
								"phone_scan" => "mobile",
								'manual' => 'pencil',
							];
							if (!empty($getStartShift['att_time']) and !empty($getEndShift['att_time'])) {
								$hour_shift = number_format(differenceInHours($getStartShift['att_time'], $getEndShift['att_time']), 2);
							}
							if (!empty($getStartBreak['att_time']) and !empty($getEndBreak['att_time'])) {
								$hour_break = number_format(differenceInHours($getStartBreak['att_time'], $getEndBreak['att_time']), 2);
							}

						?>
							<?php if ($i == 0) : ?>
								<tr>
									<th colspan="7" style="font-size: 14px">
										<?= strtoupper($fetchEmployeeData['user_first_name']) ?> <?= strtoupper($fetchEmployeeData['user_last_name']) ?> <i>ordinary hours: ________hours ________ minutes per week / fortnight / other __________
											(circle appropriate option and insert information if required)</i>
									</th>
									<!-- <th colspan="5" class="text-center hidd" style="font-size: 14px">Overtime</th> -->
									<!-- <th colspan="2" class="text-center hidd" style="font-size: 14px">Leave</th> -->
								</tr>
								<tr class="text-center">
									<th>Days</th>
									<th width="12%">Start/CheckIn time</th>
									<th width="12%">Break Start</th>
									<th width="12%">Break End</th>
									<th width="12%">End/CheckOut Time</th>
									<th width="12%">Total Break Time</th>
									<th width="12%">Total (Hours minus unpaid breaks)</th>
									<!-- <th width="12%">Start time (e.g. 8:30am)</th> 
						<th width="12%">Start time of unpaid break (e.g. 12:30pm)</th>
						<th width="12%">Restart time (e.g. 1:30pm)</th>
						<th width="12%">Finish time (e.g. 5:00pm)</th>
						<th width="12%">Total (Hours minus unpaid breaks)</th>
						<th width="12%">Type (e.g. personal leave, etc.)</th>
						<th width="12%">Hours (hours minus unpaid breaks)</th> -->
								</tr>
							<?php endif;
							if (date('d-M-Y', strtotime($d)) == date('d-M-Y')) {
								$opacity = "1";
							} else {
								$opacity = "0.4";
							}
							?>
							<tr align="center" class="fadeTr" style="opacity: <?= $opacity ?>;text-align:center">
								<th><?= $day ?><br><i style="font-size: 11px"><?= date('d-M-Y', strtotime($d)) ?></i>
									<?php if (mysqli_num_rows($getTracking) > 0) : ?> <br>
										<a href="#modal-id" data-toggle="modal" class="hidden-print showScreenShots" href="#" title='load_screen_shots|tracking|<?= $_REQUEST['emp_id'] ?>|<?= $business_id ?>|<?= $dated ?>'>See Images</a>
									<?php endif; ?>
								</th>
								<?php if (!empty($fetchTimeOff) and mysqli_num_rows($getTimeOff) >= 1) : ?>
									<th colspan="13" class="text-center bg-warning">
										Time Off <br>
										Reason: <?= @strtoupper($fetchTimeOff['reason']) ?>
									</th>
								<?php else : ?>
									<th>
										<?php if (!empty($getStartShift['att_time'])) : ?>
											<input type="time" value="<?= date('H:i', strtotime($getStartShift['att_time'])) ?>" class="mark_manual_attendance" title="update|<?= @$getStartShift['att_id'] ?>|<?= $business_id ?>|<?= $fetchEmployeeData['user_id'] ?>|<?= $dated ?>|start_shift|<?= @$fetchUser['user_id'] ?>">
											<button title="<?= @$getStartShift['att_id'] ?>" class="btn btn-danger btn-xs mt-2 attendance_delete_btn">Remove</button>
										<?php else : ?>
											<input type="time" class="mark_manual_attendance" title="add|<?= @$getStartShift['att_id'] ?>|<?= $business_id ?>|<?= $fetchEmployeeData['user_id'] ?>|<?= $dated ?>|start_shift|<?= @$fetchUser['user_id'] ?>">
										<?php endif; ?>

										<?php echo "<br><span class='fa fa-" . $icons[$getDeviceStart['device']] . "'></span>"; ?>


									</th>
									<th>
										<?php if (!empty($getStartBreak['att_time'])) : ?>
											<input type="time" value="<?= date('H:i', strtotime($getStartBreak['att_time'])) ?>" class="mark_manual_attendance" title="update|<?= @$getStartBreak['att_id'] ?>|<?= $business_id ?>|<?= $fetchEmployeeData['user_id'] ?>|<?= $dated ?>|start_break|<?= @$fetchUser['user_id'] ?>">
											<button title="<?= @$getStartBreak['att_id'] ?>" class="btn btn-danger btn-xs mt-2 attendance_delete_btn">Remove</button>
										<?php else : ?>
											<input type="time" class="mark_manual_attendance" title="add|<?= @$getStartBreak['att_id'] ?>|<?= $business_id ?>|<?= $fetchEmployeeData['user_id'] ?>|<?= $dated ?>|start_break|<?= @$fetchUser['user_id'] ?>">
										<?php endif; ?>

									</th>
									<th>
										<?php if (!empty($getEndBreak['att_time'])) : ?>
											<input type="time" value="<?= date('H:i', strtotime($getEndBreak['att_time'])) ?>" class="mark_manual_attendance" title="update|<?= @$getEndBreak['att_id'] ?>|<?= $business_id ?>|<?= $fetchEmployeeData['user_id'] ?>|<?= $dated ?>|end_break|<?= @$fetchUser['user_id'] ?>">
											<button title="<?= @$getEndBreak['att_id'] ?>" class="btn btn-danger btn-xs mt-2 attendance_delete_btn">Remove</button>
										<?php else : ?>
											<input type="time" class="mark_manual_attendance" title="add|<?= @$getEndBreak['att_id'] ?>|<?= $business_id ?>|<?= $fetchEmployeeData['user_id'] ?>|<?= $dated ?>|end_break|<?= @$fetchUser['user_id'] ?>">
										<?php endif; ?>


									<th>
										<?php if (!empty($getEndShift['att_time'])) : ?>
											<input type="time" value="<?= date('H:i', strtotime($getEndShift['att_time'])) ?>" class="mark_manual_attendance" title="update|<?= @$getEndShift['att_id'] ?>|<?= $business_id ?>|<?= $fetchEmployeeData['user_id'] ?>|<?= $dated ?>|end_shift|<?= @$fetchUser['user_id'] ?>">
											<button title="<?= @$getEndShift['att_id'] ?>" class="btn btn-danger btn-xs mt-2 attendance_delete_btn">Remove</button>
										<?php else : ?>
											<input type="time" class="mark_manual_attendance" title="add|<?= @$getEndShift['att_id'] ?>|<?= @$business_id ?>|<?= @$fetchEmployeeData['user_id'] ?>|<?= @$dated ?>|end_shift|<?= @$fetchUser['user_id'] ?>">
										<?php endif; ?>

										<?php echo "<br><span class='fa fa-" . @$icons[$getDeviceEnd['device']] . "'></span>"; ?>

									</th>

									<th>
										<?php if (!empty($hour_break)) {
											echo $hour_break . " hr(s)";
										} else {
											echo "-";
										} ?>
									</th>
									<th><?php

										if (!empty($getStartShift['att_time']) and !empty($getEndShift['att_time']) or (!empty($getStartBreak['att_time']) and !empty($getEndBreak['att_time']))) {
											@$totalHrs = ($hour_shift - $hour_break);
											if ($totalHrs < 0) {
												echo "Not Checked In/Checked out";
											} else {
												$grand_totalHrs = $grand_totalHrs + ($hour_shift - $hour_break);
												echo @($hour_shift - $hour_break) . " hr(s)";
											}
										}
										?>

									</th>
									<!-- <th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th> -->
								<?php endif; ?>
							</tr>
						<?php $i++;
						endfor; ?>
						<tr>
							<th colspan="6" class="text-right" align="right">Total Hour(s)</th>
							<td><?= $grand_totalHrs ?> hr(s)</td>
						</tr>

					</table>
				</div>
			</div>
		</span>
</div>
<?php endif; ?>