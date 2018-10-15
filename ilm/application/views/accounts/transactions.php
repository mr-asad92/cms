<div class="container">

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
                                <th>Description</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php

                            $sr = 1;
                                foreach ($transactions as $transaction){
                                    ?>

                                   <tr>
                                       <th><?php echo $sr;?> </th>
                                       <td><?php echo $transaction['title'];?></td>
                                       <td><?php echo $transaction['book_reference'];?></td>
                                       <td><?php echo $transaction['dr_acc_title'];?></td>
                                       <td><?php echo $transaction['cr_acc_title'];?></td>
                                       <td><?php echo $transaction['description'];?></td>
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