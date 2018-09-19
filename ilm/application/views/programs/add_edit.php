<?php
/**
 * Created by PhpStorm.
 * User: Hafiz Ali Hamza
 * Date: 8/15/2018
 * Time: 6:28 PM
 */


?>


<div id="rldFrm">

    <div class="panel panel-midnightblue">
        <div class="panel-body">
            <h4><?= $method ;?> Study Program</h4>
            <form action="<?php echo $submitUrl?>" method="post">
                <?php if($edit != false): ?>
                <?php echo form_hidden('id',$program->id); ?>
                <?php endif;?>
                <div class="form-group">

                    <label class="control-label col-sm-1" for="Name">Name</label>
                    <div class="col-sm-3">

                        <input class="form-control" id="Name" name="title" placeholder="Study Program Name"
                               value="<?php
                                            if ($edit != false)
                                            {
                                                echo $program->title;
                                            }
                                        ?>" type="text">
                        <span class="field-validation-valid"></span>
                    </div>
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary"><?= $method ;?> Study Program</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
