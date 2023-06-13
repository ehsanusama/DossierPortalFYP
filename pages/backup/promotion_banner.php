<div class="portlet light">
	<div class="portlet-body">
		<form enctype="multipart/form-data" action="" method="post">
			<?php $btn = (empty($fetchPromotionBanner['id'])) ? "add" : "update"; ?>
			<input type="hidden" name="operation" value="<?= $btn_value ?>">
			<input type="hidden" name="id" value="<?= @base64_encode($fetchPromotionBanner['id']) ?>">
			<div class="form-group">
				<input type="file" name="f" class="form-control">
			</div><!-- group -->
			<div class="form-group">
				<label>Title</label>
				<input type="text" name="title" class="form-control" value="<?= @$fetchPromotionBanner['title'] ?>" required>
			</div><!-- group -->
			<div class="form-group">
				<label>URL/Link</label>
				<input type="text" name="link" class="form-control" value="<?= @$fetchPromotionBanner['link'] ?>" required>
			</div><!-- group -->
			<div class="form-group">
				<label>Status</label>
				<select name="status" class="form-control" id="" required>
					<option <?php if (!empty($fetchPromotionBanner) and $fetchPromotionBanner['status'] == "active") {
								echo "selected";
							} ?> value="active">Active</option>
					<option <?php if (!empty($fetchPromotionBanner) and $fetchPromotionBanner['status'] == "deactive") {
								echo "selected";
							} ?> value="deactive">Deactive</option>
				</select>
			</div><!-- group -->
			<button class="btn btn-success" type="submit" name="banner_btn">Submit</button>
		</form>
		<hr>
		<table class="table table-condensed table-striped">
			<thead>
				<tr>
					<th>Pic</th>
					<th>Title</th>
					<th>Link</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php $getBanner = mysqli_query($dbc, "SELECT * FROM promotions");
				while ($fetchBanner = mysqli_fetch_assoc($getBanner)) :
				?>
					<tr>
						<td><a href="img/promotion/<?= $fetchBanner['pic'] ?>" target="_blank">
								<img src="img/promotion/<?= $fetchBanner['pic'] ?>" class="img img-responsive" width="80" height="80" alt="" style="width: 80px;">
							</a></td>
						<td><?= $fetchBanner['title'] ?></td>
						<td><?= $fetchBanner['link'] ?></td>
						<td><?= $fetchBanner['status'] ?></td>
						<td>
							<a href="#!" onclick="deleteData('promotions','id',<?= $fetchBanner['id'] ?>,'index.php?nav=<?= $_REQUEST["nav"] ?>&business=<?= $_REQUEST['business'] ?>',this)" class="btn btn-danger btn-xs">Delete</a> |
							<a href="index.php?nav=<?= $_REQUEST["nav"] ?>&business=<?= $_REQUEST['business'] ?>&edit_promotion_id=<?= base64_encode($fetchBanner['id']) ?>" class="btn btn-primary btn-xs">Edit</a>

						</td>
					</tr>
				<?php endwhile; ?>
			</tbody>
		</table>
	</div><!-- body -->
</div><!-- card -->