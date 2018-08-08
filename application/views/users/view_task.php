<?php
	if ($task) {
		?>
		<font class="text-info" style="font-size:33px;">
		Task Title: 
		</font>
		<font class="text-primary" style="font-size:27px;">
		<?php echo $task->task_title;?>
		</font><br>
		<font class="text-info" style="font-size:25px;">
		Task Adding Date: 
		</font>
		<font class="text-primary" style="font-size:20px;">
		( <?php echo $task->task_date;?> )
		</font><br><br>
		<font class="text-info" style="font-size:25px;">
		Task Body: 
		</font>
		<p class="text-info"><?php echo $task->task_descr;?></p>
		<?php
	}
	else{
		echo "<p class=\"text-danger\">Invalid Task ID.</p>";
	}
?>
