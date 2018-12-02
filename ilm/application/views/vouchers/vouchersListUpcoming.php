
<link href='<?php echo base_url();?>assets/plugins/datatables/dataTables.css' rel='stylesheet' type='text/css' media='all' id='headerswitcher'>

<div class="container">


    <div class="panel panel-info">
        <div class="panel-heading">
            <h4>Student Vouchers List</h4>


            <input style="margin-top:5px;" class="btn btn-primary btn-sm pull-right" id="btnPrintsel" value="Print Selected" type="button">
            <div class="options">

            </div>
        </div>
        <div class="panel-body std-panel infinite-scroll">
            <div class="std-detail clearfix">
                <div class="col-sm-12">
                    <div class="">
                        <table class="table table-responsive" id="vouchersList" >
                            <thead>
                            <tr>
                                <th class="text-center">
                                    <input id="checkAll" type="checkbox">
                                </th>
                                <th>Enrollment No</th>
                                <th>Full Name</th>
                                <th>Installment No</th>
                                <th>Roll No</th>
                                <th>Installment Amount</th>
                                <th>Installment Date</th>
                                <th>Class</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($vouchers as $voucher): ?>
                                <tr>

                                    <td class="text-center hdns">
                                        <input class="checkbox chkbulk" name="printChkBox" type="checkbox" value="<?php echo $voucher->enrollmentId."_".$voucher->installment_no."_".$voucher->vocher_id;?>">
                                    </td>
                                    <td><?php echo $voucher->enrollmentId ;?></td>
                                    <td><?php echo $voucher->roll_no ;?></td>
                                    <td><?php echo $voucher->first_name .' '.$voucher->last_name  ;?></td>
                                    <td><?php echo $voucher->installment_no ;?></td>
                                    <td><?php echo $voucher->fee_amount ;?></td>
                                    <td><?php echo $voucher->installment_date ;?></td>
                                    <td><?php echo $voucher->programTitle.' - '.$voucher->classTitle.' - '.$voucher->sectionTitle ;?></td>
                                    <td>
                                        <?php

                                        if ($voucher->status == 0){
                                            echo '<p class="text-danger">Unpaid</p>';
                                        }
                                        else if($voucher->status == 1){
                                            echo '<p class="text-success">Paid</p>';
                                        }
                                        else if($voucher->status == 2){
                                            echo '<p class="text-danger">Waved Off</p>';
                                        }


                                        ;?>
                                    </td>

                                    <td>
                                        &nbsp;
                                        <a href="<?php echo base_url().'vouchers/details/'. $voucher->vocher_id ;?>"
                                           style="margin-top:2px" class="fa fa-info"
                                           title="Details"> </a>
                                        &nbsp;
                                        <a href="<?php echo base_url().'vouchers/feePackageAndHistory/'.
                                            $voucher->enrollmentId ;?>"
                                           style="margin-top:2px"
                                           class="fa fa-history"
                                           title="Fee History"> </a>
                                        &nbsp;
                                        <a href="<?php echo base_url().'vouchers/printVoucher/'. $voucher->vocher_id ;?>"
                                           style="margin-top:2px"
                                           class="fa fa-print"
                                           id="<?php echo $voucher->enrollmentId."_".$voucher->installment_no."_".$voucher->vocher_id;?>"
                                           title="Print"> </a>
                                    </td>


                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
