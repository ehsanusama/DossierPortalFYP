<?php $business_id = base64_decode($_REQUEST['business']);
$fetchBusinessData = fetchRecord($dbc, "business", "business_id", $business_id);
$show_date = (empty($_REQUEST['dated'])) ? date('d-M-Y') : $_REQUEST['dated'];
$img = (!empty($fetchBusinessData['business_logo'])) ? "img/" . $fetchBusinessData['business_logo'] : "../img/logo.png";
?>
<style>
	.print-card-box {
		width: 350px;
		margin: auto;
		min-height: 400;
		/*background-color: red;*/
		border-radius: 10px 10px 0 0;
	}

	.print-card-box-header {
		width: 100%;
		height: 200px;
		/*background: green;*/
		background-image: url(<?= $img ?>);
		background-size: cover;
		background-position: center center;
		background-repeat: no-repeat;
		border-radius: 10px 10px 0 0;

	}

	.print-card-box-body {
		width: 100%;
		min-height: 350px;
		background: #D2A934;
		padding: 20px;
		position: relative;
	}

	.print-card-box-footer {
		width: 100%;
		background: #202020;
		padding: 5px;
		text-align: center;
		color: #fff;
		font-size: 14px;
	}

	.print-card-box-header-overlay {
		height: 100%;
		width: 100%;
		background: rgba(0, 0, 0, 0.6);
		padding: 20px;
		border-radius: 10px 10px 0 0;
	}

	.header-overlay-text {
		/*position: absolute;*/
		color: #fff;
		font-weight: 400;
		font-size: 1.6em;
		text-align-last: center;
		display: block;
		line-height: 16px;
		margin: auto;
		font-style: normal;
		font-family: "Apple Chancery";
	}

	.pic-box {
		height: 150px;
		width: 150px;
		position: absolute;
		top: -105px;
		left: 105px;
	}

	.pic-box img {
		width: 100%;
		height: 100%;
	}

	.main-heading {
		text-align: center;
		font-weight: 900;
		margin-top: 25px;
	}

	.sub-heading {
		font-weight: 500;
		font-size: 14px;
		text-align: center;
		display: block;
	}

	.card-table tr,
	th,
	td,
	thead,
	tbody,
	tfoot {
		border: none !important;
		font-size: 14px;
		background: #D2A934 !important;
		padding: 10px;
	}

	@media print {

		.card-table tr,
		th,
		td,
		thead,
		tbody,
		tfoot {
			background: #D2A934 !important;
		}
	}

	.qr-img {
		margin-top: 40px;
	}
</style>
<div class="portlet light">
	<div class="portlet-body">
		<h2 class="hidden-print">Print Employee/Staff Card</h2>
		<a href="#" id="download_link"></a>

		<form action="" method="post" class="hidden-print">
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group">
						<label for="">Employee Name</label>
						<select name="emp_id" id="" class="form-control select2">
							<?php
							$getEmployee = mysqli_query($dbc, "SELECT * FROM assign_business WHERE business_id='$business_id'");
							while ($fetchEmployee = mysqli_fetch_assoc($getEmployee)) :
								if (countWhen($dbc, "users", "user_id", $fetchEmployee['user_id']) == 0) {
									continue;
								}
								$fetchEmployeeData = fetchRecord($dbc, "users", "user_id", $fetchEmployee['user_id']);
							?>
								<option <?php if (!empty($_REQUEST['emp_id']) and $_REQUEST['emp_id'] == $fetchEmployee['user_id']) {
											echo "selected";
										} ?> value="<?= @$fetchEmployeeData['user_id'] ?>"><?= strtoupper($fetchEmployeeData['user_first_name']) ?> <?= strtoupper($fetchEmployeeData['user_last_name']) ?></option>
							<?php endwhile; ?>
						</select>
					</div><!-- group -->
				</div><!-- col -->
				<div class="col-sm-12">
					<div class="form-group text-right">
						<button class="btn btn-success" type="submit" name="print_card_btn">Submit</button>
					</div><!-- form-group -->
				</div>
			</div><!-- row -->
		</form>
		<?php if (isset($_REQUEST['print_card_btn'])) :
			$fetchEmployeeData = fetchRecord($dbc, "users", "user_id", $_REQUEST['emp_id']);
			if (!empty($fetchEmployeeData['user_pic'])) {
				$pic = $fetchEmployeeData['user_pic'];
			} else {
				$pic = "default.png";
			}
		?>
			<div class="print-card-box">
				<div class="print-card-box-header">
					<div class="print-card-box-header-overlay">
						<span class="header-overlay-text text-capitalize">
							<?= @$fetchBusinessData['business_name'] ?>
						</span>
					</div><!-- overlay -->
				</div><!-- header -->
				<div class="print-card-box-body">
					<div class="pic-box">
						<img src="img/staff/<?= $pic ?>" class="img-responsive img-circle" alt="">
					</div><!-- pic-box -->
					<h2 class="main-heading text-uppercase"><?= @$fetchEmployeeData['user_first_name'] ?>
						<span class="sub-heading"><?= @$fetchEmployeeData['designation'] ?></span>
					</h2>

					<table class="card-table" width="100%">
						<tr>
							<th></th>
							<th align="center" rowspan="3">
								<center>
									<img src="qrcode.php?data=<?= $fetchEmployeeData['user_id'] ?>&size=80" width="80" height="80" class="img-responsive qr-img">
								</center>
							</th>
							<th></th>
						</tr>
						<tr>
							<td align="right">
								<b>ID#</b> <br>
								<?= @$fetchEmployeeData['user_id'] ?>
							</td>

							<td align="left"><b>DOB</b> <br>
								<?= @date('d-M-Y', strtotime($fetchEmployeeData['user_dob'])) ?></td>
						</tr>
						<tr>
							<td align="right">
								<b>Date of Join</b> <br>
								<?= @date('d-M-Y', strtotime($fetchEmployeeData['user_join_date'])) ?>
							</td>
							<td align="left"><b>Team</b> <br>
								<?= @ucwords($fetchEmployeeData['user_team']) ?></td>

						</tr>
					</table>
					<center>
						<b>Email</b> <br>
						<?= @strtolower($fetchEmployeeData['user_email']) ?>
					</center>
				</div><!-- body -->
				<div class="print-card-box-footer">
					<?= @strtoupper($fetchBusinessData['business_email']) ?>
					<br>
					<span style="font-size: 9px;">Powered by: ATTENDEZZ.COM</span>
				</div><!-- footer -->
			</div><!-- box -->
		<?php endif; ?>
	</div><!-- card -->
</div><!-- card -->