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

            //print_r($user_id); exit();

            if ($user_id != FALSE) {
                // $this->load->view('users/profile',$profile_data);
                $data=array(
                    'user_id'=>$user_id,
                    'email'=>$email,
                    'logged_in'=>TRUE
                );
                $this->session->set_userdata($data);
                //echo '<pre>'; print_r($this->session->userdata('user_id')); exit();
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
        $this->form_validation->set_rules('role_id', 'Role','trim|required');

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
                'email'=> $this->input->post('email'),
                'role_id' => $this->input->post('role_id'),
                'created_by' => $this->session->userdata('user_id')
            );

                //echo "<pre>"; print_r($reg_data); exit();
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

    public function resetPassword(){
        $this->load->model('authentication_model');

        $email = $this->input->post('email');
        $findemail = $this->authentication_model->forgotPassword($email);
        if($findemail){
            $this->authentication_model->sendpassword($findemail);
        }else{
            $this->session->set_flashdata('msg',' Email not found!');
            redirect(base_url().'authentication/forgot_password');
        }

    }

    public function change_password(){
        $data=array(
            'title'=>'ILM | Change Password',
            'view'=>'authentication/change_password'
        );

        $this->load->view('masterLayouts/authentication', $data);
    }

    public function updatePassword(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('opassword','Old Password','required|trim');
        $this->form_validation->set_rules('npassword','New Password','required|trim|min_length[6]');
        $this->form_validation->set_rules('cpassword','Confirm Password','required|trim|matches[npassword]|min_length[6]');

        if($this->form_validation->run()== FALSE) {

            $data=array(
                'errors'=>validation_errors()
            );
            $this->session->set_flashdata($data);

//            $data=array(
//                'title'=>'ILM | Change Password',
//                'view'=>'authentication/change_password'
//            );
//
//            $this->load->view('masterLayouts/authentication', $data);

            redirect('authentication/change_password');

        }

        else{
            $sql = $this->db->select("*")->from("users")->where("email",$this->session->userdata('email'))->get();

            foreach ($sql->result() as $my_info) {

                $db_password = $my_info->password;
                $db_id = $my_info->id;

            }

            if(md5($this->input->post("opassword")) == $db_password){

                $fixed_pw = md5($this->input->post("npassword"));
                $update = $this->db->query("Update `users` SET `password`='$fixed_pw' WHERE `id`='$db_id'")or die(mysqli_error());

                $this->session->set_flashdata('msg', 'Password Updated Sucessfully!');

            }else {

                $this->session->set_flashdata('msg', 'Wrong Old Password!');
            }

            redirect(base_url().'authentication/change_password');
        }
    }


    public function change() {
        $sql = $this->db->select("*")->from("users")->where("email",$this->session->userdata('email'))->get();

        foreach ($sql->result() as $my_info) {

            $db_password = $my_info->password;
            $db_id = $my_info->id;

        }

        if(md5($this->input->post("opassword")) == $db_password){

            $fixed_pw = md5($this->input->post("npassword"));
            $update = $this->db->query("Update `users` SET `password`='$fixed_pw' WHERE `id`='$db_id'")or die(mysqli_error());

            $this->session->set_flashdata('msg', 'Password Updated Sucessfully!');
            return false;

        }else {

            $this->session->set_flashdata('msg', 'Wrong Old Password!');
        }

        redirect(base_url().'authentication/change_password');
    }

    

}