<?php $business_id = base64_decode($_REQUEST['business']);
@$fetchBusinessData = fetchRecord($dbc, "business", "business_id", $business_id);
$show_date = (empty($_REQUEST['dated'])) ? date('d-M-Y') : $_REQUEST['dated'];
?>
<div class="portlet light">
	<div class="portlet-body">


		<h2 class="hidden-print">Full Attendance Report</h2>
		<a href="#" id="download_link"></a>
		<form action="" method="post" class="hidden-print">
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label for="">Business Name</label>
						<select name="business_id" id="" class="form-control">
							<?php
							if ($getRoleAdmin) {
								$getEmployeeBusiness = mysqli_query($dbc, "SELECT * FROM business");
							} else {
								$getEmployeeBusiness = mysqli_query($dbc, "SELECT * FROM business WHERE user_id='$fetchUser[user_id]'");
							}

							while ($fetchEmployeeBusiness = mysqli_fetch_assoc($getEmployeeBusiness)) :
								@$fetchBusinessDetails = fetchRecord($dbc, "business", "business_id", $fetchEmployeeBusiness['business_id']);
							?>
								<option <?php if (!empty($_REQUEST['business_id']) and $_REQUEST['business_id'] == $fetchBusinessDetails['business_id']) {
											echo "selected";
										} ?> value="<?= @$fetchBusinessDetails['business_id'] ?>"><?= strtoupper($fetchBusinessDetails['business_name']) ?></option>
							<?php endwhile; ?>
						</select>
					</div><!-- group -->
				</div><!-- col -->
				<div class="col-sm-6">
					<div class="form-group">
						<label for="">Select Month</label>
						<input type="month" readonly autocomplete="off" class="form-control monthDateField" name="dated" placeholder="Month" value="<?= @$show_date ?>">
					</div><!-- group -->
				</div><!-- col -->
				<div class="col-sm-12 text-right">
					<div class="form-group">
						<button class="btn btn-success" type="submit" name="report_btn">Submit</button>
					</div><!-- form-group -->
				</div>
			</div><!-- row -->
		</form>
		<?php if (isset($_REQUEST['report_btn'])) :  ?>
			<div class="portlet-body">
				<h4><a href="#!" onclick="window.print()" class="btn btn-warning pull-right"><span class="fa fa-print"></span> Print</a> <button class="btn btn-danger pdf_btn hidden-print pull-right">Export PDF</button></h4>
				<?php
				$month_date = (!empty($_REQUEST['dated']) ? date('M-Y', strtotime($_REQUEST['dated'])) : date('M-Y'));
				$date_array = getStartAndEndDate(date('W', strtotime($_REQUEST['dated'])), date('Y', strtotime($_REQUEST['dated'])));
				$date_month = date('m', strtotime($_REQUEST['dated']));
				$date_year = date('Y', strtotime($_REQUEST['dated']));
				$date_total_days = date('t', strtotime($_REQUEST['dated']));
				$business_id = $_REQUEST['business_id'];
				?>
				<div class="table-responsive" id="pdfBody" style="width:100%">
					<center>
						<h3 class="text-center"><?= $month_date ?></h3>
					</center>
					<table class="table table-bordered text-center" style="font-size:12px;width:100%">
						<tr>
							<th>Staff</th>
							<?php
							if (!empty($_REQUEST['dated'])) {
								$days = date('t', strtotime($_REQUEST['dated']));
							} else {
								$days = date('t');
							}
							for ($i = 1; $i <= $days; $i++) :
								@$month = date('Y-m', strtotime(($_REQUEST['dated'])));
								$dated = (!empty($_REQUEST['dated'])) ? date($month . "-" . $i) : date('Y-m-' . $i);
							?>
								<th class="text-center">
									<?= date('D', strtotime($dated)) ?>
									<?= $i ?>
								</th>
							<?php endfor; ?>
						</tr>
						<?php $getEmployee = mysqli_query($dbc, "SELECT * FROM assign_business WHERE business_id='$business_id'");
						while ($fetchEmployee = mysqli_fetch_assoc($getEmployee)) :
							if (countWhen($dbc, "users", "user_id", $fetchEmployee['user_id']) == 0) {
								continue;
							}
							$fetchEmployeeData = fetchRecord($dbc, "users", "user_id", $fetchEmployee['user_id']);
							if (!empty($fetchEmployeeData['user_pic'])) {
								$pic = $fetchEmployeeData['user_pic'];
							} else {
								$pic = "default.png";
							}
							if (strtolower($fetchEmployeeData['user_status'] == "disabled")) {
								continue;
							}

						?>
							<tr>
								<td style="width: 80px">
									<img src="img/staff/<?= $pic ?>" class="img img-responsive img-circle" width="40" height="40" align="left" hspace="10">
									<strong>Staff ID </strong> <?= $fetchEmployeeData['user_id'] ?>
									<br>
									<?= strtoupper($fetchEmployeeData['user_first_name']) ?> <?= strtoupper($fetchEmployeeData['user_last_name']) ?>
								</td>
								<?php for ($i = 1; $i <= $days; $i++) :
									$d = $date_year . "-" . $date_month . "-" . $i;
									$dated = date('Y-m-d', strtotime($d));
									$_REQUEST['emp_id'] = $fetchEmployeeData['user_id'];
									$getTimeOff = mysqli_query($dbc, "SELECT * FROM emp_attendance WHERE emp_id='$_REQUEST[emp_id]' AND business_id='$business_id' AND att_date='$dated' AND status='leave'");
									if (mysqli_num_rows($getTimeOff) >= 1) {
										$fetchTimeOff = mysqli_fetch_assoc($getTimeOff);
									}

									$day = date('l', strtotime($d));
									@$getStartShift = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM emp_attendance WHERE att_date='$dated' AND shift='start_shift' AND emp_id='$_REQUEST[emp_id]' AND business_id='$business_id'"));
									@$getEndShift = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM emp_attendance WHERE att_date='$dated' AND shift='end_shift' AND emp_id='$_REQUEST[emp_id]' AND business_id='$business_id'"));
									@$getStartBreak = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM emp_attendance WHERE att_date='$dated' AND shift='start_break' AND emp_id='$_REQUEST[emp_id]' AND business_id='$business_id'"));
									@$getEndBreak = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM emp_attendance WHERE att_date='$dated' AND shift='end_break' AND emp_id='$_REQUEST[emp_id]' AND business_id='$business_id'"));
									$hour_shift = $hour_break = '';
									if (!empty($getStartShift['att_time']) and !empty($getEndShift['att_time'])) {
										$hour_shift = number_format(differenceInHours($getStartShift['att_time'], $getEndShift['att_time']), 2);
									}
									if (!empty($getStartBreak['att_time']) and !empty($getEndBreak['att_time'])) {
										$hour_break = number_format(differenceInHours($getStartBreak['att_time'], $getEndBreak['att_time']), 2);
									}
								?>
									<?php if (!empty($fetchTimeOff) and mysqli_num_rows($getTimeOff) >= 1) : ?>
										<th class="text-center bg-warning">
											Time Off <br>
											Reason: <?= @strtoupper($fetchTimeOff['reason']) ?>
										</th>
									<?php else : ?>
										<td style="font-size: 9px"> <?php if (!empty($getStartShift['att_time'])) {
																		echo "<b>IN: </b>" . date('h:i A', strtotime($getStartShift['att_time']));
																	} else {
																		echo "-";
																	} ?><br>
											<?php if (!empty($getStartBreak['att_time'])) {
												echo "<b>B-IN:</b> " . date('h:i A', strtotime($getStartBreak['att_time']));
											} else {
												echo "-";
											} ?><br>
											<?php if (!empty($getEndBreak['att_time'])) {
												echo "<b>B-OUT:</b> " . date('h:i A', strtotime($getEndBreak['att_time']));
											} else {
												echo "-";
											} ?><br>
											<?php if (!empty($getEndShift['att_time'])) {
												echo "<b>OUT:</b> " . date('h:i A', strtotime($getEndShift['att_time']));
											} else {
												echo "-";
											} ?></td>


									<?php endif; ?>
								<?php endfor; ?>
							</tr>
						<?php endwhile; ?>
					</table>
				</div>
			</div><!-- card -->
		<?php endif; ?>
	</div>
</div>