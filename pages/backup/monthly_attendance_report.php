<?php $business_id = base64_decode($_REQUEST['business']);
$fetchBusinessData = fetchRecord($dbc, "business", "business_id", $business_id);
$show_date = (empty($_REQUEST['dated'])) ? date('d-M-Y') : $_REQUEST['dated'];
$icons = [
	'card_scan' => "id-card",
	'manual' => 'pencil',
	"phone_scan" => "mobile",
];
?>
<style>
	.report_table tr:nth-child(2) .report_table th,
	.report_table td {
		background: #202020;
		color: #fff;
		border-color: #202020 !important;
	}

	@media print {

		.report_table tr:nth-child(2) th,
		td {
			background: #fff;
			color: #000;
			border-color: #eee !important;
		}

		*,
		body {
			color: #202020 !important;
		}
	}
</style>
<div class="portlet light">
	<div class="portlet-body">


		<h2 class="hidden-print">Monthly Attendance Report</h2>
		<a href="#" id="download_link"></a>

		<form action="" method="post" class="hidden-print">
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label for="">Employee Name</label>
						<select name="emp_id" id="" class="form-control select2">
							<?php
							$getEmployee = mysqli_query($dbc, "SELECT * FROM assign_business WHERE business_id='$business_id'");
							while ($fetchEmployee = mysqli_fetch_assoc($getEmployee)) :
								if (countWhen($dbc, "users", "user_id", $fetchEmployee['user_id']) == 0) {
									continue;
								}
								$fetchEmployeeData = fetchRecord($dbc, "users", "user_id", $fetchEmployee['user_id']);
								if ($fetchEmployeeData['user_status'] != "enable") {
									continue;
								}
							?>
								<option <?php if (!empty($_REQUEST['emp_id']) and $_REQUEST['emp_id'] == $fetchEmployee['user_id']) {
											echo "selected";
										} ?> value="<?= @$fetchEmployeeData['user_id'] ?>"><?= strtoupper($fetchEmployeeData['user_first_name']) ?> <?= strtoupper($fetchEmployeeData['user_last_name']) ?></option>
							<?php endwhile; ?>
						</select>
					</div><!-- group -->
				</div><!-- col -->
				<div class="col-sm-5">
					<div class="form-group">
						<label for="">Select Month</label>
						<input type="month" readonly autocomplete="off" class="form-control monthDateField" name="dated" placeholder="Month" value="<?= @$show_date ?>">
					</div><!-- group -->
				</div><!-- col -->
				<div class="col-sm-1">
					<br>
					<div class="form-group mt-2">
						<button class="btn btn-success" type="submit" name="report_btn">Submit</button>
					</div><!-- form-group -->
				</div>
			</div><!-- row -->
		</form>
		<form action="" method="post" class="hidden-print">
			<div class="row">
				<div class="col-sm-5">
					<div class="form-group">
						<label for="">Employee Name</label>
						<select name="emp_id" id="" class="form-control select2">
							<?php
							$getEmployee = mysqli_query($dbc, "SELECT * FROM assign_business WHERE business_id='$business_id'");
							while ($fetchEmployee = mysqli_fetch_assoc($getEmployee)) :
								if (countWhen($dbc, "users", "user_id", $fetchEmployee['user_id']) == 0) {
									continue;
								}
								$fetchEmployeeData = fetchRecord($dbc, "users", "user_id", $fetchEmployee['user_id']);
								if ($fetchEmployeeData['user_status'] != "enable") {
									continue;
								}
							?>
								<option <?php if (!empty($_REQUEST['emp_id']) and $_REQUEST['emp_id'] == $fetchEmployee['user_id']) {
											echo "selected";
										} ?> value="<?= @$fetchEmployeeData['user_id'] ?>"><?= strtoupper($fetchEmployeeData['user_first_name']) ?> <?= strtoupper($fetchEmployeeData['user_last_name']) ?></option>
							<?php endwhile; ?>
						</select>
					</div><!-- group -->
				</div><!-- col -->
				<div class="col-sm-3">
					<div class="form-group">
						<label for="">From Date</label>
						<input type="text" readonly autocomplete="off" class="form-control dateField" name="from" id="from" placeholder="From Date" value="<?= @$_REQUEST['from'] ?>">
					</div><!-- group -->
				</div><!-- col -->
				<div class="col-sm-3">
					<div class="form-group">
						<label for="">To Date</label>
						<input type="text" readonly autocomplete="off" class="form-control dateField" name="to" id="to" placeholder="To Date" value="<?= @$_REQUEST['to'] ?>">
					</div><!-- group -->
				</div><!-- col -->
				<div class="col-sm-1">
					<div class="form-group">
						<br>
						<button class="btn btn-success mt-2" type="submit" name="report_range_btn">Submit</button>
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
			$fetchEmployeeMetaData = (array) json_decode($fetchEmployeeData['user_extra']);
			$employeeOffDays = ['sun'];
			if (!empty($fetchEmployeeData['user_pic'])) {
				$pic = $fetchEmployeeData['user_pic'];
			} else {
				$pic = "default.png";
			}
		?>
			<span id="photo" style="padding: 15px">
				<div class="portlet-body" style="padding: 15px">
					<div class="hidden-print btn-group pull-right">
						<a style="font-size: 12px" href="#!" onclick="window.print()" class="btn btn-warning"><span class="fa fa-print"></span> Print</a>
						<a style="font-size: 12px" href="#!" onclick="takeScreenshot()" class="btn btn-info"><span class="fa fa-camera"></span> Take Screenshot</a>
						<a style="font-size: 12px" href="export_monthly_attendance_report.php?emp_id=<?= $_REQUEST['emp_id'] ?>&business=<?= $_REQUEST['business'] ?>&dated=<?= $_REQUEST['dated'] ?>" target="_blank" class="btn btn-success"><span class="fa fa-download"></span> Export to Excel</a>
						<button style="font-size: 12px" class="btn btn-danger pdf_portrait_btn hidden-print">Export PDF</button>
					</div>

					<span id="pdfBodyPortrait">
						<div class="row">
							<div class="col-sm-4">
								<a style="color: black" href="#modal-id" data-toggle="modal" title="load_staff_form|user_id|<?= @$fetchEmployeeData['user_id'] ?>" class="modal-action">

									<img src="img/staff/<?= $pic ?>" class="img img-responsive img-circle" width="80" height="80" align="left" hspace="10">
									<strong>ID#: <?= strtoupper($fetchEmployeeData['user_id']) ?> </strong> <br>
									<strong><?= strtoupper($fetchEmployeeData['user_first_name']) ?> <?= strtoupper($fetchEmployeeData['user_last_name']) ?></strong> <br>

									<strong>Designation: </strong><?= $fetchEmployeeData['designation'] ?> <br>
									<strong>Email: </strong><a href="mailto:<?= $fetchEmployeeData['user_email'] ?>"><?= $fetchEmployeeData['user_email'] ?></a><br>
								</a>
							</div><!-- col -->
							<br> <br>
							<div class="col-sm-4">
								<h3><?= date('F-Y', strtotime($_REQUEST['dated'])) ?></h3>
							</div><!-- col -->


						</div><!-- row -->
						<div class="table-responsive panel panel-default panel-body">

							<table class="table table-bordered table-condensed report_table myTable" style="font-size: 12px">
								<?php $absent = $i = 0;
								$grand_totalHrs = 0;
								for ($j = 1; $j <= $date_total_days; $j++) :
									$d = $date_year . "-" . $date_month . "-" . $j;
									$dated = date('Y-m-d', strtotime($d));
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
									<?php endif; ?>
									<tr align="center">
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
											<th class="getLocation" title="<?= $getStartShift['location'] ?>">
												<?php if (!empty($getStartShift['att_time'])) {
													echo date('h:i A', strtotime($getStartShift['att_time']));
													echo "<br><span class='fa fa-" . $icons[$getDeviceStart['device']] . "'></span>";
												} else {
													if (!in_array(strtolower(date('D', strtotime($d))), $employeeOffDays)) {
														$absent++;
													}
													echo "-";
												} ?>

											</th>
											<th><?php if (!empty($getStartBreak['att_time'])) {
													echo date('h:i A', strtotime($getStartBreak['att_time']));
												} else {
													echo "-";
												} ?></th>
											<th><?php if (!empty($getEndBreak['att_time'])) {
													echo date('h:i A', strtotime($getEndBreak['att_time']));
												} else {
													echo "-";
												} ?></th>
											<th><?php if (!empty($getEndShift['att_time'])) {
													echo date('h:i A', strtotime($getEndShift['att_time']));
													echo "<br><span class='fa fa-" . $icons[$getDeviceEnd['device']] . "'></span>";
												} else {
													echo "-";
												} ?></th>

											<th>
												<?php if (!empty($hour_break)) {
													echo $hour_break . " hr(s)";
												} else {
													echo "-";
												} ?>
											</th>
											<th><?php

												if (!empty($getStartShift['att_time']) and !empty($getEndShift['att_time']) or (!empty($getStartBreak['att_time']) and !empty($getEndBreak['att_time']))) {
													$totalHrs = ($hour_shift - $hour_break);
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
							<table class="table table-condensed table-striped table-bordered">
								<tr>
									<th colspan="2" class="bg-primary">Salary Section</th>
								</tr>
								<tr>
									<th>Salary Type</th>
									<th class="text-uppercase"><?= $fetchEmployeeData['salary_mode'] ?></th>
								</tr>
								<?php if (strtolower($fetchEmployeeData['salary_mode']) == "fixed") : ?>
									<tr>
										<th>Amount</th>
										<td><?php echo number_format($fetchEmployeeMetaData['fixed_salary']) ?></td>
									</tr>
									<tr>
										<th>Per Day Salary</th>
										<td><?php
											$per_day = ($fetchEmployeeMetaData['fixed_salary'] / $date_total_days);
											echo number_format($per_day); ?></td>
									</tr>
									<tr>
										<th>Total Absent(s)</th>
										<td><?php echo $absent ?></td>
									</tr>
									<tr class="bg-danger">
										<th>Deduction in Salary</th>
										<td><?php echo $deduction = number_format($absent * $per_day); ?></td>
									</tr>
									<tr class="bg-success">
										<th>Net Salary</th>
										<td><?php echo number_format(doubleval($fetchEmployeeMetaData['fixed_salary']) - doubleval($absent * $per_day)); ?></td>
									</tr>
								<?php endif; ?>
							</table>
						</div>
					</span>
				</div>

			</span>
		<?php endif; ?>
		<!-- Filter by Range -->
		<?php if (isset($_REQUEST['report_range_btn'])) :
			@$date_array = getStartAndEndDate(date('W', strtotime($_REQUEST['dated'])), date('Y', strtotime($_REQUEST['dated'])));
			@$date_month = date('m', strtotime($_REQUEST['dated']));
			@$date_year = date('Y', strtotime($_REQUEST['dated']));

			@$fetchEmployeeData = fetchRecord($dbc, "users", "user_id", $_REQUEST['emp_id']);
			$fetchEmployeeMetaData = (array) json_decode($fetchEmployeeData['user_extra']);
			$employeeOffDays = ['sun'];
			if (!empty($fetchEmployeeData['user_pic'])) {
				$pic = $fetchEmployeeData['user_pic'];
			} else {
				$pic = "default.png";
			}
			@$from = new DateTime($_REQUEST['from']);
			@$to = new DateTime($_REQUEST['to']);
			@$diff = date_diff($from, $to);
			@$days = $diff->format("%d");
			@$date_range = getDatesFromRange(date('Y-m-d', strtotime($_REQUEST['from'])), date('Y-m-d', strtotime($_REQUEST['to'])));
			@$date_total_days = count($date_range);
			$workingdays = date('t', strtotime($_REQUEST['from']));
			$interval = $from->diff($to);
			$days = $interval->days;

		?>
			<span id="photo" style="padding: 15px">
				<div class="card card-body" style="padding: 15px">
					<div class="pull-right hidden-print btn-group" style="float: right  !important;">
						<a style="font-size: 12px" href="#!" onclick="window.print()" class="btn btn-warning"><span class="fa fa-print"></span> Print</a>
						<a style="font-size: 12px" href="#!" onclick="takeScreenshot()" class="btn btn-info"><span class="fa fa-camera"></span> Take Screenshot</a>
						<a style="font-size: 12px" href="export_monthly_attendance_report_range.php?emp_id=<?= $_REQUEST['emp_id'] ?>&business=<?= $_REQUEST['business'] ?>&dated=<?= $_REQUEST['dated'] ?>&date_range=true&from=<?= $_REQUEST['from'] ?>&to=<?= $_REQUEST['to'] ?>" target="_blank" class="btn btn-success"><span class="fa fa-download"></span> Export to Excel</a>
						<button style="font-size: 12px" class="btn btn-danger pdf_portrait_btn hidden-print">Export PDF</button>
					</div>
					<span id="pdfBodyPortrait">
						<div class="row">
							<div class="col-sm-4">
								<a style="color: black" href="#modal-id" data-toggle="modal" title="load_staff_form|user_id|<?= @$fetchEmployeeData['user_id'] ?>" class="modal-action">
									<img src="img/staff/<?= $pic ?>" class="img img-responsive img-circle" width="80" height="80" align="left" hspace="10">
									<strong>ID#: <?= strtoupper($fetchEmployeeData['user_id']) ?> </strong> <br>
									<strong><?= strtoupper($fetchEmployeeData['user_first_name']) ?> <?= strtoupper($fetchEmployeeData['user_last_name']) ?></strong> <br>
									<strong>Designation: </strong><?= $fetchEmployeeData['designation'] ?> <br>
									<strong>Email: </strong><a href="mailto:<?= $fetchEmployeeData['user_email'] ?>"><?= $fetchEmployeeData['user_email'] ?></a><br>
								</a>
								<br> <br>
							</div><!-- col -->
							<div class="col-sm-4">
								<h3><?= date('d-M-Y', strtotime($_REQUEST['from'])) ?> - <?= date('d-M-Y', strtotime($_REQUEST['to'])) ?></h3>
							</div><!-- col -->
						</div><!-- row -->
						<div class="table-responsive panel panel-default panel-body">

							<table class="table table-bordered table-condensed report_table myTable" style="font-size: 12px">
								<?php $absent = $i = 0;
								$grand_totalHrs = 0;
								foreach ($date_range as $dr) :
									$d = $dr;
									$dated = date('Y-m-d', strtotime($d));
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
									<?php endif; ?>
									<tr align="center">
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
											<th><?php if (!empty($getStartShift['att_time'])) {
													echo date('h:i A', strtotime($getStartShift['att_time']));
													echo "<br><span class='fa fa-" . $icons[$getDeviceStart['device']] . "'></span>";
												} else {
													if (!in_array(strtolower(date('D', strtotime($d))), $employeeOffDays)) {
														$absent++;
													}
													echo "-";
												} ?>

											</th>
											<th><?php if (!empty($getStartBreak['att_time'])) {
													echo date('h:i A', strtotime($getStartBreak['att_time']));
												} else {
													echo "-";
												} ?></th>
											<th><?php if (!empty($getEndBreak['att_time'])) {
													echo date('h:i A', strtotime($getEndBreak['att_time']));
												} else {
													echo "-";
												} ?></th>
											<th><?php if (!empty($getEndShift['att_time'])) {
													echo date('h:i A', strtotime($getEndShift['att_time']));
													echo "<br><span class='fa fa-" . $icons[$getDeviceEnd['device']] . "'></span>";
												} else {
													echo "-";
												} ?></th>

											<th>
												<?php if (!empty($hour_break)) {
													echo $hour_break . " hr(s)";
												} else {
													echo "-";
												} ?>
											</th>
											<th><?php

												if (!empty($getStartShift['att_time']) and !empty($getEndShift['att_time']) or (!empty($getStartBreak['att_time']) and !empty($getEndBreak['att_time']))) {
													$totalHrs = ($hour_shift - $hour_break);
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
								endforeach; ?>
								<tr>
									<th colspan="6" class="text-right" align="right">Total Hour(s)</th>
									<td><?= $grand_totalHrs ?> hr(s)</td>
								</tr>

							</table>
							<table class="table table-condensed table-striped table-bordered">
								<tr>
									<th colspan="2" class="bg-primary">Salary Section</th>
								</tr>
								<tr>
									<th>Salary Type</th>
									<th class="text-uppercase"><?= $fetchEmployeeData['salary_mode'] ?></th>
								</tr>
								<?php if (strtolower($fetchEmployeeData['salary_mode']) == "fixed") : ?>
									<tr>
										<th>Amount</th>
										<td><?php echo number_format($fetchEmployeeMetaData['fixed_salary']) ?></td>
									</tr>
									<tr>
										<th>Per Day Salary</th>
										<td><?php
											$per_day = ($fetchEmployeeMetaData['fixed_salary'] / $workingdays);
											echo number_format($per_day); ?></td>
									</tr>
									<tr>
										<th>Total Absent(s)</th>
										<td><?php echo $absent ?></td>
									</tr>
									<tr>
										<th>Total Present</th>
										<td><?= $present = $days - $absent ?></td>
									</tr>
									<tr class="bg-danger">
										<th>Deduction in Salary</th>
										<td><?php echo $deduction = number_format($absent * $per_day); ?></td>
									</tr>
									<tr class="bg-success">
										<th>Net Salary</th>
										<td><?php echo number_format(doubleval($fetchEmployeeMetaData['fixed_salary'] - ($absent * $per_day))); ?></td>
									</tr>
									<tr>
										<td>
											<a href="index.php?nav=<?= base64_encode("print_salary_slip") ?>&emp_id=<?= strtoupper($fetchEmployeeData['user_id']) ?>&to=<?= $_REQUEST['to'] ?>&from=<?= $_REQUEST['from'] ?>&present=<?= $present ?>">
												<button class=" btn btn-primary">Salary Slip</button></a>
										</td>
									</tr>
								<?php endif; ?>
							</table>
						</div>
					</span>
				</div>
			</span>
		<?php endif; ?>

	</div>
</div>
<div style="position: fixed;bottom: 10px; left: 10px;padding: 10px; background-color: #eee;box-shadow: 10px 10px 10px gray;border-radius: 10px;z-index: 10000 !important" class="map-view hidden">
	<button class="btn btn-danger btn-xs pull-right mb-3 close_map_view">Close</button>
	<div class="map-view-body" style="transition: all 1s"></div>
</div>
<script>
	$(document).on('click', '.getLocation', function() {
		$(".map-view").removeClass('hidden');
		$(".map-view-body").html('<iframe src="https://maps.google.com/maps?q=' + ($(this).attr('title')) + '&amp;z=20&amp;output=embed" width="100%" height="250" frameborder="0"></iframe>')
	})
	$(document).on('click', '.close_map_view', function() {
		$(".map-view").addClass('hidden');
		$(".map-view-body").html('')
	})
</script>