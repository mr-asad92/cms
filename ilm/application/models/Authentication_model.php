<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
                'password'=>$password,
                'is_approved' => 1
            )
        );
        $num=$this->db->get('users')->num_rows();
        if ($num>0) {
            $this->db->where(
                array(
                    'email'=>$email,
                    'password'=>$password,
                    'is_approved' => 1
                )
            );
            $data = $this->db->get('users')->row(0);
            $return['user_id'] = $data->id;
            $return['role_id'] = $data->role_id;
            $return['full_name'] = $data->first_name.' '. $data->last_name;
            $return['user_dp'] = $data->image_url;
            $return['status'] = TRUE;
        }
        else{
            $return['status'] = FALSE;
        }
        return $return;
    }

    public function forgotPassword($email){

        $this->db->select('email');
        $this->db->from('users');
        $this->db->where('email', $email);
        $query=$this->db->get();
        return $query->row_array();

    }

    public function sendpassword($data){
        $email = $data['email'];
        $query1=$this->db->query("SELECT *  from users where email = '".$email."' ");
        $row=$query1->result_array();
        if ($query1->num_rows()>0) {

            $passwordplain  = uniqid();
            $newpass['password'] = md5($passwordplain);
            $this->db->where('email', $email);
            $this->db->update('users', $newpass);
            $mail_message='Dear '.ucfirst($row[0]['first_name']).','. "\r\n";
            $mail_message.='Thanks for contacting regarding to forgot password,<br> Your <b>Password</b> is <b>'.$passwordplain.'</b>'."\r\n";
            $mail_message.='<br>Please login with this password and update your password from your account.';
            $mail_message.='<br>Thanks & Regards';
            $mail_message.='<br>ILM College.';

            date_default_timezone_set('Asia/Karachi');

            require FCPATH.'assets/libs/PHPMailer/src/Exception.php';
            require FCPATH.'assets/libs/PHPMailer/src/PHPMailer.php';
            require FCPATH.'assets/libs/PHPMailer/src/SMTP.php';

            try {
                /*
                $mail = new PHPMailer;
                $mail->isSMTP();
                $mail->SMTPSecure = "ssl";
                $mail->Debugoutput = 'html';
                $mail->Host = "srv41.hosterpk.com";
                $mail->Port = 465;
                $mail->SMTPAuth = true;
                $mail->Username = "ilmcollege@ilm.aimgetsolution.com";
                $mail->Password = "ilmCollege123";
                $mail->setFrom('ilmcollege@ilm.aimgetsolution.com', 'ILM College');
                $mail->IsHTML(true);
                $mail->addAddress($email);
                $mail->Subject = 'ILM | Your new password is here!';
                $mail->Body = $mail_message;
                $mail->AltBody = $mail_message;
                $mail->send();
                */


                $mail = new PHPMailer;
                $mail->isSMTP();
                $mail->SMTPSecure = "tls";
                $mail->Debugoutput = 'html';
                $mail->Host = "smtp.gmail.com";
                $mail->Port = 587;
                $mail->SMTPAuth = true;
                $mail->Username = "ilm.college.info@gmail.com";
                $mail->Password = "ilmclg123";
                $mail->setFrom('ilm.college.info@gmail.com', 'ILM College');
                $mail->IsHTML(true);
                $mail->addAddress($email);
                $mail->Subject = 'ILM | Your new password is here!';
                $mail->Body = $mail_message;
                $mail->AltBody = $mail_message;
                $mail->send();
                $this->session->set_flashdata('msg','Password sent to your email!'.$mail->ErrorInfo);

            }
            catch (Exception $e) {
                $this->session->set_flashdata('msg','Failed to send password, please try again!\n\n'. $mail->ErrorInfo);
//                echo $mail->ErrorInfo; //Pretty error messages from PHPMailer
            }

//            if (!$mail->send()) {
//                $this->session->set_flashdata('msg','Failed to send password, please try again!');
//            }
//            else {
//                $this->session->set_flashdata('msg','Password sent to your email!');
//            }
            redirect(base_url().'authentication');
        }
        else {
            $this->session->set_flashdata('msg','Email not found try again!');
            redirect(base_url().'authentication');
        }

    }

    public function getPass($email){
        return $this->db->select('password')->from('users')->where('email', $email)->get()->result_array()[0]['password'];
    }

}


?>