<?php $fetchBusinessData = fetchRecord($dbc, "business", "business_id", $global_business); ?>
<div class="portlet light">
	<div class="portlet-body">

		<a href="#!" onclick="window.print()" class="pull-right text-right text-secondary hidden-print"><span class="fa fa-print"></span> Print QR Code</a>

		<center>

			<h1>Scan QR Code</h1>

			<img src="qrcode.php?data=<?= $fetchBusinessData['business_id'] ?>|<?= $fetchBusinessData['business_location'] ?>&size=450" class="img img-responsive" alt="">

			<hr>

			<h3>Business Name: <?= $fetchBusinessData['business_name'] ?></h3>

		</center>

	</div><!-- card body -->
</div>