
<div id="rldFrm">

    <div class="panel panel-midnightblue">
        <div class="panel-body">
            <h4> Add Examination Type</h4>
            <form action="<?php echo base_url().'admin/'.$formSubmitMethod;?>" method="post">

                <div class="col-sm-2">
                    <label for="" class="control-label">Title: </label>
                    <input type="text" name="title" class="form-control" value="<?php echo $examType['title'];?>">
                </div>

                <div class="col-sm-2">

                    <br>
                    <?php
                    if ($submitButtonTitle == 'Update'){
                        ?>
                        <input type="hidden" name="examTypeId" value="<?php echo $examType['id']?>">
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
        <h4> Exam Type List</h4>
        <table class="table table-stripped table-bordered table-hover table-condesend">
            <tr>
                <th>Title</th>
                <th>Action</th>
            </tr>

            <?php
            foreach ($examTypeList as $examType){
                ?>
                <tr>
                    <td><?php echo $examType['title'];?></td>
                    <th><a href="<?php echo base_url().'admin/edit_examination_types/'.$examType['id'];?>">Edit</a> | <a href="<?php echo base_url().'admin/delete_examination_types/'.$examType['id'];?>">Delete</a></th>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
    </form>
</div>
