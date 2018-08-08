<?php


	class Admin_model extends CI_Model
	{
		public function fetch_data($id){
			$this->db->where([
					'id'=>$id
				]);
			$result=$this->db->get('users');
			if ($result->num_rows() > 0) {
				$p=$result->result();
				return $p;
			}
			else{
				return FALSE;
			}
		}


		public function change_pass($id,$old_pass,$new_pass,$c_pass){
			$this->db->where(['id'=>$id]);
			$old_p=$this->db->get('users')->row(0)->password;
			if ($old_p==$old_pass) {
				//update
				$arr=array(
					'password'=>$new_pass
					);
				$this->db->where(['id'=>$id]);
				$q=$this->db->update('users',$arr);
				if ($q) {
					return "changed";
				}
				else{
					return "not changed";
				}
			}
			else{
				return "old password incorrect";
			}
		}

		public function save_todo($form_data){
			$q=$this->db->insert('to_do_tasks',$form_data);
			if ($q) {
				return "added";
			}
			else{
				return "not_added";
			}
		}

		public function get_task_list($uid){
			$this->db->where('user_id',$uid);
			$q=$this->db->get('to_do_tasks');
			if ($q && $q->num_rows>0) {
				return $q->result();
			}
			else{
				return "No Tasks.";
			}
		}

		public function get_task($task_id, $uid){
			
			$this->db->where(['id'=>$task_id,'user_id'=>$uid]);
			$q=$this->db->get('to_do_tasks');
			if ($q->num_rows()>0) {
				
					return $q->row();
				
			}
			else{
				
				return FALSE;
			}
			

		}

		public function edit_task($form_data,$task_id, $uid){
			$this->db->where([
				'id'=>$task_id,
				'user_id'=>$uid
				]);
			$status=$this->db->update('to_do_tasks', $form_data);
			if ($status) {
				return "updated";
			}
			else{
				return "not_updated";
			}
		}

		public function delete_task($task_id,$uid){
			$this->db->where([
				'id'=>$task_id,
				'user_id'=>$uid
				]);
			$status=$this->db->delete('to_do_tasks');
			if ($status) {
				return "deleted";
			}
			else{
				return "not_deleted";
			}
		}
	}
?>