<div class="portlet light">
	<div class="portlet-title">
		<h3 class="pull-left">Manage Users</h3>
		<a href="#modal-id" data-toggle="modal" title="load_staff_form|user_id|" class="btn btn-success pull-right modal-action">+ Add New User</a>
	</div><!-- header -->
	<div class="portlet-body">
		<div class="row">
			<div class="col-sm-12">
				<form action="" method="get">
					<input type="hidden" name="nav" value="<?= @$_REQUEST['nav'] ?>">
					<input type="hidden" name="business" value="<?= @$_REQUEST['business'] ?>">
					<div class="form-group">
						<label for="">Select User Role</label>
						<select name="user_role_name" class="form-control" id="" onchange="form.submit()">
							<option value="">Select Role</option>
							<option value="all">All</option>
							<?php $getUserAllRole = mysqli_query($dbc, "SELECT * FROM user_roles");
							while ($fetchUserAllRole = mysqli_fetch_assoc($getUserAllRole)) :
							?>
								<option value="<?= strtolower($fetchUserAllRole['user_role_name']) ?>"><?= strtoupper($fetchUserAllRole['user_role_name']) ?></option>
							<?php endwhile; ?>
						</select>
					</div><!-- group -->
				</form>
				<div class="table-responsive panel panel-default panel-body">
					<table class="table myTable table-bordered" style="width: 100%;">
						<thead>
							<tr>
								<th class="">Full Name</th>
								<th class="text-center">Details</th>
								<th class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if (!empty($_REQUEST['user_role_name']) and $_REQUEST['user_role_name'] != 'all') {
								$q = mysqli_query($dbc, "SELECT * FROM users INNER JOIN assign_user_role WHERE users.user_id=assign_user_role.user_id AND assign_user_role.user_role='$_REQUEST[user_role_name]'");
							} else {
								$q = mysqli_query($dbc, "SELECT * FROM users");
							}

							while ($r = mysqli_fetch_assoc($q)) :
								@$fetchUserExtra = json_decode($r['user_extra']);
								$getBusinessData = mysqli_query($dbc, "SELECT * FROM business WHERE user_id='$r[user_id]'");
								$getAssignedBusinessData = mysqli_query($dbc, "SELECT * FROM assign_business WHERE user_id='$r[user_id]'");
								if (!empty($r['user_pic'])) {
									$pic = $r['user_pic'];
								} else {
									$pic = "default.png";
								}
							?>
								<tr class="delete_area">
									<td class="text-uppsercase" style="width: 35%;">

										<img src="img/staff/<?= $pic ?>" class="img img-responsive center-block img-circle" width="80" height="80" alt="" align="left" hspace="10" style="width: 80px;">
										<strong>User ID#</strong>: <?= $r['user_id'] ?>
										<br>
										<div style="margin-left: 100px">
											<strong><?= strtoupper($r['user_first_name']) ?> <?= strtoupper($r['user_last_name']) ?></strong> <br>
											<strong>Email: </strong><a href="mailto:<?= $r['user_email'] ?>"><?= $r['user_email'] ?></a><br>
											<strong>Phone: </strong><a href="tel:<?= $r['user_phone'] ?>"><?= $r['user_phone'] ?></a><br>
											<strong>Designation: </strong> <?= @$r['designation'] ?> <br>

											<strong>ABN: </strong> <?= @$fetchUserExtra->user_abn ?> <br>
											<strong>User Created Date: </strong> <?= @date('l, d-M-Y h:i A', strtotime($r['user_add_date'])) ?> <br>
											<strong>Current Role</strong> <br>
											<ul>
												<?php $getUserRole = mysqli_query($dbc, "SELECT * FROM assign_user_role WHERE user_id='$r[user_id]'");
												while ($fetchUserRole = mysqli_fetch_assoc($getUserRole)) :
												?>
													<li><?= strtoupper($fetchUserRole['user_role']) ?></li>
												<?php endwhile; ?>
											</ul>
										</div>
									</td>
									<td style="width: 25%;">

										<strong>User Name: </strong> <?= $r['username'] ?> <br>
										<strong>Password: </strong><?= $r['user_password'] ?> <br>
										<strong>Created Business (s): </strong> <br>
										<ol>
											<?php while ($fetchBusinessData = mysqli_fetch_assoc($getBusinessData)) : ?>
												<li><a class="dropdown-item modal-action" href="#modal-id" data-toggle="modal" title="load_business_form|business_id|<?= @$fetchBusinessData['business_id'] ?>"><?= strtoupper($fetchBusinessData['business_name']) ?></a></li>
											<?php endwhile; ?>
										</ol>

										<strong>Assigned Business for Attendance (s): </strong> <br>
										<ol>
											<?php while ($fetchAssignedBusinessData = mysqli_fetch_assoc($getAssignedBusinessData)) :
												$fetchBusinessDataAssigned = fetchRecord($dbc, "business", "business_id", $fetchAssignedBusinessData['business_id']);
											?>
												<li><a class="dropdown-item modal-action" href="#modal-id" data-toggle="modal" title="load_business_form|business_id|<?= @$fetchAssignedBusinessData['business_id'] ?>"><?= strtoupper($fetchBusinessDataAssigned['business_name']) ?></a></li>
											<?php endwhile; ?>
										</ol><br>


									</td>
									<td style="width: 25%;">
										<div>
											<a href="#" onclick="deleteData('users','user_id',<?= $r['user_id'] ?>,'index.php?nav=<?= $_REQUEST['nav'] ?>',this)" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
											<a href="#modal-id" data-toggle="modal" title="load_staff_form|user_id|<?= @$r['user_id'] ?>" class="btn btn-primary btn-sm modal-action"> <i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
										</div>
										<br><br>
										<div>
											<a class="modal-action text-secondary" href="#modal-id" data-toggle="modal" title="load_user_roles|user_id|<?= $r['user_id'] ?>">+ Add Role</a> <br>
											<a class="modal-action text-secondary" href="#modal-id" data-toggle="modal" title="load_user_business_shift|user_id|<?= $r['user_id'] ?>">+ Manage Business Shift</a> <br>
										</div>
										<br><br>
										<div class="form-group">
											<?php @$checked = (strtolower($r['user_status']) == "enable") ? "checked" : ""; ?>
											<span for="">Account Status:
												<label class="switch">
													<input title="users|<?= $r['user_id'] ?>" type="checkbox" class="switch-btn" name="user_status" value="yes" <?= @$checked ?>>
													<span class="slider round"></span>
												</label>
											</span>
										</div><!-- form group -->
									</td>
								</tr>
							<?php endwhile; ?>
						</tbody>
					</table>
				</div>
			</div><!-- col -->
		</div><!-- row -->
	</div><!-- body -->
</div><!-- box -->