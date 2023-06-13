<div class="portlet light">

	<div class="card-header  with-border">

		<h3>Assign Rights to Roles</h3>

	</div><!-- header -->

	<form class="user_role_right_form" method="post" action="api/index.php">

		<input type="hidden" name="action" value="update_user_role_rights">

		<div class="row">

			<div class="col-sm-4 col-sm-offset-1">

				<div class="portlet-body">

					<h4>Application Roles</h4>

					<hr>

					<?php $getUserRole = mysqli_query($dbc, "SELECT * FROM user_roles WHERE user_role_status='enable'");

					while ($fetchUserRole = mysqli_fetch_assoc($getUserRole)) :

					?>

						<div class="radio">

							<label class="lead">

								<input id="user_role_radio" type="radio" name="user_role_name" value="<?= $fetchUserRole['user_role_name'] ?>"> <?= ucwords($fetchUserRole['user_role_name']); ?>

							</label>

						</div><!-- checkbox -->

					<?php endwhile; ?>

				</div><!-- user application -->

			</div><!-- col -->

			<div class="col-sm-6">

				<div class="card-body" id="list_role">

					<h4>Application Modules</h4>

					<hr>

					<span id="user_role_response">

						<?php $getMenu = mysqli_query($dbc, "SELECT * FROM menus WHERE parent_id IS NOT NULL");

						while ($fetchMenu = mysqli_fetch_assoc($getMenu)) :

						?>

							<div class="radio">

								<label class="lead">

									<input type="checkbox" name="user_role_list[]" value="<?= $fetchMenu['page'] ?>"> <?= ucwords($fetchMenu['title']); ?>

								</label>

							</div><!-- checkbox -->

						<?php endwhile; ?>

					</span>

				</div><!-- user application -->

			</div><!-- col -->

		</div><!-- row -->

		<button class="btn btn-primary hidden user_role_right_btn btn-block" type="submit">Update User Role</button>

	</form><!-- body -->

</div>

<!-- Box -->