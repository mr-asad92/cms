<div class="container">
    <div class="panel panel-info">
        <div class="panel-heading ">
            <h4>Serach Student</h4>
        </div>
        <div class="panel-body">
            <div class="col-sm-12">
                <form action="<?php echo base_url().'admin/fee_payments';?>" class="" method="post" novalidate="novalidate">                    <div class="mb5 clearfix">
                        <h4 class="pull-left"><strong>Enter any of the following field data to search</strong></h4>
                        <button type="submit" class="btn btn-primary pull-right"><span class="fa fa-search"></span>  Search</button>
                        <button type="button" style="margin-right: 5px;" class="btn btn-info pull-right" onclick="window.location.href= '<?php echo base_url()."admin/fee_payments";?>';"><span class="fa fa-refresh"></span>  Refresh</button>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
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
                                <input class="form-control enableDatePickerTo" data-val="true" data-val-date="The field DateTo must be a date." id="dto" name="DateTo" placeholder="To" value="<?php echo set_value('DateTo');?>" type="text">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label for="ClassId">ClassId</label>
                            <?php echo form_dropdown('classId', $classes, set_value('classId'),'class="form-control"');?>
                        </div>
                        <div class="col-sm-2">
                            <label for="SectionId">SectionId</label>
                            <?php echo form_dropdown('sectionId', $sections, set_value('sectionId'),'class="form-control"');?>
                        </div>
                        <div class="col-sm-2">
                            <label for="Status">Status</label>
                            <select class="form-control" data-val="true" data-val-number="The field Status must be a number." id="Status" name="Status"><option value="3">Select</option>
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


                                    if ($installment['status'] == 0){
                                        $status = 'UnPaid';
                                    }
                                    else if($installment['status'] == 1){
                                        $status = 'Paid';
                                    }
                                    else if($installment['status'] == 2){
                                        $status = 'Waved Off';
                                    }
                                    else{
                                        $status = '';
                                    }
                            ?>
                            <tr id="<?php echo $installment['pfid'];?>">


                                <td><?php echo $installment['id'];?></td>
                                <td><?php echo ucfirst($installment['first_name'])." ".ucfirst($installment['last_name']);?></td>
                                <td><?php echo $installment['installment_no'];?></td>
                                <td><?php echo $installment['fee_amount'];?></td>
                                <td><?php echo $installment['installment_date'];?></td>
                                <td><?php echo $installment['title'].' ('.$installment['programTitle'].')';?> </td>
                                <td><?php echo $status;?> </td>
                                <td>


<!--                                    <a href="javascript:payInstallment('--><?php //echo $installment['pfid'];?><!--')" class="btn btn-info"><i aria-hidden="true"></i>Paid</a>-->

<!--                                    <a href="javascript:getFeeData('--><?php //echo $installment['pfid'];?><!--')" class="btn btn-info --><?php //echo ($installment['status'] == 1)?'disabled':($installment['status'] == 2)?'disabled':'';?><!--"><i aria-hidden="true"></i>Paid</a>-->
                                    <?php
                                        if ($installment['status'] == 0){
                                            ?>
                                            <a href="javascript:getFeeData('<?php echo $installment['pfid'];?>')" class="btn btn-info"><i aria-hidden="true"></i>Paid</a>

                                    <?php
                                        }
                                        else if($installment['status'] == 1){
                                            ?>
                                            <a href="javascript:getFeeData('<?php echo $installment['pfid'];?>','unpay')" class="btn btn-info"><i aria-hidden="true"></i>UnPay</a>
                                    <?php
                                        }
                                        else{
                                            ?>
                                                                                <a href="javascript:getFeeData('<?php echo $installment['pfid'];?>')" class="btn btn-info <?php echo ($installment['status'] == 1)?'disabled':($installment['status'] == 2)?'disabled':'';?>"><i aria-hidden="true"></i>Paid</a>
                                    <?php
                                        }
                                    ?>

                                    <a href="<?php echo base_url()."admin/editInstallments/".$installment['id'];?>" class="btn btn-primary <?php echo ($installment['status'] == 1)?'disabled':($installment['status'] == 2)?'disabled':'';?>"><i aria-hidden="true"></i>Change</a>
                                    <a href="javascript:waveOff('<?php echo $installment['pfid'];?>')" class="btn btn-danger <?php echo ($installment['status'] == 1)?'disabled':($installment['status'] == 2)?'disabled':'';?>"><i aria-hidden="true"></i>Wave Off</a>
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

    function waveOff(id) {
        var url = '<?php echo base_url();?>admin/getInstallmenetData/'+id;
        $.ajax({
            url: url,
            type:'get',
            success: function (data) {
//                console.log(JSON.stringify(data, null, 4));
                data = JSON.parse(data);
                var html = '<table class="table table-stripped table-condensed">';

                var status = data.status == 0? 'UnPaid':'Paid';
                html += '' +
                    '<tr><th>Enrollment No: </th><td>'+data.id+'</td></tr>\n' +
                    '<tr><th>Name: </th><td>'+data.first_name+' '+data.last_name+'</td></tr>\n' +
                    '<tr><th>Class: </th><td>'+data.title+'</td></tr>\n' +
                    '<tr><th>Installment No: </th><td>'+data.installment_no+'</td></tr>\n' +
                    '<tr><th>Installment Date: </th><td>'+data.installment_date+'</td></tr>\n' +
                    '<tr><th>Installment Amount: </th><td><span id="feeAmount">'+data.fee_amount+'</span></td></tr>\n' +
                    '<tr><th>Fine: </th><td><input type="text" id="calculatedFine" class="form-control" onchange="calculateTotalAmount()" value="'+data.calculated_fine+'"></td></tr>\n' +
                    '<tr><th class="text-info">Total Amount: </th><th class="text-info"><span id="totalAmount">'+data.total_amount+'</span></th></tr>\n' +
                    '<tr><th class="text-danger">Status: </th><td class="text-danger">'+status+'</td></tr>\n' +
                    '';

                html += "<tr><td></td><td><a href='javascript:submitWaveOff("+data.pfid+")' class='btn btn-danger'><i aria-hidden='true'></i>Wave Off</a></td></tr>";

                html +='</table>';

                $("#payFeeModalBody").html(html);
                $("#feePayModal").modal('show');

            },
            error: function (err) {
                console.log(err);
            }
        });
    }
    
    function submitWaveOff(id) {

        var url = '<?php echo base_url();?>admin/submitWaveOff/'+id;
        $.ajax({
            url: url,
            type:'get',
            success: function (data) {
                alert("Installment Waved Off!");
                $("#"+id).slideUp("slow", function() { $("#"+id).remove();});

            },
            error: function (err) {
                console.log(err);
            }
        });
    }

    function getFeeData(id, unpay=false){

        var methodName = 'getPaidInstallmenetData';
        if(unpay==false){
            var methodName = 'getInstallmenetData';
        }

        var url = '<?php echo base_url();?>admin/'+methodName+'/'+id;
        $.ajax({
            url: url,
            type:'get',
            success: function (data) {
                console.log(JSON.stringify(data, null, 4));
                data = JSON.parse(data);
                var html = '<table class="table table-stripped table-condensed">';

                var status = data.status == 0? 'UnPaid':'Paid';
                html += '' +
                    '<tr><th>Enrollment No: </th><td>'+data.id+'</td></tr>\n' +
                    '<tr><th>Name: </th><td>'+data.first_name+' '+data.last_name+'</td></tr>\n' +
                    '<tr><th>Class: </th><td>'+data.title+'</td></tr>\n' +
                    '<tr><th>Installment No: </th><td>'+data.installment_no+'</td></tr>\n' +
                    '<tr><th>Installment Date: </th><td>'+data.installment_date+'</td></tr>\n' +
                    '<tr><th>Installment Amount: </th><td><span id="feeAmount">'+data.fee_amount+'</span></td></tr>\n' +
                    '<tr><th>Fine: </th><td><input type="text" id="calculatedFine" class="form-control" onchange="calculateTotalAmount()" value="'+data.calculated_fine+'"></td></tr>\n' +
                    '<tr><th class="text-info">Total Amount: </th><th class="text-info"><span id="totalAmount">'+data.total_amount+'</span></th></tr>\n' +
                    '<tr><th class="text-danger">Status: </th><td class="text-danger">'+status+'</td></tr>\n' +
                    '';

                if (unpay=='unpay'){
                    html += "<tr><td></td><td><a href='javascript:unpayInstallment(" + data.pfid + ")' class='btn btn-info'><i aria-hidden='true'></i>Confirm UnPay</a></td></tr>";
                }
                else {
                    html += "<tr><td></td><td><a href='javascript:payInstallment(" + data.pfid + ")' class='btn btn-info'><i aria-hidden='true'></i>Confirm Pay</a></td></tr>";
                }
                html +='</table>';

                $("#payFeeModalBody").html(html);
                $("#feePayModal").modal('show');

            },
            error: function (err) {
                console.log(err);
            }
        });
    }
    
    function calculateTotalAmount() {
        var fee_amount = $('#feeAmount').html();
        var total_amount = $('#totalAmount').html();
        var fine = $('#calculatedFine').val();

        total_amount = Number(fee_amount) + Number(fine);
        $('#totalAmount').html(total_amount);

    }
    function payInstallment(id){
        var calculatedFine = $('#calculatedFine').val();

        var url = '<?php echo base_url();?>admin/payInstallment/'+id+'/'+calculatedFine;
        $.ajax({
            url: url,
            type:'get',
            success: function (data) {
                alert("Installment Paid!");
                $("#"+id).slideUp("slow", function() { $("#"+id).remove();});

            },
            error: function (err) {
                console.log(err);
            }
        });
    }

    function unpayInstallment(id){
        var calculatedFine = $('#calculatedFine').val();

        var url = '<?php echo base_url();?>admin/unpayInstallment/'+id+'/'+calculatedFine;
        $.ajax({
            url: url,
            type:'get',
            success: function (data) {
                console.log(JSON.stringify(data, null, 4));
                alert("Installment unPaid!");
                $("#"+id).slideUp("slow", function() { $("#"+id).remove();});

            },
            error: function (err) {
                console.log(err);
            }
        });
    }
</script>