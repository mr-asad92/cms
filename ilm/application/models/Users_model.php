<?php
/**
 * Created by PhpStorm.
 * User: Hafiz Ali Hamza
 * Date: 9/13/2018
 * Time: 5:30 PM
 */

class Users_model extends CI_Model
{
    public function getUsers()
    {
        //$q = $this->db->get('users');
        //return $q->result();

        $q = "SELECT e.*, us.first_name as user_fname, us.last_name as user_lname,
          usr.first_name as usr_firstName, usr.last_name as usr_lastName
          FROM users e
          LEFT JOIN users us
          on e.created_by = us.id
          LEFT JOIN users usr
          on e.modified_by = usr.id
        ";

        $res = $this->db->query($q)->result();

        return $res;

        //print_r($this->db->last_query()); exit();
    }

    public function getById($id)
    {
        $q = "SELECT e.*, us.first_name as user_fname, us.last_name as user_lname,
          usr.first_name as usr_firstName, usr.last_name as usr_lastName
          FROM users e
          LEFT JOIN users us
          on e.created_by = us.id
          LEFT JOIN users usr
          on e.modified_by = usr.id
          where e.id = $id
        ";

        $res = $this->db->query($q)->result();

        return $res;

        /*$query = $this->db->where('id',$id)
                ->get('users');

        return $query->result();*/

    }

    public function edit_user($id)
    {
        $query = $this->db->where('id',$id)
            ->get('users');

        return $query->row();

    }

    public function update_profile($data)
    {
        $query = $this->db->where('id',$data['id'])
                        ->update('users',$data);
        return $query;
    }


    public function update_status($user_id,$status)
    {
        $set_defaultTimeZone = date_default_timezone_set('Asia/Karachi');

        $this->db->where('id',$user_id);
        if ($status == 0)
        {
            $this->db->set('is_approved',1);
        }
        else
        {
            $this->db->set('is_approved', 0);
        }

        $this->db->set('modified_by', $this->session->userdata('user_id'));
        $this->db->set('modified_at', date('y-m-d h:i:s'));

        return $this->db->update('users');

    }
}