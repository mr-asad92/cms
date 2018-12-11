
<link href='<?php echo base_url();?>assets/plugins/datatables/dataTables.css' rel='stylesheet' type='text/css' media='all' id='headerswitcher'>

<div class="container col-md-6 col-md-offset-3">

    <div class="panel panel-info ">
        <div class="panel-heading">
            <h4>Payment And Receipt</h4>

            <div class="options">

            </div>
        </div>
        <div class="panel-body std-panel infinite-scroll ">
            <div class="std-detail clearfix">
                <div class="col-sm-12">
                    <div class="">
                        <form action="<?php echo base_url().'vouchers/save_payment_and_receipt';?>" method="post">
                        <table class="table table-responsive" id="postVouchers" >

                            <tr>
                                <th>Date: *</th>
                                <th><input type="text" name="v_date" class="form-control enableDatePicker" value="<?php echo date('Y-m-d');?>" required="required"></th>
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
                                <th>Acc Head: *</th>
                                <th>
                                    <select name="acc_head" class="form-control">
                                        <option value="0" selected>Select Account</option>
                                        <?php echo $accounts;?>
                                    </select>
                                </th>
                            </tr>

                            <tr>
                                <th></th>
                                <th>
                                    <input type="radio" name="debit_credit" value="credit" id="payment" checked="checked"> <label for="credit">Payment</label>
                                    <input type="radio" name="debit_credit" value="debit" id="receipt"> <label for="debit">Receipt</label>
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
