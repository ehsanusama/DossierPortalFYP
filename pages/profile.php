<div class="portlet light">

	<div class="portlet-title">

		<h3>Update Profile</h3>

	</div>

	<div class="portlet-body">

		<form action="api/index.php" method="post" class="ajax-form">

			<input type="hidden" name="action" value="update_user_profile">

			<div class="row">

				<div class="col-sm-12">

					<div class="panel panel-default panel-body">

						<div class="row">

							<div class="col-sm-6">

								<div class="form-group">

									<label for=""> First Name</label>

									<input type="text" name="user_first_name" value="<?= @$fetchUser['user_first_name'] ?>" class="form-control">

								</div><!-- group -->

							</div><!-- col -->

							<div class="col-sm-6">

								<div class="form-group">

									<label for=""> Last Name</label>

									<input type="text" name="user_last_name" value="<?= @$fetchUser['user_last_name'] ?>" class="form-control">

								</div><!-- group -->

							</div><!-- col -->

						</div><!-- row -->

					</div><!-- panel -->

				</div><!-- col -->

				<div class="col-sm-12">

					<div class="panel panel-default panel-body">

						<div class="form-group">

							<label for="">Username</label>

							<input type="text" name="username" value="<?= @$fetchUser['username'] ?>" class="form-control" disabled>

						</div><!-- group -->

						<div class="form-group">

							<label for="">User Email</label>

							<input type="text" name="user_email" value="<?= @$fetchUser['user_email'] ?>" class="form-control" disabled>

						</div><!-- group -->

						<div class="form-group">

							<label for="">Phone</label>

							<input type="text" name="user_phone" value="<?= @$fetchUser['user_phone'] ?>" class="form-control">

						</div><!-- group -->

					</div><!-- panel -->

				</div><!-- col -->

			</div><!-- row -->

			<button class="btn btn-primary" name="update_user_profile">Update Profile</button>

		</form>

	</div>

</div>

<div class="portlet light">

	<div class="card-header">

		<h3>Change Password</h3>

	</div>

	<div class="portlet-body">

		<div class="panel panel-default panel-body">

			<form action="api/index.php" class="ajax-form" method="post">

				<input type="hidden" name="action" value="update_password">

				<div class="from-group"><label for="">Old password</label><input type="password" class="form-control" name="old_password" placeholder="Old Password"></div>

				<div class="from-group"><label for="">New password</label><input type="password" class="form-control" name="new_password" placeholder="New Password"></div>

				<div class="from-group"><label for="">Confirm password</label><input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password"></div><br>

				<button class="btn btn-success" name="update_password">Update Password</button>

			</form>

		</div>

	</div><!-- body -->

</div><!-- box -->