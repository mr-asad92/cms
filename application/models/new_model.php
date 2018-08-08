<?php
	
	class New_model extends CI_Model
	{
		public function show_profile($username, $password){
			$this->db->where([
					'username'=>$username,
					'password'=>$password
					]);
				$result=$this->db->get('users');
				if ($result->num_rows() > 0) {
					$q=$result->row(0)->id;
					return $q;
					// $profile_data=array();
					// $this->session->set_flashdata($profile_data);
					
					// redirect('home_cont');
				}
				else{
					return FALSE;
				}
		}

		public function register($data){
			$username=$data['username'];
			$password=$data['password'];
			$this->db->where('username',$username);
			$num=$this->db->get('users')->num_rows();
			if ($num>0) {
				return "user_exists";
			}
			else{
				$q=$this->db->insert('users',$data);
				if ($q) {
					$this->db->where(['username'=>$username,'password'=>$password]);
					$id=$this->db->get('users')->row(0)->id;
					$data=array(
						'status'=>TRUE,
						'user_id'=>$id
						);
					return $data;
				}
				else{
					return FALSE;
				}
			}
		}

		public function pass($pass,$user_id){
			
			$this->db->set('password',$pass);
			$this->db->where('id',$user_id);
			$status=$this->db->update('users');
			if ($status) {
				return true;
			}
			else{
				return false;
			}
		}

		public function fetch_username($user_id){
			$this->db->where('id',$user_id);
			return $this->db->get('users')->row(0)->username;

		}
		public function fetch_id($username){
			$this->db->where('username',$username);
			return $this->db->get('users')->row(0)->id;

		}
		public function fetch_images($user_id){
			$this->db->where('user_id',$user_id);
			$q=$this->db->get('uploaded_images');
			return $q->result_array();
		}
		public function validate_username($username){
			$this->db->where('username',$username);
			$num=$this->db->get('users')->num_rows;
			if ($num>0) {
				return true;
			}
			else{
				return false;
			}
		}
		public function user_imgs_array($array){
			
			foreach ($array as $key => $value) {
				$arr[]=$value['img_path'];
			}
			return $arr;
		}

		public function merge($user_imgs,$imgLib){
			$num_rows=count($user_imgs);
			$img_Lib=array();
			//load user images into an array
			for ($xx=0; $xx < $num_rows; $xx++) { 
				$img_Lib[$xx]=$user_imgs[$xx];
			}
			
			
			$images=$imgLib;
			$counter="30";
			

			for($x = $num_rows; $x<$counter;$x++){
				$m = rand(2, sizeof($images)-1);
				if (array_key_exists($m,$images)) {
					
					
					$src=base_url()."imgLib/".$images[$m];
					$img_Lib[$x] = $src;
					
					unset($images[$m]);
				}
				else{
					$counter++;
				}
			}
			// filter array from empty indexes and create final array to store addreses of images
					$finalImgs=array();
					//counter var
					$c="30";
					$finalImgsIndex=0;

					for ($d=0; $d < $c; $d++) { 
							
							if (array_key_exists($d,$img_Lib)) {
							$finalImgs[$finalImgsIndex] = $img_Lib[$d];
							$finalImgsIndex++;
							unset($img_Lib[$d]);
							
						}		
						else{
							$c++;
						}
						
					}

					// randomize the final images


						$loopCounter=30;
						$finalImages=[];
						$t=0;
						for ($b=0; $b < $loopCounter ; $b++) {
							$u=rand(0,30);
							if (array_key_exists($u, $finalImgs)) {
								$finalImages[$t]=$finalImgs[$u];
								unset($finalImgs[$u]);
								$t++;
							}
							else{
								$loopCounter++;
							}
						}

			return $finalImages;
		}

		public function upload_to_db($img_path, $img_id, $user_id){
			$arr=array(
				'user_id'=>$user_id,
				'img_id'=>$img_id,
				'img_path'=>$img_path
				);
			$this->db->where(['user_id'=>$user_id, 'img_id'=>$img_id]);
			$num=$this->db->get('uploaded_images')->num_rows;
			if ($num == 0) {
				
				$status=$this->db->insert('uploaded_images',$arr);
				if ($status) {
					return true;
				}
				else{
					return false;
				}
			}
			else{
				$this->db->where(['user_id'=>$user_id, 'img_id'=>$img_id]);
				$status=$this->db->update('uploaded_images',$arr);
				if ($status) {
					return true;
				}
				else{
					return false;
				}
			}
			
		}


	}

?>