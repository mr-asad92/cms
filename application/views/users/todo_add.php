<div class="panel panel-primary">
	
	<div class="panel-heading">Add To Do Task</div>
	<div class="panel-body">
		<?php
		$attr=array(
			'class'=>'form-horizontal'
			);
			echo form_open('admin/todo_add_task',$attr);
			?>
			<div class="form-group">
				<div class="col-sm-3 control-label"><?php echo form_label('Task Title');?></div>
				<div class="col-sm-9"><?php
				$attr=array(
					'name'=>'task_title',
					'class'=>'form-control'
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
					'rows'=>'5'
					);
				echo form_textarea($attr);
				?></div>
			</div>
			<div class="form-group">
				<div class="col-sm-3 control-label"><?php echo form_label('Task Date');?></div>
				<div class="col-sm-9"><?php
				$attr=array(
					'name'=>'due_date',
					'class'=>'form-control',
					'type'=>'date'
					);
				// echo form_input($attr);
				?>
				<input type="date" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-4"></div>
				<div class="col-sm-8"><?php
				$attr=array(
					'class'=>'btn btn-info',
					'value'=>'Add'
					);

				echo form_submit($attr);

				?></div>

			</div>
			<?php
			echo form_close();

		?>
	</div>

</div>

<script type="text/javascript">
	// fix for date field in firefox
	webshims.setOptions('forms-ext',{types: 'date'});
	webshims.polyfill('forms forms-ext');
</script>