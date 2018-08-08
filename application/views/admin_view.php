<?php
	foreach ($profile as $value) {
		$id=$value->id;
		$username=$value->username;
		$email=$value->email;
		$gender=$value->gender;
		$country=$value->country;
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $username;?>'s Profile</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js-webshim/minified/polyfiller.js"></script>
</head>
<body>
<?php $this->load->view('users/top_nav');?>
<div class="container" style="padding-top:100px;">
	<?php $this->load->view('users/side_links');?>
	<div class="col-sm-8">
		<?php $this->load->view($view);?>
	</div>
</div>
<div class="container">
	<?php
		if ($this->session->flashdata('pass_update_msg')) {
			echo $this->session->flashdata('pass_update_msg');
		}
		if ($this->session->flashdata('change_pass_errors')) {
			echo $this->session->flashdata('change_pass_errors');
		}
		if ($this->session->flashdata('add_task_errors')) {
			echo $this->session->flashdata('add_task_errors');
		}
		if ($this->session->flashdata('task_added')) {
			echo $this->session->flashdata('task_added');
		}

	?>
</div>
<nav class="navbar navbar-default navbar-fixed-bottom">
		<div class="container">
			<div style="padding-top: 15px;">Copyright @ 2016, All Rights Reserved.</div>

		</div>
	</nav>
</body>
</html>