<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title;?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

</head>
<body>
<div class="container">
	<div class="col-sm-4">
		<?php $this->load->view('users/user_login');?>
	</div>
	<div class="col-sm-8">
		<?php 

			$this->load->view('users/user_registration');
		?>
		
	</div>	
</div>
<div class="container">
	<?php $this->load->view('error/show_errors');?>
</div>
</body>
</html>