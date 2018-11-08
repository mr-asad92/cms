
<div id="rldFrm">

    <div class="panel panel-midnightblue">
        <div class="panel-body">
            <h4> Add Section</h4>
            <form action="<?php echo base_url().'admin/'.$formSubmitMethod;?>" method="post">

                <div class="col-sm-4">
                    <label for="" class="control-label">Class: </label>
                    <?php echo form_dropdown('classId', $classes, $section['class_id'],'class="form-control"');?>
                </div>

                <div class="col-sm-2">
                    <label for="" class="control-label">Title: </label>
                    <input type="text" name="title" class="form-control" value="<?php echo $section['title'];?>">
        </div>

                <div class="col-sm-2">

                    <br>
                    <?php
                        if ($submitButtonTitle == 'Update'){
                            ?>
                            <input type="hidden" name="sectionId" value="<?php echo $section['id']?>">
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
        <h4> Section List</h4>
        <table class="table table-stripped table-bordered table-hover table-condesend">
            <tr>
                <th>Section</th>
                <th>Class</th>
                <th>Action</th>
            </tr>

            <?php
                foreach ($sectionData as $data){
                    $class = $this->admin_model->getClassName($data['class_id']);
                    ?>
                    <tr>
                        <td><?php echo $data['title'];?></td>
                        <td><?php echo $class;?></td>
                        <th>
                            <a href="<?php echo base_url().'admin/edit_section/'.$data['id'];?>">Edit</a> |
                            <a href="<?php echo base_url().'admin/delete_section/'.$data['id'];?>">Delete</a>
                        </th>
                    </tr>
            <?php
                }
            ?>
        </table>
    </div>
    </form>
</div>
