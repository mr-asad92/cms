<?php
/**
 * Created by PhpStorm.
 * User: Hafiz Ali Hamza
 * Date: 9/13/2018
 * Time: 5:30 PM
 */

class Transaction_model extends CI_Model
{
    public function getTransactionList()
    {
        $q = $this->db->select('
            transactions.*,
            accounts.account_name as debit_account_name ,
            a.account_name as credit_account_name
            
             
            
        ')
            ->from('transactions')
            ->join('accounts','accounts.id = transactions.debit_account')
            ->join('accounts a','a.id = transactions.credit_account')
            ->get();

        return $q->result();

    }
    public function getById($id)
    {

        $q = $this->db->select('
            transactions.*,
            accounts.account_name as debit_account_name ,
            a.account_name as credit_account_name
            
             
            
        ')
            ->from('transactions')
            ->join('accounts','accounts.id = transactions.debit_account')
            ->join('accounts a','a.id = transactions.credit_account')
            ->where('transactions.id',$id)
            ->get();

        return $q->row();

    }

    public function add_account($data)
    {
        $q = $this->db->insert('accounts',$data);
        return $q;

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
        $query =  $this->db->where('enrollment_id',$enrollment_id)
            ->get('fee_info');
        return $query->row();
    }

    public function getPaidFee($enrollment_id)
    {
        $query =  $this->db->where(array('enrollment_id' => $enrollment_id, 'status' => 1))
            ->get('paid_fee');

        //print_r($this->db->last_query());

        return $query->result();
    }
    public function getUnPaidFee($enrollment_id)
    {
        $query =  $this->db->where(array('enrollment_id' => $enrollment_id, 'status' => 0))
            ->get('paid_fee');

        //print_r($this->db->last_query());

        return $query->result();
    }
}