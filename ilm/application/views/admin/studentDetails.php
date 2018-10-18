<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="text-center"><b>Admission Form</b></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">
        			<span>
        				<h5><b>Enrollment No  : <?php echo $student_detail['enrollment_id'] ;?></b></h5>
        			</span>
        </div>
        <div class="col-sm-2 col-sm-offset-8">
        			<span>
        				<h5><b>Study Program : <?php echo $student_detail['class_name'] ;?></b></h5>
        			</span>
        </div>
    </div>
    <div class="row">
        <div class="panel panel-info">
            <div class="panel-heading ">
                <h4>Student Info</h4>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-9">
                        <div class="panel-body">
                            <table class="table table-responsive">
                                <tbody>
                                <tr>
                                    <th>Name</th>
                                    <td><?php echo ucfirst($student_detail['fName']) . ' ' . ucfirst($student_detail['lName']);?></td>
                                    <th>Father Name</th>
                                    <td><?php echo ucfirst($student_detail['father_name']);?></td>
                                </tr>

                                <tr>
                                    <th>Class</th>
                                    <td>
                                        <?php echo $student_detail['class_name'] ;?>
                                    </td>
                                    <th>Section</th>
                                    <td colspan="3"><?php echo $student_detail['section_name'] ;?></td>
                                </tr>
                                <tr>
                                    <th>NIC No</th>
                                    <td>
                                        <?php echo $student_detail['bform_or_cnic_no'] ;?>
                                    </td>
                                    <td><strong>D.O.B</strong></td>
                                    <td><?php echo $student_detail['dob'] ;?></td>
                                </tr>
                                <tr>
                                    <th>Mobile No</th>
                                    <td>
                                        <?php echo $student_detail['profession'];?>
                                    </td>
                                    <td><strong>Email</strong></td>
                                    <td><?php echo $student_detail['email'];?></td>
                                </tr>
                                <tr>
                                    <td><b>Address</b></td>
                                    <td colspan="3"><?php echo $student_detail['class_name'] ;?></td>
                                </tr>
                                <tr>
                                    <td><b>Permanat Address</b></td>
                                    <td colspan="3"><?php echo $addresses['permenant']['address'].', '.$addresses['permenant']['district'].', '.$addresses['permenant']['city'].', '.$addresses['permenant']['country'] ;?></td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-2 col-md-offset-1 text-right">
                        <div class="col-md-12">
                            <?php
                                $dpSrc = ($student_detail['pic'] != '')?base_url().'studentsPics/'.$student_detail['pic']:base_url().'assets/img/profile picture.png';
                            ?>
                            <img src="<?php echo $dpSrc;?>" class="img-responsive thumbnail">
                            <br>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <span class="alert alert-info"><b>Roll No   : <?php echo $student_detail['roll_no'] ;?> </b> </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="panel panel-info">
            <div class="panel-heading ">
                <h4>Guardian's Information</h4>
            </div>
            <div class="panel-body">
                <div class="panel-body">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>Guardain Name</th>
                            <td><?php echo ucfirst($student_detail['g_fname']).' '.ucfirst($student_detail['g_lname']) ;?></td>
                            <th>Father Name</th>
                            <td><?php echo ucfirst($student_detail['father_name']) ;?></td>
                        </tr>

                        <tr>
                            <th>Profession</th>
                            <td><?php echo $student_detail['profession'];?></td>
                            <th>Mobile No : </th>
                            <td>
                                <?php echo $student_detail['mobile_no'];?>
                            </td>

                        </tr>
                        <tr>
                            <td><b>Permanent Address</b></td>
                            <td colspan="8"><?php echo $addresses['permenant']['address'].', '.$addresses['permenant']['district'].', '.$addresses['permenant']['city'].', '.$addresses['permenant']['country'] ;?></td>
                        </tr>
                        <tr>
                            <td><b>Permanent Address</b></td>
                            <td colspan="8"><?php echo $addresses['present']['address'].', '.$addresses['present']['district'].', '.$addresses['present']['city'].', '.$addresses['present']['country'] ;?></td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="panel panel-info">
            <div class="panel-heading ">
                <h4>Previous Institute Detail</h4>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
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
                                            <th>Board/Univercity</th>
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

                                                <td><?php echo  $institute['title']; ?></td>
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
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <span>Student Signature___________</span>
            <span class="pull-right"> Signature___________</span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 text-center" style="background: #2bbce0;color: white;font-family: Arial;height: 50px;padding: 1%;">
        <span>G.T Road, Gujranwala - 055-4296350|0555-4296360|055-4272937</span>
    </div>
</div>