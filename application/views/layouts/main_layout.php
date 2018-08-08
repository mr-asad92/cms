<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title;?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/style.css">
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/custom.js"></script>
</head>
<body class="signin">

<?php $this->load->view($view);?>
 
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