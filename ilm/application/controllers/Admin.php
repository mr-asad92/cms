<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller
{

    public function index() {

        $data = array(
            'title' => 'ILM | Admin',
            'view' => 'admin/home'
        );

        $data['submitUrl'] = base_url().'admin/enrollment_save';
        $data['enrollment_id'] = $this->admin_model->getEnrollmentId();
        $data['classes'] = $this->admin_model->getClasses();
        $data['sections'] = $this->admin_model->getSections();
        $data['studyMedium'] = ['1' => 'English', '2' => 'Urdu'];
        $data['gender'] = ['1' => 'Male', '2' => 'Female'];
        $data['religion'] = ['1' => 'Muslim', '2' => 'Non-Muslim'];
        $data['bloodGroup'] = ['1' => 'A+', '2' => 'A-', '3' => 'B+', '4' => 'B-', '5' => 'AB+', '6' => 'AB-', '7' => 'O+', '8' => 'O-'];
        $data['PreviousInstitutesExamType'] = $this->admin_model->getPreviousExamsTypes();
        ;
        $data['editRegistration'] = false;
        $data['enrollment_data'] = [];
        $data['presentAddresses'] = [];
        $data['permenantAddresses'] = [];

        $data['previousInstitutes'] = [];

        $this->load->view('masterLayouts/admin', $data);

    }

    public function enrollment_save(){


//        temporarily disabling validation. will do that in javascript


//        $this->form_validation->set_rules('enrollmentNo',      'Enrollment No','trim|required');
//        $this->form_validation->set_rules('enrollmentDate',     'Enrollment Date','trim|required');
//        $this->form_validation->set_rules('classId',           'Class','trim|required');
//        $this->form_validation->set_rules('sectionId',         'Section','trim|required');
//        $this->form_validation->set_rules('roll_no',         'roll_no','trim|required');
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

        if (!empty($_FILES['studentsPics']['name'])) {

            $config['upload_path'] = './studentsPics/';
            $config['allowed_types'] = 'jpeg|jpg|png';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('studentsPics')) {
                $res = array('error' => $this->upload->display_errors());
            } else {
                $res = $this->upload->data();
            }
        }


            $enrollment = [
                'enrollment_date'          => $this->input->post('enrollmentDate'),
                'class_id'                 => $this->input->post('classId'),
                'section_id'               => $this->input->post('sectionId'),
                'study_medium'             => $this->input->post('studyMedium'),
                'roll_no'                  => $this->input->post('roll_no'),
                'pic'                      => '',
                'created_by'               => $this->session->userdata['user_id'],
                'edited_by'               => 0,
            ];

            if (isset($res) && isset($res['file_name'])){
                $enrollment['pic'] = $res['file_name'];
            }

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

    public function editRegistration($regId){
        $data = array(
            'title' => 'ILM | Admin',
            'view' => 'admin/home'
        );

        $data['submitUrl'] = base_url().'admin/updateRegistration/'.$regId;
        $data['enrollment_id'] = $this->admin_model->getEnrollmentId();
        $data['classes'] = $this->admin_model->getClasses();
        $data['sections'] = $this->admin_model->getSections();
        $data['studyMedium'] = ['1' => 'English', '2' => 'Urdu'];
        $data['gender'] = ['1' => 'Male', '2' => 'Female'];
        $data['PreviousInstitutesExamType'] = ['1' => 'MatricOrEqualant', '2' => 'InterOrEqualant', '3' => 'GraduationOrEqualant', '4' => 'Others'];
        $data['religion'] = ['1' => 'Muslim', '2' => 'Non-Muslim'];
        $data['bloodGroup'] = ['1' => 'A+', '2' => 'A-', '3' => 'B+', '4' => 'B-', '5' => 'AB+', '6' => 'AB-', '7' => 'O+', '8' => 'O-'];
        $data['editRegistration'] = true;

        //get record from DB
        $data['enrollment_data'] = $this->admin_model->getEditRegistrationData($regId);

        $enroll_id = $data['enrollment_data']['enroll_id'];

        $data['presentAddresses'] = $this->admin_model->getPresentAddresses($enroll_id);
        $data['permenantAddresses'] = $this->admin_model->getPermanentAddresses($enroll_id);

        $data['previousInstitutes'] = $this->admin_model->getPreviousInstitutes($enroll_id);

        $this->load->view('masterLayouts/admin', $data);

    }

    public function updateRegistration($regId){



        $enrollment = [
            'class_id'                 => $this->input->post('classId'),
            'section_id'               => $this->input->post('sectionId'),
            'study_medium'             => $this->input->post('studyMedium'),
            'roll_no'                  => $this->input->post('roll_no'),
            'pic'                      => '',
            'edited_by'                => $this->session->userdata['user_id'],
            'updated_at'               => date("Y-m-d h:i:s")
        ];

        if (isset($res) && isset($res['file_name'])){
            $enrollment['pic'] = $res['file_name'];
        }

        $personal_details = [
            'first_name'               => $this->input->post('firstName'),
            'last_name'                => $this->input->post('lastName'),
            'gender'                   => $this->input->post('gender'),
            'dob'                      => $this->input->post('DOB'),
            'religion'                 => $this->input->post('religion'),
            'blood_group'              => $this->input->post('bloodGroup'),
            'caste'                    => $this->input->post('cast'),
        ];

//        die(print_r($this->input->post('PI_rowId')));
        $previous_institution_detail = [
            'id'                      => $this->input->post('PI_rowId'),
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
            'personal_details'            => $personal_details,
            'previous_institution_detail' => $previous_institution_detail,
            'address'                     => $address,
            'family_information'          => $family_information,
            'fee_info'                    => $fee_info,
            'enrollment_id'               => $regId
        ];

        $is_updated = $this->admin_model->update_enrollment($enrollment_data);

        if($is_updated){
            redirect(base_url().'admin/editRegistration/'.$regId);
        }
    }

    public function studentsList()
    {

        $data = array(
            'title' => 'ILM | Admin',
            'view' => 'admin/studentsList',
            'classes' => $this->admin_model->getClasses(),
            'studentsList' => $this->admin_model->getStudentsList()
        );


        $this->load->view('masterLayouts/admin',$data);
    }

    public function studentDetails($id = NULL)
    {
        if ($id)
        {
            $data = array(
                'title' => 'ILM | Admin',
                'view' => 'admin/studentDetails',
                'student_detail' => $this->admin_model->getStudentDetail($id),
                'feeInfo' => $this->admin_model->getFeeInfo($id)
            );
            $genderId = $data['student_detail']['gender'];

            $data['gender'] = $this->getGenderById($genderId);

            $enroll_id = $data['student_detail']['enroll_id'];

            $data['presentAddresses'] = $this->admin_model->getPresentAddresses($enroll_id);
            $data['permenantAddresses'] = $this->admin_model->getPermanentAddresses($enroll_id);

            $data['previousInstitutes'] = $this->admin_model->getPreviousInstitutes($enroll_id);

            $data['blood_group'] = ['1' => 'A+', '2' => 'A-', '3' => 'B+', '4' => 'B-', '5' => 'AB+', '6' => 'AB-',
             '7' => 'O+', '8' => 'O-'];

            //echo '<pre>';print_r($data['feeInfo']);exit();

            $this->load->view('masterLayouts/admin',$data);
        }

    }

    public function getGenderById($id)
    {
        if ($id == 1)
        {
            return 'Male';
        }
        else
        {
            return 'Female';
        }
    }

    public function searchStudent()
    {
        $searchData = array(
            'enrollment_no' => $this->input->post('EnrollmentNo'),
            'roll_no' => $this->input->post('rollNo'),
            'student_name' => $this->input->post('Name'),
            'guardian_name' => $this->input->post('guardianName'),
            'mobile_no' => $this->input->post('guardianMobile'),
            'class_id' => $this->input->post('classId')
        );

        $data = array(
            'title' => 'ILM | Admin',
            'view' => 'admin/studentsList',
            'classes' => $this->admin_model->getClasses(),
            'studentsList' => $this->admin_model->searchStudent($searchData)
        );

        //echo '<pre>';print_r($data['studentsList']);exit();

        //$this->studentsList();



        $this->load->view('masterLayouts/admin',$data);
    }

    public function makeInstallments($enrollment_id){

        //check if installments are already made then redirect to edit installments

        $installment_exists = $this->admin_model->installments_exists($enrollment_id);

        if($installment_exists){
            redirect(base_url().'admin/editInstallments/'.$enrollment_id);
        }

        $classId = $this->admin_model->getCurrentClassId($enrollment_id);
        $sectionId = $this->admin_model->getCurrentSectionId($enrollment_id);

        $data = array(
            'title' => 'ILM | Admin',
            'view' => 'admin/makeInstallments',
            'student_detail' => $this->admin_model->getStudentInfoForInstallments($enrollment_id),
            'to_date' => date("Y-m-d", strtotime("+30 days")),
        );

        $data['student_detail']['enrollment_number']=$enrollment_id;

//        debug($this->admin_model->getTotalPaidFee($enrollment_id, $classId, $sectionId));
//        die();
        $total_paidFee = $this->admin_model->getTotalPaidFee($enrollment_id, $classId, $sectionId);

//        debug($data['student_detail']['grand_total']);
        $data['pending_amount'] = number_format($data['student_detail']['grand_total'], 2, '.', '') - number_format($total_paidFee['total_paid_fee'], 2, '.', '');

        $this->load->view('masterLayouts/admin',$data);
    }

    public function editInstallments($enrollment_id){

        $installment_exists = $this->admin_model->installments_exists($enrollment_id);

        if(!$installment_exists){
            redirect(base_url().'admin/makeInstallments/'.$enrollment_id);
        }

        $classId = $this->admin_model->getCurrentClassId($enrollment_id);
        $sectionId = $this->admin_model->getCurrentSectionId($enrollment_id);

        $data = array(
            'title' => 'ILM | Admin',
            'view' => 'admin/editInstallments',
            'student_detail' => $this->admin_model->getStudentInfoForInstallments($enrollment_id),
            'initial_amount' => $this->admin_model->getInitialAmount($enrollment_id),
            'installments'   => $this->admin_model->getInstallments($enrollment_id),
            'to_date' => date("Y-m-d", strtotime("+30 days")),
        );

        $data['student_detail']['enrollment_number']=$enrollment_id;

        $total_paidFee = $this->admin_model->getTotalPaidFee($enrollment_id, $classId, $sectionId);

//        debug($data['student_detail']['grand_total']);
        $data['pending_amount'] = number_format($data['student_detail']['grand_total'], 2, '.', '') - number_format($total_paidFee['total_paid_fee'], 2, '.', '');

        $this->load->view('masterLayouts/admin',$data);

    }

    public function saveInstallments(){

        $enrollment_id = $this->input->post('enrollmentNo');

        $classId = $this->admin_model->getCurrentClassId($enrollment_id);
        $sectionId = $this->admin_model->getCurrentSectionId($enrollment_id);

        $first_installment = [
            'enrollment_id'            => $enrollment_id,
            'classId'                  => $classId,
            'sectionId'                => $sectionId,
            'installment_no'           => 1,
            'fee_amount'               => $this->input->post('initialAmount'),
            'installment_date'         => date("Y-m-d"),
            'status'                   => 1,
            'created_by'               => $this->session->userdata['user_id'],
            'edited_by'                => 0,
        ];

        $installments = [
            'enrollment_id'            => $enrollment_id,
            'classId'                  => $classId,
            'sectionId'                => $sectionId,
            'installment_no'           => $this->input->post('installmentNo'),
            'fee_amount'               => $this->input->post('installmentAmount'),
            'installment_date'         => array_map("formatDateForDb", $this->input->post('installmentDate')),
            'created_by'               => $this->session->userdata['user_id'],
        ];

//        debug($this->input->post('installmentNo'));
        $data = [
            'first_installment'   => $first_installment,
            'installments'        => $installments,
        ];

        $is_saved = $this->admin_model->save_installments($data);

        if($is_saved){
            $this->session->set_flashdata('msg', 'Installments Saved!');
            redirect(base_url().'admin/makeInstallments/'.$installments['enrollment_id']);
        }


    }

    public function updateInstallments(){

        $enrollment_id = $this->input->post('enrollmentNo');

        $classId = $this->admin_model->getCurrentClassId($enrollment_id);
        $sectionId = $this->admin_model->getCurrentSectionId($enrollment_id);

        $first_installment = [
            'enrollment_id'            => $enrollment_id,
            'classId'                  => $classId,
            'sectionId'                => $sectionId,
            'installment_no'           => 1,
            'fee_amount'               => $this->input->post('initialAmount'),
            'installment_date'         => date("Y-m-d"),
            'status'                   => 1,
            'created_by'               => $this->session->userdata['user_id'],
            'edited_by'                => 0,
        ];

        $installments = [
            'enrollment_id'            => $enrollment_id,
            'classId'                  => $classId,
            'sectionId'                => $sectionId,
            'installment_no'           => $this->input->post('installmentNo'),
            'fee_amount'               => $this->input->post('installmentAmount'),
            'installment_date'         => array_map("formatDateForDb", $this->input->post('installmentDate')),
            'created_by'               => $this->session->userdata['user_id'],
        ];

        $data = [
            'first_installment'   => $first_installment,
            'installments'        => $installments,
        ];

        $is_saved = $this->admin_model->update_installments($data);

        if($is_saved){
            $this->session->set_flashdata('msg', 'Installments Saved!');
            redirect(base_url().'admin/makeInstallments/'.$installments['enrollment_id']);
        }

    }

    public function printStudentDetails($id = NULL){
        if ($id)
        {
            $data = array(
                'title' => 'ILM | Admin',
                'view' => 'admin/printStudentDetails',
                'student_detail' => $this->admin_model->getStudentDetail($id),
                'feeInfo' => $this->admin_model->getFeeInfo($id)
            );
            $genderId = $data['student_detail']['gender'];

            $data['gender'] = $this->getGenderById($genderId);

            $enroll_id = $data['student_detail']['enroll_id'];

            $data['presentAddresses'] = $this->admin_model->getPresentAddresses($enroll_id);
            $data['permenantAddresses'] = $this->admin_model->getPermanentAddresses($enroll_id);

            $data['previousInstitutes'] = $this->admin_model->getPreviousInstitutes($enroll_id);

            //echo '<pre>';print_r($data['feeInfo']);exit();

            $this->load->view('masterLayouts/admin',$data);
        }

    }
}
?>