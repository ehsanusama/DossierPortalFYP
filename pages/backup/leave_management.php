<?php $business_id = base64_decode($_REQUEST['business']);
$fetchBusinessData = fetchRecord($dbc, "business", "business_id", $business_id);
$show_date = (empty($_REQUEST['dated'])) ? date('d-M-Y') : $_REQUEST['dated'];
?>
<div class="portlet light">
	<div class="portlet-body">
		<h4>Leave Management</h4>
		<?php if (!empty($_REQUEST['business'])) : ?>
			<div class="row">
				<div class="col-sm-12">
					<form action="api/index.php" method="post" class="ajax-form">
						<input type="hidden" name="action" value="leave_management">
						<input type="hidden" value="<?= @$global_business ?>" name="business_id">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="">Employee</label>
									<select name="emp_id" required id="" class="form-control">
										<option value="">Select Employee</option>
										<?php foreach (getBusinessEmployee($dbc, $global_business) as $emp) : ?>
											<option value="<?= $emp['user_id'] ?>"><?= $emp['user_first_name'] ?> <?= $emp['user_last_name'] ?></option>
										<?php endforeach; ?>
									</select>
								</div><!-- group -->
							</div><!-- col -->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="">Status</label>
									<select name="status" id="" class="form-control">
										<option value="">Status</option>
										<?php foreach ($attendance_status as $status) : ?>
											<option value="<?= $status ?>"><?= strtoupper($status) ?></option>
										<?php endforeach; ?>
									</select>
								</div><!-- group -->
							</div><!-- col -->
						</div><!-- row -->
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="">From Date</label>
									<input type="text" autocomplete="off" class="form-control" id="from" name="from_date" placeholder="From Date" required>
								</div><!-- group -->
							</div><!-- col -->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="">To Date</label>
									<input type="text" autocomplete="off" class="form-control" id="to" placeholder="To Date" name="to_date" required>
								</div><!-- group -->
							</div><!-- col -->
						</div><!-- row -->
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label for="">Reason / Remarks / Notes</label>
									<textarea name="description" class="form-control" id="" cols="30" rows="4" placeholder="(Optional)"></textarea>
								</div><!-- group -->
							</div><!-- col -->
						</div><!-- row -->
						<div class="row">
							<div class="col-sm-12">
								<center>
									<div class="btn-group">
										<button type="submit" name="leave_btn" class="btn btn-primary"><span class="fa fa-check-circle"></span> Submit Leave</button>
										<button data-toggle="collapse" type="button" data-target="#showSearchLeave" class="btn btn-success"><span class="fa fa-search"></span> Search</button>
										<button data-toggle="collapse" type="button" data-target="#showLeaveRequest" class="btn btn-warning"><span class="fa fa-eye-open"></span> View Leave Request(s)</button>
									</div><!-- group -->
								</center>
							</div><!-- col -->
						</div><!-- row -->
					</form>
				</div><!-- col -->
			</div><!-- row -->
			<br>
			<form action="" class="collapse" id="showSearchLeave" method="post">
				<input type="hidden" name="action" value="load_leave_management">
				<legend>Search Leave</legend>
				<div class="row">
					<div class="col-sm-4">
						<div class="form-group">
							<label for="">Employee</label>
							<select name="emp_id" id="" class="form-control">
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
					<div class="col-sm-4">
						<div class="form-group">
							<label for="">From Date</label>
							<input type="text" autocomplete="off" class="form-control from" name="from_date" placeholder="From Date" required>
						</div><!-- group -->
					</div><!-- col -->
					<div class="col-sm-4">
						<div class="form-group">
							<label for="">To Date</label>
							<input type="text" autocomplete="off" class="form-control to" placeholder="To Date" name="to_date" required>
						</div><!-- group -->
					</div><!-- col -->
					<div class="form-group">
						<button type="submit" name="leave_search_btn" class="btn btn-primary">Submit</button>
					</div>
				</div><!-- row -->
			</form>
			<!-- Veiw Leave Request -->
			<form action="" class="collapse" id="showLeaveRequest" method="post">
				<input type="hidden" name="action" value="load_leave_request">
				<legend>Leave Request</legend>
				<div class="row">
					<div class="col-sm-4">
						<div class="form-group">
							<label for="">Employee</label>
							<select name="emp_id" id="" class="form-control">
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
					<div class="col-sm-4">
						<div class="form-group">
							<label for="">From Date</label>
							<input type="text" autocomplete="off" class="form-control from" name="from_date" placeholder="From Date" required>
						</div><!-- group -->
					</div><!-- col -->
					<div class="col-sm-4">
						<div class="form-group">
							<label for="">To Date</label>
							<input type="text" autocomplete="off" class="form-control to" placeholder="To Date" name="to_date" required>
						</div><!-- group -->
					</div><!-- col -->
					<div class="form-group">
						<button type="submit" name="leave_request_btn" class="btn btn-primary">Submit</button>
					</div>
				</div><!-- row -->
			</form>

			<div id="search_data"></div>
		<?php else : ?>
			<center>
				<h3>Please Choose business first</h3>
			</center>
		<?php endif; ?>
	</div><!-- card body -->
</div><!-- card -->