<?php

class Authentication_Model extends CI_Model
{
    public function register($data) {

        $email=$data['email'];

        $this->db->where('email',$email);
        $num=$this->db->get('users')->num_rows();
        if ($num>0) {
            return "user_exists";
        }
        else{
            $q=$this->db->insert('users',$data);
            if ($q) {

                return TRUE;
            }
            else{
                return FALSE;
            }
        }


    }

    public function verifyLogin($email,$password){
        $this->db->where(
            array(
                'email'=>$email,
                'password'=>$password
            )
        );
        $num=$this->db->get('users')->num_rows();
        if ($num>0) {
            $this->db->where(
                array(
                    'email'=>$email,
                    'password'=>$password
                )
            );
            $return = $this->db->get('users')->row(0)->id;
        }
        else{
            $return = FALSE;
        }
        return $return;
    }

}


?>