
<link href='<?php echo base_url();?>assets/plugins/datatables/dataTables.css' rel='stylesheet' type='text/css' media='all' id='headerswitcher'>

<div class="container">
    <div class="panel panel-info">
        <div class="panel-heading ">
            <h4>Search Accounts</h4>
        </div>
        <div class="panel-body">
            <div class="col-sm-12">
                <form action="/Admission/Fee" class="" method="get" novalidate="novalidate">                    <div class="mb5 clearfix">
                        <h4 class="pull-left"><strong>Enter any of the following field data to search</strong></h4>
                        <button type="submit" class="btn btn-primary pull-right"><span class="fa fa-search"></span>  Search</button>
                        <a href="<?php echo base_url();?>accounts" data-toggle="tooltip" title="Refresh Search"
                           class="pull-right btn
                        btn-info"><i
                                class="fa fa-refresh" aria-hidden="true"></i> Refresh</a>

                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label for="EnrollmentNo">Account Name</label>
                            <input class="form-control" name="account_name" type="text">
                        </div>
                        <div class="col-sm-2">
                            <label class="control-label" for="DateFrom">Date From</label>
                            <div class="input-group date">
                                <input type="date" class="form-control" name="">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label class="control-label" for="DateTo">Date To</label>
                            <div class="input-group date">
                                <input class="form-control" name="DateTo" type="date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label for="ClassId">Account Type</label>
                            <select class="form-control" id="" name="account_type"><option value="">Select
                                    Type</option>
                                <option value="1">Debit</option>
                                <option value="2">Credit</option>

                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label for="SectionId">Class</label>
                            <select class="form-control" id="ddlSection" name="SectionId"><option value="">Select Section</option>
                            </select>                        </div>
                        <div class="col-sm-2">
                            <label for="Status">Status</label>
                            <select class="form-control" data-val="true" data-val-number="The field Status must be a number." id="Status" name="Status"><option selected="selected" value="0">UnPaid</option>
                                <option value="1">Paid</option>
                                <option value="3">All</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="panel panel-info">
        <div class="panel-heading">
            <h4>Accounts List</h4>

                <button class="btn btn-primary pull-right" data-toggle="modal"
                        data-target="#addAccountsModal">Add new Account</button>

            <div class="options">

            </div>
        </div>
        <div class="panel-body std-panel infinite-scroll">
            <div class="std-detail clearfix">
                <div class="col-sm-12">
                    <div class="">
                        <table class="table table-responsive" id="accountsList" >
                            <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>Account Title</th>
                                <th>Account Type</th>
                                <th>Date Created</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $i = 1 ?>
                            <?php foreach ($accounts as $account): ?>
                                <tr>
                                    <td><?php echo $i ;?></td>
                                    <td><?php echo $account->account_name ;?></td>
                                    <td>
                                        <?php
                                        if ($account->account_type == 1)
                                        {
                                            echo '<p class="">Debit</p>';
                                        }
                                        else
                                        {
                                            echo '<p class="">Credit</p>';
                                        }
                                        ;?>
                                    </td>
                                    <td><?php echo $account->created_at ;?></td>
                                    <td><?php echo $account->description ;?></td>
                                    <td>
                                        <a data-toggle="modal" data-target="#editAccountsModal"
                                           style="margin-top:2px" class="fa fa-pencil"
                                           title="Edit" href="<?php echo 'accounts/edit'.$account->id ;?>"> </a>

                                        &nbsp;
                                        <a href="<?php echo base_url().'vouchers/details/'.$account->id  ;?>"
                                           style="margin-top:2px" class="fa fa-info"
                                           title="Details"> </a>
                                        &nbsp;
                                        <a href="<?php echo base_url().'vouchers/feePackageAndHistory/'.$account->id
                                             ;?>"
                                           style="margin-top:2px"
                                           class="fa fa-trash-o"
                                           title="Delete"> </a>
                                        &nbsp;
                                        <a href="<?php echo base_url().'vouchers/printVoucher/'.$account->id ;?>"
                                           style="margin-top:2px"
                                           class="fa fa-history"
                                           title="History"> </a>
                                    </td>


                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>


<div class="modal fade modal-lg" tabindex="-1" role="dialog" id="addAccountsModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add new Account</h4>
            </div>
            <form action="<?php echo base_url().'accounts/addAccount';?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">

                            <?php //echo form_hidden('enrollment_id',''); ?>

                            <div class="form-group">
                                <select name="account_headId" id="" class="form-control">
                                    <option value="" disabled selected>Account Head</option>
                                    <option value="1">Expense</option>
                                    <option value="2">Revenue</option>
                                    <option value="3">Asset</option>
                                    <option value="4">Equity</option>
                                    <option value="5">Liability</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="text" name="account_name" class="form-control"
                                       placeholder="Account Name">
                            </div>

                            <div class="form-group">
                                <textarea name="description" class="form-control"
                                          placeholder="Description"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="account_type">Is Credit</label>
                                <input type="checkbox" name="account_type" class="" data-toggle="toggle">
                            </div>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal fade modal-lg" tabindex="-1" role="dialog" id="editAccountsModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Account</h4>
            </div>
            <form action="<?php echo base_url().'accounts/updateAccount';?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">

                            <?php echo form_hidden('id',$account->id); ?>

                            <div class="form-group">
                                <select name="account_headId" id="" class="form-control">
                                    <option value="" disabled selected>Account Head</option>
                                    <option value="1">Expense</option>
                                    <option value="2">Revenue</option>
                                    <option value="3">Asset</option>
                                    <option value="4">Equity</option>
                                    <option value="5">Liability</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="text" name="account_name" class="form-control"
                                       placeholder="Account Name">
                            </div>

                            <div class="form-group">
                                <textarea name="description" class="form-control"
                                          placeholder="Description"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="account_type">Is Credit</label>
                                <input type="checkbox" name="account_type" class="" data-toggle="toggle">
                            </div>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update changes</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>