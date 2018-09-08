<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller
{

    public function index() {

        $data = array(
            'title' => 'ILM | Admin',
            'view' => 'admin/home'
        );

        $data['enrollment_id'] = $this->admin_model->getEnrollmentId();
        $data['classes'] = $this->admin_model->getClasses();
        $data['sections'] = $this->admin_model->getSections();

        $this->load->view('masterLayouts/admin', $data);

    }

    public function enrollment_save(){


//        temporarily disabling validation. will do that in javascript


//        $this->form_validation->set_rules('enrollmentNo',      'Enrollment No','trim|required');
//        $this->form_validation->set_rules('enrollmentDate',     'Enrollment Date','trim|required');
//        $this->form_validation->set_rules('classId',           'Class','trim|required');
//        $this->form_validation->set_rules('sectionId',         'Section','trim|required');
//        $this->form_validation->set_rules('studyMedium',       'Study Medium','trim|required');
//        $this->form_validation->set_rules('firstName',         'First Name','trim|required');
//        $this->form_validation->set_rules('lastName',          'Last Name','trim|required');
//        $this->form_validation->set_rules('gender',            'Gender','trim|required');
//        $this->form_validation->set_rules('DOB',               'Date Of Birth','trim|required');
//        $this->form_validation->set_rules('religion',          'Religion','trim|required');
//        $this->form_validation->set_rules('presentAddress',    'Present Address','trim|required');
//        $this->form_validation->set_rules('presentCity',       'Present City','trim|required');
//        $this->form_validation->set_rules('presentDistrict',   'Present District','trim|required');
//        $this->form_validation->set_rules('guardian',          'Guardian','trim|required');
//        $this->form_validation->set_rules('presentcntry',      'Present Country','trim|required');
//        $this->form_validation->set_rules('studentGuardianMob', 'Guardian Mobile #','trim|required');
//        $this->form_validation->set_rules('studentGuardianCNIC', 'Guardian CNIC','trim|required');
//        $this->form_validation->set_rules('paidFee',             'Paid Fee','trim|required');
//        $this->form_validation->set_rules('fatherFirstName',   'Father First Name','trim|required');
//        $this->form_validation->set_rules('fatherLastName',     'Father Last Name','trim|required');
//        $this->form_validation->set_rules('motherFirstName',   'Mother First Name','trim|required');
//        $this->form_validation->set_rules('motherLastName',    'Mother Last Name','trim|required');


//        if ($this->form_validation->run()==FALSE) {
//            $data=array(
//                'errors'=>validation_errors()
//            );
//            $this->session->set_flashdata($data);
//
////            redirect(base_url().'Admin');
//            $data = array(
//                'title' => 'ILM | Admin',
//                'view' => 'admin/home'
//            );
//
//            $data['enrollment_id'] = $this->admin_model->getEnrollmentId();
//            $data['classes'] = $this->admin_model->getClasses();
//            $data['sections'] = $this->admin_model->getSections();
//
//            $this->load->view('masterLayouts/admin', $data);
//
//        }
//        else{
            //save Data in DB.

        // profile pic is not saving yet, I will do that with update enrollment part
        
            $enrollment = [
                'enrollment_date'          => $this->input->post('enrollmentDate'),
                'class_id'                 => $this->input->post('classId'),
                'section_id'               => $this->input->post('sectionId'),
                'study_medium'             => $this->input->post('studyMedium'),
                'roll_no'                  => $this->input->post('roll_no')
            ];

            $personal_details = [
                'first_name'               => $this->input->post('firstName'),
                'last_name'                => $this->input->post('lastName'),
                'gender'                   => $this->input->post('gender'),
                'dob'                      => $this->input->post('DOB'),
                'religion'                 => $this->input->post('religion'),
                'blood_group'              => $this->input->post('bloodGroup'),
                'caste'                    => $this->input->post('cast'),
            ];

            $previous_institution_detail = [
                'exam_type'               => $this->input->post('PreviousInstitutesExamType'),
                'exam_year'               => $this->input->post('previousInstitueYear'),
                'p_roll_no'               => $this->input->post('previousInstitueRollNo'),
                'board_university'        => $this->input->post('previousInstitueBoardUni'),
                'obt_marks'               => $this->input->post('previousInstitueObtainedMarks'),
                'total_marks'             => $this->input->post('previousInstitueTotalMarks'),
                'grade'                   => $this->input->post('previousInstitueGrade'),
                'subjects'                => $this->input->post('previousInstitueSubjects'),
                'institute_name'          => $this->input->post('previousInstitueName'),
            ];

            $address = [
              'present_address'   => [
                  'address'               => $this->input->post('presentAddress'),
                  'city'                  => $this->input->post('presentCity'),
                  'district'              => $this->input->post('presentDistrict'),
                  'country'               => $this->input->post('presentCountry'),
                  'address_type'          => 0,
              ],
              'permanent_address' => [
                  'address'               => $this->input->post('permenentAddress'),
                  'city'                  => $this->input->post('permenentCity'),
                  'district'              => $this->input->post('permenentDistrict'),
                  'country'               => $this->input->post('permenentCountry'),
                  'address_type'          => 1,
              ]
            ];

            $family_information = [
                'guardian'                => $this->input->post('guardian'),
                'first_name'              => $this->input->post('fatherFirstName'),
                'last_name'               => $this->input->post('fatherLastName'),
                'profession'              => $this->input->post('fatherProfession'),
                'designation'             => $this->input->post('fatherDesignation'),
                'organization_name'       => $this->input->post('fatherOrgName'),
                'office_address'          => $this->input->post('fatherOfficeAddress'),
                'telephone'               => $this->input->post('fatherTelephone'),
                'mobile_no'          => $this->input->post('fatherMobile'),
                'email'                   => $this->input->post('fatherEmail'),
            ];

            $fee_info = [
                'adm_fee'                => $this->input->post('admission_fee'),
                'fee_package'            => $this->input->post('feePkg'),
                'tuition_fee'            => $this->input->post('tuitionFee'),
                'boardUniReg_fee'        => $this->input->post('boardUniRegFee'),
                'library_fee'            => $this->input->post('libFee'),
                'miscellaneous_fee'      => $this->input->post('miscFee'),
                'others'                 => $this->input->post('otherFee'),
                'total_fee'              => $this->input->post('totalFee'),
                'grand_total'            => $this->input->post('grandTotal'),
            ];


            $enrollment_data = [
                'enrollment'                  => $enrollment,
                'personal_details'             => $personal_details,
                'previous_institution_detail' => $previous_institution_detail,
                'address'                     => $address,
                'family_information'          => $family_information,
                'fee_info'                    => $fee_info,
            ];

            $is_saved = $this->admin_model->save_enrollment($enrollment_data);

            if($is_saved){
                redirect(base_url().'admin');
            }
//        }

    }


}
?>