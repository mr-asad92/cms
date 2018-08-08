<?php

	/**
	* 
	*/
	class Home_cont extends CI_Controller
	{
		public function index(){
			$data=array(
				'title'=>'Login | Register',
				'view'=>'users/login_view'
				);
			$this->load->view('layouts/main_layout',$data);
		}

		public function register_view(){
			$data=array(
				'title'=>'Login | Register',
				'view'=>'users/user_registration'
				);
			$this->load->view('layouts/main_layout',$data);
		}

		public function login(){
			$this->form_validation->set_rules('username', 'Username','trim|required|min_length[3]');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]');
			if ($this->form_validation->run()==FALSE) {
				$data=array(
					'errors'=>validation_errors()
					);
				$this->session->set_flashdata($data);
				redirect('home_cont');
			}
			else{
				$username=$this->input->post('username');
				$password=$this->input->post('password');
				$this->load->model('new_model');
				$user_id=$this->new_model->show_profile($username,$password);
				if ($user_id!=FALSE) {
					// $this->load->view('users/profile',$profile_data);
					$data=array(
						'user_id'=>$user_id,
						'username'=>$username,
						'logged_in'=>TRUE
						);
					$this->session->set_userdata($data);
					// $this->session->set_flashdata($data);
					redirect('admin/index');
					// redirect('home_cont');
				}
				else{
					$data=array(
						'errors'=>'<p class="text-success" style="color:#fff;">User Does Not Exists.</p>'
						);
					$this->session->set_flashdata($data);
					redirect('home_cont');
					
				}
				
			}
		}


		public function login_gua(){
			$username=$_GET['username'];
			$this->load->model('new_model');
			$if_exists=$this->new_model->validate_username($username);
			if ($if_exists) {
				$user_id=$this->new_model->fetch_id($username);
				$user_imgs=$this->new_model->fetch_images($user_id);
				$user_images=$this->new_model->user_imgs_array($user_imgs);
				$imgLib=directory_map('./imgLib/');
				
				$merge=$this->new_model->merge($user_images,$imgLib);
				$data=array(
				'title'=>'Login | Register',
				'view'=>'users/select_images',
				'username'=>$username,
				'user_images'=>$merge
				);
				
				$this->load->view('layouts/main_layout',$data);
			}
			else{
				$data=array(
						'errors'=>'<p class="text-success" style="color:#fff;">User Does Not Exists.</p>'
						);
					$this->session->set_flashdata($data);
					redirect('home_cont');
			}
		}

		public function login_verify(){
			$this->load->model('new_model');
			$username=$this->input->post('username');
			$user_id=$this->new_model->fetch_id($username);
			// $img_id=1;
			$str="";
			foreach ($this->input->post('selectedImgs') as $key => $value) {
				// $this->db->where([
				// 	'user_id'=>$user_id,
				// 	'img_id'=>$img_id,
				// 	'img_path'=>$value
				// 	]);
				// $num=$this->db->get('uploaded_images')->num_rows();

				// $img_id++;
				$str.=$value;
			}
			$pass=md5($str);
				$this->db->where([
					'id'=>$user_id,
					'password'=>$pass
					]);
				$num=$this->db->get('users')->num_rows();
				if ($num>0) {
					$data=array(
						'user_id'=>$user_id,
						'username'=>$username,
						'logged_in'=>TRUE
						);
					$this->session->set_userdata($data);
					redirect('admin/index');
				}
				else{
					$data=array(
						'errors'=>'<p class="text-success" style="color:#fff;">User Does Not Exists.</p>'
						);
					$this->session->set_flashdata($data);
					redirect('home_cont');
				}
		}

		public function register(){
			$this->form_validation->set_rules('username', 'Username','trim|required|min_length[3]');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
			// $this->form_validation->set_rules('c_password', 'Confirm Password', 'trim|required|min_length[3]|matches[password]');
			$this->form_validation->set_rules('email', 'Email','trim|required|min_length[12]');
			
			if ($this->form_validation->run()==FALSE) {
				$data=array(
					'errors'=>validation_errors()
					);
				$this->session->set_flashdata($data);
				redirect('home_cont/register_view');
			}
			else{
				$reg_data=array(
					'username'=>$this->input->post('username'),
					'password'=>$this->input->post('password'),
					'email'=>$this->input->post('email'),
					'gender'=>$this->input->post('gender')
					
					);
				// 'country'=>$this->input->post('country'),
				$this->load->model('new_model');
				$data=$this->new_model->register($reg_data);
				
				if ($data['status']==TRUE) {
					$msg=array(
						'msg'=>'<p class="text-default" style="color:#fff;">User Registered Successfully, Please login to procceed.</p>'
						);
					redirect('home_cont/upload_images/'.$data['user_id']);
				}
				 else if ($data['status']=="user_exists") {
					$msg=array(
						'msg'=>'<p class="text-default" style="color:#fff;">User already exists, please choose another username.</p>'
						);
				}
			
			
				else{
					$msg=array(
						'msg'=>'<p class="text-danger">There is some error, Please try again later.</p>'
						);
				}
				$this->session->set_flashdata($msg);
				redirect('home_cont/index');
			}
		}

		public function upload_images($user_id){
			$data=array(
				'title'=>'Upload Images',
				'view'=>'users/upload_images_view',
				'user_id'=>$user_id
				);
			$this->load->view('layouts/main_layout',$data);
			}

		
		

		public function upload_to_db($user_id){
				$this->load->library('upload');
				$config['upload_path'] = './user_uploads/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['overwrite'] = TRUE;

                
                $this->load->model('new_model');
                $username=$this->new_model->fetch_username($user_id);
                $img_id=1;
                $str="";
                for ($i=1; $i <= 6; $i++) { 
                	
                	
                	$uploadFieldName="image_".$i;
                	
                	
				if (isset($_FILES[$uploadFieldName]) && is_uploaded_file($_FILES[$uploadFieldName]['tmp_name'])) {
					
					$tmp_name=explode(".", $_FILES[$uploadFieldName]['name']);
					$ext=end($tmp_name);
				
					//that means file is selected
					//rename that file before upload
					$new_name = $username."_".$img_id.".".$ext;
					$config['file_name']=$new_name; 
					
					$this->upload->initialize($config);
					if ( ! (($this->upload->do_upload($uploadFieldName)) ))
                {
                        
                        $data=array(
							'title'=>'Upload Images',
							'view'=>'users/upload_images_view',
							'error' => $this->upload->display_errors()
							);
						$this->load->view('layouts/main_layout',$data);
						$i=6; //false the condition to stop the loop
                       
                }
                else
                {

						//load a model here to save images paths in databse
						$image_path=base_url()."user_uploads/".$new_name;
						$this->load->model('new_model');
						$this->new_model->upload_to_db($image_path,$img_id,$user_id);
						// echo $new_name."<br>";
						$str.=$image_path;
						$img_id++;
                	}// end else


				}
				
			    
			}
				$pass=md5($str);
				$this->load->model('new_model');
				$status=$this->new_model->pass($pass, $user_id);
				if ($status) {
					$data=$this->session->set_flashdata('register_msg', '<p class="text-success" style="color:#fff;">You have been registered Successfully.</p>');
					redirect('home_cont/index',$data);
				}
				else{
					$data=$this->session->set_flashdata('register_msg', '<p class="text-success" style="color:#fff;">There is some error</p>');
					redirect('home_cont/index',$data);
				}
				
               
                
		}

		public function show_login_error(){
			$msg=array(
					'login_error_msg'=>'<p class="text-danger">You must be logged in to access you account.</p>'
				);
			$this->session->set_flashdata($msg);
			redirect('home_cont/index');
		}

	}

?>