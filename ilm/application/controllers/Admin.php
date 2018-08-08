<?php

class Admin extends CI_Controller
{

    public function index()
    {

        $data = array(
            'title' => 'ILM | Admin',
            'view' => 'admin/home'
        );

        $this->load->view('masterLayouts/admin', $data);

    }

}


?>