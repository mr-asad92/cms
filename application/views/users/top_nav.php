<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#headerNav">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="<?php echo base_url();?>admin/index" class="navbar-brand brand-padding"><span class="glyphicon glyphicon-home"></span> Home</a>
			</div>	
			<div id="headerNav" class="collapse navbar-collapse">
				<ul class="nav navbar-nav">

					<li><a href="#">Change Password</a></li>
					<li><a href="#">Change Profile</a></li>
					<li><a href="<?php echo base_url();?>admin/todo_add">Add To Do Task</a></li>
					<li><a href="<?php echo base_url();?>admin/todo_list">To Do List</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					
					<li><a href="<?php echo base_url();?>admin/logout" data-toggle="modal" data-target="#loginModal"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
					
				</ul>
			</div>
		</div>
	</nav>