<?php
if ($this->session->flashdata('profile')) {
	$profile=$this->session->flashdata('profile');
	?>

	<table class="table table-striped table-condensed">
		<tr>
			<th colspan="5"><center>Profile</center></th>
		</tr>
		<tr>
			<th>ID</th>
			<th>Username</th>
			<th>Email</th>
			<th>Gender</th>
		</tr>


	<?php
	foreach ($profile as $value) {
		echo "<tr>";
		echo "<td>".$value->id."</td>";
		echo "<td>".$value->username."</td>";
		echo "<td>".$value->email."</td>";
		echo "<td>".$value->gender."</td>";
		echo "</tr>";
	}
}
	
?>
	</table>