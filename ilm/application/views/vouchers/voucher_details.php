<div id="printVoucher">
    <div class="col-md-10 col-md-offset-1" style="background-color: #fff;border: 2px solid #000; border-radius: 5px; margin-bottom:30px;">
        <div class="col-md-12 text-center">
            <img src="<?= base_url(). 'uploaded_images/ilmCollege.png';?>">
        </div>
        <div class="col-md-12">
            <h2 class="text-center"> Student Fee Voucher (Student Copy) </h2>
            <table class="table">
                <tr>
                    <th>Student Name</th>
                    <th class="alert alert-info">
                        <?php echo $voucher->first_name.'       '. $voucher->last_name;?>
                    </th>

                    <th>Father Name</th>
                    <td>
                        <?php echo $voucher->first_name.'     '. $voucher->last_name;?>
                    </td>
                </tr>
                <tr>
                    <th>Enrollment No</th>
                    <td>
                        <?php echo $voucher->enrollmentId;?>
                    </td>

                    <th>Class </th>
                    <td>
<!--                        --><?php //echo $voucher->classTitle.' '. $voucher->title;?>
                        <?php echo $voucher->classTitle;?>
                    </td>
                </tr>
                <tr>
                    <th>Study Program</th>
                    <td>
                        <?php echo $voucher->programTitle;?>
                    </td>

                    <th>Section </th>
                    <td>
                        <?php echo $voucher->sectionTitle;?>
                    </td>
                </tr>
                <tr>
                    <th>Installment No</th>
                    <td>
                        <?php echo $voucher->installment_no;?>
                    </td>

                    <th>Installment Amuount </th>
                    <td>
                        <?php echo $voucher->fee_amount;?>
                    </td>
                </tr>
                <tr>
                    <th>Due Date</th>
                    <td>
                        <?php echo $voucher->installment_date;?>
                    </td>

                    <th>Fine</th>
                    <td>
                        <?php echo $voucher->installment_fine;?>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>

                    </td>

                    <th>Total Amount</th>
                    <th class="alert alert-warning">
                        <?php echo $voucher->fee_amount;?>
                    </th>
                </tr>
            </table>
        </div>
    </div>

    <div class="col-md-10 col-md-offset-1" style="background-color: #fff;border: 2px solid #000; border-radius: 5px; margin-bottom:30px;">
        <div class="col-md-12 text-center">
            <img src="<?= base_url(). 'uploaded_images/ilmCollege.png';?>">
        </div>
        <div class="col-md-12">
            <h2 class="text-center"> Student Fee Voucher (Accounts Copy) </h2>
            <table class="table">
                <tr>
                    <th>Student Name</th>
                    <th class="alert alert-info">
                        <?php echo $voucher->first_name.'       '. $voucher->last_name;?>
                    </th>

                    <th>Father Name</th>
                    <td>
                        <?php echo $voucher->first_name.'     '. $voucher->last_name;?>
                    </td>
                </tr>
                <tr>
                    <th>Enrollment No</th>
                    <td>
                        <?php echo $voucher->enrollmentId;?>
                    </td>

                    <th>Class </th>
                    <td>
                        <?php echo $voucher->classTitle?>
                    </td>
                </tr>
                <tr>
                    <th>Study Program</th>
                    <td>
                        <?php echo $voucher->programTitle;?>
                    </td>

                    <th>Section </th>
                    <td>
                        <?php echo $voucher->sectionTitle;?>
                    </td>
                </tr>

                <tr>
                    <th>Installment No</th>
                    <td>
                        <?php echo $voucher->installment_no;?>
                    </td>

                    <th>Installment Amuount </th>
                    <td>
                        <?php echo $voucher->fee_amount;?>
                    </td>
                </tr>
                <tr>
                    <th>Due Date</th>
                    <td>
                        <?php echo $voucher->installment_date;?>
                    </td>

                    <th>Fine</th>
                    <td>
                        <?php echo $voucher->installment_fine;?>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>

                    </td>

                    <th>Total Amount</th>
                    <th class="alert alert-warning">
                        <?php echo $voucher->fee_amount;?>
                    </th>
                </tr>
            </table>
        </div>
    </div>

    <div class="col-md-10 col-md-offset-1" style="background-color: #fff;border: 2px solid #000; border-radius: 5px; margin-bottom:30px;">
        <div class="col-md-12 text-center">
            <img src="<?= base_url(). 'uploaded_images/ilmCollege.png';?>">
        </div>
        <div class="col-md-12">
            <h2 class="text-center"> Student Fee Voucher (Admin Copy) </h2>
            <table class="table">
                <tr>
                    <th>Student Name</th>
                    <th class="alert alert-info">
                        <?php echo $voucher->first_name.'       '. $voucher->last_name;?>
                    </th>

                    <th>Father Name</th>
                    <td>
                        <?php echo $voucher->first_name.'     '. $voucher->last_name;?>
                    </td>
                </tr>
                <tr>
                    <th>Enrollment No</th>
                    <td>
                        <?php echo $voucher->enrollmentId;?>
                    </td>

                    <th>Class </th>
                    <td>
                        <?php echo $voucher->classTitle;?>
                    </td>
                </tr>
                <tr>
                    <th>Study Program</th>
                    <td>
                        <?php echo $voucher->programTitle;?>
                    </td>

                    <th>Section </th>
                    <td>
                        <?php echo $voucher->sectionTitle;?>
                    </td>
                </tr>
                <tr>
                    <th>Installment No</th>
                    <td>
                        <?php echo $voucher->installment_no;?>
                    </td>

                    <th>Installment Amuount </th>
                    <td>
                        <?php echo $voucher->fee_amount;?>
                    </td>
                </tr>
                <tr>
                    <th>Due Date</th>
                    <td>
                        <?php echo $voucher->installment_date;?>
                    </td>

                    <th>Fine</th>
                    <td>
                        <?php echo $voucher->installment_fine;?>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>

                    </td>

                    <th>Total Amount</th>
                    <th class="alert alert-warning">
                        <?php echo $voucher->fee_amount;?>
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
            window.location.href = '<?php echo base_url()."vouchers/index";?>';
        }

        function Popup(data) {
            var infoPrintWindow = window.open('', 'Student Fee Voucher', "width="+screen.availWidth+",height="+screen
                .availHeight);
            infoPrintWindow.document.write('<html><head><title>Student Fee Voucher</title>');
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
