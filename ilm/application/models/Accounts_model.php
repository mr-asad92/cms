<?php
/**
 * Created by PhpStorm.
 * User: Hafiz Ali Hamza
 * Date: 9/13/2018
 * Time: 5:30 PM
 */

class Accounts_model extends CI_Model
{
    public function getAccountsList($search = [])
    {
//        $q = $this->db->get('accounts');


        $q = $this->db->select('*')->from('accounts');
        if(!empty($search)){

            if($search['account_name']){
                $q->where('account_name',$search['account_name']);
            }

            if($search['dateFrom']){
                $q->where('created_at >= ',date('Y-m-d',strtotime($search['dateFrom'])));
            }

            if($search['dateTo']){
                $q->where('created_at <= ',date('Y-m-d',strtotime($search['dateTo'])));
            }

            if($search['account_type'] || $search['account_type']!=""){
                $q->where('account_type',$search['account_type']);
            }

        }
        return $q->get()->result_array();

    }

    public function add_account($data)
    {
        $q = $this->db->insert('accounts',$data);
        return $q;

    }

    public function update_account($data){
        $this->db->where('id', $data['id']);
        unset($data['id']);
        $this->db->update('accounts', $data);

//        debug($data);
        return true;
    }

    public function deleteAccount($id){
        $this->db->where('id', $id);
        $this->db->delete('accounts');

        return "deleted";
    }

    public function getById($id)
    {

        $query = $this->db->where('id',$id)
                ->get('accounts');

        return $query->row();

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

    public function getCashBookTransactions($from_date, $to_date, $account){

        $from_date = date("Y-m-d", strtotime($from_date));
        $to_date = date("Y-m-d", strtotime($to_date));

        $query = "SELECT * FROM transactions WHERE (debit_account='$account' OR credit_account='$account') AND created_at >= '$from_date' AND created_at <= '$to_date' + INTERVAL 1 DAY";
        $r = $this->db->query($query);
        $transactions = [];

        if ($r->num_rows() > 0) {
            $res = $r->result_array();
            foreach ($res as $key => $value) {
                $value['dr_acc_title'] = $this->getAccountTitle($value['debit_account']);
                $value['cr_acc_title'] = $this->getAccountTitle($value['credit_account']);

                $transactions[] = $value;
            }
        }

        return $transactions;
    }

    public function getAccountTitle($id){
        $account_name = $this->db->select('account_name')
            ->from('accounts')
            ->where('id', $id)
            ->get()->result_array()[0]['account_name'];

            return($account_name);
    }

    public function getAccountId($name){

        return $this->db->select('id')->from('accounts')->where('account_name',$name)->get()->result_array()[0]['id'];
//        if($name == 'Cash'){
//            return 17; //cash account id
//        }
//        else{
//            return 12; //expense account id
//        }
    }

    public function getGrandTotal($from_date, $to_date, $cash_account){
        $grandTotal = 0;
        $query = "SELECT (SELECT SUM(amount) FROM transactions WHERE debit_account = '$cash_account' AND created_at >= '$from_date' AND created_at <= '$to_date' + INTERVAL 1 DAY) as debit_sum, (SELECT SUM(amount) FROM transactions WHERE credit_account = '$cash_account' AND created_at >= '$from_date' AND created_at <= '$to_date' + INTERVAL 1 DAY) as credit_sum FROM transactions";

        $result = $this->db->query($query);

        if($result->num_rows() > 0){
            $r = $result->result_array()[0];
            $grandTotal = $r['debit_sum'] - $r['credit_sum'];
        }

        return $grandTotal;
    }

    public function getOpeningBalanceDate($date){
        $lastWorkingDay = null;
        $q = "SELECT count(id) as nR FROM transactions  WHERE created_at <= '$date' + INTERVAL 1 DAY";
        $nR = $this->db->query($q)->result_array()[0]['nR'];
//        debug($nR);
        if($nR == 0){

            do{

                $query = "SELECT COUNT(id) as numRows FROM transactions WHERE created_at LIKE '%$date%'";
                $numRows = $this->db->query($query)->result_array()[0]['numRows'];

                if($numRows > 0){
                    $lastWorkingDay = $date;
                }
                else{
                    $date = date('Y-m-d', strtotime($date.' -1 day'));
                }
            }
            while($lastWorkingDay == null);
        }
        else{
            $lastWorkingDay = $date;
        }


        return $lastWorkingDay;
    }

    public function getOpeningBalance($cash_account, $date, $account = 17){

        if($date == null){
            // get initial opening Balance
            $openingBalance = $this->db->select('opening_balance')->from('accounts')->where('id', $cash_account)->get()->result_array()[0]['opening_balance'];
        }
        else{
            $query = "SELECT (SELECT SUM(amount) FROM transactions WHERE debit_account = '$cash_account' AND created_at LIKE '%$date%') as debit_sum, (SELECT SUM(amount) FROM transactions WHERE credit_account = '$cash_account' AND created_at LIKE '%$date%') as credit_sum FROM transactions";

            $result = $this->db->query($query)->result_array()[0];

            $openingBalance = $result['debit_sum'] - $result['credit_sum'];
            // + opening balance of previous working day

            $qry = "SELECT sum(amount) as amnt FROM transactions WHERE (debit_account='$account' OR credit_account='$account') AND created_at LIKE '%$date%'";
            $r = $this->db->query($qry);
            if($r->num_rows() > 0){
//                debug($r->result_array()[0]['amnt']);
//                $openingBalance += $r->result_array()[0]['amnt'];
            }
        }


        return $openingBalance;

    }

    public function getOpeningBalanceNew($cash_account, $date, $account = 17){

        if($date == null){
            // get initial opening Balance
            $openingBalance = $this->db->select('opening_balance')->from('accounts')->where('id', $cash_account)->get()->result_array()[0]['opening_balance'];
        }
        else{
            $query = "SELECT (SELECT SUM(amount) FROM transactions WHERE debit_account = '$cash_account' AND created_at <= '$date' + INTERVAL 1 DAY) as debit_sum, (SELECT SUM(amount) FROM transactions WHERE credit_account = '$cash_account' AND created_at <= '$date' + INTERVAL 1 DAY) as credit_sum FROM transactions";

            $result = $this->db->query($query)->result_array()[0];

            $openingBalance = $result['debit_sum'] - $result['credit_sum'];
            // + opening balance of previous working day

            $startOpeningBalance = $this->db->select('opening_balance')->from('accounts')->where('id', $cash_account)->get()->result_array()[0]['opening_balance'];

            $openingBalance += $startOpeningBalance;
        }


        return $openingBalance;

    }

    public function getTransactions($search = []){
//        $query = "SELECT * FROM transactions ORDER BY created_at DESC";
        $query = "SELECT * FROM transactions ";
        if(!empty($search)){
            if ($search['dateFrom'] != ''){
                $condition = (whereClauseExists($query))?'AND ':' WHERE ';
                $query .= $condition." created_at >= '".date("Y-m-d",strtotime($search['dateFrom']))."'";
            }
            else if ($search['dateTo'] != ''){
                $condition = (whereClauseExists($query))?'AND ':' WHERE ';
                $query .= $condition." created_at <= '".date("Y-m-d",strtotime($search['dateTo']))."'";
            }
        }

        $query .= ' ORDER BY created_at DESC';
//        debug($query);

        $res = $this->db->query($query);

        if ($res->num_rows() > 0) {
            $transactions = [];
            foreach ($res->result_array() as $key => $value) {
                $value['dr_acc_title'] = $this->getAccountTitle($value['debit_account']);
                $value['cr_acc_title'] = $this->getAccountTitle($value['credit_account']);

                $transactions[] = $value;
            }
            $return = $transactions;
        }
        else{
            $return = [];
        }

        return $return;
    }

    public function getInstallmentId($transaction_id){
        $q = $this->db->where('transaction_id', $transaction_id)->get('paid_installments_vouchers');
        if ($q->num_rows() > 0){
            $return = $q->result_array()[0]['installment_id'];
        }
        else{
            $return = 'not_found';
        }
        return $return;
    }

    public function getSectionAndProgramId($installment_id){
        $q = $this->db->select('program_id, sectionId')->from('paid_fee')->where('id', $installment_id)->get()->result_array()[0];
//        debug($q);
        $return = ['program_id' => $q['program_id'], 'section_id' => $q['sectionId']];
        return $return;
    }

    public function getCurrentMonthIncome($firstDayOfThisMonth, $lastDayThisMonth, $fee_account){
        $query = "SELECT SUM(amount) as monthlyIncome FROM transactions WHERE credit_account='$fee_account' AND created_at>='$firstDayOfThisMonth' AND created_at <= '$lastDayThisMonth' + INTERVAL 1 DAY ";

        return $this->db->query($query)->result_array()[0]['monthlyIncome'];
    }

    public function getCurrentMonthExpense($firstDayOfThisMonth, $lastDayThisMonth, $expense_account){
        $query = "SELECT SUM(amount) as monthlyExpense FROM transactions WHERE debit_account='$expense_account' AND created_at>='$firstDayOfThisMonth' AND created_at <= '$lastDayThisMonth' + INTERVAL 1 DAY ";

        return $this->db->query($query)->result_array()[0]['monthlyExpense'];
    }

    public function getCurrentMonthExpectedFee($firstDayOfThisMonth, $lastDayThisMonth){
        $query = "SELECT SUM(fee_amount) as expectedFee FROM paid_fee WHERE status = 0 AND installment_date>='$firstDayOfThisMonth' AND installment_date <= '$lastDayThisMonth' + INTERVAL 1 DAY ";

        return $this->db->query($query)->result_array()[0]['expectedFee'];
    }

    public function getTotalReceivedFee(){
        $query = "SELECT SUM(fee_amount) as receivedFee FROM paid_fee WHERE status = 1";

        return $this->db->query($query)->result_array()[0]['receivedFee'];
    }

    public function getTotalReceiveableFee(){
        $query = "SELECT SUM(fee_amount) as receiveableFee FROM paid_fee WHERE status = 0";

        return $this->db->query($query)->result_array()[0]['receiveableFee'];
    }

    public function getTrialBalance($from_date, $to_date){

        $query = "SELECT id, account_name FROM accounts";
        $res = $this->db->query($query)->result_array();

        $rows = [];
        foreach ($res as $key => $value){
            $acc_id = $value['id'];
            $acc_name = $value['account_name'];

            $query = "SELECT SUM(amount) as debit_amount FROM transactions WHERE debit_account='$acc_id' AND created_at >= '$from_date' AND created_at <= '$to_date' + INTERVAL 1 DAY";
            $debit_amount = $this->db->query($query)->result_array()[0]['debit_amount'];

            $query = "SELECT SUM(amount) as credit_amount FROM transactions WHERE credit_account='$acc_id' AND created_at >= '$from_date' AND created_at <= '$to_date' + INTERVAL 1 DAY";
            $credit_amount = $this->db->query($query)->result_array()[0]['credit_amount'];

            $rows[$acc_id] = [
                'account_id' => $acc_id,
                'account_name' => $acc_name,
                'debit_amount' => $debit_amount,
                'credit_amount' => $credit_amount
            ];

        }

        return $rows;
    }

    public function getExpensesListing($from_date, $to_date){

        $expense_account = 12;
        $query = "SELECT t.*, a.account_name FROM transactions t 
 LEFT JOIN accounts a ON a.id=t.debit_account
 WHERE t.debit_account='$expense_account' AND t.created_at >= '$from_date' AND t.created_at <= '$to_date' + INTERVAL 1 DAY";
        return $this->db->query($query)->result_array();

    }

    public function getIncomeListing($from_date, $to_date){

        $fee_account = 17;
        $fine_account = 18;
        $query = "SELECT t.*,a.account_name FROM transactions t LEFT JOIN accounts a ON a.id=t.debit_account WHERE (t.debit_account='$fee_account' OR t.debit_account='$fine_account') AND t.created_at >= '$from_date' AND t.created_at <= '$to_date' + INTERVAL 1 DAY";
        return $this->db->query($query)->result_array();

    }

}