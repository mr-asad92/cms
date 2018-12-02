<div id="printVoucher">
    <div class="col-md-10 col-md-offset-1" style="background-color: #fff;border: 2px solid #000; border-radius: 5px; margin-bottom:30px;">
        <div class="row">
        <div class="col-md-12 text-center">
            <div style="float: left;">
            <img src="<?= base_url(). 'uploaded_images/ilmCollege.png';?>" style="width: 220px; height: 50px;" style="margin: 0 auto;">
            </div>

            <div style="float: right;">
                <h4 class="text-center"> Student Fee Voucher (Student Copy) </h4>
            </div>
            <div style="clear:both;"></div>

        </div>
        </div>
        <div class="col-md-12">
            <?php
                $paid_amount = $amounts['paid_amount'];
                $unpaid_amount = $amounts['unpaid_amount'];
                $total_amount = $paid_amount + $amounts['unpaid_amount'];
                $balance = $total_amount - ($paid_amount + $voucher->fee_amount);
                $balance = ($balance < 0)?0:$balance;
            ?>

            <table class="table table-condensed custom_table">
                <tr>
                    <th>Voucher ID</th>
                    <th>
                        <?php echo $voucher_no;?>
                    </th>
                    <th>Enrollment No</th>
                    <td>
                        <?php echo $voucher->enrollmentId;?>
                    </td>
                    <th>Due Date</th>
                    <td>
                        <?php echo date("d-m-Y", strtotime($voucher->installment_date));?>
                    </td>
                </tr>
                <tr>
                    <th>Student Name</th>
                    <th class="alert alert-info">
                        <?php echo $voucher->first_name.'       '. $voucher->last_name;?>
                    </th>

                    <th>Father Name</th>
                    <td>
                        <?php echo $voucher->father_name;?>
                    </td>
                    <th>Installment No</th>
                    <td>
                        <?php echo $voucher->installment_no;?>
                    </td>
                </tr>
                <tr>


                    <th>Class </th>
                    <td>
<!--                        --><?php //echo $voucher->classTitle.' '. $voucher->title;?>
                        <?php echo $voucher->classTitle.' - '.$voucher->programTitle.' - '.$voucher->sectionTitle;?>
                    </td>
                    <th>Roll #</th>
                    <td>
                        <?php echo $voucher->roll_no;?>
                    </td>
                    <th>Installment Amount </th>
                    <td>
                        <?php echo $voucher->fee_amount;?>
                    </td>
                </tr>
<!--                <tr>-->
<!--                    <th>Study Program</th>-->
<!--                    <td>-->
<!--                        --><?php //echo $voucher->programTitle;?>
<!--                    </td>-->
<!---->
<!--                    <th>Section </th>-->
<!--                    <td>-->
<!--                        --><?php //echo $voucher->sectionTitle;?>
<!--                    </td>-->
<!--                </tr>-->


                <tr>
                    <td></td><td></td><td></td><td></td>
<!--                    <th>Previously Paid Amount</th>-->
<!--                    <td>-->
<!--                        --><?php //echo $paid_amount;?>
<!--                    </td>-->
<!---->
<!--                    <th>Un Paid Amount</th>-->
<!--                    <td>-->
<!--                        --><?php //echo $unpaid_amount;?>
<!--                    </td>-->
                    <th>Fine</th>
                    <td>
                        <?php echo $voucher->installment_fine;?>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>

                    </td>
                    <td></td><td></td>
                    <th>Total Amount</th>
                    <th class="alert alert-warning">
                        <?php echo ($voucher->fee_amount + $voucher->installment_fine);?>
                    </th>
                </tr>

                <tr>
                    <th></th>
                    <td>

                    </td>
                    <td></td><td></td>
                    <th> </th>
                    <th>
                        Sign: &nbsp;&nbsp;&nbsp; ______________
                    </th>
                </tr>

<!--                <tr>-->
<!--                    <th></th>-->
<!--                    <td>-->
<!---->
<!--                    </td>-->
<!--                    <td></td><td></td>-->
<!--                    <th>Balance</th>-->
<!--                    <th>-->
<!--                        --><?php //echo $balance;?>
<!--                    </th>-->
<!--                </tr>-->
            </table>
            <small><b>Note: <?php echo $fineAfterDueDate;?> Rs. will be charged per day after due date.</b></small>
        </div>
    </div>

    <div class="col-md-10 col-md-offset-1" style="background-color: #fff;border: 2px solid #000; border-radius: 5px; margin-bottom:30px;">
        <div style="float: left;">
            <img src="<?= base_url(). 'uploaded_images/ilmCollege.png';?>" style="width: 220px; height: 50px;" style="margin: 0 auto;">
        </div>

        <div style="float: right;">
            <h4 class="text-center"> Student Fee Voucher (Accounts Copy) </h4>
        </div>
        <div style="clear:both;"></div>
        <div class="col-md-12">
            <table class="table table-condensed custom_table">
                <tr>
                    <th>Voucher ID</th>
                    <th>
                        <?php echo $voucher_no;?>
                    </th>
                    <th>Enrollment No</th>
                    <td>
                        <?php echo $voucher->enrollmentId;?>
                    </td>
                    <th>Due Date</th>
                    <td>
                        <?php echo date("d-m-Y", strtotime($voucher->installment_date));?>
                    </td>
                </tr>
                <tr>
                    <th>Student Name</th>
                    <th class="alert alert-info">
                        <?php echo $voucher->first_name.'       '. $voucher->last_name;?>
                    </th>

                    <th>Father Name</th>
                    <td>
                        <?php echo $voucher->father_name;?>
                    </td>
                    <th>Installment No</th>
                    <td>
                        <?php echo $voucher->installment_no;?>
                    </td>
                </tr>
                <tr>


                    <th>Class </th>
                    <td>
                        <!--                        --><?php //echo $voucher->classTitle.' '. $voucher->title;?>
                        <?php echo $voucher->classTitle.' - '.$voucher->programTitle.' - '.$voucher->sectionTitle;?>
                    </td>
                    <th>Roll #</th>
                    <td>
                        <?php echo $voucher->roll_no;?>
                    </td>
                    <th>Installment Amount </th>
                    <td>
                        <?php echo $voucher->fee_amount;?>
                    </td>
                </tr>
                <!--                <tr>-->
                <!--                    <th>Study Program</th>-->
                <!--                    <td>-->
                <!--                        --><?php //echo $voucher->programTitle;?>
                <!--                    </td>-->
                <!---->
                <!--                    <th>Section </th>-->
                <!--                    <td>-->
                <!--                        --><?php //echo $voucher->sectionTitle;?>
                <!--                    </td>-->
                <!--                </tr>-->


                <tr>
                    <td></td><td></td><td></td><td></td>
                    <!--                    <th>Previously Paid Amount</th>-->
                    <!--                    <td>-->
                    <!--                        --><?php //echo $paid_amount;?>
                    <!--                    </td>-->
                    <!---->
                    <!--                    <th>Un Paid Amount</th>-->
                    <!--                    <td>-->
                    <!--                        --><?php //echo $unpaid_amount;?>
                    <!--                    </td>-->
                    <th>Fine</th>
                    <td>
                        <?php echo $voucher->installment_fine;?>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>

                    </td>
                    <td></td><td></td>
                    <th>Total Amount</th>
                    <th class="alert alert-warning">
                        <?php echo ($voucher->fee_amount + $voucher->installment_fine);?>
                    </th>
                </tr>

                <tr>
                    <th></th>
                    <td>

                    </td>
                    <td></td><td></td>
                    <th> </th>
                    <th>
                        Sign: &nbsp;&nbsp;&nbsp; ______________
                    </th>
                </tr>

                <!--                <tr>-->
                <!--                    <th></th>-->
                <!--                    <td>-->
                <!---->
                <!--                    </td>-->
                <!--                    <td></td><td></td>-->
                <!--                    <th>Balance</th>-->
                <!--                    <th>-->
                <!--                        --><?php //echo $balance;?>
                <!--                    </th>-->
                <!--                </tr>-->
            </table>
            <small><b>Note: <?php echo $fineAfterDueDate;?> Rs. will be charged per day after due date.</b></small>
        </div>
    </div>

    <div class="col-md-10 col-md-offset-1" style="background-color: #fff;border: 2px solid #000; border-radius: 5px; margin-bottom:30px;">
        <div style="float: left;">
            <img src="<?= base_url(). 'uploaded_images/ilmCollege.png';?>" style="width: 220px; height: 50px;" style="margin: 0 auto;">
        </div>

        <div style="float: right;">
            <h4 class="text-center"> Student Fee Voucher (Admin Copy) </h4>
        </div>
        <div style="clear:both;"></div>
        <div class="col-md-12">
            <table class="table table-condensed custom_table">
                <tr>
                    <th>Voucher ID</th>
                    <th>
                        <?php echo $voucher_no;?>
                    </th>
                    <th>Enrollment No</th>
                    <td>
                        <?php echo $voucher->enrollmentId;?>
                    </td>
                    <th>Due Date</th>
                    <td>
                        <?php echo date("d-m-Y", strtotime($voucher->installment_date));?>
                    </td>
                </tr>
                <tr>
                    <th>Student Name</th>
                    <th class="alert alert-info">
                        <?php echo $voucher->first_name.'       '. $voucher->last_name;?>
                    </th>

                    <th>Father Name</th>
                    <td>
                        <?php echo $voucher->father_name;?>
                    </td>
                    <th>Installment No</th>
                    <td>
                        <?php echo $voucher->installment_no;?>
                    </td>
                </tr>
                <tr>


                    <th>Class </th>
                    <td>
                        <!--                        --><?php //echo $voucher->classTitle.' '. $voucher->title;?>
                        <?php echo $voucher->classTitle.' - '.$voucher->programTitle.' - '.$voucher->sectionTitle;?>
                    </td>
                    <th>Roll #</th>
                    <td>
                        <?php echo $voucher->roll_no;?>
                    </td>
                    <th>Installment Amount </th>
                    <td>
                        <?php echo $voucher->fee_amount;?>
                    </td>
                </tr>
                <!--                <tr>-->
                <!--                    <th>Study Program</th>-->
                <!--                    <td>-->
                <!--                        --><?php //echo $voucher->programTitle;?>
                <!--                    </td>-->
                <!---->
                <!--                    <th>Section </th>-->
                <!--                    <td>-->
                <!--                        --><?php //echo $voucher->sectionTitle;?>
                <!--                    </td>-->
                <!--                </tr>-->


                <tr>
                    <td></td><td></td><td></td><td></td>
                    <!--                    <th>Previously Paid Amount</th>-->
                    <!--                    <td>-->
                    <!--                        --><?php //echo $paid_amount;?>
                    <!--                    </td>-->
                    <!---->
                    <!--                    <th>Un Paid Amount</th>-->
                    <!--                    <td>-->
                    <!--                        --><?php //echo $unpaid_amount;?>
                    <!--                    </td>-->
                    <th>Fine</th>
                    <td>
                        <?php echo $voucher->installment_fine;?>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>

                    </td>
                    <td></td><td></td>
                    <th>Total Amount</th>
                    <th class="alert alert-warning">
                        <?php echo ($voucher->fee_amount + $voucher->installment_fine);?>
                    </th>
                </tr>

                <tr>
                    <th></th>
                    <td>

                    </td>
                    <td></td><td></td>
                    <th> </th>
                    <th>
                        Sign: &nbsp;&nbsp;&nbsp; ______________
                    </th>
                </tr>

                <!--                <tr>-->
                <!--                    <th></th>-->
                <!--                    <td>-->
                <!---->
                <!--                    </td>-->
                <!--                    <td></td><td></td>-->
                <!--                    <th>Balance</th>-->
                <!--                    <th>-->
                <!--                        --><?php //echo $balance;?>
                <!--                    </th>-->
                <!--                </tr>-->
            </table>
            <small><b>Note: <?php echo $fineAfterDueDate;?> Rs. will be charged per day after due date.</b></small>

        </div>
    </div>

</div>
<?php if ($print): ?>


    <script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery-1.10.2.min.js'></script>

    <script type="text/javascript">

        $(document).ready(function(){
            PrintVoucher('#printVoucher');
        });

        function PrintVoucher(elem) {
            PopupVoucher($(elem).html());
            window.location.href = '<?php echo base_url()."vouchers";?>';
        }

        function PopupVoucher(data) {
            var infoPrintWindow = window.open('', 'Student Fee Voucher', "width="+screen.availWidth+",height="+screen
                .availHeight);
            infoPrintWindow.document.write('<html><head><title>Student Fee Voucher</title>');
//            infoPrintWindow.document.write('<link rel="stylesheet" href="<?php //echo base_url();?>//assets/css/custom.css">');
//            infoPrintWindow.document.write('<link rel="stylesheet" href="<?php //echo base_url();?>//assets/css/bootstrap.css">');
//            infoPrintWindow.document.write('<link href=\'<?php //echo base_url();?>//assets/demo/variations/default.css\' rel=\'stylesheet\' type=\'text/css\' media=\'all\' id=\'styleswitcher\'>');
//            infoPrintWindow.document.write('<link href=\'<?php //echo base_url();?>//assets/demo/variations/default.css\' rel=\'stylesheet\' type=\'text/css\' media=\'all\' id=\'headerswitcher\'>');
            infoPrintWindow.document.write('<style>table {\n' +
                '  background-color: transparent;\n' +
                '}\n' +
                'caption {\n' +
                '  padding-top: 8px;\n' +
                '  padding-bottom: 8px;\n' +
                '  color: #777777;\n' +
                '  text-align: left;\n' +
                '}\n' +
                'th {\n' +
                '  text-align: left;\n' +
                '}\n' +
                '.table {\n' +
                '  width: 100%;\n' +
                '  max-width: 100%;\n' +
                '  margin-bottom: 20px;\n' +
                '}\n' +
                '.table > thead > tr > th,\n' +
                '.table > tbody > tr > th,\n' +
                '.table > tfoot > tr > th,\n' +
                '.table > thead > tr > td,\n' +
                '.table > tbody > tr > td,\n' +
                '.table > tfoot > tr > td {\n' +
                '  padding: 8px;\n' +
                '  line-height: 1.42857143;\n' +
                '  vertical-align: top;\n' +
                '  border-top: 1px solid #dddddd;\n' +
                '}\n' +
                '.table > thead > tr > th {\n' +
                '  vertical-align: bottom;\n' +
                '  border-bottom: 2px solid #dddddd;\n' +
                '}\n' +
                '.table > caption + thead > tr:first-child > th,\n' +
                '.table > colgroup + thead > tr:first-child > th,\n' +
                '.table > thead:first-child > tr:first-child > th,\n' +
                '.table > caption + thead > tr:first-child > td,\n' +
                '.table > colgroup + thead > tr:first-child > td,\n' +
                '.table > thead:first-child > tr:first-child > td {\n' +
                '  border-top: 0;\n' +
                '}\n' +
                '.table > tbody + tbody {\n' +
                '  border-top: 2px solid #dddddd;\n' +
                '}\n' +
                '.table .table {\n' +
                '  background-color: #ffffff;\n' +
                '}\n' +
                '.table-condensed > thead > tr > th,\n' +
                '.table-condensed > tbody > tr > th,\n' +
                '.table-condensed > tfoot > tr > th,\n' +
                '.table-condensed > thead > tr > td,\n' +
                '.table-condensed > tbody > tr > td,\n' +
                '.table-condensed > tfoot > tr > td {\n' +
                '  padding: 5px;\n' +
                '}\n' +
                '.table-bordered {\n' +
                '  border: 1px solid #dddddd;\n' +
                '}\n' +
                '.table-bordered > thead > tr > th,\n' +
                '.table-bordered > tbody > tr > th,\n' +
                '.table-bordered > tfoot > tr > th,\n' +
                '.table-bordered > thead > tr > td,\n' +
                '.table-bordered > tbody > tr > td,\n' +
                '.table-bordered > tfoot > tr > td {\n' +
                '  border: 1px solid #dddddd;\n' +
                '}\n' +
                '.table-bordered > thead > tr > th,\n' +
                '.table-bordered > thead > tr > td {\n' +
                '  border-bottom-width: 2px;\n' +
                '}\n' +
                '.table-striped > tbody > tr:nth-of-type(odd) {\n' +
                '  background-color: #f9f9f9;\n' +
                '}\n' +
                '.table-hover > tbody > tr:hover {\n' +
                '  background-color: #f5f5f5;\n' +
                '}\n' +
                'table col[class*="col-"] {\n' +
                '  position: static;\n' +
                '  float: none;\n' +
                '  display: table-column;\n' +
                '}\n' +
                'table td[class*="col-"],\n' +
                'table th[class*="col-"] {\n' +
                '  position: static;\n' +
                '  float: none;\n' +
                '  display: table-cell;\n' +
                '}\n' +
                '.table > thead > tr > td.active,\n' +
                '.table > tbody > tr > td.active,\n' +
                '.table > tfoot > tr > td.active,\n' +
                '.table > thead > tr > th.active,\n' +
                '.table > tbody > tr > th.active,\n' +
                '.table > tfoot > tr > th.active,\n' +
                '.table > thead > tr.active > td,\n' +
                '.table > tbody > tr.active > td,\n' +
                '.table > tfoot > tr.active > td,\n' +
                '.table > thead > tr.active > th,\n' +
                '.table > tbody > tr.active > th,\n' +
                '.table > tfoot > tr.active > th {\n' +
                '  background-color: #f5f5f5;\n' +
                '}\n' +
                '.table-hover > tbody > tr > td.active:hover,\n' +
                '.table-hover > tbody > tr > th.active:hover,\n' +
                '.table-hover > tbody > tr.active:hover > td,\n' +
                '.table-hover > tbody > tr:hover > .active,\n' +
                '.table-hover > tbody > tr.active:hover > th {\n' +
                '  background-color: #e8e8e8;\n' +
                '}\n' +
                '.table > thead > tr > td.success,\n' +
                '.table > tbody > tr > td.success,\n' +
                '.table > tfoot > tr > td.success,\n' +
                '.table > thead > tr > th.success,\n' +
                '.table > tbody > tr > th.success,\n' +
                '.table > tfoot > tr > th.success,\n' +
                '.table > thead > tr.success > td,\n' +
                '.table > tbody > tr.success > td,\n' +
                '.table > tfoot > tr.success > td,\n' +
                '.table > thead > tr.success > th,\n' +
                '.table > tbody > tr.success > th,\n' +
                '.table > tfoot > tr.success > th {\n' +
                '  background-color: #dff0d8;\n' +
                '}\n' +
                '.table-hover > tbody > tr > td.success:hover,\n' +
                '.table-hover > tbody > tr > th.success:hover,\n' +
                '.table-hover > tbody > tr.success:hover > td,\n' +
                '.table-hover > tbody > tr:hover > .success,\n' +
                '.table-hover > tbody > tr.success:hover > th {\n' +
                '  background-color: #d0e9c6;\n' +
                '}\n' +
                '.table > thead > tr > td.info,\n' +
                '.table > tbody > tr > td.info,\n' +
                '.table > tfoot > tr > td.info,\n' +
                '.table > thead > tr > th.info,\n' +
                '.table > tbody > tr > th.info,\n' +
                '.table > tfoot > tr > th.info,\n' +
                '.table > thead > tr.info > td,\n' +
                '.table > tbody > tr.info > td,\n' +
                '.table > tfoot > tr.info > td,\n' +
                '.table > thead > tr.info > th,\n' +
                '.table > tbody > tr.info > th,\n' +
                '.table > tfoot > tr.info > th {\n' +
                '  background-color: #d9edf7;\n' +
                '}\n' +
                '.table-hover > tbody > tr > td.info:hover,\n' +
                '.table-hover > tbody > tr > th.info:hover,\n' +
                '.table-hover > tbody > tr.info:hover > td,\n' +
                '.table-hover > tbody > tr:hover > .info,\n' +
                '.table-hover > tbody > tr.info:hover > th {\n' +
                '  background-color: #c4e3f3;\n' +
                '}\n' +
                '.table > thead > tr > td.warning,\n' +
                '.table > tbody > tr > td.warning,\n' +
                '.table > tfoot > tr > td.warning,\n' +
                '.table > thead > tr > th.warning,\n' +
                '.table > tbody > tr > th.warning,\n' +
                '.table > tfoot > tr > th.warning,\n' +
                '.table > thead > tr.warning > td,\n' +
                '.table > tbody > tr.warning > td,\n' +
                '.table > tfoot > tr.warning > td,\n' +
                '.table > thead > tr.warning > th,\n' +
                '.table > tbody > tr.warning > th,\n' +
                '.table > tfoot > tr.warning > th {\n' +
                '  background-color: #fcf8e3;\n' +
                '}\n' +
                '.table-hover > tbody > tr > td.warning:hover,\n' +
                '.table-hover > tbody > tr > th.warning:hover,\n' +
                '.table-hover > tbody > tr.warning:hover > td,\n' +
                '.table-hover > tbody > tr:hover > .warning,\n' +
                '.table-hover > tbody > tr.warning:hover > th {\n' +
                '  background-color: #faf2cc;\n' +
                '}\n' +
                '.table > thead > tr > td.danger,\n' +
                '.table > tbody > tr > td.danger,\n' +
                '.table > tfoot > tr > td.danger,\n' +
                '.table > thead > tr > th.danger,\n' +
                '.table > tbody > tr > th.danger,\n' +
                '.table > tfoot > tr > th.danger,\n' +
                '.table > thead > tr.danger > td,\n' +
                '.table > tbody > tr.danger > td,\n' +
                '.table > tfoot > tr.danger > td,\n' +
                '.table > thead > tr.danger > th,\n' +
                '.table > tbody > tr.danger > th,\n' +
                '.table > tfoot > tr.danger > th {\n' +
                '  background-color: #f2dede;\n' +
                '}\n' +
                '.table-hover > tbody > tr > td.danger:hover,\n' +
                '.table-hover > tbody > tr > th.danger:hover,\n' +
                '.table-hover > tbody > tr.danger:hover > td,\n' +
                '.table-hover > tbody > tr:hover > .danger,\n' +
                '.table-hover > tbody > tr.danger:hover > th {\n' +
                '  background-color: #ebcccc;\n' +
                '}table.custom_table tr td,th { font-size: 12px; }@media print {a[href]:after {\n' +
                '    content: none;\n' +
                '  }}</style>');
            infoPrintWindow.document.write('<style type="text/css" media="print">\n' +
                '@page {\n' +
                '    size: auto;   /* auto is the initial value */\n' +
                '    margin: 0;  /* this affects the margin in the printer settings */\n' +
                '}\n' +
                '</style>');
            infoPrintWindow.document.write('</head><body >');
            infoPrintWindow.document.write(data);
            infoPrintWindow.document.write('</body></html>');

            infoPrintWindow.print();
            infoPrintWindow.close();

            return true;
        }

    </script>

<?php endif; ?>
<!--infoPrintWindow.document.write('<link rel="stylesheet" href="--><?php //echo base_url();?><!--assets/css/styles.minc726.css?=140">');-->
