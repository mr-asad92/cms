<?php

class Admin_Model extends CI_Model
{
    public function getEnrollmentId() {
        $enrollment_id = 1;
        $row = $this->db->query('SELECT MAX(id) AS maxid FROM enrollment')->row();

        if ($row->maxid != null) {
            $enrollment_id = $row->maxid + 1;
        }

        return $enrollment_id;
    }

    public function getClasses() {
        $classesList = "";
        $classes = $this->db->get('classes')->result_array();

        foreach ($classes as $class ){
            $classesList .= '<option value="'.$class['id'].'">'.$class['title'].'</option>';
        }


        return $classesList;
    }

    public function getSections() {
        $classesList = "";
        $classes = $this->db->get('sections')->result_array();

        foreach ($classes as $class ){
            $classesList .= '<option value="'.$class['id'].'">'.$class['title'].'</option>';
        }


        return $classesList;
    }

    public function save_enrollment($enrollment_data){

        $this->db->insert('enrollment', $enrollment_data['enrollment']);
        $enrollment_id = $this->db->insert_id();

        $enrollment_data['personal_details']['enrollment_id'] = $enrollment_id;
        $this->db->insert('personal_details', $enrollment_data['personal_details']);

        foreach ($enrollment_data['previous_institution_detail']['exam_type'] as $key => $value){

            $previous_institution_detail = [
                'exam_type'               => $enrollment_data['previous_institution_detail']['exam_type'][$key],
                'exam_year'               => $enrollment_data['previous_institution_detail']['exam_year'][$key],
                'p_roll_no'               => $enrollment_data['previous_institution_detail']['p_roll_no'][$key],
                'board_university'        => $enrollment_data['previous_institution_detail']['board_university'][$key],
                'obt_marks'               => $enrollment_data['previous_institution_detail']['obt_marks'][$key],
                'total_marks'             => $enrollment_data['previous_institution_detail']['total_marks'][$key],
                'grade'                   => $enrollment_data['previous_institution_detail']['grade'][$key],
                'subjects'                => $enrollment_data['previous_institution_detail']['subjects'][$key],
                'institute_name'          => $enrollment_data['previous_institution_detail']['institute_name'][$key],
                'enrollment_id'           => $enrollment_id
            ];

            $this->db->insert('previous_institution_details', $previous_institution_detail);
        }

        foreach ($enrollment_data['address'] as $address){
            $address['enrollment_id'] = $enrollment_id;
            $this->db->insert('addresses', $address);
        }

        $enrollment_data['family_information']['enrollment_id'] = $enrollment_id;
        $this->db->insert('family_information', $enrollment_data['family_information']);

        $enrollment_data['fee_info']['enrollment_id'] = $enrollment_id;
        $this->db->insert('fee_info', $enrollment_data['fee_info']);

        return true;

    }

}


?>