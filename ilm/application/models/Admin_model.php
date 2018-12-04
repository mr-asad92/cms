<?php

class Admin_Model extends CI_Model
{
    public function getEnrollmentId() {
        $enrollment_id = 1;
        $row = $this->db->query('SELECT MAX(id) AS maxid FROM enrollment')->row();

        if ($row->maxid != null) {
            $enrollment_id = $row->maxid + 1;
        }

        return $enrollment_id;
    }

    public function getPrograms($get_empty_selected = false) {
        $programsList = [];
        $programs = $this->db->get('programs')->result_array();

        if ($get_empty_selected){
            $programsList['0'] = '';
        }
        foreach ($programs as $program ){
            $programsList[$program['id']] = $program['title'];
        }


        return $programsList;
    }

    public function getClasses($get_empty_selected = false) {
        $classesList = [];
        $classes = $this->db->get('classes')->result_array();

        if ($get_empty_selected){
            $classesList['0'] = '';
        }
        foreach ($classes as $class ){
            $classesList[$class['id']] = $class['title'];
        }


        return $classesList;
    }

    public function getClassName($classId){
        return $this->db->where('id', $classId)->get('classes')->result_array()[0]['title'];
    }

    public function getSections($get_empty_selected = false) {
        $sectionsList = [];
        $classes = $this->db->get('sections')->result_array();

        if ($get_empty_selected){
            $sectionsList['0'] = '';
        }
        foreach ($classes as $class ){
            $sectionsList[$class['id']] = $class['title'];
        }


        return $sectionsList;
    }

    public function getSectionName($sectionId){
        return $this->db->where('id', $sectionId)->get('sections')->result_array()[0]['title'];
    }

    public function getProgramName($program_id){
        return $this->db->where('id', $program_id)->get('programs')->result_array()[0]['title'];
    }

    public function getFeeInfo($enrollment_id)
    {
        $query =  $this->db->where('enrollment_id',$enrollment_id)
            ->get('fee_info');

        return $query->result_array()[0];
    }

    public function save_enrollment($enrollment_data){

        $this->db->insert('enrollment', $enrollment_data['enrollment']);
        $enrollment_id = $this->db->insert_id();

        $enrollment_data['personal_details']['enrollment_id'] = $enrollment_id;
        $this->db->insert('personal_details', $enrollment_data['personal_details']);

        if($enrollment_data['previous_institution_detail']['exam_type']!=NULL ) {
            foreach ($enrollment_data['previous_institution_detail']['exam_type'] as $key => $value) {

                $previous_institution_detail = [
                    'exam_type' => $enrollment_data['previous_institution_detail']['exam_type'][$key],
                    'exam_year' => $enrollment_data['previous_institution_detail']['exam_year'][$key],
                    'p_roll_no' => $enrollment_data['previous_institution_detail']['p_roll_no'][$key],
                    'board_university' => $enrollment_data['previous_institution_detail']['board_university'][$key],
                    'obt_marks' => $enrollment_data['previous_institution_detail']['obt_marks'][$key],
                    'total_marks' => $enrollment_data['previous_institution_detail']['total_marks'][$key],
                    'grade' => $enrollment_data['previous_institution_detail']['grade'][$key],
                    'subjects' => $enrollment_data['previous_institution_detail']['subjects'][$key],
                    'institute_name' => $enrollment_data['previous_institution_detail']['institute_name'][$key],
                    'enrollment_id' => $enrollment_id
                ];

                $this->db->insert('previous_institution_details', $previous_institution_detail);
            }
        }

        foreach ($enrollment_data['address'] as $address){
            $address['enrollment_id'] = $enrollment_id;
            $this->db->insert('addresses', $address);
        }

        $enrollment_data['family_information']['enrollment_id'] = $enrollment_id;
        $this->db->insert('family_information', $enrollment_data['family_information']);

        $enrollment_data['fee_info']['enrollment_id'] = $enrollment_id;
        $this->db->insert('fee_info', $enrollment_data['fee_info']);

        return true;

    }

    public function getEditRegistrationData($id){

        $query = "SELECT e.*, e.id as enroll_id, pd.first_name as fName, pd.last_name as lName, fi.*, feei.*, pd.*, fami.* FROM enrollment e 
          LEFT JOIN family_information fi ON e.id=fi.enrollment_id
          LEFT JOIN fee_info feei ON e.id=feei.enrollment_id AND feei.status = 1
          LEFT JOIN personal_details pd ON e.id=pd.enrollment_id
          LEFT JOIN family_information fami ON e.id=fami.enrollment_id
          WHERE e.id='$id'
";

        $res = $this->db->query($query)->result_array();

        return $res[0];
    }

    public function hasFeeEditPermissions($user_id){
        // check from DB

        $this->db->where(['role_id'=> 0, 'id' => $user_id]);
        $res = $this->db->get('users');

//        debug($user_id.$res->num_rows());
        if($res->num_rows() >0){
            return true;
        }
        else{
            return false;
        }

    }

    public function getPresentAddresses($enroll_id){
        return $this->db->where(['enrollment_id' => $enroll_id, 'address_type' => 0])->get('addresses')->result_array()[0];
    }

    public function getPermanentAddresses($enroll_id){
        return $this->db->where(['enrollment_id' => $enroll_id, 'address_type' => 1])->get('addresses')->result_array()[0];
    }

    public function getPreviousInstitutes($enroll_id){

        return $this->db->select('pid.*, pet.*')->from('previous_institution_details pid')->join('previous_examination_types pet', 'pid.exam_type = pet.id')->where(['enrollment_id' => $enroll_id])->get()->result_array();
//        return $this->db->where(['enrollment_id' => $enroll_id])->get('previous_institution_details pid')->result_array();
    }

    public function getPreviousExamsTypes(){
        $examTypes =  $this->db->get('previous_examination_types')->result_array();
        $formatted_array = [];

        foreach ($examTypes as $key => $examType){
            $formatted_array[$examType['id']] = $examType['title'];
        }

        return $formatted_array;
    }

    public function update_enrollment($enrollment_data){

        $enroll_id = $enrollment_data['enrollment_id'];

        $this->db->where('id', $enroll_id);
        $this->db->update('enrollment', $enrollment_data['enrollment']);

        $this->db->where('enrollment_id', $enroll_id);
        $this->db->update('personal_details', $enrollment_data['personal_details']);

        $this->db->where('enrollment_id', $enroll_id);
        $this->db->delete('previous_institution_details');

        if($enrollment_data['previous_institution_detail']!=NULL) {
            foreach ($enrollment_data['previous_institution_detail']['exam_type'] as $key => $value) {

//            $rowId = $enrollment_data['previous_institution_detail']['PI_rowId'][$key];

                $previous_institution_detail = [
                    'enrollment_id' => $enroll_id,
                    'exam_type' => $enrollment_data['previous_institution_detail']['exam_type'][$key],
                    'exam_year' => $enrollment_data['previous_institution_detail']['exam_year'][$key],
                    'p_roll_no' => $enrollment_data['previous_institution_detail']['p_roll_no'][$key],
                    'board_university' => $enrollment_data['previous_institution_detail']['board_university'][$key],
                    'obt_marks' => $enrollment_data['previous_institution_detail']['obt_marks'][$key],
                    'total_marks' => $enrollment_data['previous_institution_detail']['total_marks'][$key],
                    'grade' => $enrollment_data['previous_institution_detail']['grade'][$key],
                    'subjects' => $enrollment_data['previous_institution_detail']['subjects'][$key],
                    'institute_name' => $enrollment_data['previous_institution_detail']['institute_name'][$key]
                ];

                $this->db->insert('previous_institution_details', $previous_institution_detail);
            }
        }

        foreach ($enrollment_data['address'] as $address){
            $address_type = 0;
            if($address['address_type'] == 1){
                $address_type = 1;
            }
            $this->db->where(['enrollment_id' => $enroll_id, 'address_type' => $address_type]);
            $this->db->update('addresses', $address);
        }

        $this->db->where('enrollment_id', $enroll_id);
        $this->db->update('family_information', $enrollment_data['family_information']);


        $compare = false;

        $this->db->where(['enrollment_id' => $enroll_id, 'status' => 1]);
        $res = $this->db->get('fee_info');

        if($res->num_rows() > 0){
            $dbArr = $res->result_array()[0];

            unset($dbArr['id']);
            unset($dbArr['enrollment_id']);
            unset($dbArr['status']);

            foreach ($dbArr as $key => $elem){
                if($elem != $enrollment_data['fee_info'][$key]){

                    $compare = true;
                    break;
                }
            }
        }
        if($compare) {

            //update status of all old fee pkgs to maintain history
            $this->db->where('enrollment_id', $enroll_id);
            $this->db->update('fee_info', ['status' => 0]);

            //add entry to fee_pkg_history table
            $enrollment_data['fee_pkg_history']['enrollment_id'] = $enroll_id;
            $this->db->insert('fee_pkg_history', $enrollment_data['fee_pkg_history']);

            //add newly edited fee pkg
            $enrollment_data['fee_info']['enrollment_id'] = $enroll_id;
            $this->db->insert('fee_info', $enrollment_data['fee_info']);
        }
        return true;

    }

    public function getActiveFeePkgId($enroll_id){
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        return $this->db->select('id')->from('fee_info')->where(['enrollment_id' => $enroll_id, 'status'=>1])->get()->result_array()[0]['id'];
    }

    public function getStudentsList()
    {
        $query = $this->db->select('

            enrollment.id as enrollment_no,
            enrollment.status,
            enrollment.roll_no,
            personal_details.first_name as student_firstName,
            personal_details.last_name as student_lastName,
            family_information.first_name as guardian_firstName,
            family_information.last_name as guardian_lastName,
            family_information.father_name as father_name,
            family_information.mobile_no,
            classes.title as class_name,
            programs.title as study_program,
            sections.title as section_name
            
            ')
            ->from('enrollment')
            ->join('personal_details','enrollment.id = personal_details.enrollment_id')
            ->join('family_information', 'enrollment.id = family_information.enrollment_id')
            ->join('classes', 'classes.id = enrollment.class_id' )
            ->join('programs', 'programs.id = enrollment.program_id' )
            ->join('sections', 'sections.id = enrollment.section_id')
            ->get();

        return $query->result_array();
    }

    public function getStudentsFeeList()
    {
        $query = $this->db->select('

            enrollment.id as enrollment_no, roll_no,
            personal_details.first_name as student_firstName,
            personal_details.last_name as student_lastName, father_name,
            classes.title as class_name,
            classes.id as class_id,
            fee_info.grand_total,
            ')
            ->from('enrollment')
            ->where('fee_info.status', 1)
            ->join('personal_details','enrollment.id = personal_details.enrollment_id')
            ->join('family_information', 'enrollment.id = family_information.enrollment_id')
            ->join('classes', 'classes.id = enrollment.class_id' )
            ->join('programs', 'programs.id = enrollment.program_id' )
            ->join('sections', 'sections.id = enrollment.section_id')
            ->join('fee_info', 'fee_info.enrollment_id= enrollment.id')
            ->get();

        return $query->result_array();
    }

    public function getStudentsFeeTotals(){
        $q = "SELECT SUM(fi.grand_total) as grandTotal, SUM(pf.fee_amount) as paid_fee FROM fee_info fi LEFT JOIN paid_fee pf ON fi.enrollment_id = pf.enrollment_id WHERE pf.status = 1 AND fi.status = 1 AND pf.delete_status = 0";

        return $this->db->query($q)->result_array()[0];
    }

    public function searchStudentsFeeTotals($searchData){
        $query = "SELECT SUM(fi.grand_total) as grandTotal, SUM(pf.fee_amount) as paid_fee FROM fee_info fi 
LEFT JOIN paid_fee pf ON fi.enrollment_id = pf.enrollment_id 
LEFT JOIN enrollment e ON fi.enrollment_id = e.id 
LEFT JOIN personal_details pd ON e.id=pd.enrollment_id
LEFT JOIN family_information fami ON e.id=fami.enrollment_id
WHERE pf.status = 1 AND fi.status = 1 AND pf.delete_status = 0 ";

        $enroll_no = $searchData['enrollment_no'];
        $roll_no = $searchData['roll_no'];
        $student_name = $searchData['student_name'];
        $guardian_name = $searchData['guardian_name'];
        $mobile_no = $searchData['mobile_no'];
        $class_id = $searchData['class_id'];
        $section_id = $searchData['section_id'];

        $condition = '';
        if($enroll_no != ""){
            $condition = (whereClauseExists($query))?'AND ':' WHERE ';
            $query .= $condition." e.id = '$enroll_no'";
        }

        if($roll_no != ""){
            $condition = (whereClauseExists($query))?'AND ':' WHERE ';
            $query .= $condition." e.roll_no = '$roll_no'";
        }

        if($student_name != ""){
            $condition = (whereClauseExists($query))?'AND ':' WHERE ';
            $query .= $condition." (pd.first_name LIKE '$student_name' OR pd.last_name LIKE '$student_name')";
        }

        if($guardian_name != ""){
            $condition = (whereClauseExists($query))?'AND ':' WHERE ';
//            $query .= $condition." (family_information.first_name LIKE '$guardian_name' OR family_information.last_name LIKE '$guardian_name')";
            $query .= $condition." (fami.father_name LIKE '$guardian_name' )";
        }

        if($mobile_no != ""){
            $condition = (whereClauseExists($query))?'AND ':' WHERE ';
            $query .= $condition." (fami.mobile_no = '$mobile_no' )"; // OR family_information.mobile_no = '$student_name')
        }

        if($class_id != 0){
            $condition = (whereClauseExists($query))?'AND ':' WHERE ';
            $query .= $condition." e.class_id = '$class_id'";
        }

        if($section_id != 0){
            $condition = (whereClauseExists($query))?'AND ':' WHERE ';
            $query .= $condition." e.section_id = '$section_id'";
        }
        $q = $this->db->query($query);
//        die($this->db->last_query());
        return $q->result_array()[0];
    }

    public function getPastDueAmount($enrollment_no){
        $today_date = date("Y-m-d");
        $q = "SELECT SUM(pf.fee_amount) as pastDueAmount FROM paid_fee pf WHERE status = 0 AND delete_status = 0 AND enrollment_id='$enrollment_no' AND installment_date <= '$today_date'";

        return $this->db->query($q)->result_array()[0]['pastDueAmount'];
    }

    public function getStudentFee($enrollment_id, $fee_status = 0){
        return $this->db->select('SUM(fee_amount) as fee')->from('paid_fee')->where(['enrollment_id' => $enrollment_id,'delete_status' => 0, 'status' => $fee_status])->get()->result_array()[0]['fee'];
    }

    public function getStudentAddresses($id){
        $q = $this->db->where('enrollment_id', $id)->get('addresses')->result_array();

        $addresses = [];
        foreach ($q as $address){
            if ($address['address_type'] == 0){
                $addresses['present'] = $address;
            }
            else{
                $addresses['permenant'] = $address;
            }
        }

        return $addresses;
    }

    public function getStudentDetail($id)
    {
        $query = "SELECT e.*, e.id as enroll_id, e.status as std_status, pd.first_name as fName, pd.last_name as lName, fi.*, fi.first_name as g_fname, fi.last_name as g_lname, feei.*, pd.*, fami.*,cl.*,
        cl.title as class_name,
        pr.title as program_title,
        sec.*, sec.title as section_name FROM 
          enrollment e 
          LEFT JOIN family_information fi ON e.id=fi.enrollment_id
          LEFT JOIN fee_info feei ON e.id=feei.enrollment_id
          LEFT JOIN personal_details pd ON e.id=pd.enrollment_id
          LEFT JOIN family_information fami ON e.id=fami.enrollment_id
          LEFT JOIN classes cl ON cl.id=e.class_id
          LEFT JOIN programs pr ON pr.id=e.program_id
          LEFT JOIN sections sec ON sec.id=e.section_id
          WHERE e.id='$id' ";


          $res = $this->db->query($query)->result_array();

          return $res[0];

    }

    public function searchStudent($searchData)
    {

        $enroll_no = $searchData['enrollment_no'];
        $roll_no = $searchData['roll_no'];
        $student_name = $searchData['student_name'];
        $guardian_name = $searchData['guardian_name'];
        $mobile_no = $searchData['mobile_no'];
        $class_id = $searchData['class_id'];
        $section_id = $searchData['section_id'];


        $query = "
        SELECT 
        `enrollment`.*, `enrollment`.`id` as `enrollment_no`, `enrollment`.`roll_no`, 
        `personal_details`.`first_name` as `student_firstName`, `personal_details`.`last_name` as `student_lastName`, 
        `family_information`.`first_name` as `guardian_firstName`, `family_information`.`last_name` as `guardian_lastName`, `family_information`.`mobile_no`, `family_information`.`father_name` as `father_name`,
        `classes`.*, `classes`.`title` as `class_name`, 
        `programs`.*, `programs`.`title` as `study_program`, 
        `sections`.`title` as `section_name` 
        FROM `enrollment` 
        LEFT JOIN `personal_details` ON `enrollment`.`id` = `personal_details`.`enrollment_id` 
        LEFT JOIN `family_information` ON `enrollment`.`id` = `family_information`.`enrollment_id` 
        LEFT JOIN `classes` ON `classes`.`id` = `enrollment`.`class_id` 
        LEFT JOIN `programs` ON `programs`.`id` = `enrollment`.`program_id` 
        LEFT JOIN `sections` ON `sections`.`id` = `enrollment`.`section_id`
        ";

        $condition = '';
        if($enroll_no != ""){
            $condition = (whereClauseExists($query))?'AND ':' WHERE ';
            $query .= $condition."`enrollment`.`id` = '$enroll_no'";
        }

        if($roll_no != ""){
            $condition = (whereClauseExists($query))?'AND ':' WHERE ';
            $query .= $condition." `enrollment`.`roll_no` = '$roll_no'";
        }

        if($student_name != ""){
            $condition = (whereClauseExists($query))?'AND ':' WHERE ';
            $query .= $condition." (`personal_details`.`first_name` LIKE '$student_name' OR `personal_details`.`last_name` LIKE '$student_name')";
        }

        if($guardian_name != ""){
            $condition = (whereClauseExists($query))?'AND ':' WHERE ';
//            $query .= $condition." (`family_information`.`first_name` LIKE '$guardian_name' OR `family_information`.`last_name` LIKE '$guardian_name')";
            $query .= $condition." (`family_information`.`father_name` LIKE '$guardian_name' )";
        }

        if($mobile_no != ""){
            $condition = (whereClauseExists($query))?'AND ':' WHERE ';
            $query .= $condition." (`family_information`.`mobile_no` = '$mobile_no' OR `family_information`.`mobile_no` = '$student_name')";
        }

        if($class_id != 0){
            $condition = (whereClauseExists($query))?'AND ':' WHERE ';
            $query .= $condition." `enrollment`.`class_id` = '$class_id'";
        }

        if($section_id != 0){
            $condition = (whereClauseExists($query))?'AND ':' WHERE ';
            $query .= $condition." `enrollment`.`section_id` = '$section_id'";
        }

        $res = $this->db->query($query);

            return $res->result_array();

    }


    public function searchStudentsFeeList($searchData){

        $enroll_no = $searchData['enrollment_no'];
        $roll_no = $searchData['roll_no'];
        $student_name = $searchData['student_name'];
        $guardian_name = $searchData['guardian_name'];
        $mobile_no = $searchData['mobile_no'];
        $class_id = $searchData['class_id'];
        $section_id = $searchData['section_id'];


        $query = "
        SELECT 
        `enrollment`.*, `enrollment`.`id` as `enrollment_no`, `enrollment`.`roll_no`, 
        `personal_details`.`first_name` as `student_firstName`, `personal_details`.`last_name` as `student_lastName`, 
        `classes`.id as `class_id`, `classes`.`title` as `class_name`,
        `family_information`.`father_name`,
        `fee_info`.`grand_total`
        FROM `enrollment` 
        LEFT JOIN `personal_details` ON `enrollment`.`id` = `personal_details`.`enrollment_id` 
        LEFT JOIN `family_information` ON `enrollment`.`id` = `family_information`.`enrollment_id` 
        LEFT JOIN `classes` ON `classes`.`id` = `enrollment`.`class_id` 
        LEFT JOIN `fee_info` ON `fee_info`.`enrollment_id` = `enrollment`.`id` 
        WHERE `fee_info`.`status` = '1' 
        ";

        $condition = '';
        if($enroll_no != ""){
            $condition = (whereClauseExists($query))?'AND ':' WHERE ';
            $query .= $condition."`enrollment`.`id` = '$enroll_no'";
        }

        if($roll_no != ""){
            $condition = (whereClauseExists($query))?'AND ':' WHERE ';
            $query .= $condition." `enrollment`.`roll_no` = '$roll_no'";
        }

        if($student_name != ""){
            $condition = (whereClauseExists($query))?'AND ':' WHERE ';
            $query .= $condition." (`personal_details`.`first_name` LIKE '$student_name' OR `personal_details`.`last_name` LIKE '$student_name')";
        }

        if($guardian_name != ""){
            $condition = (whereClauseExists($query))?'AND ':' WHERE ';
//            $query .= $condition." (`family_information`.`first_name` LIKE '$guardian_name' OR `family_information`.`last_name` LIKE '$guardian_name')";
            $query .= $condition." (`family_information`.`father_name` LIKE '$guardian_name' )";
        }

        if($mobile_no != ""){
            $condition = (whereClauseExists($query))?'AND ':' WHERE ';
            $query .= $condition." (`family_information`.`mobile_no` = '$mobile_no' )"; // OR `family_information`.`mobile_no` = '$student_name')
        }

        if($class_id != 0){
            $condition = (whereClauseExists($query))?'AND ':' WHERE ';
            $query .= $condition." `enrollment`.`class_id` = '$class_id'";
        }

        if($section_id != 0){
            $condition = (whereClauseExists($query))?'AND ':' WHERE ';
            $query .= $condition." `enrollment`.`section_id` = '$section_id'";
        }

        $res = $this->db->query($query);

//        if(!$res){
//            debug($this->db->error());
//        }
            return $res->result_array();

    }


    public function getStudentInfoForInstallments($enrollment_id){

        $query = $this->db->select('
            
            personal_details.first_name,personal_details.last_name,
            family_information.first_name as guardian_first_name, family_information.last_name as guardian_last_name,
            fee_info.grand_total
            ')
            ->from('enrollment')
            ->join('personal_details','enrollment.id = personal_details.enrollment_id')
            ->join('fee_info','enrollment.id = fee_info.enrollment_id')
            ->join('family_information', 'enrollment.id = family_information.enrollment_id')
            ->where('enrollment.id',$enrollment_id)
            ->where('fee_info.status',1)
            ->get()->result_array()[0];

        return $query;

    }

    public function getInitialAmount($enrollment_id){
        $query = $this->db->select('
            fee_amount, status
            ')
            ->from('paid_fee')
            ->where(['enrollment_id'=>$enrollment_id,'installment_no' => 1,'delete_status'=>0])
            ->get()->result_array()[0]['fee_amount'];

        return $query;
    }

    public function getInstallments($enrollment_id){
        $query = $this->db->select('
            installment_no, fee_amount, installment_date, status
            ')
            ->from('paid_fee')
            ->where(['enrollment_id'=>$enrollment_id, 'delete_status' => 0, 'installment_no > ' => 1])
            ->get()->result_array();

        return $query;
    }

    public function getTotalPaidFee($enrollment_id, $classId, $sectionId){
        $query = $this->db->select('
            SUM(fee_amount) as total_paid_fee
            ')
            ->from('paid_fee')
            ->where('paid_fee.enrollment_id',$enrollment_id)
            ->where('paid_fee.status',1)
            ->where('paid_fee.classId',$classId)
            ->where('paid_fee.sectionId',$sectionId)
            ->where('paid_fee.delete_status',0)
            ->get()->result_array()[0];

            if($query['total_paid_fee'] == ""){
                $query['total_paid_fee'] = 0;
            }

        return $query;
    }

    public function getCurrentProgramId($enrollment_id){
        return $this->db->select('program_id')->where(['id' => $enrollment_id])->get('enrollment')->result_array()[0]['program_id'];
    }

    public function getCurrentClassId($enrollment_id){
        return $this->db->select('class_id')->where(['id' => $enrollment_id])->get('enrollment')->result_array()[0]['class_id'];
    }

    public function getCurrentSectionId($enrollment_id){
        return $this->db->select('section_id')->where(['id' => $enrollment_id])->get('enrollment')->result_array()[0]['section_id'];
    }

    public function installments_exists($enrollment_id){
        $this->db->where(
            array(
                'enrollment_id'=>$enrollment_id,
                'delete_status'=>0
            )
        );
        $num=$this->db->get('paid_fee')->num_rows();
        if ($num>0) {
            $return = TRUE;
        }
        else{
            $return = FALSE;
        }
        return $return;
    }

    public function save_installments($data){

        $group_id = uniqid();
        $data['first_installment']['group_id'] = $group_id;
        $this->db->insert('paid_fee', $data['first_installment']);
        $insert_id = $this->db->insert_id();

        foreach ($data['installments']['installment_no'] as $key => $value){

            $installment = [
                'enrollment_id'            => $data['installments']['enrollment_id'],
                'program_id'               => $data['installments']['program_id'],
                'classId'                  => $data['installments']['classId'],
                'sectionId'                => $data['installments']['sectionId'],
                'installment_no'           => $data['installments']['installment_no'][$key],
                'fee_amount'               => $data['installments']['fee_amount'][$key],
                'installment_date'         => $data['installments']['installment_date'][$key],
                'pay_date'                 => '',
                'status'                   => $data['installments']['paidStatus'][$key],
                'created_by'               => $data['installments']['created_by'],
                'group_id'                 => $group_id
            ];

            $this->db->insert('paid_fee', $installment);

        }


        return $insert_id;

    }

    public function softDeleteInstallments($enrollment_id, $edited_by, $group_id=0){

        $updateData = ['delete_status' => 1, 'edited_by' => $edited_by];

        $where = ['enrollment_id'=> $enrollment_id];
        if($group_id != 0){
            $where['group_id'] = $group_id;
        }
        $this->db->where($where);
        $this->db->update('paid_fee', $updateData);
    }

    public function update_installments($data){
        $enrollment_id = $data['installments']['enrollment_id'];

        /*
        //hard delete previously soft deleted installments
        $where = ['enrollment_id' => $enrollment_id, 'delete_status' => 1];
        $this->db->delete('paid_fee', $where);
        */
        $where = ['enrollment_id' => $enrollment_id, 'delete_status' => 0];
        $group_id = $this->db->select('group_id')->from('paid_fee')->where($where)->get()->result_array()[0]['group_id'];

        $edited_by = $data['installments']['created_by'];
        $this->softDeleteInstallments($enrollment_id, $edited_by, $group_id);

        $this->save_installments($data);

        return true;

    }

    public function getFeeListInstallments($enrollment_id){
        $query = $this->db->select('
            installment_no, fee_amount, installment_date, status
            ')
            ->from('paid_fee')
            ->where(['enrollment_id'=>$enrollment_id, 'delete_status' => 0])
            ->get()->result_array();

        return $query;
    }

    public function getUnPaidInstallments(){
        $query = $this->db->select('
            e.id,
            pd.first_name, pd.last_name,
            pf.installment_no, pf.fee_amount, pf.installment_date, pf.status, pf.installment_date, pf.id as pfid,
            c.title, p.title as programTitle
            ')
            ->from('enrollment e')
            ->join('personal_details pd', 'pd.enrollment_id = e.id')
            ->join('paid_fee pf', 'pf.enrollment_id = e.id')
            ->join('classes c', 'pf.classId = c.id')
            ->join('programs p', 'pf.program_id = p.id')
            ->where(['pf.status' => 0, 'delete_status' => 0, 'installment_no > ' => 1])
            ->get()->result_array();

//        debug($this->db->last_query());
        return $query;
    }

    public function searchFeePayments($search){


        $query = "SELECT
            e.id,
            pd.first_name, pd.last_name,
            pf.installment_no, pf.fee_amount, pf.installment_date, pf.status, pf.installment_date, pf.id as pfid,
            c.title, p.title as programTitle
            FROM enrollment e 
            LEFT JOIN personal_details pd ON pd.enrollment_id = e.id
            LEFT JOIN paid_fee pf ON pf.enrollment_id = e.id
            LEFT JOIN classes c ON pf.classId = c.id
            LEFT JOIN programs p ON pf.program_id = p.id
            WHERE pf.delete_status = 0
        ";

        if($search['enrollmentNo']){
            $query .= " AND pf.enrollment_id = '".$search['enrollmentNo']."'";
        }

        if($search['dateFrom']){
            $query .= " AND pf.installment_date >= '".date('Y-m-d',strtotime($search['dateFrom']))."'";
        }

        if($search['dateTo']){
            $query .= " AND pf.installment_date <= '".date('Y-m-d',strtotime($search['dateTo']))."'";
        }

        if($search['classId']){
            $query .= " AND pf.classId = '".$search['classId']."'";
        }

        if($search['sectionId']){
            $query .= " AND pf.sectionId = '".$search['sectionId']."'";
        }

        if($search['status'] || $search['status'] == 0){
            if($search['status'] != 3){
                $query .= " AND pf.status = '".$search['status']."'";
            }
        }

//        debug($query);

        $result = $this->db->query($query)->result_array();

        return $result;
    }

    public function submitWaveOff($id){
        $data = [
            'status' => 2,
            'pay_date' => date("Y-m-d h:i:s")
        ];

        $this->db->where('id', $id);
        $this->db->update('paid_fee', $data);

        return true;
    }

    public function getInstallmentData($installment_id, $paid = false){

        $status = 0;
        if ($paid){
            $status = 1;
        }

        $query = $this->db->select('
            e.id,
            pd.first_name, pd.last_name,
            pf.classId, pf.sectionId, pf.program_id,
            pf.installment_no, pf.fee_amount, pf.installment_date, pf.status, pf.installment_date, pf.id as pfid,
            c.title
            ')
            ->from('enrollment e')
            ->join('personal_details pd', 'pd.enrollment_id = e.id')
            ->join('paid_fee pf', 'pf.enrollment_id = e.id')
            ->join('classes c', 'pf.classId = c.id')
            ->where(['pf.status' => $status, 'pf.delete_status' => 0, 'pf.id ' => $installment_id])
            ->get()->result_array()[0];

//            die($this->db->last_query());
        return $query;
    }

    public function getFine($classId, $sectionId, $installment_date){
        $perDayFine = $this->db->select('
           f.fine
            ')
            ->from('fines f')
            ->where(['f.classId' => $classId, 'f.sectionId' => $sectionId])
            ->get();

            if($perDayFine->num_rows() > 0){
                $perDayFine = $perDayFine->result_array()[0]['fine'];
            }
            else{
                $perDayFine = 0;
            }
            $today_date = date('Y-m-d');
            $days = getDaysDifference($installment_date, $today_date);
            $calculated_fine = $perDayFine * $days;
            return $calculated_fine;
    }

    public function payInstallment($id, $fine){
        $data = [
            'status' => 1,
            'pay_date' => date("Y-m-d h:i:s"),
            'installment_fine' => $fine
        ];

        $this->db->where('id', $id);
        $this->db->update('paid_fee', $data);

        return true;
    }

    public function getSuspendHistory($enrollment_id)
    {
        $q = $this->db->where(array('enrollment_id' => $enrollment_id, 'status_id' => 2))
                                ->get('student_status');

        return $q->result_array();
    }

    public function getLeaveHistory($enrollment_id)
    {
        $q = $this->db->where(array('enrollment_id' => $enrollment_id, 'status_id' => 3))
            ->get('student_status');

        return $q->result_array();
    }

    public function getSuspendReason($enrollment_id)
    {
       $q = $this->db->where(array('enrollment_id' => $enrollment_id, 'status_id' => 2))
            ->order_by('created_at','desc')
            ->get('student_status');

        //print_r($this->db->last_query()); exit();
        return $q->row();
    }

    public function getLeaveReason($enrollment_id)
    {
        $q = $this->db->where(array('enrollment_id' => $enrollment_id, 'status_id' => 3))
            ->order_by('created_at','desc')
            ->get('student_status');

        //print_r($this->db->last_query()); exit();
        return $q->row();
    }

    public function activeStudent($enrollment_id)
    {
        $query = $this->db->where('id',$enrollment_id)
                 ->set('status',1)
                 ->update('enrollment');

        return $query;
    }

    public function suspendStudent($data)
    {
        $enrollment_id = $data['enrollment_id'];
        $query1 = $this->db->insert('student_status',$data);
        $query2 = $this->db->where('id',$enrollment_id)
                        ->set('status',2)
                        ->update('enrollment');

        return true;
    }

    public function leaveStudent($data)
    {
        $enrollment_id = $data['enrollment_id'];
        $query1 = $this->db->insert('student_status',$data);
        $query2 = $this->db->where('id',$enrollment_id)
            ->set('status',3)
            ->update('enrollment');

        return true;
    }

    public function getFeeHistory(){
        $query = $this->db->select(
            'fph.*, 
            u.first_name as editor_first_name, u.last_name as editor_last_name,
            pd.first_name as std_first_name, pd.last_name as std_last_name,
            fi.*
            '
        )
            ->from('fee_pkg_history fph')
            ->join('users u', 'u.id = fph.modified_by')
            ->join('personal_details pd', 'pd.enrollment_id = fph.enrollment_id')
            ->join('fee_info fi', 'fph.fee_pkg_id = fi.id')
            ->order_by('modification_date','DESC')
            ->get()->result();
        ;

        return $query;
    }

    public function getActiveStudentsCount(){
        $query = "SELECT COUNT(id) as activeStudentsCount FROM enrollment WHERE status = 1";
        return $this->db->query($query)->result_array()[0]['activeStudentsCount'];

    }

    public function getInActiveOrLeaveStudentsCount(){
        $query = "SELECT COUNT(id) as inactiveOrLeaveStudentsCount FROM enrollment WHERE status IN (2, 3)";
        return $this->db->query($query)->result_array()[0]['inactiveOrLeaveStudentsCount'];

    }

    public function isProfileExists($email){
        $q = $this->db->select('address')->from('users')->where('email', $email)->where('address', '')->get()->num_rows();

        $return = true;
        if($q > 0){
            $return = false;
        }

        return $return;
    }

    public function getFinesList(){
        return $this->db->get('fines')->result_array();
    }

    public function getDatesList(){
        return $this->db->get('installments_to_dates')->result_array();
    }

    public function getSectionsList(){
        return $this->db->get('sections')->result_array();
    }

    public function getSectionsData($id){
        return $this->db->where('id', $id)->get('sections')->result_array()[0];
    }

    public function save_section($data){
        $this->db->insert('sections', $data);
        return true;
    }

    public function update_section($data){
        $sectionId = $data['sectionId'];
        unset($data['sectionId']);
        $this->db->where('id', $sectionId)->update('sections', $data);
//        debug($this->db->last_query());
        return true;
    }

    public function save_fine($data){
        $this->db->insert('fines', $data);
        return true;
    }

    public function update_fine($data){
        $fineId = $data['fineId'];
        unset($data['fineId']);
        $this->db->where('id', $fineId)->update('fines', $data);
        return true;
    }

    public function getFinesData($id){
        return $this->db->where('id', $id)->get('fines')->result_array()[0];
    }


    public function save_date($data){
        $this->db->insert('installments_to_dates', $data);
        return true;
    }

    public function update_date($data){
        $id = $data['id'];
        unset($data['id']);
        $this->db->where('id', $id)->update('installments_to_dates', $data);
        return true;
    }

    public function getDatesData($id){
        return $this->db->where('id', $id)->get('installments_to_dates')->result_array()[0];
    }

    public function getExamTypesList(){
        return $this->db->get('previous_examination_types')->result_array();
    }

    public function getExamTypeData($id){
        return $this->db->where('id', $id)->get('previous_examination_types')->result_array()[0];

    }

    public function save_exam_type($data){
        $this->db->insert('previous_examination_types', $data);
        return true;
    }

    public function update_exam_type($data){
        $id = $data['id'];
        unset($data['id']);
        $this->db->where('id', $id)->update('previous_examination_types', $data);
        return true;
    }

    public function delete_examination_types($id){
        $this->db->where('id', $id)->delete('previous_examination_types');
    }

    public function getPermissionsList(){
        return $this->db->get('permissions')->result_array();
    }

    public function getUserPermissions($user_id){
        $p = [];
        $permissions = $this->db->select('permissionID')->from('permission_map')->where('groupID', $user_id)->get()->result_array();
//        debug($permissions);
        if (count($permissions) > 0){
            foreach ($permissions as $permission){
                $p[] = $permission['permissionID'];
            }
        }

        return $p;
    }

    public function getUserTypes(){

        $userTypes = [];
        $q = $this->db->where('groupId !=', 0)->get('permission_groups')->result_array();

        $userTypes[0] = '--- SELECT ---';
        foreach ($q as $uType ){
            $userTypes[$uType['groupId']] = $uType['groupName'];
        }
        return $userTypes;
    }

    public function getUsers(){

        $userTypes = [];
        $q = $this->db->select('id, first_name, last_name, email')->from('users')->where('role_id !=', 0)->where('is_active', 1)->where('is_approved', 1)->get()->result_array();

        $userTypes[0] = '--- SELECT ---';
        foreach ($q as $uType ){
            $userTypes[$uType['id']] = $uType['first_name'].' '.$uType['last_name'].' ('.$uType['email'].')';
        }
        return $userTypes;
    }

    public function update_permissions($userType, $permissions){
        $this->db->where('groupID', $userType);
        $this->db->delete('permission_map');

        foreach ($permissions as $key => $value){

//            $this->db->set('groupID', $userType);
//            $this->db->set('permissionID', $value);
            $data = ['groupID'=> $userType, 'permissionID' => $value];
            $status = $this->db->insert('permission_map', $data);

        }

        return true;
    }

    public function getClassesInStudyProgram($program_id){
        return $this->db->where('program_id', $program_id)->get('classes')->result_array();
    }

    public function getSectionsInClasses($class_id){
        return $this->db->where('class_id', $class_id)->get('sections')->result_array();
    }

    public function getClassesWithProgramTitle($get_empty_selected = false){
        $classes = $this->db->select('c.*, p.title as programTitle')->from('classes c')->join('programs p','p.id = c.program_id')->get()->result_array();
        $classesList = [];

        if ($get_empty_selected){
            $classesList['0'] = '';
        }
        foreach ($classes as $class ){
            $classesList[$class['id']] = $class['title'].' ('.$class['programTitle'].')';
        }


        return $classesList;
    }

    public function getSectionsWithProgramAndClassTitle($get_empty_selected = false){
        $sections = $this->db->select('s.*, c.title as classTitle, p.title as programTitle')->from('sections s')->join('classes c','c.id = s.class_id')->join('programs p','p.id = c.program_id')->get()->result_array();
        $sectionsList = [];

        if ($get_empty_selected){
            $sectionsList['0'] = '';
        }
        foreach ($sections as $section ){
            $sectionsList[$section['id']] = $section['title'].' ('.$section['programTitle'].' - '.$section['classTitle'].')';
        }


        return $sectionsList;
    }

    public function getClassesWithProgramAndSectionTitle($get_empty_selected = false){
        $classes = $this->db->select('c.*, s.title as sectionTitle, p.title as programTitle')->from('classes c')->join('programs p','p.id = c.program_id', 'left')->join('sections s','c.id = s.class_id', 'left')->get()->result_array();

//        debug($this->db->last_query());
        $classesList = [];

        if ($get_empty_selected){
            $classesList['0'] = '';
        }
        foreach ($classes as $class ){
            $classesList[$class['id']] = $class['title'].' ('.$class['programTitle'].' - '.$class['sectionTitle'].')';
        }


        return $classesList;
    }

    public function getClassNameWithProgramTitle($class_id){
        $q = $classes = $this->db->select('c.*, p.title as programTitle')->from('classes c')->join('programs p','p.id = c.program_id')->where('c.id',$class_id)->get()->result_array()[0];

        return $q['title'].' ('.$q['programTitle'].')';

    }

    public function getUpcomingVouchersDays(){
        return $this->db->get('settings')->result_array()[0]['next_days'];
    }

    public function updateUpcomingVouchersDays($days){
        $this->db->query("UPDATE settings set next_days = '$days'");
    }

    public function getToDate($enrollment_id){
        $data = $this->db->select('class_id, section_id')->from('enrollment')->where('id', $enrollment_id)->get()->result_array()[0];
        $q = $this->db->where(['classId' => $data['class_id'], 'sectionId'=>$data['section_id']])->get('installments_to_dates');

        if($q->num_rows() > 0){
            $return = $q->result_array()[0]['to_date'];
        }
        else{
            $return = date("Y-m-d", strtotime("+30 days"));
        }

        return $return;
    }
}


?>