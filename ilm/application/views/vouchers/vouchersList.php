
<link href='<?php echo base_url();?>assets/plugins/datatables/dataTables.css' rel='stylesheet' type='text/css' media='all' id='headerswitcher'>

<div class="container">
    <div class="panel panel-info">
        <div class="panel-heading ">
            <h4>Serach Student Vouchers</h4>
        </div>
        <div class="panel-body">
            <div class="col-sm-12">
                <form action="/Admission/Fee" class="" method="get" novalidate="novalidate">                    <div class="mb5 clearfix">
                        <h4 class="pull-left"><strong>Enter any of the following field data to search</strong></h4>
                        <button type="submit" class="btn btn-primary pull-right"><span class="fa fa-search"></span>  Search</button>
                        <a href="/Admission/Fee" data-toggle="tooltip" title="Refresh Search" class="pull-right btn btn-info"><i class="fa fa-refresh" aria-hidden="true"></i> Refresh</a>

                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label for="EnrollmentNo">Enrollment No</label>
                            <input class="form-control" name="enrollment_id" type="text">
                        </div>
                        <div class="col-sm-2">
                            <label class="control-label" for="DateFrom">Date From</label>
                            <div class="input-group date">
                                <input type="date" class="form-control" name="">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label class="control-label" for="DateTo">Date To</label>
                            <div class="input-group date">
                                <input class="form-control" name="DateTo" type="date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label for="ClassId">Program</label>
                            <select class="form-control" id="" name="ProgramId"><option value="">Select
                                    Class</option>
                                <option value="7">B</option>
                                <option value="6">FA</option>
                                <option value="5">ICS</option>
                                <option value="4">I-Com</option>
                                <option value="3">ADP(CS)</option>
                                <option value="2">ADP (Accounting )</option>
                                <option value="1">FSC (Medical)</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label for="SectionId">Section</label>
                            <select class="form-control" id="ddlSection" name="SectionId"><option value="">Select Section</option>
                            </select>                        </div>
                        <div class="col-sm-2">
                            <label for="Status">Status</label>
                            <select class="form-control" data-val="true" data-val-number="The field Status must be a number." id="Status" name="Status"><option selected="selected" value="0">UnPaid</option>
                                <option value="1">Paid</option>
                                <option value="3">All</option>
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
                                    <input id="chkAll" type="checkbox">
                                </th>
                                <th>Enrollment No</th>
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
                            <?php foreach ($vouchers as $voucher): ?>
                                <tr>

                                    <td class="text-center hdns">
                                        <input class="checkbox chkbulk" type="checkbox">
                                    </td>
                                    <td><?php echo $voucher->enrollmentId ;?></td>
                                    <td><?php echo $voucher->first_name .' '.$voucher->last_name  ;?></td>
                                    <td><?php echo $voucher->installment_no ;?></td>
                                    <td><?php echo $voucher->fee_amount ;?></td>
                                    <td><?php echo $voucher->installment_date ;?></td>
                                    <td><?php echo $voucher->classTitle ;?></td>
                                    <td>
                                        <?php
                                        if ($voucher->status == 1)
                                        {
                                            echo '<p class="text-success">Paid</p>';
                                        }
                                        else
                                        {
                                            echo '<p class="text-danger">Unpaid</p>';
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