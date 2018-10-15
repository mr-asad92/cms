<div class="panel panel-info">
    <div class="panel-heading ">
        <h4>Cash Book</h4>
        <div class="options">
            <a href="javascript:printElem('cashBookTable')" class="btn btn-primary" style="margin-top: 5px; padding: 10px">Print</a>
        </div>
    </div>
    <div class="panel-body">
        <div class="col-sm-12">

            <form action="<?php echo base_url().'/accounts/cash_book';?>" method="post">
                <div class="row">
                    <div class="col-sm-2"><input type="date" name="from_date" value="<?php echo date('Y-m-d');?>" class="form-control"></div>

                    <div><input type="submit" value="Submit" class="btn btn-info"></div>
                </div>
            </form>
            <br />
            <div id="cashBookTable">
                <table class="table table-bordered table-condensed table-striped">

                <tr>
                    <th colspan="7" class="text-center">Income Details</th>

                </tr>

                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th class="text-center">Opening Balance</th>
                    <th class="text-right"><?php echo $opening_balance;?></th>
                </tr>

                <tr>
                    <th>Sr No.</th>
                    <th>Ref.</th>
                    <th>Title</th>
                    <th>Dr. A/C</th>
                    <th>Cr. A/C</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>

                <?php
                $sr = 1;
                $total_amount = 0;
                    foreach ($transactions as $transaction){
                        ?>
                        <tr>
                            <td><?php echo $sr;?></td>
                            <td><?php echo $transaction['book_reference'];?></td>
                            <td><?php echo $transaction['title'];?></td>
                            <td><?php echo $transaction['dr_acc_title'];?></td>
                            <td><?php echo $transaction['cr_acc_title'];?></td>
                            <td><?php echo $transaction['description'];?></td>
                            <td class="text-right"><?php echo $transaction['amount'];?></td>
                        </tr>
                <?php
                        $total_amount += $transaction['amount'];
                        $sr++;
                    }
                ?>

                <tr>
                    <th>&nbsp;</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>

                <tr>
                    <th>&nbsp;</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>

                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Total</th>
                    <th class="text-right"><?php echo $total_amount;?></th>
                </tr>

                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Closing Balance</th>
                    <th class="text-right"><?php echo $grand_total;?></th>
                </tr>

            </table>
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
        infoPrintWindow.document.write('<html><head><title>Cash Book</title>');
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