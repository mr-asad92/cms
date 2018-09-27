<div class="panel panel-midnightblue">
    <div class="pannel">
        <h4>Employee Details</h4>
    </div>

    <?php foreach ($users as $user): ?>

    <div class="panel-body">
        <div class="std-detail clearfix">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <div class="col-sm-8">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th> Name</th>
                                <td><?php echo $user->first_name . ' ' . $user->last_name;?></td>


                            </tr>
                            <tr>

                                <th>Email</th>
                                <td>
                                    <?php echo $user->email ;?>
                                </td>

                            </tr>
                            <tr>
                                <th>Qualification</th>
                                <td><?php echo $user->qualification ;?></td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td><?php echo ucfirst($user->gender) ;?></td>

                            </tr>

                            <tr>
                                <th>Date of Birth</th>
                                <td><?php echo $user->dob ;?></td>
                            </tr>

                            <tr>
                                <th>Mobile No</th>
                                <td><?php echo $user->phone_no ;?></td>

                            </tr>

                            <tr>
                                <th>C.N.I.C</th>
                                <td><?php echo $user->cnic ;?></td>
                            </tr>

                            <tr>
                                <th>Created Date</th>
                                <td><?php echo $user->created_at ;?></td>
                            </tr>

                            <tr>
                                <th>Modified Date</th>
                                <td><?php echo $user->modified_at ;?></td>
                            </tr>

                            <tr>
                                <th>Created By</th>
                                <td><?php echo $user->user_fname.' '.$user->user_lname ;?></td>
                            </tr>

                            <tr>
                                <th>Status</th>
                                <td colspan="3">
                                    <?php

                                    if ($user->is_approved == 0)
                                    {
                                        echo '<p class="text-danger">Disapproved</p>';
                                    }
                                    else
                                    {
                                        echo '<p class="text-success">Approved</p>';
                                    }
                                    ;?>
                                </td>
                            </tr>

                            <tr>
                                <?php if ($user->is_approved == 0) :?>
                                    <th>Disapproved By</th>
                                <?php else: ?>
                                    <th>Approved By</th>
                                <?php endif; ?>
                                <td><?php echo $user->usr_firstName.' '.$user->usr_lastName ;?></td>
                            </tr>

                            <tr>
                                <th>Address</th>
                                <td colspan="3"><?php echo $user->address ;?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-sm-3 col-sm-offset-1">

                        <?php if ($user->image_url != NULL) : ?>

                            <img src="<?php echo base_url(). $user->image_url ;?>"
                                 class="img-responsive">
                        <?php else: ?>

                            <img src="<?php echo base_url();?>assets/img/profile picture.png"
                                 class="img-responsive">

                        <?php endif; ?>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

</div>

