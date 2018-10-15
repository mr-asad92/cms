<?php
/**
 * Created by PhpStorm.
 * User: Hafiz Ali Hamza
 * Date: 9/13/2018
 * Time: 5:29 PM
 */

class Accounts extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Accounts_model');
    }

    public function index()
    {
        $data = array(
            'title' => 'ILM | Accounts',
            'view' => 'accounts/accountsList',
//            'accounts' => getChildren(buildTree1($this->Accounts_model->getAccountsList(), 'parent_id', 'id')),
            'accounts' => getChildren(buildTree($this->Accounts_model->getAccountsList(), 'parent_id', 'id')),
            'accountsOptions' => getHieraricalAccounts(buildTree($this->Accounts_model->getAccountsList(), 'parent_id', 'id'))
        );

        $this->load->view('masterLayouts/admin',$data);
    }

    public function transactions()
    {
        $data = array(
            'title' => 'ILM | Accounts',
            'view' => 'accounts/transactions',
            'transactions' => $this->Accounts_model->getTransactions(),
        );

        $this->load->view('masterLayouts/admin',$data);
    }

    public function edit($id)
    {
        $data = array(
            'view' => 'accounts/accountsList',
            'account' => $this->Accounts_model->getById($id),
        );

        $this->load->view('masterLayouts/admin',$data);
    }

    public function addAccount()
    {
        $this->form_validation->set_rules('parent_id', 'Parent ID','trim|required');
        $this->form_validation->set_rules('account_name','Account Name','trim|required');
        $this->form_validation->set_rules('description', 'Description','trim|required');
        $this->form_validation->set_rules('opening_balance', 'Opening balance','trim|required');

        if ($this->form_validation->run() == false)
        {
            $data = array(
                'errors' => validation_errors('<p class="alert alert-danger">','</p>')
            );

            $this->session->set_flashdata($data);

            redirect('accounts');

        }
        else
        {
            //set_defaultTimeZone
            date_default_timezone_set('Asia/Karachi');

            $data = array(

                'parent_id' => $this->input->post('parent_id'),
                'account_name' => $this->input->post('account_name'),
                'description' => $this->input->post('description'),
                'opening_balance' => $this->input->post('opening_balance'),
                'account_type' => $this->input->post('account_type'),
                'created_by' => $this->session->userdata('user_id')
            );


            $result = $this->Accounts_model->add_account($data);

            if($result)
            {
                $this->session->set_flashdata('msg', '<p class="alert alert-success">Account has been created successfully</p>');
            }
            else
            {
                $this->session->set_flashdata('errors', '<p class="alert alert-danger">An unknown error occurred.</p>');
            }


            redirect('accounts');
        }

    }

    public function update_account($id){

        $data = array(
            'title' => 'ILM | Edit Account',
            'view' => 'accounts/updateAccount',
            'account' => $this->Accounts_model->getById($id),
//            'parentIds' => [0 => 'Account Head',1 => 'Expense', 2 => 'Revenue', 3 => 'Asset', 4 => 'Equity', 5 => 'Liability']

        );
//        debug($data['account']->parent_id);
        $data['parentIds'] = getHieraricalAccounts(buildTree($this->Accounts_model->getAccountsList(), 'parent_id', 'id'),0, $data['account']->parent_id);

        $this->load->view('masterLayouts/admin',$data);

    }


    public function updateAccount()
    {
        $this->form_validation->set_rules('parent_id', 'Parent ID','trim|required');
        $this->form_validation->set_rules('account_name','account Name','trim|required');
        $this->form_validation->set_rules('description', 'Description','trim|required');
        $this->form_validation->set_rules('opening_balance', 'Opening Balance','trim|required');

        if ($this->form_validation->run() == false)
        {
            $data = array(
                'errors' => validation_errors('<p class="alert alert-danger">','</p>')
            );

            $this->session->set_flashdata($data);

            redirect('accounts/update_account/'.$this->input->post('id'));

        }
        else
        {
            //set_defaultTimeZone
            date_default_timezone_set('Asia/Karachi');

            $data = array(
                'id' => $this->input->post('id'),
                'parent_id' => $this->input->post('parent_id'),
                'account_name' => $this->input->post('account_name'),
                'description' => $this->input->post('description'),
                'opening_balance' => $this->input->post('opening_balance'),
                'account_type' => $this->input->post('account_type'),
                'modified_by' => $this->session->userdata('user_id'),
                'modified_at' => date('y-m-d h:i:s')
            );


            $result = $this->Accounts_model->update_account($data);

            if($result)
            {
                $this->session->set_flashdata('msg', '<p class="alert alert-success">Account has been updated successfully</p>');
            }
            else
            {
                $this->session->set_flashdata('errors', '<p class="alert alert-danger">An unknown error occurred.</p>');
            }


            redirect('accounts');
        }

    }

    public function deleteAccount($id){
        $return = $this->Accounts_model->deleteAccount($id);
        echo $return;
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

    public function cash_book() {

        date_default_timezone_set('Asia/Karachi');

        $from_date = '';
        if(isset($_POST)){
            $from_date = $this->input->post('from_date');
        }
        $to_date = $from_date;
        if($from_date == ''){
            $from_date = date('Y-m-d');
            $to_date = date('Y-m-d');

        }

        $openingBalanceDate = $this->Accounts_model->getOpeningBalanceDate(date('Y-m-d', strtotime($from_date.' -1 day')));

        $cash_account = $this->Accounts_model->getAccountId('Cash');
        $expense_account = $this->Accounts_model->getAccountId('Expense');
        $data = array(
            'title' => 'ILM | Admin',
            'view' => 'accounts/cash_book',
            'transactions' => $this->Accounts_model->getCashBookTransactions($from_date, $to_date),
            'opening_balance' => $this->Accounts_model->getOpeningBalance($cash_account, $openingBalanceDate),
            'grand_total' => $this->Accounts_model->getGrandTotal($from_date, $to_date, $cash_account, $expense_account)

        );

//        debug($data['transactions']);
        $this->load->view('masterLayouts/admin',$data);



    }







}