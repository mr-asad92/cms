<?php
	/**
	* 
	*/
	class Admin extends CI_Controller
	{
		protected $uid;
		public function __construct(){
			parent:: __construct();
			if(!$this->session->userdata('logged_in')){
				redirect('home_cont/show_login_error');
				}
				else{
					$this->uid=$this->session->userdata('user_id');
				}
			
		}

		public function common($view){
			
				$id=$this->session->userdata('user_id');
				$this->load->model('admin_model');
				
				$data=array(
					'profile'=>$this->admin_model->fetch_data($id),
					'view'=>$view
					);
				$this->load->view('admin_view',$data);
				
			
		}
		public function common_with_data($view,$data){
			
				$id=$this->session->userdata('user_id');
				$this->load->model('admin_model');
				$data['profile']=$this->admin_model->fetch_data($id);
				$data['view']=$view;
				$this->load->view('admin_view',$data);
				
			
		}
		
		public function index(){
			$this->common('users/user_profile');
		}
		

		public function change_pass(){
			$this->common('users/change_pass');
		}

		public function change_password(){
			$this->form_validation->set_rules('old_password', 'Old Password', 'trim|required');
			$this->form_validation->set_rules('new_password', 'New Password', 'trim|required');
			$this->form_validation->set_rules('c_password', 'Confirm Password', 'trim|required|matches[new_password]');
			if ($this->form_validation->run()==FALSE) {
				$data=array(
					'change_pass_errors'=>validation_errors()
					);
				$this->session->set_flashdata($data);
				redirect('admin/change_pass');
			}
			else{
				$form_data=array(
					'id' => $this->input->post('id'),
					'old_pass'=>$this->input->post('old_password'),
					'new_pass'=>$this->input->post('new_password'),
					'c_pass'=>$this->input->post('c_password')
					);
				$this->load->model('admin_model');
				$status=$this->admin_model->change_pass($this->input->post('id'),$this->input->post('old_password'),$this->input->post('new_password'),$this->input->post('c_password'));
				if ($status=="changed") {
					$msg['pass_update_msg']='<p class="text-success">Your password has been updated successfully.</p>';
				}
				else{
					$msg['pass_update_msg']='<p class="text-danger">There is some error while updating password.</p><p class="text-info">Error Info = '.$status.'</p>';

				}
				$this->session->set_flashdata($msg);
				redirect('admin/change_pass');
			}
		}

		public function todo_add(){
			$this->common('users/todo_add');
		}
		public function todo_add_task(){
			// $task_id=$this->input->post('task_id');
			// $task_descr=$this->input->post('task_descr');
			$this->form_validation->set_rules('task_title', 'Task Title', 'required|min_lenght[3]');
			$this->form_validation->set_rules('task_descr', 'Task Description', 'required|min_lenght[10]');
			if ($this->form_validation->run()==FALSE) {
				$data=array(
					'add_task_errors'=>validation_errors()
				);
				$this->session->set_flashdata($data);
				redirect('admin/todo_add');
			}
			else{
				//send this form data to mdoel to save in db
				$form_data=array(
					'user_id'=>$this->uid,
					'task_title'=>$this->input->post('task_title'),
					'task_descr'=>$this->input->post('task_descr')

					);
				$this->load->model('admin_model');
				$status=$this->admin_model->save_todo($form_data);
				if ($status=="added") {
					$data=array(
						'task_added'=>'<p class="text-success">To Do Task Added successfully</p>'
						);
					
				}
				else{
					$data=array(
						'task_added'=>'<p class="text-danger">There is some error, Please try again later.</p>'
						);
					
				}
				$this->session->set_flashdata($data);
					redirect('admin/todo_add');

			}
		}
		public function todo_list(){
			$this->load->model('admin_model');
			$list['todo_list']=$this->admin_model->get_task_list($this->uid);
			$this->common_with_data('users/todo_list',$list);
		}

		public function view_task($task_id){
			$this->load->model('admin_model');
			$data['task']=$this->admin_model->get_task($task_id, $this->uid);
			$this->common_with_data('users/view_task', $data);
		}
		public function edit_task_view($task_id){
			$this->load->model('admin_model');
			$data['task']=$this->admin_model->get_task($task_id, $this->uid);
			$this->common_with_data('users/edit_task', $data);
			// $form_data=array(
			// 	'task_title'=>$this->input->post('task_title'),
			// 	'task_descr'=>$this->input->post('task_descr')
			// 	);
			// $this->load->model('admin_model');
			// $data['task']=$this->admin_model->edit_task($form_data,$task_id, $this->uid);
		}

		public function edit_task($task_id){
			$form_data=array(
				'task_title'=>$this->input->post('task_title'),
				'task_descr'=>$this->input->post('task_descr')
				);
			$this->load->model('admin_model');
			$data['task']=$this->admin_model->edit_task($form_data,$task_id, $this->uid);
			// $this->common_with_data('users/edit_task_view', $data);
			if ($data['task']=="updated") {
				$this->session->set_flashdata('edit_msg', 'task has been updated');
			}
			else{
				$this->session->set_flashdata('edit_msg', 'task not updated');
			}
			redirect('admin/edit_task_view/'.$task_id);
			
		}

		public function delete_task($task_id){
			$this->load->model('admin_model');
			
			$status=$this->admin_model->delete_task($task_id, $this->uid);
			if ($status=="deleted") {
				$this->session->set_flashdata('del_msg','Task Deleted Successfully.');
				redirect('admin/todo_list');
				
			}
			else{
				$this->session->set_flashdata('del_msg','Task NOT Deleted.');
				redirect('admin/todo_list');
			}
		}

		public function logout(){
			$this->session->sess_destroy();
			redirect('home_cont');
		}
	}

?>