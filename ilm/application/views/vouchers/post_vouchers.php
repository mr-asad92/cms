
<link href='<?php echo base_url();?>assets/plugins/datatables/dataTables.css' rel='stylesheet' type='text/css' media='all' id='headerswitcher'>

<div class="container">

    <div class="panel panel-info">
        <div class="panel-heading">
            <h4>General Voucher</h4>

            <div class="options">

            </div>
        </div>
        <div class="panel-body std-panel infinite-scroll">
            <div class="std-detail clearfix">
                <div class="col-sm-12">
                    <div class="">
                        <form action="<?php echo base_url().'vouchers/save_voucher';?>" method="post">
                        <table class="table table-responsive" id="postVouchers" >

                            <tr>
                                <th>Date: *</th>
                                <th><input type="date" name="v_date" class="form-control" value="<?php echo date('Y-m-d');?>" required="required"></th>
                            </tr>

                            <tr>
                                <th>Title: *</th>
                                <th><input type="text" name="title" class="form-control" required="required"></th>
                            </tr>

                            <tr>
                                <th>Book Reference: *</th>
                                <th><input type="text" name="book_reference" class="form-control" required="required"></th>
                            </tr>

                            <tr>
                                <th>Acc Dr.: *</th>
                                <th>
                                    <select name="acc_debit" class="form-control">
                                        <option value="0" selected>Select Account</option>
                                        <?php echo $accounts;?>
                                    </select>
                                </th>
                            </tr>

                            <tr>
                                <th>Acc Cr.: *</th>
                                <th>
                                    <select name="acc_credit" class="form-control">
                                        <option value="0" selected>Select Account</option>
                                        <?php echo $accounts;?>
                                    </select>
                                </th>
                            </tr>

                            <tr>
                                <th>Description: *</th>
                                <th><input type="text" name="description" class="form-control" required="required"></th>
                            </tr>

                            <tr>
                                <th>Amount: *</th>
                                <th><input type="text" name="amount" class="form-control" required="required"></th>
                            </tr>

                            <tr>
                                <th></th>
                                <th><input type="submit" name="submit" class="btn btn-info" value="Submit"></th>
                            </tr>
                        </table>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
