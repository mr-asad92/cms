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
            'accounts' => $this->Accounts_model->getAccountsList(),
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
        $this->form_validation->set_rules('account_headId', 'Account Head','trim|required');
        $this->form_validation->set_rules('account_name','account Name','trim|required');
        $this->form_validation->set_rules('description', 'Description','trim|required');

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

                'account_headId' => $this->input->post('account_headId'),
                'account_name' => $this->input->post('account_name'),
                'description' => $this->input->post('description'),
                'created_by' => $this->session->userdata('user_id'),
                'created_at' => date('y-m-d')
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

    public function updateAccount()
    {
        $this->form_validation->set_rules('account_headId', 'Account Head','trim|required');
        $this->form_validation->set_rules('account_name','account Name','trim|required');
        $this->form_validation->set_rules('description', 'Description','trim|required');

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
                'id' => $this->input->post('id'),
                'account_headId' => $this->input->post('account_headId'),
                'account_name' => $this->input->post('account_name'),
                'description' => $this->input->post('description'),
                'created_by' => $this->session->userdata('user_id'),
                'created_at' => date('y-m-d')
            );


            $result = $this->Accounts_model->add_account($data);

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







}