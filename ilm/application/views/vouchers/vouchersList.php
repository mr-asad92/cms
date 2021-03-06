
<link href='<?php echo base_url();?>assets/plugins/datatables/dataTables.css' rel='stylesheet' type='text/css' media='all' id='headerswitcher'>

<div class="container">


    <div class="panel panel-info">
        <div class="panel-heading ">
            <h4>Serach Student</h4>
        </div>
        <div class="panel-body">
            <div class="col-sm-12">
                <form action="<?php echo base_url().'vouchers';?>" class="" method="post" novalidate="novalidate">                    <div class="mb5 clearfix">
                        <h4 class="pull-left"><strong>Enter any of the following field data to search</strong></h4>
                        <button type="submit" class="btn btn-primary pull-right"><span class="fa fa-search"></span>  Search</button>
                        <button type="button" style="margin-right: 5px;" class="btn btn-info pull-right" onclick="window.location.href= '<?php echo base_url()."Vouchers";?>';"><span class="fa fa-refresh"></span>  Refresh</button>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-1">
                            <label for="voucherNo">VoucherNo</label>
                            <input class="form-control" id="voucherNo" name="voucherNo" value="<?php echo set_value('voucherNo');?>" type="text">
                        </div>
                        <div class="col-sm-1">
                            <label for="EnrollmentNo">EnrollmentNo</label>
                            <input class="form-control" id="EnrollmentNo" name="EnrollmentNo" value="<?php echo set_value('EnrollmentNo');?>" type="text">
                        </div>
                        <div class="col-sm-2">
                            <label class="control-label" for="DateFrom">DateFrom</label>
                            <div class="input-group date">
                                <input class="form-control enableDatePickerFrom" data-val="true" data-val-date="The field DateFrom must be a date." id="dto" name="DateFrom" placeholder="From" value="<?php echo set_value('DateFrom');?>" type="text">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label class="control-label" for="DateTo">DateTo</label>
                            <div class="input-group date">
                                <input class="form-control enableDatePickerTo" data-val="true" data-val-date="The field DateTo must be a date." id="dto" name="DateTo" placeholder="To" value="<?php echo set_value('DateTo', date("m/t/Y"));?>" type="text">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-2">
<!--                            <label for="ClassId">ClassId</label>-->
<!--                            --><?php //echo form_dropdown('classId', $classes, set_value('classId'),'class="form-control"');?>

                            <label for="ClassId">Roll #</label>
                            <input class="form-control" data-val="true" data-val-date="The field Roll No must be a date." id="dto" name="roll_no" value="<?php echo set_value('roll_no');?>" type="text">
                        </div>
                        <div class="col-sm-1">
                            <label for="Class">Class</label>
                            <?php echo form_dropdown('classId', $classes, set_value('classId', setVal('', 0, 'class_id', '')),'class="form-control"');?>


                        </div>
                        <div class="col-sm-1">
                            <label for="SectionId">SectionId</label>
                            <?php echo form_dropdown('sectionId', $sections, set_value('sectionId'),'class="form-control"');?>
                        </div>
                        <div class="col-sm-2">
                            <label for="Status">Status</label>
                            <select class="form-control" data-val="true" data-val-number="The field Status must be a number." id="Status" name="Status">
                                <option value="0">UnPaid</option>
                                <option value="1">Paid</option>
                                <option value="2">Waved Off</option>
                                <option selected="selected" value="3">All</option>
                            </select>
                        </div>
                    </div>
                </form>            </div>
        </div>
    </div>


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
                                <th>Voucher No</th>
                                <th>Enrollment No</th>
                                <th>Roll No</th>
                                <th>Full Name</th>
                                <th>Installment No</th>
                                <th>Installment Amount</th>
                                <th>Installment Date</th>
                                <th>Class</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($vouchers as $voucher){
                                $classTitle = $this->admin_model->getClassName($voucher->classId);
                                $sectionTitle = $this->admin_model->getSectionName($voucher->sectionId);
                                $programTitle = $this->admin_model->getProgramName($voucher->program_id);
                                $csp = trim($programTitle.' - '.$classTitle.' - '.$sectionTitle);
//                                debug($programTitle.' - '.$classTitle.' - '.$sectionTitle);
                                ?>
                                <tr>

                                    <td class="text-center hdns">
                                        <input class="checkbox chkbulk" name="printChkBox" type="checkbox" value="<?php echo $voucher->enrollmentId."_".$voucher->installment_no."_".$voucher->vocher_id;?>">
                                    </td>
                                    <td><?php echo $voucher->id ;?></td>
                                    <td><?php echo $voucher->enrollmentId ;?></td>
                                    <td><?php echo $voucher->roll_no ;?></td>
                                    <td><?php echo $voucher->first_name .' '.$voucher->last_name  ;?></td>
                                    <td><?php echo $voucher->installment_no ;?></td>
                                    <td><?php echo $voucher->fee_amount ;?></td>
                                    <td><?php echo formatDateForView($voucher->installment_date) ;?></td>
                                    <td><?php echo $csp ;?></td>
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
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
