

<div class="container">
    <div class="panel panel-midnightblue">
        <div class="">
            <h4>Manage Permissions</h4>
        </div>
        <div class="panel-body">
            <div class="syllabus_table">
                <div class="table-responsive">
                    <form method="post" action="<?php echo base_url().'admin/manage_permissions';?>">
                        <table class="table table-bordered table-hover table-striped">
                            <tr>
                                <th>User Type</th>
                                <th><?php echo form_dropdown('userType', $userTypes,$selectedUser, 'class="form-control" onchange="getPermissions(this.value)"');?></th>
                            </tr>
                            <?php

                            foreach ($permissionsList as $permission){
                                if($permission['category'] != '') {
                                    echo "<tr>";
                                    ?>
                                    <td width='20'><input type='checkbox' name='permissions[]' <?php echo (in_array($permission["permissionID"], $userPermissions))?'checked="checked"':'';?> value='<?php echo $permission["permissionID"];?>'></td>
                                    <?php
                                    echo "<td>" . $permission['category'] . "</td>";
                                    echo "</tr>";
                                }
                            }
                            ?>

                            <tr>
                                <th></th>
                                <th><input type="submit" value="Save" class="btn btn-info"></th>
                            </tr>

                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
