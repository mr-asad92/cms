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
        $this->load->model('Sections_model');
    }
}