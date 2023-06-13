<?php $business_id = base64_decode($_REQUEST['business']);
@$fetchBusinessData = fetchRecord($dbc, "business", "business_id", $business_id);
$show_date = (empty($_REQUEST['dated'])) ? date('d-M-Y') : $_REQUEST['dated'];
?>
<style>
	table tr:nth-child(2) th,
	td {
		background: #202020;
		color: #fff;
		border-color: #202020 !important;
	}

	@media print {

		table tr:nth-child(2) th,
		td {
			background: #fff;
			color: #000;
			border-color: #eee !important;
		}
	}
</style>
<div class="portlet light">
	<div class="portlet-body">
		<h2 class="hidden-print">Monthly Report</h2>
		<a href="#" id="download_link"></a>
		<form action="" method="post" class="hidden-print">
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group">
						<label for="">Select Month</label>
						<input type="month" readonly autocomplete="off" class="form-control monthDateField" name="dated" placeholder="Month" value="<?= @$show_date ?>">
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
			if (!empty($fetchUser['user_pic'])) {
				$pic = $fetchUser['user_pic'];
			} else {
				$pic = "default.png";
			}

		?>
			<span id="photo" style="padding: 15px">
				<div class="card card-body" style="padding: 15px">
					<div class="row">
						<div class="col-sm-6">
							<img src="img/staff/<?= $pic ?>" class="img img-responsive img-circle" width="80" height="80" align="left" hspace="10">
							<strong>ID#: <?= strtoupper($fetchUser['user_id']) ?> </strong> <br>
							<strong><?= strtoupper($fetchUser['user_first_name']) ?> <?= strtoupper($fetchUser['user_last_name']) ?></strong> <br>
							<strong>Designation: </strong><?= $fetchUser['designation'] ?> <br>
							<strong>Email: </strong><a href="mailto:<?= $fetchUser['user_email'] ?>"><?= $fetchUser['user_email'] ?></a><br><br>
						</div><!-- col -->
						<div class="col-sm-6">
							<h3><?= date('F-Y', strtotime($_REQUEST['dated'])) ?></h3>
						</div><!-- col -->
					</div><!-- row -->

					<table class="table table-bordered table-condensed" style="font-size: 12px">
						<?php $i = 0;
						$_REQUEST['emp_id'] = $fetchUser['user_id'];
						$business_id = $_REQUEST['business_id'];
						for ($j = 1; $j <= $date_total_days; $j++) :
							$d = $date_year . "-" . $date_month . "-" . $j;
							$dated = date('Y-m-d', strtotime($d));
							$fetchEmployeeData = fetchRecord($dbc, "users", "user_id", $_REQUEST['emp_id']);
							$getTimeOff = mysqli_query($dbc, "SELECT * FROM emp_attendance WHERE emp_id='$_REQUEST[emp_id]' AND att_date='$dated' AND status='leave'");
							if (mysqli_num_rows($getTimeOff) >= 1) {
								$fetchTimeOff = mysqli_fetch_assoc($getTimeOff);
							}
							$day = date('l', strtotime($d));
							@$getStartShift = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM emp_attendance WHERE att_date='$dated' AND shift='start_shift' AND emp_id='$_REQUEST[emp_id]'"));
							@$getEndShift = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM emp_attendance WHERE att_date='$dated' AND shift='end_shift' AND emp_id='$_REQUEST[emp_id]'"));
							@$getStartBreak = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM emp_attendance WHERE att_date='$dated' AND shift='start_break' AND emp_id='$_REQUEST[emp_id]'"));
							@$getEndBreak = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM emp_attendance WHERE att_date='$dated' AND shift='end_break' AND emp_id='$_REQUEST[emp_id]'"));
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
									<!-- <th colspan="7" style="font-size: 14px">
								<?= strtoupper($fetchEmployeeData['user_first_name']) ?> <?= strtoupper($fetchEmployeeData['user_last_name']) ?> <i>ordinary hours: ________hours ________ minutes per week / fortnight / other __________
								(circle appropriate option and insert information if required)</i>
							</th> -->
									<!-- <th colspan="5" class="text-center hidd" style="font-size: 14px">Overtime</th> -->
									<!-- <th colspan="2" class="text-center hidd" style="font-size: 14px">Leave</th> -->
								</tr>
								<tr class="text-center">
									<th>Days</th>
									<th width="12%">Start/CheckIn time</th>
									<th width="12%">End/CheckOut Time</th>
									<th width="12%">Total Time</th>
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
								<th><?= $day ?><br><i style="font-size: 11px"><?= date('d-M-Y', strtotime($d)) ?></i></th>
								<?php if (!empty($fetchTimeOff) and mysqli_num_rows($getTimeOff) >= 1) : ?>
									<th colspan="13" class="text-center bg-warning">
										Time Off <br>
										Reason: <?= @strtoupper($fetchTimeOff['reason']) ?>
									</th>
								<?php else : ?>
									<th><?php if (!empty($getStartShift['att_time'])) {
											echo date('h:i A', strtotime($getStartShift['att_time']));
										} else {
											echo "-";
										} ?></th>
									<th><?php if (!empty($getEndShift['att_time'])) {
											echo date('h:i A', strtotime($getEndShift['att_time']));
										} else {
											echo "-";
										} ?></th>

									<th><?php

										if (!empty($getStartShift['att_time']) and !empty($getEndShift['att_time']) or (!empty($getStartBreak['att_time']) and !empty($getEndBreak['att_time']))) {
											echo @($hour_shift - $hour_break) . " hr(s)";
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

					</table>
				</div>
			</span>
		<?php endif; ?>
	</div>
</div>