
<div class="panel panel-info">
    <div class="panel-heading">


        <h4>List of Employees</h4>

        <a href="<?= base_url(); ?>authentication/register" style="margin-top:5px;" class="btn btn-primary btn-sm
        pull-right">Add Employee</a>
        <div class="options">
        </div>
    </div>
    <div class="panel-body std-panel infinite-scroll">
        <div class="std-detail clearfix">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table">
                        <thead>

                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Qualification</th>
                            <th>Created By</th>
                            <th>Date Created</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $count = 0; ?>
                        <?php foreach ($users as $user) : ?>
                            <tr>
                                <?php $count = $count + 1; ?>
                                <td><?php echo $count; ?></td>
                                <td><a href="<?php echo base_url().'users/userDetails/'.$user->id;?>"><?php echo
                                            $user->first_name . ' ' . $user->last_name ?></a></td>
                                <td><?php echo $user->email ; ?></td>
                                <td><?php echo $user->qualification ; ?></td>
                                <td><?php echo  $user->user_fname . ' ' . $user->user_lname;?></td>
                                <td><?php echo $user->created_at; ?></td>
                                <td>
                                    <?php
                                        if($user->role_id == 0)
                                        {
                                            echo 'Admin';
                                        }
                                        elseif($user->role_id == 1)
                                        {
                                            echo 'Clerk';
                                        }
                                        else
                                        {
                                            echo 'Accountant';
                                        }
                                    ?>


                                </td>
                                <td>
                                    <?php

                                        if($user->is_approved == 1)
                                        {
                                            echo '<p class="text-success">Approved</p>';
                                        }
                                        else
                                        {
                                            echo '<p class="text-danger">Disapproved</p>';
                                        }
                                    ?>

                                </td>

                                <td>

                                    <?php

                                        if ($user->is_approved == 1)
                                        {
                                            echo anchor('users/status/'. $user->id .'/'. $user->is_approved,'Disapprove');
                                        }

                                        else
                                        {
                                            echo anchor('users/status/'. $user->id .'/'. $user->is_approved,'Approve');
                                        }

                                    ?>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>