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
        $classesList = [];
        $classes = $this->db->get('classes')->result_array();

        foreach ($classes as $class ){
            $classesList[$class['id']] = $class['title'];
        }


        return $classesList;
    }

    public function getSections() {
        $sectionsList = [];
        $classes = $this->db->get('sections')->result_array();

        foreach ($classes as $class ){
            $sectionsList[$class['id']] = $class['title'];
        }


        return $sectionsList;
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

    public function getEditRegistrationData($id){

        $query = "SELECT e.*, e.id as enroll_id, pd.first_name as fName, pd.last_name as lName, fi.*, feei.*, pd.*, fami.* FROM enrollment e 
          LEFT JOIN family_information fi ON e.id=fi.enrollment_id
          LEFT JOIN fee_info feei ON e.id=feei.enrollment_id
          LEFT JOIN personal_details pd ON e.id=pd.enrollment_id
          LEFT JOIN family_information fami ON e.id=fami.enrollment_id
          WHERE e.id='$id'
";

        $res = $this->db->query($query)->result_array();

        return $res[0];
    }

    public function getPresentAddresses($enroll_id){
        return $this->db->where(['enrollment_id' => $enroll_id, 'address_type' => 0])->get('addresses')->result_array()[0];
    }

    public function getPermanentAddresses($enroll_id){
        return $this->db->where(['enrollment_id' => $enroll_id, 'address_type' => 1])->get('addresses')->result_array()[0];
    }

    public function getPreviousInstitutes($enroll_id){
        return $this->db->where(['enrollment_id' => $enroll_id])->get('previous_institution_details')->result_array();
    }

    public function update_enrollment($enrollment_data){

        $enroll_id = $enrollment_data['enrollment_id'];

        $this->db->where('id', $enroll_id);
        $this->db->update('enrollment', $enrollment_data['enrollment']);

        $this->db->where('enrollment_id', $enroll_id);
        $this->db->update('personal_details', $enrollment_data['personal_details']);

        $this->db->where('enrollment_id', $enroll_id);
        $this->db->delete('previous_institution_details');

        foreach ($enrollment_data['previous_institution_detail']['exam_type'] as $key => $value){

//            $rowId = $enrollment_data['previous_institution_detail']['PI_rowId'][$key];

            $previous_institution_detail = [
                'enrollment_id'           => $enroll_id,
                'exam_type'               => $enrollment_data['previous_institution_detail']['exam_type'][$key],
                'exam_year'               => $enrollment_data['previous_institution_detail']['exam_year'][$key],
                'p_roll_no'               => $enrollment_data['previous_institution_detail']['p_roll_no'][$key],
                'board_university'        => $enrollment_data['previous_institution_detail']['board_university'][$key],
                'obt_marks'               => $enrollment_data['previous_institution_detail']['obt_marks'][$key],
                'total_marks'             => $enrollment_data['previous_institution_detail']['total_marks'][$key],
                'grade'                   => $enrollment_data['previous_institution_detail']['grade'][$key],
                'subjects'                => $enrollment_data['previous_institution_detail']['subjects'][$key],
                'institute_name'          => $enrollment_data['previous_institution_detail']['institute_name'][$key]
            ];

            $this->db->insert('previous_institution_details', $previous_institution_detail);
        }

        foreach ($enrollment_data['address'] as $address){
            $address_type = 0;
            if($address['address_type'] == 1){
                $address_type = 1;
            }
            $this->db->where(['enrollment_id' => $enroll_id, 'address_type' => $address_type]);
            $this->db->update('addresses', $address);
        }

        $this->db->where('enrollment_id', $enroll_id);
        $this->db->update('family_information', $enrollment_data['family_information']);

        $this->db->where('enrollment_id', $enroll_id);
        $this->db->update('fee_info', $enrollment_data['fee_info']);

        return true;

    }
}


?>