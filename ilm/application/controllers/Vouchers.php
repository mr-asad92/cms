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
        if(!$this->session->userdata('logged_in')){
            redirect(base_url().'authentication/logout');
        }

        $method = $this->router->fetch_method();
        if(!empty($method ) && $method != 'buildProfileFirst') {
            if (!$this->admin_model->isProfileExists($this->session->userdata('email'))) {
                redirect(base_url() . 'admin/buildProfileFirst');
            }
        }

        if (($this->session->userdata('role_id') != 0)) { // if user is not admin then check for permissions

            if ((!empty($method) && $method != 'invalid_permissions')) {
                //  load libs
                $this->load->library('permission');

                // set groupID
                $groupID = ($this->session->userdata('user_id')) ? $this->session->userdata('user_id') : 0;

                $this->permissions = $this->permission->get_user_permissions($groupID);
                $current_page = strtolower($this->router->fetch_class()).'/'.$method;
                if (!in_array($current_page, $this->permissions)) {
                    redirect(base_url() . 'admin/invalid_permissions');
                }
            }

        }

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
        );
//        'vouchers' => $this->Vouchers_model->getVouchers(),
        $search = [];
        $data['vouchers'] = $this->Vouchers_model->getVouchers($search);

        if(isset($_POST)){

            $search['enrollmentNo'] = $this->input->post('EnrollmentNo');
            $search['dateFrom'] = $this->input->post('DateFrom');
            $search['dateTo'] = $this->input->post('DateTo');
            $search['classId'] = $this->input->post('classId');
            $search['sectionId'] = $this->input->post('sectionId');
            $search['status'] = $this->input->post('Status');

            $data['vouchers'] = $this->Vouchers_model->getVouchers($search);

        }


        $data['classes'] = $this->admin_model->getClassesWithProgramTitle(true);
        $data['sections'] = $this->admin_model->getSectionsWithProgramAndClassTitle(true);

        //echo '<pre>';print_r($data);exit();
        $this->load->view('masterLayouts/admin',$data);
    }

    public function upcoming_vouchers(){
        $data = array(
            'title' => 'ILM |Fee Voucher',
            'view' => 'vouchers/vouchersListUpcoming',
        );
//        'vouchers' => $this->Vouchers_model->getVouchers(),
        $search['dateTo'] = $this->Vouchers_model->getUpcomingVouchersDate();
        $data['vouchers'] = $this->Vouchers_model->getUpcomingVouchers($search);

        $data['classes'] = $this->admin_model->getClassesWithProgramTitle(true);
        $data['sections'] = $this->admin_model->getSectionsWithProgramAndClassTitle(true);

        $this->load->view('masterLayouts/admin',$data);
    }

    public function Details($id)
    {
        $data = array(
            'title' => 'ILM | Admin',
            'view' => 'vouchers/voucher_details',
            'voucher' => $this->Vouchers_model->getById($id),
            'voucher_no' => $id,
            'print' => false
        );
        $data['amounts'] = $this->Vouchers_model->getPaidAndRemainingAmounts($data['voucher']->enr_id);
//        debug($data['voucher']);

        $this->load->view('masterLayouts/admin',$data);
    }

    public function printVoucher($id)
    {
        $data = array(
            'title' => 'ILM | Admin',
            'view' => 'vouchers/voucher_details',
            'voucher' => $this->Vouchers_model->getById($id),
            'voucher_no' => $id,
            'print' => true
        );

        $data['amounts'] = $this->Vouchers_model->getPaidAndRemainingAmounts($data['voucher']->enr_id);

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

    public function delete_transaction($id){

        $status = $this->Vouchers_model->delete_transaction($id);

        if ($status){
            $this->session->set_flashdata('msg','<p class="alert alert-success">Transaction Deleted Successfully!</p>');
        }

        redirect(base_url().'accounts/transactions');
    }

    public function edit_transaction($id){

        $data = array(
            'title' => 'ILM | Edit Account',
            'view' => 'vouchers/update_voucher',
            'voucher' => $this->Vouchers_model->getVoucherData($id),
        );

        $data['dr_account'] = getHieraricalAccounts(buildTree($this->Accounts_model->getAccountsList(), 'parent_id', 'id'),0, $data['voucher']['debit_account']);
        $data['cr_account'] = getHieraricalAccounts(buildTree($this->Accounts_model->getAccountsList(), 'parent_id', 'id'),0, $data['voucher']['credit_account']);

        $this->load->view('masterLayouts/admin',$data);

    }

    public function saveUpdatedVoucher(){
        $id = $this->input->post('id');
        $v_date = $this->input->post('v_date');
        $title = $this->input->post('title');
        $book_reference = $this->input->post('book_reference');
        $acc_debit = $this->input->post('acc_debit');
        $acc_credit = $this->input->post('acc_credit');
        $description = $this->input->post('description');
        $amount = $this->input->post('amount');

        $data = [
            'id' => $id,
            'title'      => $title,
            'book_reference'=> $book_reference,
            'debit_account'  => $acc_debit,
            'credit_account'  => $acc_credit,
            'description'  => $description,
            'amount'  => $amount,
            'modified_by' => $this->session->userdata['user_id'],
            'modified_at' => date("Y-m-d"),
        ];

        $status = $this->Vouchers_model->update_voucher($data);

        if ($status){
            $this->session->set_flashdata('msg','<p class="alert alert-success">Transaction updated successfully!</p>');
        }

        redirect(base_url().'accounts/transactions');
    }


}