<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Teacher extends CI_Controller { 

    function __construct() {
        parent::__construct();
        		$this->load->database();                                //Load Databse Class
                $this->load->library('session');					    //Load library for session
               // $this->load->model('vacancy_model');

    }

     /*teacher dashboard code to redirect to teacher page if successfull login** */
     function dashboard() {
        if ($this->session->userdata('teacher_login') != 1) redirect(base_url(), 'refresh');
       	$page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('Teacher Dashboard');
        $this->load->view('backend/index', $page_data);
    }
	/******************* / teacher dashboard code to redirect to teacher page if successfull login** */

    function manage_profile($param1 = null, $param2 = null, $param3 = null){
        if ($this->session->userdata('teacher_login') != 1) redirect(base_url(), 'refresh');
        if ($param1 == 'update') {
    
    
            $data['name']   =   $this->input->post('name');
            $data['email']  =   $this->input->post('email');
    
            $this->db->where('teacher_id', $this->session->userdata('teacher_id'));
            $this->db->update('teacher', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $this->session->userdata('teacher_id') . '.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('Info Updated'));
            redirect(base_url() . 'teacher/manage_profile', 'refresh');
           
        }
    
        if ($param1 == 'change_password') {
            $current_password = sha1($this->input->post('current_password'));
            $new_password = sha1($this->input->post('new_password'));
            $confirm_new_password = sha1($this->input->post('confirm_new_password'));
        
            // Obtén la contraseña actual del usuario desde la base de datos
            $teacher_id = $this->session->userdata('teacher_id');
            $current_password_db = $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->row('password');
        
            if ($current_password == $current_password_db && $new_password == $confirm_new_password) {
                // Las contraseñas coinciden, puedes cambiar la contraseña
                $this->db->where('teacher_id', $teacher_id);
                $this->db->update('teacher', array('password' => $new_password));
                $this->session->set_flashdata('flash_message', get_phrase('Contraseña cambiada correctamente'));
            } elseif ($current_password != $current_password_db) {
                // Contraseña actual incorrecta
                $this->session->set_flashdata('error_message', get_phrase('contraseña actual incorrecta'));
            } else {
                // Las nuevas contraseñas no coinciden
                $this->session->set_flashdata('error_message', get_phrase('nuevas contraseñas no coinciden'));
            }
            
            redirect(base_url() . 'teacher/manage_profile', 'refresh');
        }
    
            $page_data['page_name']     = 'manage_profile';
            $page_data['page_title']    = get_phrase('Editar perfil');
            $page_data['edit_profile']  = $this->db->get_where('teacher', array('teacher_id' => $this->session->userdata('teacher_id')))->result_array();
            $this->load->view('backend/index', $page_data);
        }



        function manage_attendance($date = null, $month= null, $year = null, $class_id = null, $section_id = null ){
            $active_sms_gateway = $this->db->get_where('sms_settings', array('type' => 'active_sms_gateway'))->row()->info;
            
            if ($_POST) {
        
                // Loop all the students of $class_id
                $students = $this->db->get_where('student', array('class_id' => $class_id))->result_array();
                foreach ($students as $key => $student) {
                $attendance_status = $this->input->post('status_' . $student['student_id']);
                $full_date = $year . "-" . $month . "-" . $date;
                $this->db->where('student_id', $student['student_id']);
                $this->db->where('date', $full_date);
        
                $this->db->update('attendance', array('status' => $attendance_status));
        
                       if ($attendance_status == 2) 
                {
                         if ($active_sms_gateway != '' || $active_sms_gateway != 'disabled') {
                            $student_name   = $this->db->get_where('student' , array('student_id' => $student['student_id']))->row()->name;
                            $parent_id      = $this->db->get_where('student' , array('student_id' => $student['student_id']))->row()->parent_id;
                            $message        = 'Your child' . ' ' . $student_name . 'is absent today.';
                            if($parent_id != null && $parent_id != 0){
                                $recieverPhoneNumber = $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->phone;
                                if($recieverPhoneNumber != '' || $recieverPhoneNumber != null){
                                    $this->sms_model->send_sms($message, $recieverPhoneNumber);
                                }
                                else{
                                    $this->session->set_flashdata('error_message' , get_phrase('Parent Phone Not Found'));
                                }
                            }
                            else{
                                $this->session->set_flashdata('error_message' , get_phrase('SMS Gateway Not Found'));
                            }
                        }
               }
            }
        
                $this->session->set_flashdata('flash_message', get_phrase('Updated Successfully'));
                redirect(base_url() . 'teacher/manage_attendance/' . $date . '/' . $month . '/' . $year . '/' . $class_id . '/' . $section_id, 'refresh');
            }
    
            $page_data['date'] = $date;
            $page_data['month'] = $month;
            $page_data['year'] = $year;
            $page_data['class_id'] = $class_id;
            $page_data['section_id'] = $section_id;
            $page_data['page_name'] = 'manage_attendance';
            $page_data['page_title'] = get_phrase('Gestionar asistencia');
            $this->load->view('backend/index', $page_data);
    
        }
    
        function attendance_selector(){
            $date = $this->input->post('timestamp');
            $date = date_create($date);
            $date = date_format($date, "d/m/Y");
            redirect(base_url(). 'teacher/manage_attendance/' .$date. '/' . $this->input->post('class_id'). '/' . $this->input->post('section_id'), 'refresh');
        }
    
    
        function attendance_report($class_id = NULL, $section_id = NULL, $month = NULL, $year = NULL) {
            
            $active_sms_gateway = $this->db->get_where('sms_settings', array('type' => 'active_sms_gateway'))->row()->info;
            
            
            if ($_POST) {
            redirect(base_url() . 'teacher/attendance_report/' . $class_id . '/' . $section_id . '/' . $month . '/' . $year, 'refresh');
            }
            
            $classes = $this->db->get('class')->result_array();
            foreach ($classes as $key => $class) {
                if (isset($class_id) && $class_id == $class['class_id'])
                    $class_name = $class['name'];
                }
                        
            $sections = $this->db->get('section')->result_array();
                foreach ($sections as $key => $section) {
                    if (isset($section_id) && $section_id == $section['section_id'])
                        $section_name = $section['name'];
            }
            
            $page_data['month'] = $month;
            $page_data['year'] = $year;
            $page_data['class_id'] = $class_id;
            $page_data['section_id'] = $section_id;
            $page_data['page_name'] = 'attendance_report';
            $page_data['page_title'] = "Reporte de asistencia" . $class_name;
            $this->load->view('backend/index', $page_data);
        }
    
    
        /******************** Load attendance with ajax code starts from here **********************/
        function loadAttendanceReport($class_id, $section_id, $month, $year)
        {
            $page_data['class_id'] 		= $class_id;					// get all class_id
            $page_data['section_id'] 	= $section_id;					// get all section_id
            $page_data['month'] 		= $month;						// get all month
            $page_data['year'] 			= $year;						// get all class year
            
            $this->load->view('backend/teacher/loadAttendanceReport' , $page_data);
        }
        /******************** Load attendance with ajax code ends from here **********************/
        
    
        /******************** print attendance report **********************/
        function printAttendanceReport($class_id=NULL, $section_id=NULL, $month=NULL, $year=NULL)
        {
            $page_data['class_id'] 		= $class_id;					// get all class_id
            $page_data['section_id'] 	= $section_id;					// get all section_id
            $page_data['month'] 		= $month;						// get all month
            $page_data['year'] 			= $year;						// get all class year
            
            $page_data['page_name'] = 'printAttendanceReport';
            $page_data['page_title'] = "Attendance Report";
            $this->load->view('backend/index', $page_data);
        }
        /******************** /Ends here **********************/
     /***********  The function below manages school marks ***********************/
     function marks ($exam_id = null, $class_id = null, $student_id = null){

        if($this->input->post('operation') == 'selection'){

            $page_data['exam_id']       =  $this->input->post('exam_id'); 
            $page_data['class_id']      =  $this->input->post('class_id');
            $page_data['student_id']    =  $this->input->post('student_id');

            if($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['student_id'] > 0){

                redirect(base_url(). 'teacher/marks/'. $page_data['exam_id'] .'/' . $page_data['class_id'] . '/' . $page_data['student_id'], 'refresh');
            }
            else{
                $this->session->set_flashdata('error_message', get_phrase('Pleasen select something'));
                redirect(base_url(). 'teacher/marks', 'refresh');
            }
        }

        if($this->input->post('operation') == 'update_student_subject_score'){

            $select_subject_first = $this->db->get_where('subject', array('class_id' => $class_id ))->result_array();
                foreach ($select_subject_first as $key => $dispay_subject_from_subject_table){

                    $page_data['class_score1']  =   $this->input->post('class_score1_' . $dispay_subject_from_subject_table['subject_id']);
                    $page_data['class_score2']  =   $this->input->post('class_score2_' . $dispay_subject_from_subject_table['subject_id']);
                    $page_data['class_score3']  =   $this->input->post('class_score3_' . $dispay_subject_from_subject_table['subject_id']);
                    $page_data['exam_score']    =   $this->input->post('exam_score_' . $dispay_subject_from_subject_table['subject_id']);
                    $page_data['comment']       =   $this->input->post('comment_' . $dispay_subject_from_subject_table['subject_id']);

                    $this->db->where('mark_id', $this->input->post('mark_id_' . $dispay_subject_from_subject_table['subject_id']));
                    $this->db->update('mark', $page_data);  
                }

                $this->session->set_flashdata('flash_message', get_phrase('Data Updated Successfully'));
                redirect(base_url(). 'teacher/marks/'. $this->input->post('exam_id') .'/' . $this->input->post('class_id') . '/' . $this->input->post('student_id'), 'refresh');
        }

        $page_data['exam_id']       =   $exam_id;
        $page_data['class_id']      =   $class_id;
        $page_data['student_id']    =   $student_id;
        $page_data['subject_id']   =    $subject_id;
        $page_data['page_name']     =   'marks';
        $page_data['page_title']    = get_phrase('Student Marks');
        $this->load->view('backend/index', $page_data);
    }
    /***********  The function that manages school marks ends here ***********************/

    // Controlador Teacher
    public function generateStudentReport($student_id, $exam_id) {
        // Asegúrate de que el maestro esté autenticado y tenga permisos
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
    
        // Obtén la información necesaria para el informe
        $class_id = $this->db->get_where('student', array('student_id' => $student_id))->row()->class_id;
    
        // Consulta para obtener la información del estudiante
        $student_info = $this->db->get_where('student', array('student_id' => $student_id))->row();
    
        // Consulta para obtener la información de las asignaturas del estudiante
        $subjects = $this->db->get_where('subject', array('class_id' => $class_id))->result_array();
    
        // Inicializa variables para calcular el promedio y asignaturas aprobadas/reprobadas
        $total_class_score = 0;
        $total_subjects = count($subjects);
        $passed_subjects = 0;
        $failed_subjects = 0;

        $student_info->image_url = $this->crud_model->get_image_url('student', $student_id);
    
        // Calcular la calificación de cada asignatura
        foreach ($subjects as &$subject) {
            $obtained_mark_query = $this->db->get_where('mark', array(
                'class_id' => $class_id,
                'exam_id' => $exam_id,
                'subject_id' => $subject['subject_id'],
                'student_id' => $student_id
            ));
    
            if ($obtained_mark_query->num_rows() > 0) {
                $obtained_class_score = $obtained_mark_query->row()->class_score1;
                $subject['obtained_class_score'] = $obtained_class_score;
                $total_class_score += $obtained_class_score;
    
                if ($obtained_class_score >= 3) {
                    $passed_subjects++; // Incrementar el contador de asignaturas aprobadas
                }
    
                if ($obtained_class_score < 3) {
                    $failed_subjects++; // Incrementar el contador de asignaturas reprobadas
                }
            }
        }
    
        // Cargar datos relevantes para el informe
        $page_data['class_id'] = $class_id;
        $page_data['student_id'] = $student_id;
        $page_data['exam_id'] = $exam_id;
        $page_data['student_info'] = $student_info;
        $page_data['subjects'] = $subjects;
        $page_data['total_class_score'] = $total_class_score;
        $page_data['total_subjects'] = $total_subjects;
        $page_data['passed_subjects'] = $passed_subjects;
        $page_data['failed_subjects'] = $failed_subjects;
    
        // Especifica el nombre de la vista que mostrará el informe
        $page_data['page_name'] = 'generate_student_report'; // Utiliza un nombre de página diferente si es necesario
        $page_data['page_title'] = get_phrase('generate_student_report');
    
        // Carga la vista para generar el informe
        $this->load->view('backend/teacher/generate_student_report', $page_data); // Ajusta la vista según tus necesidades
    }

    public function generateStudentReport2($student_id, $exam_id) {
        // Asegúrate de que el maestro esté autenticado y tenga permisos
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
    
        // Obtén la información necesaria para el informe
        $class_id = $this->db->get_where('student', array('student_id' => $student_id))->row()->class_id;
    
        // Consulta para obtener la información del estudiante
        $student_info = $this->db->get_where('student', array('student_id' => $student_id))->row();
    
        // Consulta para obtener la información de las asignaturas del estudiante
        $subjects = $this->db->get_where('subject', array('class_id' => $class_id))->result_array();
    
        // Inicializa variables para calcular el promedio y asignaturas aprobadas/reprobadas
        $total_class_score = 0;
        $total_subjects = count($subjects);
        $passed_subjects = 0;
        $failed_subjects = 0;

        $student_info->image_url = $this->crud_model->get_image_url('student', $student_id);
    
        // Calcular la calificación de cada asignatura
        foreach ($subjects as &$subject) {
            $obtained_mark_query = $this->db->get_where('mark', array(
                'class_id' => $class_id,
                'exam_id' => $exam_id,
                'subject_id' => $subject['subject_id'],
                'student_id' => $student_id
            ));
    
            if ($obtained_mark_query->num_rows() > 0) {
                $obtained_class_score = $obtained_mark_query->row()->class_score2;
                $subject['obtained_class_score'] = $obtained_class_score;
                $total_class_score += $obtained_class_score;
    
                if ($obtained_class_score >= 3) {
                    $passed_subjects++; // Incrementar el contador de asignaturas aprobadas
                }
    
                if ($obtained_class_score < 3) {
                    $failed_subjects++; // Incrementar el contador de asignaturas reprobadas
                }
            }
        }
    
        // Cargar datos relevantes para el informe
        $page_data['class_id'] = $class_id;
        $page_data['student_id'] = $student_id;
        $page_data['exam_id'] = $exam_id;
        $page_data['student_info'] = $student_info;
        $page_data['subjects'] = $subjects;
        $page_data['total_class_score'] = $total_class_score;
        $page_data['total_subjects'] = $total_subjects;
        $page_data['passed_subjects'] = $passed_subjects;
        $page_data['failed_subjects'] = $failed_subjects;
    
        // Especifica el nombre de la vista que mostrará el informe
        $page_data['page_name'] = 'generate_student_report2'; // Utiliza un nombre de página diferente si es necesario
        $page_data['page_title'] = get_phrase('generate_student_report2');
    
        // Carga la vista para generar el informe
        $this->load->view('backend/teacher/generate_student_report2', $page_data); // Ajusta la vista según tus necesidades
    }

    public function generateStudentReport3($student_id, $exam_id) {
        // Asegúrate de que el maestro esté autenticado y tenga permisos
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
    
        // Obtén la información necesaria para el informe
        $class_id = $this->db->get_where('student', array('student_id' => $student_id))->row()->class_id;
    
        // Consulta para obtener la información del estudiante
        $student_info = $this->db->get_where('student', array('student_id' => $student_id))->row();
    
        // Consulta para obtener la información de las asignaturas del estudiante
        $subjects = $this->db->get_where('subject', array('class_id' => $class_id))->result_array();
    
        // Inicializa variables para calcular el promedio y asignaturas aprobadas/reprobadas
        $total_class_score = 0;
        $total_subjects = count($subjects);
        $passed_subjects = 0;
        $failed_subjects = 0;

        $student_info->image_url = $this->crud_model->get_image_url('student', $student_id);
    
        // Calcular la calificación de cada asignatura
        foreach ($subjects as &$subject) {
            $obtained_mark_query = $this->db->get_where('mark', array(
                'class_id' => $class_id,
                'exam_id' => $exam_id,
                'subject_id' => $subject['subject_id'],
                'student_id' => $student_id
            ));
    
            if ($obtained_mark_query->num_rows() > 0) {
                $obtained_class_score = $obtained_mark_query->row()->class_score3;
                $subject['obtained_class_score'] = $obtained_class_score;
                $total_class_score += $obtained_class_score;
    
                if ($obtained_class_score >= 3) {
                    $passed_subjects++; // Incrementar el contador de asignaturas aprobadas
                }
    
                if ($obtained_class_score < 3) {
                    $failed_subjects++; // Incrementar el contador de asignaturas reprobadas
                }
            }
        }
    
        // Cargar datos relevantes para el informe
        $page_data['class_id'] = $class_id;
        $page_data['student_id'] = $student_id;
        $page_data['exam_id'] = $exam_id;
        $page_data['student_info'] = $student_info;
        $page_data['subjects'] = $subjects;
        $page_data['total_class_score'] = $total_class_score;
        $page_data['total_subjects'] = $total_subjects;
        $page_data['passed_subjects'] = $passed_subjects;
        $page_data['failed_subjects'] = $failed_subjects;
    
        // Especifica el nombre de la vista que mostrará el informe
        $page_data['page_name'] = 'generate_student_report3'; // Utiliza un nombre de página diferente si es necesario
        $page_data['page_title'] = get_phrase('generate_student_report3');
    
        // Carga la vista para generar el informe
        $this->load->view('backend/teacher/generate_student_report3', $page_data); // Ajusta la vista según tus necesidades
    }

    public function generateStudentReport4($student_id, $exam_id) {
        // Asegúrate de que el maestro esté autenticado y tenga permisos
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
    
        // Obtén la información necesaria para el informe
        $class_id = $this->db->get_where('student', array('student_id' => $student_id))->row()->class_id;
    
        // Consulta para obtener la información del estudiante
        $student_info = $this->db->get_where('student', array('student_id' => $student_id))->row();
    
        // Consulta para obtener la información de las asignaturas del estudiante
        $subjects = $this->db->get_where('subject', array('class_id' => $class_id))->result_array();
    
        // Inicializa variables para calcular el promedio y asignaturas aprobadas/reprobadas
        $total_class_score = 0;
        $total_subjects = count($subjects);
        $passed_subjects = 0;
        $failed_subjects = 0;

        $student_info->image_url = $this->crud_model->get_image_url('student', $student_id);
    
        // Calcular la calificación de cada asignatura
        foreach ($subjects as &$subject) {
            $obtained_mark_query = $this->db->get_where('mark', array(
                'class_id' => $class_id,
                'exam_id' => $exam_id,
                'subject_id' => $subject['subject_id'],
                'student_id' => $student_id
            ));
    
            if ($obtained_mark_query->num_rows() > 0) {
                $obtained_class_score = $obtained_mark_query->row()->exam_score;
                $subject['obtained_class_score'] = $obtained_class_score;
                $total_class_score += $obtained_class_score;
    
                if ($obtained_class_score >= 3) {
                    $passed_subjects++; // Incrementar el contador de asignaturas aprobadas
                }
    
                if ($obtained_class_score < 3) {
                    $failed_subjects++; // Incrementar el contador de asignaturas reprobadas
                }
            }
        }
    
        // Cargar datos relevantes para el informe
        $page_data['class_id'] = $class_id;
        $page_data['student_id'] = $student_id;
        $page_data['exam_id'] = $exam_id;
        $page_data['student_info'] = $student_info;
        $page_data['subjects'] = $subjects;
        $page_data['total_class_score'] = $total_class_score;
        $page_data['total_subjects'] = $total_subjects;
        $page_data['passed_subjects'] = $passed_subjects;
        $page_data['failed_subjects'] = $failed_subjects;
    
        // Especifica el nombre de la vista que mostrará el informe
        $page_data['page_name'] = 'generate_student_report4'; // Utiliza un nombre de página diferente si es necesario
        $page_data['page_title'] = get_phrase('generate_student_report4');
    
        // Carga la vista para generar el informe
        $this->load->view('backend/teacher/generate_student_report4', $page_data); // Ajusta la vista según tus necesidades
    }

    public function printResultSheet($student_id, $exam_id)
    {
        // Asegúrate de que el maestro esté autenticado y tenga permisos
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }

        $class_id = $this->db->get_where('student', array('student_id' => $student_id))->row()->class_id;
        $class_name = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;

        $page_data['student_id'] = $student_id;
        $page_data['class_id'] = $class_id;
        $page_data['exam_id'] = $exam_id;
        $page_data['page_name'] = 'printResultSheet'; // Cambia el nombre de la vista según tus necesidades
        $page_data['page_title'] = get_phrase('print_result_sheet');

        $this->load->view('backend/index', $page_data);
    }

    

    /***********  The function below manages school marks ***********************/
    function student_marksheet_subject ($exam_id = null, $class_id = null, $subject_id = null){

    if($this->input->post('operation') == 'selection'){

        $page_data['exam_id']       =  $this->input->post('exam_id'); 
        $page_data['class_id']      =  $this->input->post('class_id');
        $page_data['subject_id']    =  $this->input->post('subject_id');

        if($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['subject_id'] > 0){

            redirect(base_url(). 'teacher/student_marksheet_subject/'. $page_data['exam_id'] .'/' . $page_data['class_id'] . '/' . $page_data['subject_id'], 'refresh');
        }
        else{
            $this->session->set_flashdata('error_message', get_phrase('Pleasen select something'));
            redirect(base_url(). 'teacher/student_marksheet_subject', 'refresh');
        }
    }

    if($this->input->post('operation') == 'update_student_subject_score'){

        $select_student_first = $this->db->get_where('student', array('class_id' => $class_id ))->result_array();
            foreach ($select_student_first as $key => $dispay_student_from_student_table){

                $page_data['class_score1']  =   $this->input->post('class_score1_' . $dispay_student_from_student_table['student_id']);
                $page_data['class_score2']  =   $this->input->post('class_score2_' . $dispay_student_from_student_table['student_id']);
                $page_data['class_score3']  =   $this->input->post('class_score3_' . $dispay_student_from_student_table['student_id']);
                $page_data['exam_score']    =   $this->input->post('exam_score_' . $dispay_student_from_student_table['student_id']);
                $page_data['comment']       =   $this->input->post('comment_' . $dispay_student_from_student_table['student_id']);

                $this->db->where('mark_id', $this->input->post('mark_id_' . $dispay_student_from_student_table['student_id']));
                $this->db->update('mark', $page_data);  
            }

            $this->session->set_flashdata('flash_message', get_phrase('Data Updated Successfully'));
            redirect(base_url(). 'teacher/student_marksheet_subject/'. $this->input->post('exam_id') .'/' . $this->input->post('class_id') . '/' . $this->input->post('subject_id'), 'refresh');
    }

    $page_data['exam_id']       =   $exam_id;
    $page_data['class_id']      =   $class_id;
    $page_data['student_id']    =   $student_id;
    $page_data['subject_id']   =    $subject_id;
    $page_data['page_name']     =   'student_marksheet_subject';
    $page_data['page_title']    = get_phrase('Student Marks');
    $this->load->view('backend/index', $page_data);
    }
    /***********  The function that manages school marks ends here ***********************/    

    function periodtime($param1 = null, $param2 = null, $param3 = null){

        if ($param1 == 'insert'){

            $this->crud_model->insert_periodtime();
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully saved'));
            redirect(base_url(). 'teacher/periodtime', 'refresh');
        }

        $page_data['page_name']         = 'periodtime';
        $page_data['page_title']        = get_phrase('Plazo para modificar notas');
        $page_data['select_periodtime']   = $this->db->get('periodtime')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    public function get_class_subject($class_id, $teacher_id) {
        // Realiza la consulta en la base de datos para obtener las asignaturas relacionadas con el docente y la clase
        $subjects = $this->db->where(array('class_id' => $class_id, 'teacher_id' => $teacher_id))->get('subject')->result_array();
    
        // Luego, genera las opciones del menú desplegable en función de las asignaturas obtenidas
        $options = '<option value="">' . get_phrase('select_subject') . '</option>';
        foreach ($subjects as $subject) {
            $options .= '<option value="' . $subject['subject_id'] . '">' . $subject['name'] . '</option>';
        }
    
        // Devuelve las opciones al cliente (JavaScript)
        echo $options;
    }

    public function get_subject_name($subject_id) {
        $this->load->database(); // Carga la base de datos si aún no lo has hecho

        // Realiza una consulta a la base de datos para obtener el nombre de la asignatura
        $this->db->select('name');
        $this->db->from('subject');
        $this->db->where('subject_id', $subject_id);
        $query = $this->db->get();

        // Comprueba si se encontró un registro
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $subject_name = $row->name;
            echo $subject_name; // Devuelve el nombre de la asignatura
        } else {
            echo 'Asignatura no encontrada'; // Maneja el caso en que no se encuentre la asignatura
        }
    }

    
    
    

}