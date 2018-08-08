	<h2 class="text-danger">Login Here</h2>
	<div class="panel panel-primary">
	<div class="panel-heading"> Login</div>
	<div class="panel-body"> 
	
<?php

	$attributes=array(
		'id'=>'login_form',
		'class'=>'form-horizontal'

		);
	echo form_open('home/login',$attributes);
	?>
	<div class="form-group">
		<?php
		
			$attr=array(
				'class'=>'form-control',
				'type'=>'text',
				'name'=>'username'
				);
			
			echo "<div class=\"col-sm-3\">".form_label('Username')."</div>";
			echo "<div class=\"col-sm-9\">".form_input($attr)."</div>";

		?>
	</div>

	<div class="form-group">
		<?php
		
			$attr=array(
					'class'=>'form-control',
					'type'=>'password',
					'name'=>'password'
				);

			
			echo "<div class=\"col-sm-3\">".form_label('Password')."</div>";
			echo "<div class=\"col-sm-9\">".form_input($attr)."</div>";

		?>
	</div>	
	<div class="form-group">
		<?php
		$attr=array(
				'type'=>'submit',
				'value'=>'Login',
				'name'=>'submit',
				'class'=>'btn btn-success'
			);
			echo "<div class=\"col-sm-3\">"."<div class=\"col-sm-3\">".form_hidden("hidden","true")."</div>"."</div>";
		
			echo "<div class=\"col-sm-9\">".form_input($attr)."</div>";
		?>
	</div>


<?php
	echo form_close();
?>
</div>
</div>