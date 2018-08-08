<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title;?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/style.css">
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
</head>
<body class="signin">

<div class="container">
	<div class="col-sm-4">
		<?php $this->load->view('users/login_view.php');?>
	</div>

	<div class="col-sm-8">
		<?php $this->load->view('users/register_view');?>
	</div>
</div>
 
<div class="container">
	<?php 
		if ($this->session->flashdata('errors')) {
			$this->load->view('error/errors.php');
		}
		if ($this->session->flashdata('profile')) {
			$this->load->view('users/profile.php');
		}
		if ($this->session->flashdata('msg')) {
			echo $this->session->flashdata('msg');
		}
		if ($this->session->flashdata('login_error_msg')) {
			echo $this->session->flashdata('login_error_msg');
		}

	?>
</div>
</body>
</html>