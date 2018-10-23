
<div id="rldFrm">

    <div class="panel panel-midnightblue">
        <div class="panel-body">
            <h4> Add Fines</h4>
            <form action="<?php echo base_url().'admin/'.$formSubmitMethod;?>" method="post">


                <div class="col-sm-4">
                    <label for="" class="control-label">Section: </label>
                    <?php echo form_dropdown('sectionId', $sections, $finesData['sectionId'],'class="form-control"');?>
                </div>

                <div class="col-sm-4">
                    <label for="" class="control-label">Class: </label>
                    <?php echo form_dropdown('classId', $classes, $finesData['classId'],'class="form-control"');?>
                </div>

                <div class="col-sm-2">
                    <label for="" class="control-label">Fine: </label>
                    <input type="text" name="fine" class="form-control" value="<?php echo $finesData['fine'];?>">
                </div>

                <div class="col-sm-2">

                    <br>
                    <?php
                        if ($submitButtonTitle == 'Update'){
                            ?>
                            <input type="hidden" name="fineId" value="<?php echo $finesData['id']?>">
                            <?php
                        }
                    ?>
                    <input type="submit" class="btn btn-info" value="<?php echo $submitButtonTitle;?>" style="margin-top: 10px;">
                </div>


            </form>
        </div>
        </form>
    </div>
</div>


<div class="panel panel-midnightblue">
    <div class="panel-body">
        <h4> Fines List</h4>
        <table class="table table-stripped table-bordered table-hover table-condesend">
            <tr>
                <th>Section</th>
                <th>Class</th>
                <th>Fine</th>
                <th>Action</th>
            </tr>

            <?php
                foreach ($finesList as $fine){
                    $class = $this->admin_model->getClassName($fine['classId']);
                    $section = $this->admin_model->getSectionName($fine['sectionId']);
                    ?>
                    <tr>
                        <td><?php echo $section;?></td>
                        <td><?php echo $class;?></td>
                        <td><?php echo $fine['fine'];?></td>
                        <th><a href="<?php echo base_url().'admin/edit_fines/'.$fine['id'];?>">Edit</a></th>
                    </tr>
            <?php
                }
            ?>
        </table>
    </div>
    </form>
</div>
