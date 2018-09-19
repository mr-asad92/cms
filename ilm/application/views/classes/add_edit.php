
<div id="rldFrm">

	<div class="panel panel-midnightblue">
		<div class="panel-body">
			<h4><?= $method ;?> Class</h4>
			<form action="<?= $submitUrl ?>" method="post">
				<div class="col-sm-4">
                        <?php
                            if($edit != false)
                            {
                                echo form_hidden('id',$class->id);
                            }

                        ?>
                        <select name="program_id" class="form-control">
							<?php foreach($programs as $program) : ?>
								<?php if($program->id == $class->program_id): ?>
									<option value="<?= $program->id ;?>" selected><?= $program->title ;?></option>
								<?php else:?>

                                   <option value="<?= $program->id ;?>"><?= $program->title ;?></option>

								<?php endif;?>
							<?php endforeach;?>
						</select>

					</div>
					<div class="col-sm-4">

						<input class="form-control" id="Name" name="title" placeholder="Class Name"
                               value="<?php
                                       if($edit != false)
                                       {
                                           echo $class->title;
                                       }

                                       ?>"
							   type="text">

					</div>
					<div class="col-sm-4">
						<button type="submit" class="btn btn-primary"><?= $method ;?> Class</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
