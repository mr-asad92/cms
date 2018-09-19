<?php
/**
 * Created by PhpStorm.
 * User: Hafiz Ali Hamza
 * Date: 8/15/2018
 * Time: 5:50 PM
 */

class Programs_model extends CI_Model
{
    public function getPrograms()
    {
        $q = $this->db->get('programs');
        return $q->result();
    }

    public function add_program($data)
    {
        return $this->db->insert('programs',$data);
    }

    public function getById($id)
    {
        $q = $this->db->where('id', $id)
            ->get('programs');
        return $q->row();
    }


    public function update_program($data)
    {
        $id = $data['id'];
        return $this->db->where('id', $id)
            ->update('programs',$data);

    }

    public function delete($id)
    {
        return $this->db->where('id',$id)
            ->delete('programs');

    }
}
