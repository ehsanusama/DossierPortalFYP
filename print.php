<?php include_once 'inc/functions.php'; ?>
<style>
	body,*{
		font-family: 'Calibri';
	}
</style>
<?php if(!empty($_REQUEST['action']) AND $_REQUEST['action']=="weekly_schedule"): 
	$date_array=getStartAndEndDate(date('W',strtotime($_REQUEST['dated'])),date('Y',strtotime($_REQUEST['dated'])));
	$business_id=base64_decode($_REQUEST['business_id']);
	$fetchBusinessData=fetchRecord($dbc,"business","business_id",$business_id);
	$show_date=(empty($_REQUEST['dated']))?date('Y-m-d'):$_REQUEST['dated'];
	?>
	<center>
		<u>
			<h1>STAFF SCHEDULE:WEEKLY</h1>
		</u>
	</center>
	<table border="0" width="98%" align="center">
		<tr>
			<td width="50%"><u><b>WEEK</b>: <?=$date_array['start_date']?> - <?=$date_array['end_date']?></u></td>
			<td width="50%" align="right"><u><b>BUSINESS NAME</b>: <?=strtoupper($fetchBusinessData['business_name'])?></u></td>
		</tr>
	</table>
	<table border="1" width="98%" align="center" cellspacing="0" style="text-align: center;">
		<tr style="font-size: 12px">
			<th>Staff</th>
			<?php foreach(dateRange($date_array['start_date'],$date_array['end_date']) as $d):
				?>
					<th>
						<?=date('D',strtotime($d))?> <br>
						<?=date('d/m/Y',strtotime($d))?> 
					</th>
				<?php endforeach; ?>
			<th>Hours</th>
		</tr>
		<?php $getEmployee=mysqli_query($dbc,"SELECT * FROM assign_business WHERE business_id='$business_id'");
			while($fetchEmployee=mysqli_fetch_assoc($getEmployee)):
				$fetchEmployeeData=fetchRecord($dbc,"users","user_id",$fetchEmployee['user_id']);
				if(countWhen($dbc,"users","user_id",$fetchEmployee['user_id'])==0 OR $fetchEmployeeData['user_status']!='enable'){
					continue;
				}
				

			 ?>
			 <tr style="font-size: 13px;">
			 	<td>
			 		<strong>Staff ID </strong> <?=$fetchEmployeeData['user_id']?>
			 		<br>
			 		<?=strtoupper($fetchEmployeeData['user_first_name'])?> <?=strtoupper($fetchEmployeeData['user_last_name'])?>
			 	</td>
			 	 <?php $grand_hour=$i=0;
              foreach(dateRange($date_array['start_date'],$date_array['end_date']) as $d):
              	$dated=date('Y-m-d',strtotime($d));
              	$query=mysqli_query($dbc,"SELECT * FROM roaster WHERE emp_id='$fetchEmployeeData[user_id]' AND business_id='$business_id' AND dated='$dated'");
              	$getTimeOff=mysqli_query($dbc,"SELECT * FROM emp_attendance WHERE emp_id='$fetchEmployeeData[user_id]' AND business_id='$business_id' AND att_date='$dated' AND status='leave'");
              	if(mysqli_num_rows($getTimeOff)>=1){
              		$fetchTimeOff=mysqli_fetch_assoc($getTimeOff);
              	}
					$count=mysqli_num_rows($query);
					if ($count==0) {
						$fetchRoasterData=[];
					}else{
						$fetchRoasterData=mysqli_fetch_assoc($query);
						@$times=json_decode($fetchRoasterData['times']);
					}
					@$hour= number_format(differenceInHours($times->opening_time,$times->closing_time),2);
					@$grand_hour=$grand_hour+$hour;
				?>
				
                <td>
                	<?php if(!empty($fetchTimeOff) AND mysqli_num_rows($getTimeOff)>=1):
                	echo strtoupper($fetchTimeOff['reason']);
                	 ?>

                	<?php else: ?>
                	<?php echo $hour; ?> <br>
                	<?=@$fetchRoasterData['work_assigned']?>
                <?php endif; ?>
                </td>
              <?php $i++; endforeach; ?>
              <td><?=$grand_hour?></td>
              </tr>
			<?php endwhile; ?>
	</table>
<?php endif; ?>