	<h2 class="text-danger">Register Here</h2>
	<div class="panel panel-primary">
	<div class="panel-heading"> Register</div>
	<div class="panel-body"> 
	
<?php

	$attributes=array(
		'id'=>'registration_form',
		'class'=>'form-horizontal'

		);
	echo form_open('home/registration',$attributes);
	?>
	<div class="form-group">
		<?php
		
			$attr=array(
				'class'=>'form-control',
				'type'=>'text',
				'name'=>'username'
				);
		
			
			echo "<div class=\"col-sm-3 control-label\">".form_label('Username')."</div>";
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
			echo "<div class=\"col-sm-3 control-label\">".form_label('Password')."</div>";
			echo "<div class=\"col-sm-9\">".form_input($attr)."</div>";

		?>
	</div>	
	<div class="form-group">
		<?php
			$attr=array(
					'class'=>'form-control',
					'type'=>'email',
					'name'=>'email'
				);
			echo "<div class=\"col-sm-3 control-label\">".form_label('Email')."</div>";
			echo "<div class=\"col-sm-9\">".form_input($attr)."</div>";

		?>
	</div>
	<div class="form-group">
		<?php
			$attr_male=array(
					
					'type'=>'radio',
					'name'=>'gender',
					'value'=>'male',
					'checked'=>'checked'
				);
			$attr_female=array(
					
					'type'=>'radio',
					'name'=>'gender',
					'value'=>'female'
				);
			echo "<div class=\"col-sm-3 control-label\">".form_label('Gender')."</div>";
			echo "<div class=\"col-sm-9\">".form_input($attr_male)." Male ".form_input($attr_female)." Female</div>";
			

		?>
	</div>
	<div class="form-group">
		<?php
			$countries=array(
					
					'pak'=>'Pakistan',
					'ind'=>'India',
					'chi'=>'China',
					'jap'=>'Japan'
				);
			$attr="class='form-control'";
		
			
			echo "<div class=\"col-sm-3 control-label\">".form_label('Country')."</div>";
			echo "<div class=\"col-sm-9\">".form_dropdown('country',$countries,'pak',$attr)."</div>";
			

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