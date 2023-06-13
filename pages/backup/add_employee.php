<div class="portlet light">
	<div class="portlet-title">
		<h3 class="pull-left">Manage Staff</h3>
		<a href="#modal-id" data-toggle="modal" title="load_staff_form|user_id|" class="btn btn-success pull-right modal-action">+ Add Staff</a>
	</div><!-- header -->
	<div class="portlet-body">
		<div class="row">
			<div class="col-sm-12">
				<form action="">
					<input type="hidden" name="nav" value="<?= @$_REQUEST['nav'] ?>">
					<input type="hidden" name="business" value="<?= @$_REQUEST['business'] ?>">
					<div class="form-group">
						<label for="">Search by Business</label>
						<div class="input-group">
							<select required name="search_business_id" class="form-control">
								<option value="">Choose Business</option>
								<option value="all">All</option>
								<?php $getBusiness = mysqli_query($dbc, "SELECT * FROM business WHERE user_id='$fetchUser[user_id]'");
								while ($fetchBusniess = mysqli_fetch_assoc($getBusiness)) : ?>
									<option <?php if (!empty($_REQUEST['search_business_id']) and $_REQUEST['search_business_id'] == $fetchBusniess['business_id']) {
												echo "selected";
											} ?> value="<?= @$fetchBusniess['business_id'] ?>"><?= ucwords($fetchBusniess['business_name']) ?></option>
								<?php endwhile; ?>
							</select>
							<span class="input-group-btn">
								<button type="submit" name="search_business" class="btn btn-success">Search</button>
							</span>
						</div><!-- input group -->
					</div><!-- group -->
				</form>
			</div><!-- col -->
		</div><!-- row -->
		<div class="row">
			<div class="col-sm-12">
				<div class="table-responsive panel panel-default panel-body">
					<table class="table myTable">
						<thead>
							<tr>
								<th class="">Staff Information</th>

								<th class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ($getRoleAdmin > 0) {
								$q = mysqli_query($dbc, "SELECT * FROM users INNER JOIN assign_user_role WHERE users.user_id=assign_user_role.user_id AND LOWER(assign_user_role.user_role)='employee'");
							} else {
								$q = mysqli_query($dbc, "SELECT * FROM users INNER JOIN assign_user_role WHERE users.user_id=assign_user_role.user_id AND LOWER(assign_user_role.user_role)='employee' AND users.user_created_id='$fetchUser[user_id]'");
							}
							while ($r = mysqli_fetch_assoc($q)) :
								@$fetchUserExtra = json_decode($r['user_extra']);
								if (!empty($_REQUEST['search_business_id']) and $_REQUEST['search_business_id'] != "all") {
									if (mysqli_num_rows(mysqli_query($dbc, "SELECT * FROM assign_business WHERE user_id='$r[user_id]' AND business_id='$_REQUEST[search_business_id]'")) == 0) {
										continue;
									}
								}
								if (!empty($r['user_pic'])) {
									$pic = $r['user_pic'];
								} else {
									$pic = "default.png";
								}
							?>
								<tr class="delete_area">
									<td class="text-uppsercase">

										<span style="margin-left: 100px">
											<strong>Satff ID</strong> <?= $r['user_id'] ?>
											<br>
										</span>
										<img src="img/staff/<?= $pic ?>" class="img img-responsive img-circle" width="80" height="80" align="left" hspace="10" style="width: 80px;">
										<strong><?= strtoupper($r['user_first_name']) ?> <?= strtoupper($r['user_last_name']) ?></strong> <br>
										<strong>Email: </strong><a href="mailto:<?= $r['user_email'] ?>"><?= $r['user_email'] ?></a><br>
										<strong>Phone: </strong><a href="tel:<?= $r['user_phone'] ?>"><?= $r['user_phone'] ?></a><br><br>
										<div style="margin-left: 100px">
											<strong>Designation: </strong> <?= @$r['designation'] ?> <br>
											<strong>User Name: </strong> <?= $r['username'] ?> <br>
											<strong>Encrypted Password: </strong> <br> <?= $r['user_password'] ?> <br>
											<div class="form-group">
												<?php @$checked = (strtolower($r['user_status']) == "enable") ? "checked" : ""; ?>

											</div>
										</div><!-- form group -->
									</td>

									<td class="">
										<div>
											<a href="#" onclick="deleteData('users','user_id',<?= $r['user_id'] ?>,'index.php?nav=<?= $_REQUEST['nav'] ?>',this)" class="btn btn-danger btn-sm "><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
											<a href="#modal-id" data-toggle="modal" title="load_staff_form|user_id|<?= @$r['user_id'] ?>" class="btn btn-primary  modal-action btn-sm"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
										</div>
										<br><br>
										<div>
											<a class="modal-action text-secondary" href="#modal-id" data-toggle="modal" title="load_user_roles|user_id|<?= $r['user_id'] ?>">+ Add Role</a> <br>
											<a class="modal-action text-secondary" href="#modal-id" data-toggle="modal" title="load_user_business_shift|user_id|<?= $r['user_id'] ?>">+ Manage Business Shift</a>
										</div>
										<br>
										<label for="">Account Status: </label>
										<label class="switch">
											<input title="users|<?= $r['user_id'] ?>" type="checkbox" class="switch-btn" name="user_status" value="yes" <?= @$checked ?>>
											<span class="slider round"></span>
											<span class="text-uppercase user_status"></span>
										</label>
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