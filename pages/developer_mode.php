<div class="portlet light">

	<div class="card-header">

		<h3>Developer Mode</h3>

	</div><!-- header -->

	<div class="portlet-body">

		<div class="row">

			<div class="col-sm-4">

				<form action="" method="post">

					<div class="form-group">

						<input type="text" class="form-control" placeholder="Page Title" name="title" value="<?= @$fetchMenu['title'] ?>">

					</div><!-- group -->

					<div class="form-group">

						<input type="text" class="form-control" placeholder="Page File (.php)" name="page" value="<?= @$fetchMenu['page'] ?>">

					</div><!-- group -->

					<div class="form-group">

						<select name="parent_id" id="" class="form-control">

							<?php getSelectTag(@$fetchMenu['parent_id'], "Select Parent ID"); ?>

							<?php $q = mysqli_query($dbc, "SELECT DISTINCT(title),id FROM menus");

							while ($r = mysqli_fetch_assoc($q)) :

							?>

								<option value="<?= $r['id'] ?>"><?= $r['title'] ?></option>

							<?php endwhile; ?>

						</select>

					</div><!-- group -->

					<div class="form-group">

						<label for="">Icon</label>

						<table class="table table-condensed myTable">

							<thead>

								<tr>

									<th>Icon</th>

								</tr>

							</thead>

							<tbody>

								<?php

								$myfile = fopen("font-list.txt", "r") or die("Unable to open file!");

								$data = fread($myfile, filesize("font-list.txt"));

								fclose($myfile);

								$font_array = explode("\n", $data);

								foreach ($font_array as $icon) :

								?>

									<tr>

										<td>

											<label>

												<input type="radio" name="icon" value="<?= $icon ?>"> <span class="fa <?= $icon ?>"></span> <?= $icon ?>

											</label>

										</td>

									</tr>

								<?php endforeach; ?>

							</tbody>

						</table>

					</div><!-- group -->

					<?= @$menu_btn; ?>

				</form>

			</div><!-- col -->

			<div class="col-sm-8">

				<div class="table-responsive">

					<table class="table table-hover myTable">

						<thead>

							<tr>

								<th>Title</th>

								<th>Parent</th>

							</tr>

						</thead>

						<tbody>

							<?php $q = mysqli_query($dbc, "SELECT * FROM menus WHERE parent_id IS NOT NULL");

							while ($r = mysqli_fetch_assoc($q)) :

								$fetchParent = fetchRecord($dbc, "menus", "id", $r['parent_id']);

							?>

								<tr>

									<td>

										<strong><?= ucwords($r['title']) ?></strong>

										<br>

										<?= empty($r['page']) ? "Parent" : $r['page'] ?>

										<br>

										<a href="index.php?nav=<?= $_REQUEST['nav'] ?>&edit_menu_id=<?= base64_encode($r['id']) ?>">Edit</a> | <a href="#" onclick="deleteData('menus','id',<?= $r['id'] ?>,'index.php?nav=<?= $_REQUEST["nav"] ?>')" class="text-danger">Delete</a>

									</td>

									<td><?= empty($r['page']) ? "Parent" : $fetchParent['title'] ?></td>

								</tr>

							<?php endwhile; ?>

						</tbody>

					</table>

				</div>

			</div><!-- col -->

		</div><!-- row -->

	</div><!-- body -->

</div><!-- box -->

<div class="card">

	<div class="card-body">

		<h3>Backup and Restore Database</h3>

		<?php include_once 'inc/backup_code.php'; ?>

		<div class="row">

			<div class="col-sm-4">

				<form action="" method="post">

					<legend>Settings</legend>

					<?php $settings = explode('|', file_get_contents("settings.txt"));

					$label = ["server", "user", "password", "database", "directory"];

					?>

					<?php for ($i = 0; $i < count($settings) - 1; $i++) : ?>



						<div class="form-group">

							<label for="" class="text-capitalize"><?= $label[$i] ?></label>

							<input type="text" class="form-control" name="<?= $label[$i] ?>" placeholder="<?= $label[$i] ?>" value="<?= $settings[$i] ?>">

						</div><!-- group -->

					<?php endfor; ?>

					<button class="btn btn-primary btn-block" name="update_settings" type="submit">Update Settings</button>

				</form>

			</div><!-- col -->

			<div class="col-sm-8">

				<br> <br> <br> <br>

				<div class="row">

					<div class="col-sm-4">

						<form action="" method="post">

							<button type="submit" name="action" value="backup" class="thumbnail box">

								Backup Database

							</button>

						</form>

					</div><!-- col -->

					<div class="col-sm-4">

						<div class="btn-group">

							<button class="box btn btn-default btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

								Restore Backup <span class="caret"></span>

							</button>

							<ul class="dropdown-menu">

								<li><a href="#">

										<form action="" method="post" enctype="multipart/form-data">

											<div class="input-group">

												<input type="file" name="f">

												<span class="input-group-btn"><button type="submit" name="upload_back_file" class="btn btn-success btn-xs">Upload</button></span>

											</div>

											<input type="hidden" value="<?= @$settings[4] ?>/" name="backup_dir">

											<p class="text-muted">Upload File .sql , sql..gz</p>

										</form>

									</a></li>

								<?php

								if (is_dir($settings[4])) :

									$opendir = opendir($settings[4]);

									while ($r = readdir($opendir)) :

										$file_address = $settings[4] . "/" . $r;

										if ($r == "." or $r == "..") {
											continue;
										}

								?>

										<li>

											<div class="input-group">

												<a href="index.php?nav=<?= $_REQUEST['nav'] ?>&action=restore&backupfile=<?= $r ?>"><?= $r ?></a>

												<span class="input-group-btn"> <a href="<?= $file_address ?>" download class="btn btn-danger btn-xs center-block"><span class="glyphicon glyphicon-download"></span></a></span>

											</div>

										</li>

									<?php endwhile; ?>

								<?php else : ?>

									<li><a href="#">No File Found</a></li>

								<?php endif; ?>

							</ul>

						</div>

					</div><!-- col -->

				</div><!-- row -->

			</div><!-- col -->

		</div><!-- row -->

		<div class="row">

			<div class="col-sm-6">

				<h3>Permissions</h3>

				<pre> <?php print_r($permissions); ?> </pre>

			</div><!-- col -->

			<div class="col-ms-6">

				<h3>Current Roles</h3>

				<pre> <?php print_r($user_permission); ?> </pre>

				<h3>Access to Files</h3>

				<pre><?php print_r($files) ?> </pre>

			</div><!-- col -->

		</div><!-- row -->

	</div><!-- card body -->

</div><!-- card -->