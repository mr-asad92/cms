<?php
/**
 * Created by PhpStorm.
 * User: Hafiz Ali Hamza
 * Date: 8/15/2018
 * Time: 6:36 PM
 */
?>

<div class="panel panel-midnightblue">
    <div class="">
        <h4>Study Programs</h4>
    </div>
    <div class="panel-body">
        <div class="syllabus_table">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th class="text-center">Study Programs</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($programs as $program) :?>
                    <tr>
                            <td class="text-center"><?= $program->title ?></td>
                            <td class="text-center">
                                <a class="btn btn-primary"
                                   href="<?php echo base_url();?>programs/index/<?= $program->id?>">
                                    <i class="fa fa-pencil"></i>

                                </a>
                                <a class="btn btn-danger"
                                   href="<?php echo base_url();?>programs/delete/<?= $program->id?>">

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
