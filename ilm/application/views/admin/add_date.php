
<div id="rldFrm">

    <div class="panel panel-midnightblue">
        <div class="panel-body">
            <h4> Add Date</h4>
            <form action="<?php echo base_url().'admin/'.$formSubmitMethod;?>" method="post">


                <div class="col-sm-4">
                    <label for="" class="control-label">Section: </label>
                    <?php echo form_dropdown('sectionId', $sections, $dateData['sectionId'],'class="form-control"');?>
                </div>

                <div class="col-sm-4">
                    <label for="" class="control-label">Class: </label>
                    <?php echo form_dropdown('classId', $classes, $dateData['classId'],'class="form-control"');?>
                </div>

                <div class="col-sm-2">
                    <label for="" class="control-label">Date: </label>
                    <input type="text" name="toDate" class="form-control" value="<?php echo $dateData['to_date'];?>">
                </div>

                <div class="col-sm-2">

                    <br>
                    <?php
                    if ($submitButtonTitle == 'Update'){
                        ?>
                        <input type="hidden" name="dateId" value="<?php echo $dateData['id']?>">
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
            foreach ($datesList as $fine){
                $class = $this->admin_model->getClassNameWithProgramTitle($fine['classId']);
                $section = $this->admin_model->getSectionName($fine['sectionId']);
                ?>
                <tr>
                    <td><?php echo $section;?></td>
                    <td><?php echo $class;?></td>
                    <td><?php echo $fine['to_date'];?></td>
                    <th><a href="<?php echo base_url().'admin/edit_date/'.$fine['id'];?>">Edit</a></th>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
    </form>
</div>
