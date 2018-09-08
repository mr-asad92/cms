<?php

class Authentication extends CI_Controller {

    public function index() {

        $data=array(
            'title'=>'ILM | Login',
            'view'=>'authentication/login'
        );

        $this->load->view('masterLayouts/authentication', $data);

    }

    public function init_login(){
        $this->form_validation->set_rules('email', 'Email','trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
        if ($this->form_validation->run()==FALSE) {
            $data=array(
                'errors'=>validation_errors()
            );
            $this->session->set_flashdata($data);

            redirect('authentication');
        }
        else{
            $email=$this->input->post('email');
            $password=md5($this->input->post('password'));
            $this->load->model('authentication_model');
            $user_id=$this->authentication_model->verifyLogin($email,$password);
            if ($user_id != FALSE) {
                // $this->load->view('users/profile',$profile_data);
                $data=array(
                    'user_id'=>$user_id,
                    'email'=>$email,
                    'logged_in'=>TRUE
                );
                $this->session->set_userdata($data);
                // $this->session->set_flashdata($data);
                redirect(base_url().'admin');
                // redirect('home_cont');
            }
            else{
                $data=array(
                    'errors'=>'<p class="text-danger">User Does Not Exists.</p>'
                );
                $this->session->set_flashdata($data);
//                echo "error";
                redirect('authentication');

            }

        }
    }

    public function register(){
        $data=array(
            'title'=>'ILM | Register',
            'view'=>'authentication/register'
        );

        $this->load->view('masterLayouts/authentication', $data);
    }

    public function init_register(){
        $this->form_validation->set_rules('first_name', 'First Name','trim|required|min_length[3]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|min_length[6]|matches[password]');
        $this->form_validation->set_rules('email', 'Email','trim|required|min_length[12]');

        if ($this->form_validation->run()==FALSE) {
            $data=array(
                'errors'=>validation_errors()
            );
            $this->session->set_flashdata($data);
            redirect('authentication/register');
        }
        else{
            $reg_data=array(
                'first_name'=>$this->input->post('first_name'),
                'last_name'=>$this->input->post('last_name'),
                'password'=>md5($this->input->post('password')),
                'email'=>$this->input->post('email')
            );
            // 'country'=>$this->input->post('country'),
            $this->load->model('authentication_model');
            $status=$this->authentication_model->register($reg_data);

            if ($status) {
                $msg=array(
                    'msg'=>'<p class="text-success">User Registered Successfully, Please login to procceed.</p>'
                );
//                redirect('authentication/register');
            }
            else if ($status=="user_exists") {
                $msg=array(
                    'msg'=>'<p class="text-danger">User already exists, please choose another username.</p>'
                );
            }
            else{
                $msg=array(
                    'msg'=>'<p class="text-danger">There is some error, Please try again later.</p>'
                );
            }
            $this->session->set_flashdata($msg);
            redirect('authentication/register');
        }
    }

    public function forgot_password(){

        $data=array(
            'title'=>'ILM | Forgot Password',
            'view'=>'authentication/forgot_password'
        );

        $this->load->view('masterLayouts/authentication', $data);

    }

}