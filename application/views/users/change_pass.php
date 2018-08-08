<?php
	foreach ($profile as $value) {
		$id=$value->id;
		$username=$value->username;
		$email=$value->email;
		$gender=$value->gender;
		$country=$value->country;
	}

?>

<?php
	$attr=array(
		'class'=>'form-horizontal'
		);
	echo form_open('admin/change_password', $attr);
?>
	<div class="panel panel-primary">
		<div class="panel-heading">Change Password</div>
		<div class="panel-body">
			 <div class="form-group">
			 	<div class="col-sm-3"><?php echo form_label('Old Password: ')?> </div>
			 	<div class="col-sm-8">
			 	<?php
			 		$data=array(
			 			'class'=>'form-control',
			 			'name'=>'old_password'
			 			);
			 		echo  form_input($data);

			 		 ?>
			 		 </div>
			 </div>
			 <div class="form-group">
			 	<div class="col-sm-3"><?php echo form_label('New Password: ')?> </div>
			 	<div class="col-sm-8">
			 	<?php
			 		$data=array(
			 			'class'=>'form-control',
			 			'name'=>'new_password'
			 			);
			 		echo  form_input($data);

			 		 ?>
			 		 </div>
			 </div>
			 <div class="form-group">
			 	<div class="col-sm-3"><?php echo form_label('Confirm Password: ')?> </div>
			 	<div class="col-sm-8">
			 	<?php
			 		$data=array(
			 			'class'=>'form-control',
			 			'name'=>'c_password'
			 			);
			 		echo  form_input($data);

			 		 ?>
			 		 </div>
			 </div>
			 <div class="form-group">
			 	<div class="col-sm-3">
			 	<input type="hidden" name="id" value="<?php echo $id;?>">
			 	</div>
			 	<div class="col-sm-8">
			 	<?php
			 		$data=array(
			 			'class' => 'btn btn-info',
			 			'name' => 'submit',
			 			'value' => 'Submit'
			 			);
			 		echo  form_submit($data);

			 		 ?>
			 		 </div>
			 </div>
		</div>

	</div>

<?php
	echo form_close();

?>