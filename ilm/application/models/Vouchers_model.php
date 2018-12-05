<?php
/**
 * Created by PhpStorm.
 * User: Hafiz Ali Hamza
 * Date: 9/13/2018
 * Time: 5:30 PM
 */

class Vouchers_model extends CI_Model
{
    public function getVouchers($search = [])
    {
        //$q = $this->db->get('users');
        //return $q->result();

//        $q = $this->db->select('
//
//            enrollment.*,
//            personal_details.*,
//            paid_fee.*,
//            paid_fee.id as vocher_id,
//            classes.title as classTitle,
//            sections.title as sectionTitle,
//            programs.title as programTitle,
//            enrollment.id as enrollmentId,
//            paid_fee.id as paidFeeId
//
//        ')
//            ->from('paid_fee')
//            ->join('enrollment','enrollment.id = paid_fee.enrollment_id')
//            ->join('personal_details','enrollment.id = personal_details.enrollment_id')
//            ->join('classes', 'classes.id = paid_fee.classId')
//            ->join('sections', 'sections.id = paid_fee.sectionId')
//            ->join('programs', 'programs.id = paid_fee.program_id')
//            ->where('paid_fee.delete_status',0);


        $q = $this->db->select('
        
            enrollment.*,
            personal_details.*,
            paid_fee.*,
            paid_fee.id as vocher_id,
            enrollment.id as enrollmentId,
            paid_fee.id as paidFeeId 
            
        ')
            ->from('paid_fee')
            ->join('enrollment','enrollment.id = paid_fee.enrollment_id')
            ->join('personal_details','enrollment.id = personal_details.enrollment_id')
            ->where('paid_fee.delete_status',0);

        if(!empty($search)){

            if($search['enrollmentNo']){
                $q->where('paid_fee.enrollment_id',$search['enrollmentNo']);
            }

            if($search['dateFrom']){
                $q->where('paid_fee.installment_date >= ',date('Y-m-d',strtotime($search['dateFrom'])));
            }

            if($search['dateTo']){
                $q->where('paid_fee.installment_date <= ',date('Y-m-d',strtotime($search['dateTo'])));

            }

            if($search['classId']){
                $q->where('paid_fee.classId',$search['classId']);
            }

            if($search['roll_no']){
                $q->where('enrollment.roll_no',$search['roll_no']);
            }

            if($search['sectionId']){
                $q->where('paid_fee.sectionId',$search['sectionId']);
            }

            if(($search['status'] || $search['status'] == 0) && $search['status']!=null){
                if($search['status'] != 3){
                    $q->where('paid_fee.status',$search['status']);
                }
            }

        }

        return $q->get()->result();

        //print_r($this->db->last_query()); exit();
    }


    public function getUpcomingVouchers($search = [])
    {
        //$q = $this->db->get('users');
        //return $q->result();

//        $q = $this->db->select('
//
//            enrollment.*,
//            personal_details.*,
//            paid_fee.*,
//            paid_fee.id as vocher_id,
//            classes.*,
//            classes.title as classTitle,
//            sections.title as sectionTitle,
//            programs.title as programTitle,
//            enrollment.id as enrollmentId,
//            paid_fee.id as paidFeeId
//
//        ')
//            ->from('paid_fee')
//            ->join('enrollment','enrollment.id = paid_fee.enrollment_id')
//            ->join('personal_details','enrollment.id = personal_details.enrollment_id')
//            ->join('classes', 'classes.id = paid_fee.classId')
//            ->join('sections', 'sections.id = paid_fee.sectionId')
//            ->join('programs', 'programs.id = paid_fee.program_id')
//            ->where('paid_fee.delete_status',0)
//            ->where('paid_fee.status',0);

        $q = $this->db->select('
        
            enrollment.*,
            personal_details.*,
            paid_fee.*,
            paid_fee.id as vocher_id,
            enrollment.id as enrollmentId,
            paid_fee.id as paidFeeId 
            
        ')
            ->from('paid_fee')
            ->join('enrollment','enrollment.id = paid_fee.enrollment_id')
            ->join('personal_details','enrollment.id = personal_details.enrollment_id')
            ->where('paid_fee.delete_status',0);

        if(!empty($search)){



            $q->where('paid_fee.installment_date >= ',date('Y-m-d'));


            if($search['dateTo']){
                $q->where('paid_fee.installment_date <= ',date('Y-m-d',strtotime($search['dateTo'])));

            }

        }

        return $q->get()->result();

        //print_r($this->db->last_query()); exit();
    }

    public function getById($id)
    {
        $q = $this->db->select('
        
            enrollment.*, enrollment.id as enr_id,
            personal_details.*,
            family_information.father_name,
            paid_fee.*,
            classes.*,
            classes.title as classTitle, classes.id as classId,
            sections.title as sectionTitle, sections.id as sectionId,
            programs.title as programTitle,
            enrollment.id as enrollmentId,
            paid_fee.id as paidFeeId 
            
        ')
            ->from('paid_fee')
            ->join('enrollment','enrollment.id = paid_fee.enrollment_id')
            ->join('personal_details','enrollment.id = personal_details.enrollment_id')
            ->join('family_information','enrollment.id = family_information.enrollment_id')
            ->join('classes', 'classes.id = paid_fee.classId')
            ->join('sections', 'sections.id = paid_fee.sectionId')
            ->join('programs', 'programs.id = paid_fee.program_id')
            ->where('paid_fee.id',$id)
            ->get();

//        die($this->db->last_query());
        return $q->row();

        /*$query = $this->db->where('id',$id)
                ->get('users');

        return $query->result();*/

    }

    public function getFineAfterDueDate($class_id, $section_id){
        $q =  $this->db->select('fine')->from('fines')->where(['classId' => $class_id, 'sectionId'=>$section_id])->get();
        return ($q->num_rows() > 0)?$q->result_array()[0]['fine']:0;
    }

    public function getPaidAndRemainingAmounts($enrollment_id){
        $paid_amount = $this->db->select('SUM(fee_amount) as paid_amount')->from('paid_fee')->where(['enrollment_id' => $enrollment_id, 'status'=>1, 'delete_status'=>0])->get()->result_array()[0]['paid_amount'];
        $unpaid_amount = $this->db->select('SUM(fee_amount) as unpaid_amount')->from('paid_fee')->where(['enrollment_id' => $enrollment_id, 'status'=>0, 'delete_status'=>0])->get()->result_array()[0]['unpaid_amount'];

        return ['paid_amount'=>$paid_amount, 'unpaid_amount' => $unpaid_amount];
    }

    public function getUpcomingVouchersDate(){
        return date("Y-m-d", strtotime("+".$this->db->get('settings')->result_array()[0]['next_days']." days"));
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

    public function edit_user($id)
    {
        $query = $this->db->where('id',$id)
            ->get('users');

        return $query->row();

    }

    public function update_profile($data)
    {
        $query = $this->db->where('id',$data['id'])
            ->update('users',$data);
        return $query;
    }


    public function update_status($user_id,$status)
    {
        $set_defaultTimeZone = date_default_timezone_set('Asia/Karachi');

        $this->db->where('id',$user_id);
        if ($status == 0)
        {
            $this->db->set('is_approved',1);
        }
        else
        {
            $this->db->set('is_approved', 0);
        }

        $this->db->set('modified_by', $this->session->userdata('user_id'));
        $this->db->set('modified_at', date('y-m-d h:i:s'));

        return $this->db->update('users');

    }

    public function getFeePackage($enrollment_id)
    {
        $query =  $this->db->where(['enrollment_id' => $enrollment_id])
            ->get('fee_info');
        return $query->row();
    }

    public function getPaidFee($enrollment_id)
    {
        $query =  $this->db->where(array('enrollment_id' => $enrollment_id, 'status' => 1, 'delete_status' => 0))
            ->get('paid_fee');

        //print_r($this->db->last_query());

        return $query->result();
    }
    public function getUnPaidFee($enrollment_id)
    {
        $query =  $this->db->where(array('enrollment_id' => $enrollment_id, 'status' => 0, 'delete_status' => 0))
            ->get('paid_fee');

        return $query->result();
    }

    public function save_voucher($data, $return_id = false){

        $this->db->insert('transactions', $data);

        return ($return_id)?$this->db->insert_id():true;
    }

    public function save_paid_installment_voucher_id($data){
        $this->db->insert('paid_installments_vouchers', $data);
        return true;
    }

    public function update_voucher($data){
        $this->db->where('id', $data['id']);
        unset($data['id']);
        $this->db->update('transactions', $data);
        return true;
    }

    public function delete_transaction($id){
        $this->db->where('id', $id);
        $this->db->delete('transactions');

        return true;
    }

    public function getVoucherData($id){
        $this->db->where('id', $id);
        return $this->db->get('transactions')->result_array()[0];
    }

    public function getTransactionIds($installment_id){
        $q = $this->db->query("SELECT transaction_id FROM paid_installments_vouchers WHERE installment_id = '$installment_id'");
        return $q->result_array();
//        return $this->db->where('installment_id', $installment_id)->get('paid_installments_vouchers')->result_array();
    }

    public function deleteTransactions($transaction_ids){

        foreach ($transaction_ids as $transaction_id){
            $this->db->query("DELETE FROM transactions WHERE id = '".$transaction_id['transaction_id']."'");
        }
//        die($this->db->last_query());

        return true;
    }

    public function deleteTransactionsRecord($transaction_ids){

        foreach ($transaction_ids as $transaction_id){
            $this->db->query("DELETE FROM paid_installments_vouchers WHERE transaction_id ='".$transaction_id['transaction_id']."'");
        }
        return true;
    }

    public function unpayInstallment($installment_id){
        $data = [
            'status' => 0
        ];

        $this->db->where('id', $installment_id);
        $this->db->update('paid_fee', $data);

        return true;
    }


}