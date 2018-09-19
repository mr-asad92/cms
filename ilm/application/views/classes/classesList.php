<?php
/**
 * Created by PhpStorm.
 * User: Hafiz Ali Hamza
 * Date: 8/17/2018
 * Time: 5:29 PM
 */

?>
<div class="container">
<div class="panel panel-midnightblue">
	<div class="">
		<h4>Classes</h4>
	</div>
	<div class="panel-body">
		<div class="syllabus_table">
			<div class="table-responsive">
				<table class="table table-bordered table-hover table-striped">
					<thead>
					<tr>
						<th class="text-center">Study Programs</th>
						<th class="text-center">Classes</th>
						<th class="text-center">Action</th>
					</tr>
					</thead>
					<tbody>
                    <?php foreach($classes as $class) : ?>
					<tr>
						<td class="text-center"><?= $class->progTitle ;?></td>
						<td class="text-center"><?= $class->classTitle ;?></td>
							<td class="text-center">
                                <a class="btn btn-primary"
                                   href="<?php echo base_url();?>classes/index/<?= $class->id?>">
                                    <i class="fa fa-pencil"></i>

                                </a>
                                <a class="btn btn-danger"
                                   href="<?php echo base_url();?>classes/delete/<?= $class->id?>">

                                    <i  class="fa fa-trash-o" aria-hidden="true"></i>
                                </a>
							</td>
					</tr>
                    <?php endforeach;?>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</div>
