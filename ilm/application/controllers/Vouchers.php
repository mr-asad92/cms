<?php
/**
 * Created by PhpStorm.
 * User: Hafiz Ali Hamza
 * Date: 9/13/2018
 * Time: 5:29 PM
 */

class Vouchers extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Vouchers_model');
        $this->load->model('admin_model');
        $this->load->model('Accounts_model');

        //$this->load->library('../controllers/Admin');



    }

    public function index()
    {
        $data = array(
            'title' => 'ILM |Fee Voucher',
            'view' => 'vouchers/vouchersList',
            'vouchers' => $this->Vouchers_model->getVouchers(),
        );

        //echo '<pre>';print_r($data);exit();
        $this->load->view('masterLayouts/admin',$data);
    }

    public function Details($id)
    {
        $data = array(
            'title' => 'ILM | Admin',
            'view' => 'vouchers/voucher_details',
            'voucher' => $this->Vouchers_model->getById($id),
            'print' => false
        );

        $this->load->view('masterLayouts/admin',$data);
    }

    public function printVoucher($id)
    {
        $data = array(
            'title' => 'ILM | Admin',
            'view' => 'vouchers/voucher_details',
            'voucher' => $this->Vouchers_model->getById($id),
            'print' => true
        );


        $this->load->view('masterLayouts/admin',$data);
    }

    public function searchStudent()
    {
        $searchData = array(
            'enrollment_no' => $this->input->post('EnrollmentNo'),
            'roll_no' => $this->input->post('rollNo'),
            'student_name' => $this->input->post('Name'),
            'guardian_name' => $this->input->post('guardianName'),
            'mobile_no' => $this->input->post('guardianMobile'),
            'class_id' => $this->input->post('classId')
        );

        $data = array(
            'title' => 'ILM | Admin',
            'view' => 'admin/studentsList',
            'classes' => $this->admin_model->getClasses(),
            'studentsList' => $this->admin_model->searchStudent($searchData)
        );

        //echo '<pre>';print_r($data['studentsList']);exit();


        $this->load->view('masterLayouts/admin',$data);
    }



    public function feePackageAndHistory($enrollment_id)
    {
        //require_once('Admin.php');
        //$admin = new Admin();
        $data = array(
            'title' => 'ILM | Admin',
            'view' => 'vouchers/fee_pkg_history',
            'fee_package' => $this->Vouchers_model->getFeePackage($enrollment_id),
            'student_info' => $this->studentInfo($enrollment_id),
            //'student_info' => ,
            'paid_fee' => $this->Vouchers_model->getPaidFee($enrollment_id),
            'unpaid_fee' => $this->Vouchers_model->getUnPaidFee($enrollment_id)
        );

        //echo '<pre>'; print_r($data['paid_fee']); exit();

        $this->load->view('masterLayouts/admin',$data);
    }

    public function studentInfo($id = NULL)
    {
        if ($id)
        {
            $data = array(
                'title' => 'ILM | Admin',
                //'view' => 'admin/studentDetails',
                'student_detail' => $this->admin_model->getStudentDetail($id),
                'suspendReason' => $this->admin_model->getSuspendReason($id),
                'leaveReason' => $this->admin_model->getLeaveReason($id)
            );

            $student_info = $this->load->view('admin/student_info',$data,TRUE);

            return $student_info;
        }

    }

    public function post_voucher(){

        $data = array(
            'title' => 'ILM | Post Vouchers',
            'view' => 'vouchers/post_vouchers',
            'accounts' => getHieraricalAccounts(buildTree($this->Accounts_model->getAccountsList(), 'parent_id', 'id'))
        );

//        debug($data['accounts']);
        $this->load->view('masterLayouts/admin', $data);

    }

    public function save_voucher(){

        $v_date = $this->input->post('v_date');
        $title = $this->input->post('title');
        $book_reference = $this->input->post('book_reference');
        $acc_debit = $this->input->post('acc_debit');
        $acc_credit = $this->input->post('acc_credit');
        $description = $this->input->post('description');
        $amount = $this->input->post('amount');

        $data = [
            'title'      => $title,
            'book_reference'=> $book_reference,
            'debit_account'  => $acc_debit,
            'credit_account'  => $acc_credit,
            'description'  => $description,
            'amount'  => $amount,
            'created_by' => $this->session->userdata['user_id'],
        ];

        $status = $this->Vouchers_model->save_voucher($data);

        if ($status){
            $this->session->set_flashdata('msg','<p class="alert alert-success">Transaction added successfully!</p>');
        }

        redirect(base_url().'vouchers/post_voucher');
    }





}