<?php
/**
 * Created by PhpStorm.
 * User: Hafiz Ali Hamza
 * Date: 9/19/2018
 * Time: 11:16 AM
 */

class Programs extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Programs_model');
    }

    public function programsList()
    {
        $data = array(
            'title' => 'ILM | Admin',
            //'view' => 'programs/programsList',
            'programs' => $this->Programs_model->getPrograms()
        );

        $programsView = $this->load->view('programs/programsList',$data,TRUE);
        return $programsView;
    }



    public function add()
    {
        $data = array(
            'title' => 'ILM | Admin',
            //'view' => 'programs/add_edit',
            'submitUrl' => base_url().'programs/add_post',
            'edit' => false,
            'method' => 'Add'
        );

        $addView = $this->load->view('programs/add_edit',$data,TRUE);

        return $addView;
    }

    public function index($id = NULL)
    {
        $data = array(
            'programsList' => $this->programsList(),
            'view' => 'programs/programs'

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
            //'view' => 'programs/add_edit',
            'program' => $this->Programs_model->getById($id),
            'submitUrl' => base_url().'programs/edit_post',
            'method' => 'Edit',
            'edit' => true
        );

        $editView = $this->load->view('programs/add_edit',$data,TRUE);
        return $editView;
    }


    public function add_post()
    {
        $this->form_validation->set_rules('title', 'Study Program Name','trim|required');

        if ($this->form_validation->run() == false)
        {
            $data = array(
                'errors' => validation_errors('<p class="alert alert-danger">','</p>')
            );

            $this->session->set_flashdata($data);

            redirect('programs');

        }
        else
        {
            $data = array(

                'title' => $this->input->post('title')

            );

            $result = $this->Programs_model->add_program($data);

            if($result)
            {
                $this->session->set_flashdata('msg', '<p class="alert alert-success">Study Program has been added successfully</p>');
            }
            else
            {
                $this->session->set_flashdata('errors', '<p class="alert alert-danger">An unknown error occurred.</p>');
            }

            redirect('programs');
        }
    }

    public function edit_post()
    {
        $this->form_validation->set_rules('title', 'Study Program Name','trim|required');

        if ($this->form_validation->run() == false)
        {
            $data = array(
                'errors' => validation_errors('<p class="alert alert-danger">','</p>')
            );

            $this->session->set_flashdata($data);

            redirect('programs');

        }
        else
        {
            $data = array(
                'id' => $this->input->post('id'),
                'title' => $this->input->post('title')

            );

            $result = $this->Programs_model->update_program($data);

            if($result)
            {
                $this->session->set_flashdata('msg', '<p class="alert alert-success">Study Program has been updated successfully</p>');
            }
            else
            {
                $this->session->set_flashdata('errors', '<p class="alert alert-danger">An unknown error occurred.</p>');
            }

            redirect('programs');
        }
    }

    public function delete($id)
    {
        $deleted = $this->Programs_model->delete($id);
        if($deleted)
        {
            $this->session->set_flashdata('msg','<p class="alert alert-success">Study Program has been deleted Successfully</p>');

        }
        else
        {
            $this->session->set_flashdata('errors','<p class="alert alert-danger">An unknown error occurred.</p>');
        }

        return redirect('programs');

    }
}