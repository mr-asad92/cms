<?php
	foreach ($profile as $value) {
		$id=$value->id;
		$username=$value->username;
		$email=$value->email;
		$gender=$value->gender;
	}

?>
<div class="panel panel-primary">
			
			<div class="panel-heading">Profile</div>
			<div class="panel-body">
				<table class="table table-striped ">
					<tr>
						<th>User ID</th>
						<td><?php echo $id;?></td>
					</tr>
					<tr>
						<th>Username</th>
						<td><?php echo $username;?></td>
					</tr>
					<tr>
						<th>Email</th>
						<td><?php echo $email;?></td>
					</tr>
					<tr>
						<th>Gender</th>
						<td><?php echo $gender;?></td>
					</tr>

				</table>
			</div>
		</div>