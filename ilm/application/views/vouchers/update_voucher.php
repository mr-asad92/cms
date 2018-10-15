
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
                        <form action="<?php echo base_url().'vouchers/saveUpdatedVoucher';?>" method="post">
                            <table class="table table-responsive" id="postVouchers" >

                                <tr>
                                    <th>Date: *</th>
                                    <td><input type="date" name="v_date" class="form-control" value="<?php echo set_value('v_date',date("Y-m-d",strtotime($voucher['created_at'])));?>" required="required"></td>
                                </tr>

                                <tr>
                                    <th>Title: *</th>
                                    <td><input type="text" name="title" class="form-control" value="<?php echo set_value('title', $voucher['title']);?>" required="required"></td>
                                </tr>

                                <tr>
                                    <th>Book Reference: *</th>
                                    <td><input type="text" name="book_reference" class="form-control" value="<?php echo set_value('book_reference', $voucher['book_reference']);?>" required="required"></td>
                                </tr>

                                <tr>
                                    <th>Acc Dr.: *</th>
                                    <td>
                                        <select name="acc_debit" class="form-control">
                                            <option value="0" selected>Select Account</option>
                                            <?php echo $dr_account;?>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Acc Cr.: *</th>
                                    <td>
                                        <select name="acc_credit" class="form-control">
                                            <option value="0" selected>Select Account</option>
                                            <?php echo $cr_account;?>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Description: *</th>
                                    <td><input type="text" name="description" class="form-control" value="<?php echo set_value('description', $voucher['description']);?>" required="required"></td>
                                </tr>

                                <tr>
                                    <th>Amount: *</th>
                                    <td><input type="text" name="amount" class="form-control" value="<?php echo set_value('amount', $voucher['amount']);?>" required="required"></td>
                                </tr>

                                <tr>
                                    <th><input type="hidden" name="id" value="<?php echo set_value('id', $voucher['id']);?>"></th>
                                    <td><input type="submit" name="submit" class="btn btn-info" value="Update"></td>
                                </tr>
                            </table>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
