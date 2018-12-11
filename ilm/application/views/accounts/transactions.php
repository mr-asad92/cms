<div class="container">

    <div class="panel panel-info">
        <div class="panel-heading ">
            <h4>Search Transactions</h4>
        </div>
        <div class="panel-body">
            <div class="col-sm-12">
                <form action="<?php echo base_url();?>accounts/transactions" class="" method="post" novalidate="novalidate">                    <div class="mb5 clearfix">
                        <h4 class="pull-left"><strong>Enter any of the following field data to search</strong></h4>
                        <button type="submit" class="btn btn-primary pull-right"><span class="fa fa-search"></span>  Search</button>
                        <a href="<?php echo base_url();?>accounts/transactions" data-toggle="tooltip" title="Refresh Search"
                           class="pull-right btn
                        btn-info"><i
                                    class="fa fa-refresh" aria-hidden="true"></i> Refresh</a>

                    </div>
                    <div class="form-group">

                        <div class="col-sm-2">
                            <label class="control-label" for="DateFrom">Date From</label>
                            <div class="input-group date">
                                <input type="text" class="form-control enableDatePicker" name="dateFrom">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label class="control-label" for="DateTo">Date To</label>
                            <div class="input-group date">
                                <input class="form-control enableDatePicker" name="DateTo" type="text">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="panel panel-info">
        <div class="panel-heading">
            <h4>Transactions List</h4>

            <div class="options">
                <a href="javascript:printElem('printDiv')" class="btn btn-primary" style="margin-top: 5px; padding: 10px">Print</a>
            </div>
        </div>
        <div class="panel-body std-panel infinite-scroll">
            <div class="std-detail clearfix">
                <div class="col-sm-12">
                    <div class="" id="printDiv">
                        <table class="table table-responsive table-condensed table-hover table-bordered table-striped" id="accountsList" >
                            <thead>
                            <tr>
                                <th>Sr. </th>
                                <th>Title</th>
                                <th>Ref.</th>
                                <th>Dr. A/C</th>
                                <th>Cr. A/C</th>
<!--                                <th>Description</th>-->
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php

                            $sr = 1;
                                foreach ($transactions as $transaction){
                                    $transaction_id = $transaction['id'];
                                    $installment_id = $this->Accounts_model->getInstallmentId($transaction_id);

                                    $sectionTitle = '';
                                    $programTitle = '';
                                    $otherDetails = '';
                                    if($installment_id != 'not_found'){
                                        $details = $this->Accounts_model->getSectionAndProgramId($installment_id);
//                                        debug($details);
                                        $sectionTitle = $this->admin_model->getSectionName($details['section_id']);
                                        $programTitle = $this->admin_model->getProgramName($details['program_id']);
                                        $otherDetails = ' - '.$programTitle.' - '.$sectionTitle;
                                    }
                                    ?>

                                   <tr>
                                       <th><?php echo $sr;?> </th>
                                       <td><?php echo $transaction['title'].$otherDetails;?></td>
                                       <td><?php echo $transaction['book_reference'];?></td>
                                       <td><?php echo $transaction['dr_acc_title'];?></td>
                                       <td><?php echo $transaction['cr_acc_title'];?></td>
<!--                                       <td>--><?php //echo $transaction['description'];?><!--</td>-->
                                       <td><?php echo date("d M, Y - h:i A", strtotime($transaction['created_at']));?></td>
                                       <td class="text-right"><?php echo $transaction['amount'];?></td>
                                       <td>
                                           <a href="<?php echo base_url().'vouchers/edit_transaction/'.$transaction['id'];?>"><i class="fa fa-edit"></i></a> |
                                           <a href="<?php echo base_url().'vouchers/delete_transaction/'.$transaction['id'];?>"><i class="fa fa-times"></i></a>
                                       </td>
                                   </tr>

                            <?php
                                    $sr++;
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
<script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery-1.10.2.min.js'></script>

<script>

    function printElem(elem) {
        Popup($("#"+elem).html());
    }

    function Popup(data) {
        var infoPrintWindow = window.open('', 'Student Information', "width="+screen.availWidth+",height="+screen.availHeight);
        infoPrintWindow.document.write('<html><head><title>Transactions</title>');
        infoPrintWindow.document.write('<link rel="stylesheet" href="<?php echo base_url();?>assets/css/styles.minc726.css?=140">');
        infoPrintWindow.document.write('<link href=\'<?php echo base_url();?>assets/demo/variations/default.css\' rel=\'stylesheet\' type=\'text/css\' media=\'all\' id=\'styleswitcher\'>');
        infoPrintWindow.document.write('<link href=\'<?php echo base_url();?>assets/demo/variations/default.css\' rel=\'stylesheet\' type=\'text/css\' media=\'all\' id=\'headerswitcher\'>');
        infoPrintWindow.document.write('</head><body >');
        infoPrintWindow.document.write(data);
        infoPrintWindow.document.write('</body></html>');

        infoPrintWindow.print();
        infoPrintWindow.close();

        return true;
    }
</script>