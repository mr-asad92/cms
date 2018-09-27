<?php


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
            'title' => 'ILM | Admin',
            'view' => 'accounts/accountsList',
        );

        //$result = $this->Accounts_model->getAccounts();
        //print_r($result);exit();

        $this->load->view('masterLayouts/admin',$data);
    }

    public function showAccounts()
    {
        $result = $this->Accounts_model->getAccounts();
        echo json_encode($result);
        print_r(json_encode($result));exit();
    }
}