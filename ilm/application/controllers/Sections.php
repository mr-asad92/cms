<?php
/**
 * Created by PhpStorm.
 * User: Hafiz Ali Hamza
 * Date: 9/19/2018
 * Time: 11:18 AM
 */

class Sections extends CI_Controller
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

        $this->load->model('Sections_model');
    }
}