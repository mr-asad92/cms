<h2 class="text-info">Login</h2>

<?php
	$attr=array(
		'class'=>'form-horizontal'
		);

	echo form_open('home_cont/login',$attr);
	?>
	<div class="panel panel-primary">
		
		<div class="panel-heading">Login</div>
		<div class="panel-body">
			<div class="form-group">
				<div class="col-sm-4 control-label">
					<?php echo form_label("Username");?>
				</div>
				<div class="col-sm-8">

					<?php
					$attr=array(
						'class'=>'form-control',
						'name'=>'username'
						);
					 echo form_input($attr);?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-4 control-label">
					<?php echo form_label("Password");?>
				</div>
				<div class="col-sm-8">

					<?php
					$attr=array(
						'class'=>'form-control',
						'name'=>'password'
						);
					 echo form_password($attr);?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-4">
					
				</div>
				<div class="col-sm-8">

					<?php
					$attr=array(
						'class'=>'btn btn-primary',
						'name'=>'submit',
						'value'=>'Login'
						);
					 echo form_submit($attr);?>
				</div>
			</div>
		</div>
	</div>


	<?php
	echo form_close();
?>