<?php
/**
 * Created by PhpStorm.
 * User: Hafiz Ali Hamza
 * Date: 8/17/2018
 * Time: 5:09 PM
 */

class Classes_model extends CI_Model
{
    public function getClasses()
    {
        $q = $this->db->select('classes.id, programs.title as progTitle,classes.title as classTitle')
            ->from('programs')
            ->join('classes','classes.program_id = programs.id')
            ->get();

        return $q->result();
    }

    public function add_class($data)
    {
        //print_r($data);exit();
        return $this->db->insert('classes',$data);
    }

    public function getById($id)
    {
        $q = $this->db->where('id',$id)
            ->get('classes');
        return $q->row();
    }


    public function update_class($data)
    {
        $id = $data['id'];
        return $this->db->where('id',$id)
            ->update('classes',$data);
    }

    /*public function classByProgram($programs)
    {
        echo '<pre>';
        echo print_r($programs);
        exit();
        $id = $programs['id'];
        return $this->db->where('program_id',$id)
                ->get('classes',$programs);
    }*/

    public function delete($id)
    {
        return $this->db->where('id', $id)
            ->delete('classes');
    }
}
