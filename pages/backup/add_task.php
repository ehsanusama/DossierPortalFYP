<div class="portlet light">
	<div class="portlet-body">
		<h4>Task Management</h4>
		<form action="api/index.php" class="ajax-form" method="post">
			<?php @$btn_value = (empty($fetchTask)) ? "add" : "update"; ?>
			<input type="hidden" name="user_id" value="<?= @$fetchUser['user_id'] ?>">
			<input type="hidden" name="action" value="task_module">
			<input type="hidden" name="id" value="<?= @$fetchTask['id'] ?>">
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label for="">Business Name</label>
						<select name="business_id" id="" class="form-control">
							<?php
							$getEmployeeBusiness = mysqli_query($dbc, "SELECT * FROM assign_business WHERE user_id='$fetchUser[user_id]'");
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
						<label>Dated</label>
						<input autocomplete="off" type="text" placeholder="Dated" name="dated" required value="<?= @$fetchTask['dated'] ?>" class="form-control dateField">
					</div><!-- group -->
				</div><!-- col -->
			</div><!-- row -->
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group">
						<label>Project/Task Title</label>
						<input type="text" placeholder="Title" name="title" required value="<?= @$fetchTask['title'] ?>" class="form-control">
					</div><!-- group -->
				</div><!-- col -->
				<div class="col-sm-6">
					<div class="form-group">
						<label>Task List</label>
						<textarea name="description" id="" cols="30" rows="4" class="form-control"><?= @$fetchTask['description'] ?></textarea>
					</div><!-- group -->
				</div><!-- col -->
				<div class="col-sm-6">
					<div class="form-group">
						<label>Issues/Bugs</label>
						<textarea name="issues" id="" cols="30" rows="4" class="form-control"><?= @$fetchTask['issues'] ?></textarea>
					</div><!-- group -->
				</div><!-- col -->
				<div class="col-sm-12">
					<button class="btn btn-success" value="<?= $btn_value ?>" name="add_task_btn">Submit</button>
				</div><!-- col -->
			</div><!-- row -->
		</form>
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Task Detail</th>
						<th>Title</th>
						<?php if ($getRoleAdmin >= 1) : ?>
							<th>Action</th>
						<?php endif; ?>
					</tr>
				</thead>
				<tbody>
					<?php
					if ($getRoleAdmin >= 1) {
						$getTask = mysqli_query($dbc, "SELECT * FROM tasks ORDER BY dated DESC");
					} else {
						$getTask = mysqli_query($dbc, "SELECT * FROM tasks WHERE user_id='$fetchUser[user_id]' ORDER BY dated DESC");
					}
					while ($fetchTask = mysqli_fetch_assoc($getTask)) :
						$fetchEmployee = fetchRecord($dbc, "users", 'user_id', $fetchTask['user_id']);
					?>
						<tr>
							<td width="25%" class="text-capitalize"><strong>Task #: </strong><?= $fetchTask['id'] ?> <br>
								<strong>Dated: </strong><br><?= date('l, Y-m-d', strtotime($fetchTask['dated'])) ?>
								<br>
								<span class="badge badge-success"><strong>Staff Name: </strong><?= strtoupper($fetchEmployee['user_first_name'])  ?> <?= strtoupper($fetchEmployee['user_last_name'])  ?></span>
							</td>
							<td><strong>
									<?= ucwords($fetchTask['title']) ?>
								</strong>
								<p><a data-toggle="collapse" href="#tasks_<?= $fetchTask['id'] ?>">Details <span class="caret"></span></a>
								<div class="collapse" id="tasks_<?= $fetchTask['id'] ?>">
									<strong>Task List</strong> <br>
									<?= nl2br($fetchTask['description']) ?> <br>

									<strong>Issue(s)</strong> <br>
									<?= nl2br($fetchTask['issues']) ?> <br>
								</div>
								</p>
							</td>
							<?php if ($getRoleAdmin >= 1) : ?>
								<td>
									<a href="#!" onclick="deleteData('tasks','id',<?= $fetchTask['id'] ?>,'index.php?nav=<?= $_REQUEST["nav"] ?>&business=<?= @$_REQUEST['business'] ?>',this)" class="btn btn-danger btn-xs">Delete</a>
								</td>
							<?php endif; ?>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div><!-- body -->
</div><!-- card -->