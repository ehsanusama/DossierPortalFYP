<style>
	.bg-muted {
		opacity: 0.3;
	}
</style>
<div class="portlet light">
	<div class="portlet-body">
		<h3>Site Map</h3>
		<?php $getBusinessOwner = mysqli_query($dbc, "SELECT DISTINCT(user_id) FROM business");
		while ($fetchBusinesOwner = mysqli_fetch_assoc($getBusinessOwner)) :
			$fetchOwnerData = fetchRecord($dbc, "users", "user_id", $fetchBusinesOwner['user_id']);
		?>
			<details>
				<summary><b>User ID# : <?= $fetchOwnerData['user_id'] ?>) <?= ucwords($fetchOwnerData['user_first_name']) ?> <?= ucwords($fetchOwnerData['user_last_name']) ?></b> <i><?= strtolower($fetchOwnerData['user_email']) ?></i></summary>
				<?php $getUserBusiness = mysqli_query($dbc, "SELECT * FROM business WHERE user_id='$fetchOwnerData[user_id]'");
				while ($fetchUserBusiness = mysqli_fetch_assoc($getUserBusiness)) :
				?>
					<details style="margin-left: 20px">
						<summary>Business: <?= ucwords($fetchUserBusiness['business_name']) ?></summary>
						<table class="table table-bordered">
							<?php $getAssignBusinessUsers = mysqli_query($dbc, "SELECT * FROM assign_business WHERE business_id='$fetchUserBusiness[business_id]'");
							while ($fetchAssignBusinessUsers = mysqli_fetch_assoc($getAssignBusinessUsers)) :
								$fetchStaffData = fetchRecord($dbc, "users", "user_id", $fetchAssignBusinessUsers['user_id']);
								if (empty($fetchStaffData['user_id'])) {
									continue;
								}

								if (!empty($fetchStaffData['user_pic'])) {
									$pic = $fetchStaffData['user_pic'];
								} else {
									$pic = "default.png";
								}
								if ($fetchStaffData['user_status'] == "disabled") {
									$disabled = "bg-muted";
								} else {
									$disabled = "";
								}
							?>
								<tr class="<?= $disabled ?>">
									<td>
										<img src="img/staff/<?= $pic ?>" class="img img-responsive img-circle" width="64" height="64" hspace="10"> Staff ID#: <?= ucwords($fetchStaffData['user_id']) ?> <?= ucwords($fetchStaffData['user_first_name']) ?> <?= ucwords($fetchStaffData['user_last_name']) ?>
									</td>
								</tr>

							<?php endwhile; ?>
						</table>
					</details>
				<?php endwhile; ?>
			</details>
		<?php endwhile; ?>
	</div><!-- body -->
</div><!-- card -->