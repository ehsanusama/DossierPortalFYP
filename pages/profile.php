<div class="portlet light">

	<div class="portlet-title">

		<h3>Update Profile</h3>

	</div>

	<div class="portlet-body">

		<form action="api/index.php" method="post" class="ajax-form">

			<input type="hidden" name="action" value="update_user_profile">

			<div class="row">
				<?php @$fetchUserExtra = (array) json_decode($fetchUser['user_extra']);
				?>
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
						<div class="row">

							<div class="col-sm-6">

								<div class="form-group">

									<label for="">DOB</label>

									<input type="date" name="user_dob" value="<?= @$fetchUser['user_dob'] ?>" class="form-control">

								</div><!-- group -->

							</div><!-- col -->

							<div class="col-sm-6">

								<div class="form-group">

									<label for="">Age</label>
									<input type="text" name="age" value="<?= @$fetchUserExtra['age'] ?>" class="form-control">

								</div><!-- group -->

							</div><!-- col -->

						</div><!-- row -->
						<div class="row">

							<div class="col-sm-6">

								<div class="form-group">

									<label for="">Domicile</label>

									<input type="text" name="domicile" value="<?= @$fetchUserExtra['domicile'] ?>" class="form-control">

								</div><!-- group -->

							</div><!-- col -->

							<div class="col-sm-6">

								<div class="form-group">

									<label for="">CNIC</label>
									<input type="text" name="cnic" value="<?= @$fetchUserExtra['cnic'] ?>" class="form-control">

								</div><!-- group -->

							</div><!-- col -->

						</div><!-- row -->
						<div class="row">

							<div class="col-sm-6">

								<div class="form-group">

									<label for="">Designation</label>

									<input type="text" name="designation" value="<?= @$fetchUser['designation'] ?>" class="form-control">

								</div><!-- group -->

							</div><!-- col -->

							<div class="col-sm-6">

								<div class="form-group">

									<label for="">Department</label>
									<input type="text" name="department" value="<?= @$fetchUserExtra['department'] ?>" class="form-control">

								</div><!-- group -->

							</div><!-- col -->

						</div><!-- row -->
						<div class="row">

							<div class="col-sm-6">

								<div class="form-group">

									<label for="">Total Post PhD Experience</label>

									<input type="text" name="phd_experience" value="<?= @$fetchUserExtra['phd_experience'] ?>" class="form-control">

								</div><!-- group -->

							</div><!-- col -->

							<div class="col-sm-6">

								<div class="form-group">

									<label for="">Total service on TTS</label>
									<input type="text" name="tts_service" value="<?= @$fetchUserExtra['tts_service'] ?>" class="form-control">

								</div><!-- group -->

							</div><!-- col -->

						</div><!-- row -->
						<div class="row">

							<div class="col-sm-6">

								<div class="form-group">

									<label for="">Date Of Appointment At NTU:</label>

									<input type="text" name="ntu" value="<?= @$fetchUserExtra['ntu'] ?>" class="form-control">

								</div><!-- group -->

							</div><!-- col -->

							<div class="col-sm-6">

								<div class="form-group">

									<label for="">Nationality</label>
									<input type="text" name="nationality" value="<?= @$fetchUserExtra['nationality'] ?>" class="form-control">

								</div><!-- group -->

							</div><!-- col -->

						</div><!-- row -->
						<div class="row">

							<div class="col-sm-6">

								<div class="form-group">

									<label for="">Total service as Assistant Professor</label>

									<input type="text" name="assistant_professor" value="<?= @$fetchUserExtra['assistant_professor'] ?>" class="form-control">

								</div><!-- group -->

							</div><!-- col -->

							<div class="col-sm-6">

								<div class="form-group">

									<label for="">Mid Term review (if applicable)</label>
									<input type="text" name="mid_term_review" value="<?= @$fetchUserExtra['mid_term_review'] ?>" class="form-control">

								</div><!-- group -->

							</div><!-- col -->

						</div><!-- row -->
						<div class="row">

							<div class="col-sm-12">

								<div class="form-group">

									<label for="">Address</label>

									<input type="text" name="user_address" value="<?= @$fetchUser['user_address'] ?>" class="form-control">

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