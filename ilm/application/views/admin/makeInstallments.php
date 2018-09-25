<div class="container">
    <form action="<?php echo base_url();?>admin/saveInstallments" id="frm" method="post" novalidate="novalidate">        <div class="panel panel-info">
            <div class="panel-heading ">
                <h4>Define Student Fee Installments</h4>
            </div>
            <div class="panel-body">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-sm-3">
                                <input data-val="true" data-val-number="The field Id must be a number." data-val-required="The Id field is required." id="Student_Id" name="Student.Id" value="10008" type="hidden">
                                <input data-val="true" data-val-number="The field Id must be a number." data-val-required="The Id field is required." id="Fee_Id" name="Fee.Id" value="5" type="hidden">
                                <label for="Student_EnrollmentNo">Enrollment Number</label>
                                <input class="form-control" id="Student_EnrollmentNo" name="enrollmentNo" readonly="readonly" value="<?php echo $student_detail['enrollment_number']?>" type="text">

                            </div>
                            <div class="col-sm-3">
                                <label for="Student_Name">Student Name</label>
                                <input value="<?php echo ucfirst($student_detail['first_name'])." ".ucfirst($student_detail['last_name']);?>" class="form-control" data-val="true" data-val-required="This field is requried." id="Student_FirstName" name="student_firstName" readonly="True" type="text">
                            </div>
                            <div class="col-sm-3">
                                <label for="Guardian_Name">Guardian Name</label>
                                <input value="<?php echo ucfirst($student_detail['guardian_first_name'])." ".ucfirst($student_detail['guardian_last_name']);?>" class="form-control" data-val="true" data-val-required="This field is requried." id="Student_Parent_FirstName" name="Student.Parent.FirstName" readonly="True" type="text">
                            </div>
                            <div class="col-sm-3">
                                <label for="FeeInstallment_Total">Total</label>
                                <input value="<?php echo $student_detail['grand_total']?>" class="form-control" data-val="true" data-val-number="The field Total must be a number." data-val-required="The Total field is required." id="tot" name="FeeInstallment.Total" readonly="True" type="text">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-sm-2">
                                <label for="FeeInstallment_InitialAmount">InitialAmount</label>
                                <input class="form-control txtCal valid" data-val="true" data-val-number="The field InitialAmount must be a number." id="InitialAmount" name="initialAmount" value="" aria-describedby="InitialAmount-error" aria-invalid="false" type="text">
                            </div>
                            <div class="col-sm-2">
                                <label for="FeeInstallment_PendingAmount">PendingAmount</label>
                                <input value="<?php echo $pending_amount;?>" class="form-control txtCal" data-val="true" data-val-number="The field PendingAmount must be a number." data-val-required="The PendingAmount field is required." id="InstallmentAmount" name="FeeInstallment.PendingAmount" readonly="True" type="text">
                            </div>
                            <div class="col-sm-3">
                                <label class="control-label" for="FeeInstallment_ToDate">ToDate</label>
                                <div class="input-group date">
                                    <input value="<?php echo $to_date;?>" class="form-control" data-val="true" data-val-date="The field ToDate must be a date." data-val-required="The ToDate field is required." id="dto" name="FeeInstallment.ToDate" type="text">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                                <span class="field-validation-valid text-danger" data-valmsg-for="FeeInstallment.ToDate" data-valmsg-replace="true"></span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4>Student List</h4>
                <div class="options">

                </div>
            </div>
            <div class="panel-body std-panel infinite-scroll" style="border-radius: 0px;">
                <div class="std-detail clearfix">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Installment No</th>
                                    <th>Installment Amount</th>
                                    <th>Installment Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="tbdy">

                                <tr class="rw">
                                    <td class="text-center" id="NoOfInst"><input class="form-control txtNo" data-val="true" data-val-number="The field NoOFInstallment must be a number." data-val-required="The NoOFInstallment field is required." id="FeeInstallmentDetails" readonly="readonly" name="installmentNo[]" value="2" type="text"><span class="field-validation-valid text-danger VLDNo" data-valmsg-for="FeeInstallmentDetails[0].NoOFInstallment" data-valmsg-replace="true"></span></td>

                                    <td class="text-center" id="PendAmnt"><input class="form-control txtAmnt" data-val="true" data-val-number="The field InstallmentAmount must be a number." data-val-required="The InstallmentAmount field is required." id="FeeInstallmentDetails" name="installmentAmount[]" value="10000" type="text"><span class="field-validation-valid text-danger VLDAmnt" data-valmsg-for="FeeInstallmentDetails[0].InstallmentAmount" data-valmsg-replace="true"></span></td>

                                    <td class="text-center" id="dte"><div class="input-group date "><input value="05/20/2018" class="form-control txtDate" data-val="true" data-val-date="The field InstallmentDate must be a date." data-val-required="The InstallmentDate field is required." id="Date" name="installmentDate[]" type="text"><span class="input-group-addon"><i class="fa fa-calendar"></i></span></div><span class="field-validation-valid text-danger VLDDate" data-valmsg-for="FeeInstallmentDetails[0].InstallmentDate" data-valmsg-replace="true"></span></td>

                                    <td><input value="Add" class="btn btn-info btnAdd valid" aria-invalid="false" type="button">&nbsp;<input value="Remove" class="btn btn-info btnDel" type="button"></td>

                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-sm-2 pull-right">
                        <div class="col-md-6">
                            <button class="btn btn-primary pull-right" id="btnSubmit" type="submit"> Save </button>
                        </div>
                        <div class="col-md-6">
                            <a href="<?php echo base_url().'admin/studentsList'?>" class="btn-default btn pull-right"> Cancel </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form></div>

<script type='text/javascript' src='<?php echo base_url();?>assets/js/installments.js'></script>
