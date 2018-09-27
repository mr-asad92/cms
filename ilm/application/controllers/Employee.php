<?php
/**
 * Created by PhpStorm.
 * User: Hafiz Ali Hamza
 * Date: 9/22/2018
 * Time: 12:05 PM
 */

class Employee extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Employee_model');
    }

    public function index()
    {
        $data = array(
            'title' => 'ILM | Admin',
            'view' => 'employees/',
            'submitUrl' => base_url().'programs/add_post',
            'edit' => false,
            'method' => 'Add'
        );

        $addView = $this->load->view('programs/add_edit',$data,TRUE);
    }
}