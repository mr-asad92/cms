<div id="printVoucher">
    <div class="col-md-10 col-md-offset-1" style="background-color: #fff;border: 2px solid #000; border-radius: 5px; margin-bottom:30px;">
        <div class="col-md-12 text-center">
            <img src="<?= base_url(). 'uploaded_images/ilmCollege.png';?>">
        </div>
        <div class="col-md-12">
            <h2 class="text-center"> Transaction Voucher</h2>
            <table class="table">
                <tr>
                    <th>Transaction No</th>
                    <th class="alert alert-info">
                        <?php echo $transaction->transaction_no;?>
                    </th>

                    <th>Book Refference</th>
                    <td>
                        <?php echo $transaction->book_reference;?>
                    </td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>
                        <?php echo $transaction->created_at;?>
                    </td>

                    <th>Created BY</th>
                    <td>
                        <?php echo 'Hafiz Shahid (Admin)';?>
                    </td>
                </tr>
                <tr>
                    <th>Debit Account Name</th>
                    <td>
                        <?php echo $transaction->debit_account_name;?>
                    </td>
                    <th>Credit Account Name</th>
                    <td>
                        <?php echo $transaction->credit_account_name;?>
                    </td>
                </tr>
                <tr>

                    <th>Transaction Description</th>
                    <td colspan="3">
                        <?php echo $transaction->description;?>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>

                    </td>

                    <th>Total Amount</th>
                    <th class="alert alert-warning">
                        <?php echo $transaction->amount;?>
                    </th>
                </tr>
            </table>
        </div>
    </div>
</div>
<?php if ($print): ?>


    <script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery-1.10.2.min.js'></script>

    <script type="text/javascript">

        $(document).ready(function(){
            PrintElem('#printVoucher');
        });

        function PrintElem(elem) {
            Popup($(elem).html());
            window.location.href = '<?php echo base_url()."transaction/index";?>';
        }

        function Popup(data) {
            var infoPrintWindow = window.open('', 'transaction Voucher', "width="+screen.availWidth+",height="+screen
                .availHeight);
            infoPrintWindow.document.write('<html><head><title>Print transaction Voucher</title>');
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

<?php endif; ?>
