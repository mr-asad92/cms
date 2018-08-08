<div class="panel panel-primary">
	
	<div class="panel-heading">Update To Do Task</div>
	<div class="panel-body">
		<?php
		$attr=array(
			'class'=>'form-horizontal'
			);
			echo form_open('admin/edit_task/'.$this->uri->segment(3),$attr);
			?>
			<div class="form-group">
				<div class="col-sm-3 control-label"><?php echo form_label('Task Title');?></div>
				<div class="col-sm-9"><?php
				$attr=array(
					'name'=>'task_title',
					'class'=>'form-control',
					'value'=>$task->task_title
					);
				echo form_input($attr);
				?></div>
			</div>
			<div class="form-group">
				<div class="col-sm-3 control-label"><?php echo form_label('Task Description');?></div>
				<div class="col-sm-9"><?php
				$attr=array(
					'name'=>'task_descr',
					'class'=>'form-control',
					'value'=>$task->task_descr,
					'rows'=>'5'
					);
				echo form_textarea($attr);
				?></div>
			</div>
			<div class="form-group">
				<div class="col-sm-4"></div>
				<div class="col-sm-8"><?php
				$attr=array(
					'class'=>'btn btn-info',
					'value'=>'Update'
					);

				echo form_submit($attr);

				?></div>

			</div>
			<?php
			echo form_close();

		?>
	</div>

</div>
<?php
	if ($this->session->flashdata('edit_msg') == "task has been updated") {
		echo "<p class=\"text-success\">".$this->session->flashdata('edit_msg').".</p>";
	}
	else{
		echo "<p class=\"text-danger\">".$this->session->flashdata('edit_msg')."</p>";
	}
?>