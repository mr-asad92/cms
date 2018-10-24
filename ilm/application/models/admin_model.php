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

        foreach ($enrollment_data['previous_institution_detail']['exam_type'] as $key => $value){

            $previous_institution_detail = [
                'exam_type'               => $enrollment_data['previous_institution_detail']['exam_type'][$key],
                'exam_year'               => $enrollment_data['previous_institution_detail']['exam_year'][$key],
                'p_roll_no'               => $enrollment_data['previous_institution_detail']['p_roll_no'][$key],
                'board_university'        => $enrollment_data['previous_institution_detail']['board_university'][$key],
                'obt_marks'               => $enrollment_data['previous_institution_detail']['obt_marks'][$key],
                'total_marks'             => $enrollment_data['previous_institution_detail']['total_marks'][$key],
                'grade'                   => $enrollment_data['previous_institution_detail']['grade'][$key],
                'subjects'                => $enrollment_data['previous_institution_detail']['subjects'][$key],
                'institute_name'          => $enrollment_data['previous_institution_detail']['institute_name'][$key],
                'enrollment_id'           => $enrollment_id
            ];

            $this->db->insert('previous_institution_details', $previous_institution_detail);
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

        foreach ($enrollment_data['previous_institution_detail']['exam_type'] as $key => $value){

//            $rowId = $enrollment_data['previous_institution_detail']['PI_rowId'][$key];

            $previous_institution_detail = [
                'enrollment_id'           => $enroll_id,
                'exam_type'               => $enrollment_data['previous_institution_detail']['exam_type'][$key],
                'exam_year'               => $enrollment_data['previous_institution_detail']['exam_year'][$key],
                'p_roll_no'               => $enrollment_data['previous_institution_detail']['p_roll_no'][$key],
                'board_university'        => $enrollment_data['previous_institution_detail']['board_university'][$key],
                'obt_marks'               => $enrollment_data['previous_institution_detail']['obt_marks'][$key],
                'total_marks'             => $enrollment_data['previous_institution_detail']['total_marks'][$key],
                'grade'                   => $enrollment_data['previous_institution_detail']['grade'][$key],
                'subjects'                => $enrollment_data['previous_institution_detail']['subjects'][$key],
                'institute_name'          => $enrollment_data['previous_institution_detail']['institute_name'][$key]
            ];

            $this->db->insert('previous_institution_details', $previous_institution_detail);
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
            family_information.mobile_no,
            classes.title as class_name,
            sections.title as section_name
            
            ')
            ->from('enrollment')
            ->join('personal_details','enrollment.id = personal_details.enrollment_id')
            ->join('family_information', 'enrollment.id = family_information.enrollment_id')
            ->join('classes', 'classes.id = enrollment.class_id' )
            ->join('sections', 'sections.id = enrollment.section_id')
            ->get();

        return $query->result_array();
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
        sec.*, sec.title as section_name FROM 
          enrollment e 
          LEFT JOIN family_information fi ON e.id=fi.enrollment_id
          LEFT JOIN fee_info feei ON e.id=feei.enrollment_id
          LEFT JOIN personal_details pd ON e.id=pd.enrollment_id
          LEFT JOIN family_information fami ON e.id=fami.enrollment_id
          LEFT JOIN classes cl ON cl.id=e.class_id
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


        $query = "
        SELECT 
        `enrollment`.*, `enrollment`.`id` as `enrollment_no`, `enrollment`.`roll_no`, 
        `personal_details`.`first_name` as `student_firstName`, `personal_details`.`last_name` as `student_lastName`, 
        `family_information`.`first_name` as `guardian_firstName`, `family_information`.`last_name` as `guardian_lastName`, `family_information`.`mobile_no`, 
        `classes`.*, `classes`.`title` as `class_name`, 
        `sections`.`title` as `section_name` 
        FROM `enrollment` 
        LEFT JOIN `personal_details` ON `enrollment`.`id` = `personal_details`.`enrollment_id` 
        LEFT JOIN `family_information` ON `enrollment`.`id` = `family_information`.`enrollment_id` 
        LEFT JOIN `classes` ON `classes`.`id` = `enrollment`.`class_id` 
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
            $query .= $condition." (`family_information`.`first_name` LIKE '$guardian_name' OR `family_information`.`last_name` LIKE '$guardian_name')";
        }

        if($mobile_no != ""){
            $condition = (whereClauseExists($query))?'AND ':' WHERE ';
            $query .= $condition." (`family_information`.`mobile_no` = '$mobile_no' OR `family_information`.`mobile_no` = '$student_name')";
        }

        if($class_id != ""){
            $condition = (whereClauseExists($query))?'AND ':' WHERE ';
            $query .= $condition." `enrollment`.`class_id` = '$class_id'";
        }

        $res = $this->db->query($query);

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

    public function getUnPaidInstallments(){
        $query = $this->db->select('
            e.id,
            pd.first_name, pd.last_name,
            pf.installment_no, pf.fee_amount, pf.installment_date, pf.status, pf.installment_date, pf.id as pfid,
            c.title
            ')
            ->from('enrollment e')
            ->join('personal_details pd', 'pd.enrollment_id = e.id')
            ->join('paid_fee pf', 'pf.enrollment_id = e.id')
            ->join('classes c', 'pf.classId = c.id')
            ->where(['pf.status' => 0, 'delete_status' => 0, 'installment_no > ' => 1])
            ->get()->result_array();

        return $query;
    }

    public function searchFeePayments($search){


        $query = "SELECT
            e.id,
            pd.first_name, pd.last_name,
            pf.installment_no, pf.fee_amount, pf.installment_date, pf.status, pf.installment_date, pf.id as pfid,
            c.title
            FROM enrollment e 
            LEFT JOIN personal_details pd ON pd.enrollment_id = e.id
            LEFT JOIN paid_fee pf ON pf.enrollment_id = e.id
            LEFT JOIN classes c ON pf.classId = c.id
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
            pf.classId, pf.sectionId,
            pf.installment_no, pf.fee_amount, pf.installment_date, pf.status, pf.installment_date, pf.id as pfid,
            c.title
            ')
            ->from('enrollment e')
            ->join('personal_details pd', 'pd.enrollment_id = e.id')
            ->join('paid_fee pf', 'pf.enrollment_id = e.id')
            ->join('classes c', 'pf.classId = c.id')
            ->where(['pf.status' => $status, 'delete_status' => 0, 'pf.id ' => $installment_id])
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

    public function payInstallment($id){
        $data = [
            'status' => 1,
            'pay_date' => date("Y-m-d h:i:s")
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

}


?>