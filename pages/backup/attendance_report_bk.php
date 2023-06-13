<?php $business_id=base64_decode($_REQUEST['business']);
	$fetchBusinessData=fetchRecord($dbc,"business","business_id",$business_id); 
	$show_date=(empty($_REQUEST['dated']))?date('d-M-Y'):$_REQUEST['dated'];
	?>
<h2>Timesheet</h2>
<form action="" method="post">
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<label for="">Employee Name</label>
				<select name="emp_id" id="" class="form-control">
					<?php 
					$getEmployee=mysqli_query($dbc,"SELECT * FROM assign_business WHERE business_id='$business_id'");
					while($fetchEmployee=mysqli_fetch_assoc($getEmployee)):
						if(countWhen($dbc,"users","user_id",$fetchEmployee['user_id'])==0){
							continue;
						}
						$fetchEmployeeData=fetchRecord($dbc,"users","user_id",$fetchEmployee['user_id']);
					 ?>
					 <option <?php if(!empty($_REQUEST['emp_id']) AND $_REQUEST['emp_id']==$fetchEmployee['user_id']){echo "selected";} ?> value="<?=@$fetchEmployeeData['user_id']?>"><?=$fetchEmployeeData['user_first_name']?> <?=$fetchEmployeeData['user_last_name']?></option>
					<?php endwhile; ?>
				</select>
			</div><!-- group -->
		</div><!-- col -->
		<div class="col-sm-6">
			<div class="form-group">
				<label for="">Select Week</label>
				<input type="text" readonly autocomplete="off" class="form-control dateField"  name="dated" placeholder="Week" value="<?=@$show_date?>">
			</div><!-- group -->
		</div><!-- col -->
		<div class="form-group">
			<button class="btn btn-success" type="submit" name="report_btn">Submit</button>
		</div><!-- form-group -->
	</div><!-- row -->
</form>
<?php if (isset($_REQUEST['report_btn'])) : 
	$date_array=getStartAndEndDate(date('W',strtotime($_REQUEST['dated'])),date('Y',strtotime($_REQUEST['dated'])));
?>
<div class="card card-body">
	<center>
		<h3><?=date('d-M-Y',strtotime($date_array['start_date']))?> - <?=date('d-M-Y',strtotime($date_array['end_date']))?></h3>
	</center>
	<table class="table table-bordered table-condensed" style="font-size: 12px">
	<?php $i=0;
              foreach(dateRange($date_array['start_date'],$date_array['end_date']) as $d):
              	$dated=date('Y-m-d',strtotime($d));
              	$fetchEmployeeData=fetchRecord($dbc,"users","user_id",$_REQUEST['emp_id']);
              	$getTimeOff=mysqli_query($dbc,"SELECT * FROM emp_attendance WHERE emp_id='$_REQUEST[emp_id]' AND business_id='$business_id' AND att_date='$dated' AND status='leave'");
              	if(mysqli_num_rows($getTimeOff)>=1){
              		$fetchTimeOff=mysqli_fetch_assoc($getTimeOff);
              	}
              	$day=date('l',strtotime($d));
              	@$getStartShift=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM emp_attendance WHERE att_date='$dated' AND shift='start_shift' AND emp_id='$_REQUEST[emp_id]' AND business_id='$business_id'"));
              	@$getEndShift=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM emp_attendance WHERE att_date='$dated' AND shift='end_shift' AND emp_id='$_REQUEST[emp_id]' AND business_id='$business_id'"));
              	@$getStartBreak=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM emp_attendance WHERE att_date='$dated' AND shift='start_break' AND emp_id='$_REQUEST[emp_id]' AND business_id='$business_id'"));
              	@$getEndBreak=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM emp_attendance WHERE att_date='$dated' AND shift='end_break' AND emp_id='$_REQUEST[emp_id]' AND business_id='$business_id'"));

              	
				?>
				<?php if($i==0): ?>
					<tr>
						<th colspan="7" style="font-size: 14px">
							<?=strtoupper($fetchEmployeeData['user_first_name'])?> <?=strtoupper($fetchEmployeeData['user_last_name'])?> ordinary hours: ________hours ________ minutes per week / fortnight / other __________
							(circle appropriate option and insert information if required)
						</th>
						<th colspan="5" class="text-center" style="font-size: 14px">Overtime</th>
						<th colspan="2" class="text-center" style="font-size: 14px">Leave</th>
					</tr>
					<tr class="text-center" style="background: #fab1a0">
					<th>Days</th>
					<th>Start/CheckIn time</th> 
					<th>Break Start</th>
					<th>Break End</th>
					<th>End/CheckOut Time</th>
					<th>Other times/ Breaks (e.g. time of other unpaid breaks)</th>
					<th>Total (Hours minus unpaid breaks)</th>
					<th>Start time (e.g. 8:30am)</th> 
					<th>Start time of unpaid break (e.g. 12:30pm)</th>
					<th>Restart time (e.g. 1:30pm)</th>
					<th>Finish time (e.g. 5:00pm)</th>
					<th>Total (Hours minus unpaid breaks)</th>
					<th>Type (e.g. personal leave, etc.)</th>
					<th>Hours (hours minus unpaid breaks)</th>
				</tr>
				<?php endif; ?>
				<tr>
					<th><?=$day?><br><i style="font-size: 11px"><?=date('d-M-Y',strtotime($d))?></i></th>
					<?php if(!empty($fetchTimeOff) AND mysqli_num_rows($getTimeOff)>=1): ?>
					<th colspan="13" class="text-center bg-warning">
						Time Off <br>
						Reason: <?=@strtoupper($fetchTimeOff['reason'])?>
					</th>
					<?php else: ?>
					<th><?php if(!empty($getStartShift['att_time'])){echo date('h:i A',strtotime($getStartShift['att_time']));}?></th> 
					<th><?php if(!empty($getStartBreak['att_time'])){echo date('h:i A',strtotime($getStartBreak['att_time']));}?></th> 
					<th><?php if(!empty($getEndBreak['att_time'])){echo date('h:i A',strtotime($getEndBreak['att_time']));}?></th> 
					<th><?php if(!empty($getEndShift['att_time'])){echo date('h:i A',strtotime($getEndShift['att_time']));}?></th> 
					<th><?php 
						if(!empty($getStartShift['att_time'] ) AND !empty($getEndShift['att_time'])){
							$hour_shift= number_format(differenceInHours($getStartShift['att_time'],$getEndShift['att_time']),2);
						}
						if(!empty($getStartBreak['att_time'] ) AND !empty($getEndBreak['att_time'])){
							$hour_break= number_format(differenceInHours($getStartBreak['att_time'],$getEndBreak['att_time']),2);
						}
						if(!empty($getStartShift['att_time'] ) AND !empty($getEndShift['att_time']) AND !empty($getStartBreak['att_time'] ) AND !empty($getEndBreak['att_time'])){
							echo @($hour_shift-$hour_break)." hr(s)";
						}
						?> 
						
					</th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
				<?php endif; ?>
				</tr>
  <?php $i++; endforeach; ?>
	
</table>
</div>
<?php endif; ?>