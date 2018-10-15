<div id="printStudentDetails">

    <div class="panel panel-midnightblue">
        <div class="">
            <h4>Student Information</h4>
        </div>
        <div class="panel-body">
            <div class="std-detail clearfix">
                <div class="row">
                    <div class="col-sm-5">
                        <h4><?php echo $student_detail['fName'] . ' ' . $student_detail['lName'];?></h4>
                        <h4>Enrollment No: <?php echo $student_detail['id'] ;?></h4>
                        <h4>Class: <?php echo $student_detail['class_name'] ;?></h4>
                        <h4>Section: <?php echo $student_detail['section_name'] ;?> </h4>
                    </div>
                    <div class="col-sm-7">
                        <?php
                        $src = ($student_detail['pic'] == '')?base_url().'assets/img/profile picture.png':base_url().'studentsPics/'.$student_detail['pic'];

                        ?>
                            <img src="<?php echo $src;?>" class="img-responsive pull-right" style="height: 200px; width: 200px;">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-midnightblue">
        <div class="">
            <h4>Personal Detail</h4>
        </div>
        <div class="panel-body">
            <div class="std-detail clearfix">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody><tr>
                                <th>Gender</th>
                                <td><?php echo $gender ;?></td>
                                <th>Current Address</th>
                                <td><?= $presentAddresses['address']." , ".$presentAddresses['city']."  , "
                                    .$presentAddresses['district']."  , ".$presentAddresses['country'];?></td>
                            </tr>
                            <tr>
                                <td><strong>D.O.B</strong></td>
                                <td><?php echo $student_detail['dob'] ;?></td>
                                <td><b>Permanent Address</b></td>
                                <td><?= $permenantAddresses['address']." , ".$permenantAddresses['city']."  , "
                                    .$permenantAddresses['district']."  , ".$permenantAddresses['country'];?></td>
                            </tr>
                            </tr>

                            <tr>
                                <th>Blood</th>
                                <td>

                                    <?php echo $student_detail['blood_group'] ;?>
                                </td>
                                <th>Caste</th>
                                <td colspan="3"><?php echo $student_detail['caste'] ;?></td>
                            </tr>

                            </tbody></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-midnightblue">
        <div class="pannel">
            <h4>Guardian Information</h4>
        </div>
        <div class="panel-body">
            <div class="std-detail clearfix">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody><tr>
                                <td colspan="4">
                                    <div class="form-group">
                                        <h4>
                                            <span class="col-md-2">Guardian Detail</span>
                                        </h4>
                                        <span class="col-md-6">
                                            <?php $guardian_Id = $student_detail['guardian'] ;?>
                                            <label class="col-sm-3 radiofive">
                                                <input <?php echo $guardian_Id == 0 ? 'checked="True"' : 'disabled';?>
                                                    id="father" name="Parent.Type" type="radio"> <label
                                                    for="father"></label> <span>Father</span>
                                            </label>
                                            <label class="col-sm-3 radiofive">
                                                <input <?php echo $guardian_Id == 1 ? 'checked="True"' : 'disabled';?>
                                                    id="mother" name="Parent.Type" type="radio"> <label for="mother"></label> <span>Mother</span>
                                            </label>
                                            <label class="col-sm-3 radiofive">
                                                <input <?php echo $guardian_Id == 2 ? 'checked="True"' : 'disabled';?>
                                                    id="other" name="Parent.Type"
                                                    type="radio"> <label for="other"></label> <span>Other</span>
                                            </label>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Guardian Name</th>
                                <td><?php echo $student_detail['first_name'].' '. $student_detail['last_name'] ;?></td>

                                <th>Profession</th>
                                <td>
                                    <?php echo $student_detail['profession'] ;?>
                                </td>
                            </tr>
                            <tr>
                                <th>Designation</th>
                                <td><?php echo $student_detail['designation'] ;?></td>
                            </tr>
                            <tr>
                                <th>Organization Name</th>
                                <td><?php echo $student_detail['organization_name'] ;?></td>
                                <th>Office Address</th>
                                <td><?php echo $student_detail['office_address'] ;?></td>
                            </tr>
                            <tr>
                                <th>Mobile</th>
                                <td><?php echo $student_detail['mobile_no'] ;?></td>
                                <th>Telephone</th>
                                <td><?php echo $student_detail['telephone'] ;?></td>
                            </tr>



                            <tr>
                                <th>Email</th>
                                <td colspan="3"><?php echo $student_detail['email'] ;?></td>
                            </tr>
                            </tbody></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-midnightblue">
        <div class="">
            <h4>Previous Institute Detail</h4>



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
                                <th>Examination</th>
                                <th>Year</th>
                                <th>Roll no</th>
                                <th>Board/University</th>
                                <th>Obtained Marks</th>
                                <th>Total Marks</th>
                                <th>Grade</th>
                                <th>Subjects</th>
                                <th>Institute Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($previousInstitutes as $institute) : ?>
                                <tr>

                                    <td><?php echo  $institute['exam_type']; ?></td>
                                    <td><?php echo  $institute['exam_year']; ?></td>
                                    <td><?php echo  $institute['p_roll_no']; ?> </td>
                                    <td><?php echo  $institute['board_university']; ?></td>
                                    <td><?php echo  $institute['obt_marks']; ?></td>
                                    <td><?php echo  $institute['total_marks']; ?></td>
                                    <td><?php echo  $institute['grade']; ?></td>
                                    <td><?php echo  $institute['subjects']; ?></td>
                                    <td><?php echo  $institute['institute_name']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="panel panel-midnightblue">
        <div class="">
            <h4>Fee Package</h4>



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
                                <th>Admission Fee</th>
                                <th>Fee Package</th>
                                <th>Tuition Fee</th>
                                <th>Board/University Fee</th>
                                <th>Library Fee</th>
                                <th>Miscellaneous</th>
                                <th>Others</th>
                                <th>Total</th>
                                <th>Grand Total</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr>

                                <td><?php echo  $feeInfo['adm_fee']; ?></td>
                                <td><?php echo  $feeInfo['fee_package']; ?></td>
                                <td><?php echo  $feeInfo['tuition_fee']; ?> </td>
                                <td><?php echo  $feeInfo['boardUniReg_fee']; ?></td>
                                <td><?php echo  $feeInfo['library_fee']; ?></td>
                                <td><?php echo  $feeInfo['miscellaneous_fee']; ?></td>
                                <td><?php echo  $feeInfo['others']; ?></td>
                                <td><b><?php echo  $feeInfo['total_fee']; ?></b></td>
                                <td><b><?php echo  $feeInfo['grand_total']; ?></b></td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-2 pull-right">
        <div class="col-md-6">
            <a href="<?php echo base_url(); ?>admin/editRegistration/<?php echo $student_detail['id']; ?>"
               class="btn btn-primary pull-right">Edit</a>
        </div>
        <div class="col-md-6">
            <a href="<?php echo base_url(); ?>admin/studentsList"
               class="btn-default btn pull-right"> Cancel </a>
        </div>
    </div>
</div>

<script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery-1.10.2.min.js'></script>

<script type="text/javascript">

    $(document).ready(function(){
        PrintElem('#printStudentDetails');
    });

    function PrintElem(elem) {
        Popup($(elem).html());
        window.location.href = '<?php echo base_url()."admin/studentsList";?>';
    }

    function Popup(data) {
        var infoPrintWindow = window.open('', 'Student Information', "width="+screen.availWidth+",height="+screen.availHeight);
        infoPrintWindow.document.write('<html><head><title>Student Information</title>');
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
