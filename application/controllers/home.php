<?php

/**
* 
*/
class Home extends CI_Controller
{
	
	public function index(){
		$data['content_view']='home_view';
		$data['title']='Main View';
		$this->load->view('layouts/main',$data);

	}
	public function login(){
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('password','Password', 'trim|required|min_length[6]');

		if ($this->form_validation->run()==FALSE) {
			
			$data=array(
				'errors'=>validation_errors(),
				'error_class'=>'has-error'
				);
			$this->session->set_flashdata($data);
			redirect('home');
		}
	}


	public function registration(){
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('email','Email', 'trim|required|min_length[15]');
		$this->form_validation->set_rules('gender', 'Gender', 'required');
		$this->form_validation->set_rules('country', 'Country', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data=array(
				'errors'=>validation_errors(),
				'error_class'=>'has-error'
				);
			$this->session->set_flashdata($data);
			redirect('home');
		}



	}
}

?>