<div class="panel panel-info">
    <div class="panel-heading ">
        <h4>Cash Book</h4>
        <div class="options">
            <a href="javascript:printElem('cashBookTable')" class="btn btn-primary" style="margin-top: 5px; padding: 10px">Print</a>
        </div>
    </div>
    <div class="panel-body">
        <div class="col-sm-12">

            <form action="<?php echo base_url().'/accounts/ledger';?>" method="post">
                <div class="row">
                    <div class="col-sm-1"><label class="control-label">From: </label></div>
                    <div class="col-sm-2"><input type="date" name="from_date" value="<?php echo date('Y-m-d');?>" class="form-control"></div>

                    <div class="col-sm-1"><label class="control-label">To: </label></div>
                    <div class="col-sm-2"><input type="date" name="to_date" value="<?php echo date('Y-m-d');?>" class="form-control"></div>

                    <div class="col-sm-1"><label class="control-label">Account: </label></div>
                    <div class="col-sm-2">
                        <select class="form-control" name="ledgerAcount" id="">
                            <option value="select"> --- Select ---</option>
                            <?php echo $accountsList;?>
                        </select>
                    </div>

                    <div class="col-sm-1"><label class="control-label">&nbsp;</label><input type="submit" value="Submit" class="btn btn-info"></div>
                </div>
            </form>
            <br />
            <div id="cashBookTable">

                <?php
//                debug($transactions);
                if (isset($transactions) && !empty($transactions)) {
                ?>
                <div class="row" >
                    <strong>From: </strong> <?php echo $fromDate;?><br />
                    <strong>To: </strong> <?php echo $toDate;?><br />
                    <strong>Account Title: </strong> <?php echo $accountTitle;?> <br />&nbsp;
                </div>
                <?php } ?>
                <table class="table table-bordered table-condensed table-striped">

                    <tr>
                        <th colspan="8" class="text-center">Ledger Details</th>

                    </tr>


                    <tr>
                        <th>Sr No.</th>
                        <th>Ref.</th>
                        <th>Title</th>
                        <th>Account</th>
                        <th>Description</th>
                        <th>Debit</th>
                        <th>Credit</th>
                        <th>Balance</th>
                    </tr>

                    <?php
                    $sr = 1;
                    $total_amount = 0;
                    $balance = 0;
                    $drBalance = 0;
                    $crBalance = 0;
                    if (isset($transactions) && $transactions != 0) {
                        foreach ($transactions as $transaction) {

                            $displayAccount = ($cashOrLedgerAccount == $transaction['debit_account'])?$transaction['cr_acc_title']:$transaction['dr_acc_title'];

                            $drAmount = ($cashOrLedgerAccount != $transaction['debit_account']) ? '' : $transaction['amount'];
                            $crAmount = ($cashOrLedgerAccount != $transaction['credit_account']) ? '' : $transaction['amount'];

                            $balance = ($drAmount!='')?$balance+=$transaction['amount']:$balance-=$transaction['amount'];

                            $drBalance = ($drAmount!='')?$drBalance+=$drAmount:$drBalance+=0;
                            $crBalance = ($crAmount!='')?$crBalance+=$crAmount:$crBalance+=0;
                            ?>
                            <tr>
                                <td><?php echo $sr; ?></td>
                                <td><?php echo $transaction['book_reference']; ?></td>
                                <td><?php echo $transaction['title']; ?></td>
                                <td><?php echo $displayAccount; ?></td>
                                <td><?php echo $transaction['description']; ?></td>
                                <td><?php echo $drAmount; ?></td>
                                <td><?php echo $crAmount; ?></td>
                                <td class="text-right"><?php echo $balance; ?></td>
                            </tr>
                            <?php
                            $total_amount += $transaction['amount'];
                            $sr++;
                        }
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
                        <th></th>
                    </tr>

                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th class="text-right"><?php echo $drBalance;?></th>
                        <th class="text-right"><?php echo $crBalance;?></th>
                        <th></th>
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