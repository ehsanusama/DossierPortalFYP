<?php
$business_id = base64_decode($_REQUEST['business']);
$fetchBusinessData = fetchRecord($dbc, "business", "business_id", $business_id);
$show_date = (empty($_REQUEST['dated'])) ? date('d-M-Y') : $_REQUEST['dated'];
?>
<div class="portlet light">
	<div class="portlet-body">
		<h4 class="text-center">-- Staff Schedule Weekly --</h4> <a href="index.php?nav=<?= @$_REQUEST['nav'] ?>&action=weekly_schedule_email&dated=<?= $show_date ?>&business=<?= @$_REQUEST['business'] ?>" class="btn btn-success pull-right"><span class="fa fa-send"></span> Send Email</a> <a href="print.php?action=weekly_schedule&dated=<?= $show_date ?>&business_id=<?= @$_REQUEST['business'] ?>" target="_blank" class="btn btn-warning pull-right"><span class="fa fa-print"></span> Print</a> <a href="#modal-id" data-toggle="modal" title="load_add_time_off_form|business_id|<?= $business_id ?>" class="btn btn-primary pull-right modal-action"><span class="fa fa-clock"></span> Add Time Off</a>
		<br><br>
		<form action="" method="post" class="">
			<input type="hidden" name="business_id" value="<?= @$_REQUEST['business'] ?>">
			<input type="hidden" name="nav" value="<?= @$_REQUEST['nav'] ?>">
			<input type="hidden" name="action" value="load_employee_schedule_view">
			<div class="row">
				<div class="col-6">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-btn">
								<button class="btn btn-default"><span class="fa fa-calendar"></span></button>
							</span>
							<input type="text" autocomplete="off" class="dateField form-control" placeholder="Pick a Date" required name="dated" value="<?= @$show_date ?>">
							<span class="input-group-btn">
								<button class="btn btn-success" type="submit" name="schedule_btn">Submit</button>
							</span><!--  -->
						</div><!-- group -->
					</div><!--group -->
				</div><!-- col -->
				<div class="col-6">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-btn">
								<button class="btn btn-default">Business Name:</span></button>
							</span>
							<input type="text" autocomplete="off" class="form-control disabled" placeholder="" disabled value="<?= @strtoupper($fetchBusinessData['business_name']) ?>">
						</div>
					</div><!--group -->
				</div><!-- col -->
			</div><!-- row -->
		</form>
		<div class="table-responsive" id="schedule_data">
			<?php
			if (isset($_REQUEST['schedule_btn'])) {
				$date_array = getStartAndEndDate(date('W', strtotime($_REQUEST['dated'])), date('Y', strtotime($_REQUEST['dated'])));
			} else {
				$date_array = getStartAndEndDate(date('W'), date('Y'));
			}

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
					</tr>
				</thead>
				<tbody>
					<?php $getEmployee = mysqli_query($dbc, "SELECT * FROM assign_business WHERE business_id='$business_id'");
					while ($fetchEmployee = mysqli_fetch_assoc($getEmployee)) :


						$fetchEmployeeData = fetchRecord($dbc, "users", "user_id", $fetchEmployee['user_id']);
						if (countWhen($dbc, "users", "user_id", $fetchEmployee['user_id']) == 0 or $fetchEmployeeData['user_status'] != 'enable') {
							continue;
						}
					?>
						<tr style="font-size: 12px;">
							<form action="api/index.php" method="post" class="ajax-form">
								<td style="font-size: 12px">
									<strong>Staff ID </strong> <?= $fetchEmployeeData['user_id'] ?>
									<br>
									<?= strtoupper($fetchEmployeeData['user_first_name']) ?> <?= strtoupper($fetchEmployeeData['user_last_name']) ?>
									<br>

									<button style="visibility: hidden;" class="btn btn-success btn-sm" type="submit"><span class="fa fa-floppy-o"></span></button>
								</td>

								<input type="hidden" value="<?= $fetchEmployeeData['user_id'] ?>" name="emp_id">
								<input type="hidden" value="<?= $business_id ?>" name="business_id">
								<input type="hidden" name="action" value="employee_roaster">
								<?php $i = 0;
								foreach (dateRange($date_array['start_date'], $date_array['end_date']) as $d) :
									$dated = date('Y-m-d', strtotime($d));
									$getTimeOff = mysqli_query($dbc, "SELECT * FROM emp_attendance WHERE emp_id='$fetchEmployeeData[user_id]' AND business_id='$business_id' AND att_date='$dated' AND status='leave'");
									if (mysqli_num_rows($getTimeOff) >= 1) {
										$fetchTimeOff = mysqli_fetch_assoc($getTimeOff);
									}
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
										<?php if (!empty($fetchTimeOff) and mysqli_num_rows($getTimeOff) >= 1) : ?>
											<div class="btn-group btn-group-vertical">
												<a href="#modal-id" data-toggle="modal" title="load_view_time_off_form|att_id|<?= $fetchTimeOff['att_id'] ?>" class="btn btn-info btn-xs pull-right modal-action">Time Off</a>
												<a title="emp_attendance" onclick="deleteData('emp_attendance','att_id',<?= $fetchTimeOff['att_id'] ?>,'index.php?nav=<?= $_REQUEST["nav"] ?>&business=<?= $_REQUEST["business"] ?>',this)" href="#" class="btn btn-danger btn-xs">Remove</a>
											</div>
										<?php else : ?>
											<input type="hidden" value="<?= date('Y-m-d', strtotime($d)) ?>" name="days[]">
											<input type="hidden" value="<?= @$dated ?>" name="dated[]">
											<div><input style="border: none;border-bottom: 1px solid #eee" type="time" name="opening_time[]" class="autoSave" value="<?= @$fetchRoasterData['open_time'] ?>"></div>
											<div><input style="border: none;border-bottom: 1px solid #eee" type="time" name="closing_time[]" class="autoSave" value="<?= @$fetchRoasterData['close_time'] ?>"></div>

											<textarea style="text-align:center" name="work_assigned[]" id="" class="autoSave" placeholder="Add Role" rows="2"><?= @$fetchRoasterData['work_assigned'] ?></textarea>
										<?php endif; ?>
									</td>
								<?php $i++;
								endforeach; ?>

							</form>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table><!-- table -->
		</div><!-- table -->
	</div>
</div><!-- card -->