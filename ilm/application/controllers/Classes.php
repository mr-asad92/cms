<?php
/**
 * Created by PhpStorm.
 * User: Hafiz Ali Hamza
 * Date: 9/19/2018
 * Time: 11:18 AM
 */

class Classes extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if(!$this->session->userdata('logged_in')){
            redirect(base_url().'authentication/logout');
        }
        date_default_timezone_set('Asia/Karachi');

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

        $this->load->model('Programs_model');
        $this->load->model('Classes_model');
        $this->load->model('Vouchers_model');

    }

    public function classesList()
    {
        $data = array(
            'title' => 'ILM | Admin',
            //'view' => 'classes/classesList',
            'classes' => $this->Classes_model->getClasses()
        );

        $classesList = $this->load->view('classes/classesList',$data, TRUE);
        return $classesList;
    }

    public function add()
    {
        $data = array(
            'title' => 'ILM | Admin',
            //'view' => 'classes/add_edit',
            'submitUrl' => base_url().'classes/add_post',
            'programs' => $this->Programs_model->getPrograms(),
            'edit' => false,
            'method' => 'Add'
        );

         $add = $this->load->view('classes/add_edit',$data, TRUE);
        return $add;
    }

    public function index($id = NULL)
    {
        $data = array(
            'classesList' => $this->classesList(),
            'view' => 'classes/classes',

        );

        if ($id)
        {
            $data['edit'] = $this->edit($id);
        }
        else
        {
            $data['add'] = $this->add();
        }

        $this->load->view('masterLayouts/admin',$data);
    }

    public function edit($id)
    {
        $data = array(
            'title' => 'ILM | Admin',
            //'view' => 'classes/add_edit',
            'programs' => $this->Programs_model->getPrograms(),
            'class' => $this->Classes_model->getById($id),
            'submitUrl' => base_url().'classes/edit_post',
            'method' => 'Edit',
            'edit' => true
        );

        $editView = $this->load->view('classes/add_edit',$data,TRUE);
        return $editView;
    }


    public function add_post()
    {
        $this->form_validation->set_rules('title', 'Class Name','trim|required');

        if($this->form_validation->run() == false)
        {
            $data = array(
                'errors' => validation_errors('<p class="alert alert-danger">','</p>')
            );

            $this->session->set_flashdata($data);

            redirect('classes');

        }
        else
        {
            $data = array(
                'title' => $this->input->post('title'),
                'program_id' =>$this->input->post('program_id')
            );

            $result = $this->Classes_model->add_class($data);



            if($result)
            {
                $this->session->set_flashdata('msg', '<p class="alert alert-success">Class has been added successfully</p>');
            }
            else
            {
                $this->session->set_flashdata('errors', '<p class="alert alert-danger">An unknown error occurred.</p>');
            }

            redirect('classes');
        }
    }

    public function edit_post()
    {
        $this->form_validation->set_rules('title', 'Class Name','trim|required');

        if ($this->form_validation->run() == false)
        {
            $data = array(
                'errors' => validation_errors('<p class="alert alert-danger">','</p>')
            );

            $this->session->set_flashdata($data);

            redirect('classes');

        }
        else
        {
            $data = array(
                'id' => $this->input->post('id'),
                'title' => $this->input->post('title'),
                'program_id' =>$this->input->post('program_id')

            );

            $result = $this->Classes_model->update_class($data);

            if($result)
            {
                $this->session->set_flashdata('msg', '<p class="alert alert-success">Class has been updated successfully</p>');
            }
            else
            {
                $this->session->set_flashdata('errors', '<p class="alert alert-danger">An unknown error occurred.</p>');
            }

            redirect('Classes');
        }
    }

    public function delete($id)
    {
        $deleted = $this->Classes_model->delete($id);
        if($deleted)
        {
            $this->session->set_flashdata('msg','<p class="alert alert-success">Class has been deleted Successfully</p>');

        }
        else
        {
            $this->session->set_flashdata('errors','<p class="alert alert-danger">An unknown error occurred.</p>');
        }

        return redirect('classes');

    }
}