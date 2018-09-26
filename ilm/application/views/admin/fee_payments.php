<div class="container">
    <div class="panel panel-info">
        <div class="panel-heading ">
            <h4>Serach Student</h4>
        </div>
        <div class="panel-body">
            <div class="col-sm-12">
                <form action="/Admission/FeePayment" class="" method="get" novalidate="novalidate">                    <div class="mb5 clearfix">
                        <h4 class="pull-left"><strong>Enter any of the following field data to search</strong></h4>
                        <button type="submit" class="btn btn-primary pull-right"><span class="fa fa-search"></span>  Search</button>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label for="EnrollmentNo">EnrollmentNo</label>
                            <input class="form-control" id="EnrollmentNo" name="EnrollmentNo" value="100" type="text">
                        </div>
                        <div class="col-sm-2">
                            <label class="control-label" for="DateFrom">DateFrom</label>
                            <div class="input-group date">
                                <input class="form-control" data-val="true" data-val-date="The field DateFrom must be a date." id="dto" name="DateFrom" placeholder="From" value="04/10/2018" type="text">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label class="control-label" for="DateTo">DateTo</label>
                            <div class="input-group date">
                                <input class="form-control" data-val="true" data-val-date="The field DateTo must be a date." id="dto" name="DateTo" placeholder="To" value="11/15/2018" type="text">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label for="ClassId">ClassId</label>
                            <select class="form-control" data-val="true" data-val-number="The field ClassId must be a number." id="ddlclass" name="ClassId"><option value="">Select Class</option>
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
                            <label for="SectionId">SectionId</label>
                            <select class="form-control" data-val="true" data-val-number="The field SectionId must be a number." id="ddlSection" name="SectionId"><option value="">Select Section</option>
                            </select>                        </div>
                        <div class="col-sm-2">
                            <label for="Status">Status</label>
                            <select class="form-control" data-val="true" data-val-number="The field Status must be a number." id="Status" name="Status"><option value="">Select</option>
                                <option value="0">UnPaid</option>
                                <option value="1">Paid</option>
                                <option selected="selected" value="3">All</option>
                            </select>
                        </div>
                    </div>
                </form>            </div>
        </div>
    </div>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4>Installments</h4>



            <div class="options">

            </div>
        </div>
        <div class="panel-body std-panel infinite-scroll">
            <div class="std-detail clearfix">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>

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

                            <?php
                                foreach ($installments as $installment){


                            ?>
                            <tr id="<?php echo $installment['pfid'];?>">


                                <td><?php echo $installment['id'];?></td>
                                <td><?php echo ucfirst($installment['first_name'])." ".ucfirst($installment['last_name']);?></td>
                                <td><?php echo $installment['installment_no'];?></td>
                                <td><?php echo $installment['fee_amount'];?></td>
                                <td><?php echo $installment['installment_date'];?></td>
                                <td><?php echo $installment['title'];?> </td>
                                <td><?php echo ($installment['status'] == 0)?'UnPaid':'Paid';?></td>
                                <td>


                                    <a href="javascript:payInstallment('<?php echo $installment['pfid'];?>')" class="btn btn-info"><i aria-hidden="true"></i>Paid</a>
                                    <a href="<?php echo base_url()."admin/editInstallments/".$installment['id'];?>" class="btn btn-primary"><i aria-hidden="true"></i>Change</a>
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

<script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery-1.10.2.min.js'></script>

<script>
    function payInstallment(id){
        var url = '<?php echo base_url();?>admin/payInstallment/'+id;
        $.ajax({
            url: url,
            type:'get',
            success: function () {
                alert("Installment Paid!");
                $("#"+id).slideUp("slow", function() { $("#"+id).remove();});

            },
            error: function (err) {
                console.log(err);
            }
        });
    }
</script>