<?php $business_id = base64_decode($_REQUEST['business']);
$fetchBusinessData = fetchRecord($dbc, "business", "business_id", $business_id);
$show_date = (empty($_REQUEST['dated'])) ? date('d-M-Y') : $_REQUEST['dated'];
$icons = [
	'card_scan' => "id-card",
	'manual' => 'pencil',
	"phone_scan" => "mobile",
];
?>
<div class="portlet light">
	<div class="portlet-body">


		<h2 class="hidden-print">Task Report</h2>
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
		<!-- Filter by Range -->
		<?php if (isset($_REQUEST['report_range_btn'])) :
			@$date_array = getStartAndEndDate(date('W', strtotime($_REQUEST['dated'])), date('Y', strtotime($_REQUEST['dated'])));
			@$date_month = date('m', strtotime($_REQUEST['dated']));
			@$date_year = date('Y', strtotime($_REQUEST['dated']));
			@$date_total_days = date('t', strtotime($_REQUEST['dated']));
			@$fetchEmployeeData = fetchRecord($dbc, "users", "user_id", $_REQUEST['emp_id']);
			$fetchEmployeeMetaData = (array) json_decode($fetchEmployeeData['user_extra']);
			$employeeOffDays = ['sun'];
			if (!empty($fetchEmployeeData['user_pic'])) {
				$pic = $fetchEmployeeData['user_pic'];
			} else {
				$pic = "default.png";
			}
			@$from = date_create(date('Y-m-d', strtotime($_REQUEST['from'])));
			@$to = date_create(date('Y-m-d', strtotime($_REQUEST['to'])));
			@$diff = date_diff($from, $to);
			@$days = $diff->format("%d");
			@$date_range = getDatesFromRange(date('Y-m-d', strtotime($_REQUEST['from'])), date('Y-m-d', strtotime($_REQUEST['to'])));
		?>
			<span id="photo" style="padding: 15px">
				<div class="portlet light" style="padding: 15px">
					<div class="portlet-body">
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
								</div><!-- col -->
								<div class="col-sm-4">
									<h3><?= date('d-M-Y', strtotime($_REQUEST['from'])) ?> - <?= date('d-M-Y', strtotime($_REQUEST['to'])) ?></h3>
								</div><!-- col -->
							</div><!-- row -->

							<table class="table table-bordered table-condensed report_table" style="font-size: 12px">
								<?php $absent = $i = 0;
								$grand_totalHrs = 0;
								foreach ($date_range as $dr) :
									$d = $dr;
									$dated = date('Y-m-d', strtotime($d));
									$getTask = mysqli_query($dbc, "SELECT * FROM tasks WHERE user_id='$_REQUEST[emp_id]'  AND dated='$dated'");
									$fetchTask = mysqli_fetch_assoc($getTask);
									$day = date('l', strtotime($d));
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
											<th width="10%">Days</th>
											<th width="15%">Title</th>
											<th>Task List</th>
											<th>Bugs/Issues</th>
										</tr>
									<?php endif; ?>
									<tr>
										<th width="10%"><?= $day ?><br><i style="font-size: 11px"><?= date('d-M-Y', strtotime($d)) ?></i> </th>
										<th><?= strtoupper($fetchTask['title']) ?></th>
										<td style="line-height: 11px"><?= nl2br($fetchTask['description']) ?></td>
										<td><?= empty(nl2br($fetchTask['issues'])) ? "-" : (nl2br($fetchTask['issues'])); ?></td>
									</tr>
								<?php $i++;
								endforeach; ?>

							</table>
						</span>
					</div>
				</div>
			</span>
		<?php endif; ?>
	</div>
</div>