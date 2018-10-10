<div class="panel panel-info">
    <div class="panel-heading ">
        <h4>Update Account</h4>
    </div>
    <div class="panel-body">
        <div class="col-sm-12">
            <form action="<?php echo base_url().'accounts/updateAccount';?>" method="post">

                <div class="row">
                    <div class="col-md-12">

                        <?php echo form_hidden('id',$account->id); ?>

                        <div class="form-group">

                            <?php echo form_dropdown('parent_id', $parentIds, set_value('parent_id', $account->parent_id),'class="form-control"');?>

                        </div>

                        <div class="form-group">
                            <input type="text" name="account_name" class="form-control"
                                   placeholder="Account Name" value="<?php echo set_value('account_name', $account->account_name);?>">
                        </div>

                        <div class="form-group">
                                <textarea name="description" class="form-control"
                                          placeholder="Description"><?php echo set_value('description', $account->description);?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="credit">Credit</label>
                            <input type="radio" name="account_type" class="" id="credit" value="0" <?php echo set_value('account_type', $account->account_type) == 0 ? "checked" : "";?>>


                            <label for="debit">Debit</label>
                            <input type="radio" name="account_type" class="" id="debit" value="1" <?php echo set_value('account_type', $account->account_type) == 1 ? "checked" : "";?>>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-info pull-right" value="Update" style="margin-left: 10px;">
                            <a href="<?php echo base_url().'accounts'?>" class="btn btn-default pull-right">Cancel</a>
                        </div>

                    </div>
                </div>



            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
