<div class="panel panel-primary">
	
	<div class="panel-heading">To Do List</div>
	<div class="panel-body">
	<?php if (is_array($todo_list)) { ?>
		<table class="table table-striped table-hover">
			<tr>
				<th>Task Title</th>
				<th>Task Description</th>
				<th>Actions</th>
			</tr>
			<?php

				foreach ($todo_list as $value) {
					echo "<tr>";
					echo "<td>".ucfirst($value->task_title)."</td>";
					echo "<td>$value->task_descr</td>";
					echo "<td><a href=\"".base_url()."admin/view_task/".$value->id."\">View</a> | <a href=\"".base_url()."admin/edit_task_view/".$value->id."\">Edit</a> | <a href=\"".base_url()."admin/delete_task/".$value->id."\">Delete</a></td>";
					echo "</tr>";
				}

			?>
		</table>
		<?php
			}
			else{
				echo "<p class=\"text-danger\">$todo_list</p>";
			}
		?>
	</div>

</div>
<?php
	if ($this->session->flashdata('del_msg') == "Task Deleted Successfully.") {
		echo "<p class=\"text-success\">".$this->session->flashdata('del_msg')."</p>";
	}
	else{
		echo "<p class=\"text-danger\">".$this->session->flashdata('del_msg')."</p>";
	}
?>