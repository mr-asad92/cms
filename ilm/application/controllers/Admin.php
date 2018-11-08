<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller
{
    var $permissions = array();
    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('logged_in')){
            redirect(base_url().'authentication/logout');
        }

        $method = $this->router->fetch_method();
        if(!empty($method ) && $method != 'buildProfileFirst') {
            if (!$this->admin_model->isProfileExists($this->session->userdata('email'))) {
                redirect(base_url() . 'admin/buildProfileFirst');
            }
        }

        if (($this->session->userdata('role_id') != 0)) { // if user is not admin then check for permissions

            if ((!empty($method) && $method != 'invalid_permissions')) {
                //  load libs
                $this->load->library('permission');

                // set groupID
                $groupID = ($this->session->userdata('role_id')) ? $this->session->userdata('role_id') : 0;

                $this->permissions = $this->permission->get_user_permissions($groupID);
                $current_page = strtolower($this->router->fetch_class()).'/'.$method;
                if (!in_array($current_page, $this->permissions)) {
                    redirect(base_url() . 'admin/invalid_permissions');
                }
            }

        }

        $this->load->model('Vouchers_model');
        $this->load->model('Accounts_model');


    }

    public function manage_permissions(){
        $permissionList = $this->admin_model->getPermissionsList();
        $userTypes = $this->admin_model->getUserTypes();

        if(isset($_POST['userType'])){
            $userType = $this->input->post('userType');
            $permissions = $this->input->post('permissions');

            $this->admin_model->update_permissions($userType, $permissions);
            $this->session->set_flashdata('msg', '<p class="alert alert-success">Permissions has been saved Successfully</p>');
        }
        $data = array(
            'title' => 'ILM | Manage Permissions',
            'view' => 'admin/managePermissions',
            'permissionsList' => $permissionList,
            'userTypes' => $userTypes,
        );

        $this->load->view('masterLayouts/admin', $data);

    }

    public function buildProfileFirst(){

        if ($this->admin_model->isProfileExists($this->session->userdata('email'))) {
            redirect(base_url() . 'admin');
        }

        $data = array(
            'title' => 'ILM | Build Profile',
            'view' => 'admin/buildProfileFirst'
        );

        $this->load->view('masterLayouts/admin', $data);

    }

    public function invalid_permissions(){

        $data = array(
            'title' => 'ILM | Not Allowed',
            'view' => 'admin/invalid_permissions'
        );

        $this->load->view('masterLayouts/admin', $data);
    }

    public function index() {

        $data = array(
            'title' => 'ILM | Admin',
            'view' => 'admin/home'
        );

        $data['submitUrl'] = base_url().'admin/enrollment_save';
        $data['enrollment_id'] = $this->admin_model->getEnrollmentId();
        $data['classes'] = $this->admin_model->getClasses(true);
        $data['programs'] = $this->admin_model->getPrograms(true);
        $data['sections'] = $this->admin_model->getSections(true);
        $data['studyMedium'] = ['1' => 'English', '2' => 'Urdu'];
        $data['gender'] = ['1' => 'Male', '2' => 'Female'];
        $data['religion'] = ['1' => 'Muslim', '2' => 'Non-Muslim'];
        $data['bloodGroup'] = ['0' => '--- Select ---','1' => 'A+', '2' => 'A-', '3' => 'B+', '4' => 'B-', '5' => 'AB+', '6' => 'AB-', '7' => 'O+', '8' => 'O-'];
        $data['PreviousInstitutesExamType'] = $this->admin_model->getPreviousExamsTypes();
        ;
        $data['editRegistration'] = false;
        $data['enrollment_data'] = [];
        $data['presentAddresses'] = [];
        $data['permenantAddresses'] = [];

        $data['previousInstitutes'] = [];

        $data['hasFeeEditPermissions'] = true;


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

        $res['file_name']='';

        if (!empty($_FILES['studentsPics']['name'])) {

            $new_name = uniqid().'_'.$_FILES["studentsPics"]['name'];
            $config['file_name'] = $new_name;
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
                'program_id'                 => $this->input->post('programId'),
                'class_id'                 => $this->input->post('classId'),
                'section_id'               => $this->input->post('sectionId'),
                'study_medium'             => $this->input->post('studyMedium'),
                'roll_no'                  => $this->input->post('roll_no'),
                'pic'                      => $res['file_name'],
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
                'bform_or_cnic_no'         => $this->input->post('bform_or_cnic'),
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
                'father_name'             => $this->input->post('fathername'),
                'father_cnic'             => $this->input->post('father_cnic'),
                'guardian'                => $this->input->post('guardian'),
                'first_name'              => $this->input->post('fatherFirstName'),
                'last_name'               => $this->input->post('fatherLastName'),
                'profession'              => $this->input->post('fatherProfession'),
                'designation'             => $this->input->post('fatherDesignation'),
                'organization_name'       => $this->input->post('fatherOrgName'),
                'office_address'          => $this->input->post('fatherOfficeAddress'),
                'telephone'               => $this->input->post('fatherTelephone'),
                'mobile_no'               => $this->input->post('fatherMobile'),
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
                'discount'               => $this->input->post('discount'),
                'grand_total'            => $this->input->post('grandTotal'),
            ];


            $enrollment_data = [
                'enrollment'                  => $enrollment,
                'personal_details'            => $personal_details,
                'previous_institution_detail' => $previous_institution_detail,
                'address'                     => $address,
                'family_information'          => $family_information,
                'fee_info'                    => $fee_info,
            ];

            $is_saved = $this->admin_model->save_enrollment($enrollment_data);

            if($is_saved){
                $this->session->set_flashdata('msg','<p class="alert alert-success">Student record has been added Successfully</p>');
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
        $data['classes'] = $this->admin_model->getClasses(true);
        $data['sections'] = $this->admin_model->getSections(true);
        $data['programs'] = $this->admin_model->getPrograms(true);
        $data['studyMedium'] = ['1' => 'English', '2' => 'Urdu'];
        $data['gender'] = ['1' => 'Male', '2' => 'Female'];
        $data['PreviousInstitutesExamType'] = ['1' => 'MatricOrEqualant', '2' => 'InterOrEqualant', '3' => 'GraduationOrEqualant', '4' => 'Others'];
        $data['religion'] = ['1' => 'Muslim', '2' => 'Non-Muslim'];
        $data['bloodGroup'] = ['0' => '--- Select ---','1' => 'A+', '2' => 'A-', '3' => 'B+', '4' => 'B-', '5' => 'AB+', '6' => 'AB-', '7' => 'O+', '8' => 'O-'];
        $data['editRegistration'] = true;

        //get record from DB
        $data['enrollment_data'] = $this->admin_model->getEditRegistrationData($regId);

        $enroll_id = $data['enrollment_data']['enroll_id'];

        $data['presentAddresses'] = $this->admin_model->getPresentAddresses($enroll_id);
        $data['permenantAddresses'] = $this->admin_model->getPermanentAddresses($enroll_id);

        $data['previousInstitutes'] = $this->admin_model->getPreviousInstitutes($enroll_id);
        $data['hasFeeEditPermissions'] = $this->admin_model->hasFeeEditPermissions($this->session->userdata['user_id']);

        $this->load->view('masterLayouts/admin', $data);
        

    }

    public function updateRegistration($regId){

        if (!empty($_FILES['studentsPics']['name'])) {

            $new_name = uniqid().'_'.$_FILES["studentsPics"]['name'];
            $config['file_name'] = $new_name;
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
            'program_id'               => $this->input->post('programId'),
            'class_id'                 => $this->input->post('classId'),
            'section_id'               => $this->input->post('sectionId'),
            'study_medium'             => $this->input->post('studyMedium'),
            'roll_no'                  => $this->input->post('roll_no'),
            'edited_by'                => $this->session->userdata['user_id'],
            'updated_at'               => date("Y-m-d h:i:s")
        ];

        if(isset($res['file_name'])){
            $enrollment['pic'] = $res['file_name'];
        }

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
            'bform_or_cnic_no'         => $this->input->post('bform_or_cnic'),
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
            'father_name'             => $this->input->post('fathername'),
            'father_cnic'             => $this->input->post('father_cnic'),
            'guardian'                => $this->input->post('guardian'),
            'first_name'              => $this->input->post('fatherFirstName'),
            'last_name'               => $this->input->post('fatherLastName'),
            'profession'              => $this->input->post('fatherProfession'),
            'designation'             => $this->input->post('fatherDesignation'),
            'organization_name'       => $this->input->post('fatherOrgName'),
            'office_address'          => $this->input->post('fatherOfficeAddress'),
            'telephone'               => $this->input->post('fatherTelephone'),
            'mobile_no'               => $this->input->post('fatherMobile'),
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
            'discount'               => $this->input->post('discount'),
            'grand_total'            => $this->input->post('grandTotal'),
        ];

        $fee_pkg_history = [
            'fee_pkg_id'             => $this->admin_model->getActiveFeePkgId($regId),
            'modified_by'            => $this->session->userdata['user_id'],
        ];


        $enrollment_data = [
            'enrollment'                  => $enrollment,
            'personal_details'            => $personal_details,
            'previous_institution_detail' => $previous_institution_detail,
            'address'                     => $address,
            'family_information'          => $family_information,
            'fee_info'                    => $fee_info,
            'fee_pkg_history'             => $fee_pkg_history,
            'enrollment_id'               => $regId
        ];

        $is_updated = $this->admin_model->update_enrollment($enrollment_data);

        if($is_updated){
            $this->session->set_flashdata('msg','<p class="alert alert-success">Student record has been updated Successfully</p>');
            redirect(base_url().'admin/editRegistration/'.$regId);
        }
    }

    public function studentsList()
    {

        $data = array(
            'title' => 'ILM | Admin',
            'view' => 'admin/studentsList',
            'classes' => $this->admin_model->getClasses(true),
            'studentsList' => $this->admin_model->getStudentsList()
        );

        //echo '<pre>'; print_r($data); exit();


        $this->load->view('masterLayouts/admin',$data);
    }

    public function feeRecord($enrollment_id)
    {
        $data = array(
            'title' => 'ILM | Admin',
            //'view' => 'vouchers/fee_pkg_history',
            'fee_package' => $this->Vouchers_model->getFeePackage($enrollment_id),
            'paid_fee' => $this->Vouchers_model->getPaidFee($enrollment_id),
        );

        $data['unpaid_fee'] = $this->Vouchers_model->getUnPaidFee($enrollment_id);
        //echo '<pre>'; print_r($data['paid_fee']); exit();

        $view = $this->load->view('vouchers/fee_pkg_history',$data,TRUE);
        return $view;
    }

    public function studentInfo($id = NULL)
    {
        if ($id)
        {
            $data = array(
                'student_detail' => $this->admin_model->getStudentDetail($id),
                'suspendReason' => $this->admin_model->getSuspendReason($id),
                'leaveReason' => $this->admin_model->getLeaveReason($id)
            );

            $student_info = $this->load->view('admin/student_info',$data,TRUE);

            return $student_info;
        }

    }

    public function studentDetails($id = NULL)
    {
        if ($id)
        {
            $data = array(
                'title' => 'ILM | Admin',
                'view' => 'admin/studentDetails',
                'student_detail' => $this->admin_model->getStudentDetail($id),
                'addresses' => $this->admin_model->getStudentAddresses($id),
                'student_info_view' => $this->studentInfo($id),
                'fee_pkg_history_view' => $this->feeRecord($id),
                'studentSuspendHistory' => $this->admin_model->getSuspendHistory($id),
                'studentLeaveHistory' => $this->admin_model->getLeaveHistory($id),
                'suspendReason' => $this->admin_model->getSuspendReason($id),
                'leaveReason' => $this->admin_model->getLeaveReason($id)
            );
            $genderId = $data['student_detail']['gender'];

            $data['gender'] = $this->getGenderById($genderId);

            $enroll_id = $data['student_detail']['enroll_id'];

            $data['presentAddresses'] = $this->admin_model->getPresentAddresses($enroll_id);
            $data['permenantAddresses'] = $this->admin_model->getPermanentAddresses($enroll_id);

            $data['previousInstitutes'] = $this->admin_model->getPreviousInstitutes($enroll_id);

            $data['blood_group'] = array('1' => 'A+', '2' => 'A-', '3' => 'B+', '4' => 'B-', '5' => 'AB+', '6' => 'AB-',
             '7' => 'O+', '8' => 'O-');

            //echo '<pre>';print_r($data['student_detail']);exit();

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
            'classes' => $this->admin_model->getClasses(true),
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

        $programId = $this->admin_model->getCurrentProgramId($enrollment_id);
        $classId = $this->admin_model->getCurrentClassId($enrollment_id);
        $sectionId = $this->admin_model->getCurrentSectionId($enrollment_id);

        $first_installment = [
            'enrollment_id'            => $enrollment_id,
            'program_id'               => $programId,
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
            'program_id'               => $programId,
            'classId'                  => $classId,
            'sectionId'                => $sectionId,
            'installment_no'           => $this->input->post('installmentNo'),
            'fee_amount'               => $this->input->post('installmentAmount'),
            'paidStatus'                   => $this->input->post('paidStatus'),
            'installment_date'         => array_map("formatDateForDb", $this->input->post('installmentDate')),
            'created_by'               => $this->session->userdata['user_id'],
        ];

//        debug($this->input->post('installmentNo'));
        $data = [
            'first_installment'   => $first_installment,
            'installments'        => $installments,
        ];

        $installment_id = $this->admin_model->save_installments($data);

//        debug($installment_id);
        // add transaction in transactions table against cash and fee accounts

        $installment = $this->getInstallmenetData($installment_id, true, true);

        $installment = json_decode($installment, true);

        $enroll_id = $enrollment_id;

        $info = $this->admin_model->getStudentDetail($enroll_id);
        $student_name = ucfirst($info['fName'])." ".ucfirst($info['lName']);
        $class_name = $info['class_name'];

        $transaction_title = 'Fee Recevied From: '. $student_name.', Class: '.$class_name;
        $transaction_descr = $transaction_title;
        $amount = $installment['total_amount'];

        $credit_account = 16;
        $debit_account = 17;

        $data = [
            'title' => $transaction_title,
            'description' => $transaction_descr,
            'amount' => $amount,
            'debit_account' => $debit_account,
            'credit_account' => $credit_account,
            'created_by' => $this->session->userdata('user_id'),
        ];

        $this->Vouchers_model->save_voucher($data);


        if(true){
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
            'paidStatus'               => $this->input->post('paidStatus'),
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
        if ($id) {
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

    public function fee_payments(){

        $data = array(
            'title' => 'ILM | Admin',
            'view' => 'admin/fee_payments',
        );

        if(isset($_POST)){
            $search = [];

            $search['enrollmentNo'] = $this->input->post('EnrollmentNo');
            $search['dateFrom'] = $this->input->post('DateFrom');
            $search['dateTo'] = $this->input->post('DateTo');
            $search['classId'] = $this->input->post('classId');
            $search['sectionId'] = $this->input->post('sectionId');
            $search['status'] = $this->input->post('Status');

            $data['installments'] = $this->admin_model->searchFeePayments($search);


        }
        else{
            $data['installments'] = $this->admin_model->getUnPaidInstallments();
        }

        $data['classes'] = $this->admin_model->getClasses(true);
        $data['sections'] = $this->admin_model->getSections(true);

        $this->load->view('masterLayouts/admin',$data);
    }

    public function getInstallmenetData($id, $getPaidInstallment = false,$return = false){
        $data = $this->admin_model->getInstallmentData($id, $getPaidInstallment); //second parameter was true before.
        $data['calculated_fine'] = 0;
        if($data['installment_date'] < date('Y-m-d')){
            $data['calculated_fine'] = $this->admin_model->getFine($data['classId'],$data['sectionId'],$data['installment_date']);
        }
//        $data['total_amount'] = $data['calculated_fine'] + $data['fee_amount'];
        $data['total_amount'] = $data['fee_amount'];

        if($return){
            return json_encode($data);
        }
        else{
            echo json_encode($data);
        }
    }

    public function getPaidInstallmenetData($id, $return = false){
        $data = $this->admin_model->getInstallmentData($id, true); //second parameter was true before.
        $data['calculated_fine'] = 0;
        if($data['installment_date'] < date('Y-m-d')){
            $data['calculated_fine'] = $this->admin_model->getFine($data['classId'],$data['sectionId'],$data['installment_date']);
        }
//        $data['total_amount'] = $data['calculated_fine'] + $data['fee_amount'];
        $data['total_amount'] = $data['fee_amount'];

        if($return){
            return json_encode($data);
        }
        else{
            echo json_encode($data);
        }
    }

    public function submitWaveOff($id){
        $this->admin_model->submitWaveOff($id);
        echo true;
    }

    public function payInstallment($id, $fine = 0){

        // add transaction in transactions table against cash and fee accounts

        $installment = $this->getInstallmenetData($id, true);

        $installment = json_decode($installment, true);

        $enroll_id = $installment['id'];

        $info = $this->admin_model->getStudentDetail($enroll_id);
        $student_name = ucfirst($info['fName'])." ".ucfirst($info['lName']);
        $class_name = $info['class_name'];

        $transaction_title = 'Fee Recevied From: '. $student_name.', Class: '.$class_name;
        $transaction_descr = $transaction_title;
        $amount = $installment['total_amount'];

        $credit_account = 16;
        $debit_account = 17;

        $data = [
            'title' => $transaction_title,
            'description' => $transaction_descr,
            'amount' => $amount,
            'debit_account' => $debit_account,
            'credit_account' => $credit_account,
            'created_by' => $this->session->userdata('user_id'),
        ];

        $voucher_id = $this->Vouchers_model->save_voucher($data, true);

        // now check if installment has any fine with it?

        $fine_transaction_id = false;
        if ($fine > 0){
            $transaction_title = 'Fine Recevied From: '. $student_name.', Class: '.$class_name;
            $transaction_descr = $transaction_title;
            $credit_account = $this->Accounts_model->getAccountId('Fine');;
            $debit_account = 17;
            $data = [
                'title' => $transaction_title,
                'description' => $transaction_descr,
                'amount' => $fine,
                'debit_account' => $debit_account,
                'credit_account' => $credit_account,
                'created_by' => $this->session->userdata('user_id'),
            ];

            $fine_transaction_id = $this->Vouchers_model->save_voucher($data, true);
        }


        // make record of transaction id (it will be needed for unpay scenario)

        $record = ['installment_id'=>$id,'transaction_id'=>$voucher_id];
        $this->Vouchers_model->save_paid_installment_voucher_id($record);


        if($fine_transaction_id != false){
            $record = ['installment_id'=>$id,'transaction_id'=>$fine_transaction_id];
            $this->Vouchers_model->save_paid_installment_voucher_id($record);
        }

        // now make fee status as paid`
        $this->admin_model->payInstallment($id);

        echo true;
    }

    public function unpayInstallment($id){

        $transaction_ids = $this->Vouchers_model->getTransactionIds($id);

        $this->Vouchers_model->deleteTransactions($transaction_ids);

        $this->Vouchers_model->deleteTransactionsRecord($transaction_ids);

        $this->Vouchers_model->unpayInstallment($id);

        return $transaction_ids;
    }

    public function makeStudentActive($enrollment_id)
    {
        $result = $this->admin_model->activeStudent($enrollment_id);
        if ($result)
        {
            $this->session->set_flashdata('msg','<p class="alert alert-success">Student has been marked as Active Successfully</p>');
        }
        else
        {
            $this->session->set_flashdata('msg','<p class="alert alert-danger">An unknown error occurred.</p>');
        }

        return redirect('admin/studentDetails/'.$enrollment_id);

    }

    public function makeStudentSuspend()
    {
        //set default time zone

        date_default_timezone_set('Asia/Karachi');

        $data = array(
            'enrollment_id' => $this->input->post('enrollment_id'),
            'reason' => $this->input->post('reason'),
            'created_at' => date('y-m-d'),
            'created_by' => $this->session->userdata('user_id'),
            'status_id' => 2
        );

        //echo '<pre>';print_r($data);exit();

        $result = $this->admin_model->suspendStudent($data);
        if ($result)
        {
            $this->session->set_flashdata('msg','<p class="alert alert-success">Student has been marked as Suspend Successfully</p>');
        }
        else
        {
            $this->session->set_flashdata('msg','<p class="alert alert-danger">An unknown error occurred.</p>');
        }

        return redirect('admin/studentDetails/'.$data['enrollment_id']);

    }

    public function makeStudentLeave()
    {
        //set default time zone

        date_default_timezone_set('Asia/Karachi');

        $data = array(
            'enrollment_id' => $this->input->post('enrollment_id'),
            'reason' => $this->input->post('reason'),
            'created_at' => date('y-m-d'),
            'created_by' => $this->session->userdata('user_id'),
            'status_id' => 3
        );

        //echo '<pre>';print_r($data);exit();

        $result = $this->admin_model->leaveStudent($data);
        if ($result)
        {
            $this->session->set_flashdata('msg','<p class="alert alert-success">Student has been marked as Leave Successfully</p>');
        }
        else
        {
            $this->session->set_flashdata('msg','<p class="alert alert-danger">An unknown error occurred.</p>');
        }

        return redirect('admin/studentDetails/'.$data['enrollment_id']);

    }

    public function searchFeePayments(){

        $data = [];

        $data['enrollmentNo'] = $this->input->post('EnrollmentNo');
        $data['dateFrom'] = $this->input->post('DateFrom');
        $data['dateTo'] = $this->input->post('DateTo');
        $data['classId'] = $this->input->post('classId');
        $data['sectionId'] = $this->input->post('sectionId');
        $data['status'] = $this->input->post('Status');

        $this->admin_model->searchFeePayments($data);

    }

    public function fee_history(){
        $data = array(
            'title' => 'ILM | Admin',
            'view' => 'admin/fee_change_history',
            'fee_history' => $this->admin_model->getFeeHistory()
        );

//        debug($data['fee_history']);

        $this->load->view('masterLayouts/admin',$data);
    }

    public function dashboard(){
        $from_date = date('Y-m-d');
        $to_date = date('Y-m-d');

        $today_date = date('Y-m-d');
        $firstDayOfThisMonth = date("Y-m").'-01';
        $lastDayThisMonth = date("Y-m-t");


        $openingBalanceDate = $this->Accounts_model->getOpeningBalanceDate(date('Y-m-d', strtotime($from_date.' -1 day')));

        $cash_account = $this->Accounts_model->getAccountId('Cash');
        $expense_account = $this->Accounts_model->getAccountId('Expense');
        $fee_account = $this->Accounts_model->getAccountId('Fee');


        $data = array(
            'title' => 'ILM | Admin',
            'view' => 'admin/dashboard',
            'opening_balance' => $this->Accounts_model->getOpeningBalance($cash_account, $openingBalanceDate),
            'grand_total' => $this->Accounts_model->getGrandTotal($from_date, $to_date, $cash_account, $expense_account),
            'current_month_income' => $this->Accounts_model->getCurrentMonthIncome($firstDayOfThisMonth, $lastDayThisMonth, $fee_account),
            'current_month_expense' => $this->Accounts_model->getCurrentMonthExpense($firstDayOfThisMonth, $lastDayThisMonth, $expense_account),
            'current_month_expected_fee' => $this->Accounts_model->getCurrentMonthExpectedFee($firstDayOfThisMonth, $lastDayThisMonth),
            'total_fee_received' => $this->Accounts_model->getTotalReceivedFee(),
            'total_fee_receiveable' => $this->Accounts_model->getTotalReceiveableFee(),
            'total_active_students' => $this->admin_model->getActiveStudentsCount(),
            'total_inactive_students' => $this->admin_model->getInActiveOrLeaveStudentsCount(),
        );

//        debug($data['total_fee_received']);
        if ($data['grand_total'] == 0){
            $data['grand_total'] = $data['opening_balance'];
        }

        $this->load->view('masterLayouts/admin',$data);
    }

    public function add_examination_types(){
        $data = array(
            'title' => 'ILM | Admin',
            'view' => 'admin/add_institution_details',
        );

        $data['examTypeList'] = $this->admin_model->getExamTypesList();
        $data['formSubmitMethod'] = 'save_exam_type';
        $data['submitButtonTitle'] = 'Add';
        $data['examType'] = ['title'=>'', 'id'=>''];

        $this->load->view('masterLayouts/admin',$data);
    }

    public function edit_examination_types($id){
        $data = array(
            'title' => 'ILM | Admin',
            'view' => 'admin/add_institution_details',
        );

        $data['examTypeList'] = $this->admin_model->getExamTypesList();
        $data['formSubmitMethod'] = 'update_exam_type';
        $data['submitButtonTitle'] = 'Update';
        $data['examType'] = $this->admin_model->getExamTypeData($id);

        $this->load->view('masterLayouts/admin',$data);
    }

    public function save_exam_type(){
        $exam_type = [
            'title' => $this->input->post('title'),
        ];

        $this->admin_model->save_exam_type($exam_type);

        $this->session->set_flashdata('msg', '<p class="alert alert-success">Exam type has been added successfully!</p>');
        redirect(base_url().'admin/add_examination_types');
    }

    public function update_exam_type(){
        $exam_type = [
            'id'   => $this->input->post('examTypeId'),
            'title'=> $this->input->post('title'),
        ];

        $this->admin_model->update_exam_type($exam_type);

        $this->session->set_flashdata('msg', '<p class="alert alert-success">Exam type has been updated successfully!</p>');
        redirect(base_url().'admin/add_examination_types');
    }

    public function delete_examination_types($id){
        $this->admin_model->delete_examination_types($id);

        $this->session->set_flashdata('msg', '<p class="alert alert-success">Exam type has been deleted successfully!</p>');
        redirect(base_url().'admin/add_examination_types');
    }

    public function add_fines(){
        $data = array(
            'title' => 'ILM | Admin',
            'view' => 'admin/add_fines',
        );

        $data['classes'] = $this->admin_model->getClasses(true);
        $data['sections'] = $this->admin_model->getSections(true);

        $data['finesList'] = $this->admin_model->getFinesList();
        $data['formSubmitMethod'] = 'save_fine';
        $data['submitButtonTitle'] = 'Add';
        $data['finesData'] = [
            'sectionId' => '',
            'classId' => '',
            'fine' => '',
        ];

        $this->load->view('masterLayouts/admin',$data);
    }

    public function edit_fines($id){
        $data = array(
            'title' => 'ILM | Admin',
            'view' => 'admin/add_fines',
        );

        $data['classes'] = $this->admin_model->getClasses(true);
        $data['sections'] = $this->admin_model->getSections(true);

        $data['finesList'] = $this->admin_model->getFinesList();
        $data['finesData'] = $this->admin_model->getFinesData($id);
        $data['formSubmitMethod'] = 'update_fine';
        $data['submitButtonTitle'] = 'Update';

        $this->load->view('masterLayouts/admin',$data);
    }

    public function save_fine(){
        $fine = [
            'classId'                   => $this->input->post('classId'),
            'sectionId'                 => $this->input->post('sectionId'),
            'fine'                      => $this->input->post('fine'),
        ];

        $this->admin_model->save_fine($fine);

        $this->session->set_flashdata('msg', '<p class="alert alert-success">Fine has been added successfully!</p>');
        redirect(base_url().'admin/add_fines');
    }

    public function update_fine(){
        $fine = [
            'classId'                   => $this->input->post('classId'),
            'sectionId'                 => $this->input->post('sectionId'),
            'fine'                      => $this->input->post('fine'),
            'fineId'                      => $this->input->post('fineId'),
        ];

        $this->admin_model->update_fine($fine);

        $this->session->set_flashdata('msg', '<p class="alert alert-success">Fine has been Updated successfully!</p>');
        redirect(base_url().'admin/add_fines');
    }



    public function add_section(){
        $data = array(
            'title' => 'ILM | Admin',
            'view' => 'admin/add_section',
        );

        $data['classes'] = $this->admin_model->getClasses(true);

        $data['sectionData'] = $this->admin_model->getSectionsList();
        $data['formSubmitMethod'] = 'save_section';
        $data['submitButtonTitle'] = 'Add';
        $data['section'] = [
            'class_id' => '',
            'title' => '',
        ];

        $this->load->view('masterLayouts/admin',$data);
    }

    public function edit_section($id){
        $data = array(
            'title' => 'ILM | Admin',
            'view' => 'admin/add_section',
        );

        $data['classes'] = $this->admin_model->getClasses(true);
        $data['sectionData'] = $this->admin_model->getSectionsList();

        $data['section'] = $this->admin_model->getSectionsData($id);


        $data['formSubmitMethod'] = 'update_section';
        $data['submitButtonTitle'] = 'Update';

        $this->load->view('masterLayouts/admin',$data);
    }

    public function save_section(){
        $section = [
            'class_id'                   => $this->input->post('classId'),
            'title'                      => $this->input->post('title'),
        ];

        $this->admin_model->save_section($section);

        $this->session->set_flashdata('msg', '<p class="alert alert-success">Section has been added successfully!</p>');
        redirect(base_url().'admin/add_section');
    }

    public function update_section(){
        $section = [
            'classId'                   => $this->input->post('classId'),
            'title'                      => $this->input->post('title'),
            'sectionId'                      => $this->input->post('sectionId'),
        ];

        $this->admin_model->update_section($section);

        $this->session->set_flashdata('msg', '<p class="alert alert-success">Section has been Updated successfully!</p>');
        redirect(base_url().'admin/add_section');
    }

    public function delete_section($id){
        $this->db->where('id',$id)->delete('sections');
        $this->session->set_flashdata('msg', '<p class="alert alert-success">Section has been Delete successfully!</p>');
        redirect(base_url().'admin/add_section');
    }

}
?>