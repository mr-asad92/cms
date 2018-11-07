<?php
/**
 * Created by PhpStorm.
 * User: Hafiz Ali Hamza
 * Date: 9/13/2018
 * Time: 5:29 PM
 */

class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('logged_in')){
            redirect(base_url().'authentication/logout');
        }
        $this->load->model('Users_model');
    }

    /**
     *
     */
    public function index()
    {
        $data = array(
            'title' => 'ILM | Admin',
            'view' => 'users/usersList',
            'users' => $this->Users_model->getUsers()
        );
        //$role_id = $data['users'][1]->role_id;
        //$data['role'] = $this->getRoleTitle($role_id);

        //echo '<pre>'; print_r($data['users']); exit();

        $this->load->view('masterLayouts/admin',$data);
    }

    public function userDetails($id)
    {
        $data = array(
            'title' => 'ILM | Admin',
            'view' => 'users/user_details',
            'users' => $this->Users_model->getById($id),
            'url_text' => 'All Employees Details',
            'url' => 'users/all_userDetails',
            'url_txt' => 'Back to List',
            'url_address' => 'users'
        );
        //echo '<pre>'; print_r($data['user']); exit();

        $this->load->view('masterLayouts/admin',$data);
    }

    public function all_userDetails()
    {
        $data = array(
            'title' => 'ILM | Admin',
            'view' => 'users/user_details',
            'users' => $this->Users_model->getUsers(),
            'url_text' => 'Back to List',
            'url' => 'users'

        );
        //echo '<pre>'; print_r($data['users']); exit();

        $this->load->view('masterLayouts/admin',$data);
    }

    public function edit_profile($id)
    {
        $data = array(
            'title' => 'ILM | Admin',
            'view' => 'users/edit_user',
            'user' => $this->Users_model->edit_user($id)
        );

        //echo '<pre>'; print_r($data['user']); exit();

        $this->load->view('masterLayouts/admin',$data);
    }

    public function update_profile()
    {
        $this->form_validation->set_rules('first_name', 'First Name','trim|required');
        $this->form_validation->set_rules('last_name','Last Name','trim|required');
        $this->form_validation->set_rules('gender', 'Gender','trim|required');
        $this->form_validation->set_rules('qualification', 'Qualification','trim|required');
        $this->form_validation->set_rules('dob', 'Date of Birth','trim|required');
        $this->form_validation->set_rules('phone_no', 'Mobile No','trim|required');
        $this->form_validation->set_rules('cnic','CNIC','trim|required');
        $this->form_validation->set_rules('address', 'Address','trim|required');

        if ($this->form_validation->run() == false)
        {
            $data = array(
                'errors' => validation_errors('<p class="alert alert-danger">','</p>')
            );

            $this->session->set_flashdata($data);

            redirect('users/edit_profile/'.$this->input->post('id'));

        }
        else
        {
            $uploaded = '';
//            debug($_FILES['image']);
            if (!empty($_FILES['image']) && $_FILES['image']['name'] != '')
            {
                $config = array(

                    'upload_path' => './Uploaded_images',
                    'allowed_types' => 'gif|png|jpeg|jpg'
                );

                $this->load->library('upload',$config);

                if (! $this->upload->do_upload('image'))
                {
                    $data = array(
                        'errors' => $this->upload->display_errors('<p class="alert alert-danger">','</p>')
                    );
                    $this->session->set_flashdata($data);
                    redirect('users/edit_profile/'.$this->input->post('id'));
                }
                else
                {
                    $uploaded1 = $this->upload->data();
                    $uploaded = './uploaded_images/'.$this->upload->file_name;
                }
            }

            //$set_defaultTimeZone = date_default_timezone_set('Asia/Karachi');

            $data = array(

                'id' => $this->input->post('id'),
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'email' => $this->input->post('email'),
                'gender' => $this->input->post('gender'),
                'qualification' => $this->input->post('qualification'),
                'dob' => $this->input->post('dob'),
                'phone_no' => $this->input->post('phone_no'),
                'cnic' => $this->input->post('cnic'),
                'address' => $this->input->post('address'),
                //'modified_by' => $this->session->userdata('user_id'),

                //'modified_at' => date('y-m-d h:i:s')
            );

            if ($uploaded!=''){
                $data['image_url'] = $uploaded;
            }

            //print_r($data['modified_at']);exit();
            $result = $this->Users_model->update_profile($data);

            if($result)
            {
                $this->session->set_flashdata('msg', '<p class="alert alert-success">Your Profile has been updated successfully</p>');
            }
            else
            {
                $this->session->set_flashdata('errors', '<p class="alert alert-danger">An unknown error occurred.</p>');
            }

            redirect('users/edit_profile/'.$this->input->post('id'));
//            redirect('users');
        }

    }

    public function status($user_id,$status)
    {
        $this->Users_model->update_status($user_id,$status);
        $this->session->set_flashdata('msg','<p class="alert alert-success">Employee Status has been updated Successfully</p>');
        redirect('users');
    }


}