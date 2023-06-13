<?php 
	include_once 'functions.php';
	 /*Delete*/
 if (!empty($_REQUEST['user_role'])) {
 	# code...
 	$user_role = $_REQUEST['user_role'];
	$assign_user_page=array();
	$getAssignRoles = mysqli_query($dbc,"SELECT * FROM assign_module WHERE user_role='$user_role'");
	while($fetchAssignRole = mysqli_fetch_assoc($getAssignRoles)){
		$assign_user_page[]=$fetchAssignRole['menu_page'];
	}
	$getMenu=mysqli_query($dbc,"SELECT * FROM menus WHERE parent_id IS NOT NULL");
		while($fetchMenu = mysqli_fetch_assoc($getMenu)):
			if (in_array($fetchMenu['page'], $assign_user_page)) {
				# code...
				$checked="checked";
			}else{
				$checked="";
			}
			if (empty($fetchMenu['parent_id'])) {
				# code...
				$indent="";
				$txt="(<span class='text-danger'>Parent</span>)";
				$disabled="disabled";
			}else{
				$disabled="";
				$txt='';
				$indent="style='margin-left:15px'";
			}
		 ?>
		 <div class="checkbox">
		 	<label class="lead" <?=@$indent?>>
		 		<input <?=@$checked?> <?=@$disabled?> type="checkbox" name="user_role_page[]" value="<?=$fetchMenu['page']?>"> <?=ucwords($fetchMenu['title']);?> <?=@$txt?>
		 	</label>
		 </div><!-- checkbox -->
		<?php endwhile;
 }
  ?>
