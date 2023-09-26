<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Parents extends CI_Controller { 

    function __construct() {
        parent::__construct();
        		$this->load->database();                                //Load Databse Class
                $this->load->library('session');					    //Load library for session
  
    }

     /*parent dashboard code to redirect to parent page if successfull login** */
     function dashboard() {
        if ($this->session->userdata('parent_login') != 1) redirect(base_url(), 'refresh');
       	$page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('parent Dashboard');
        $this->load->view('backend/index', $page_data);
    }
	/******************* / parent dashboard code to redirect to parent page if successfull login** */

    function manage_profile($param1 = null, $param2 = null, $param3 = null){
        if ($this->session->userdata('parent_login') != 1) redirect(base_url(), 'refresh');
        if ($param1 == 'update') {
    
    
            $data['name']   =   $this->input->post('name');
            $data['email']  =   $this->input->post('email');
    
            $this->db->where('parent_id', $this->session->userdata('parent_id'));
            $this->db->update('parent', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/parent_image/' . $this->session->userdata('parent_id') . '.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('Info Updated'));
            redirect(base_url() . 'parents/manage_profile', 'refresh');
        }
    
        if ($param1 == 'change_password') {
            $current_password = sha1($this->input->post('current_password'));
            $new_password = sha1($this->input->post('new_password'));
            $confirm_new_password = sha1($this->input->post('confirm_new_password'));
        
            // Obtén la contraseña actual del usuario desde la base de datos
            $parent_id = $this->session->userdata('parent_id');
            $current_password_db = $this->db->get_where('parent', array('parent_id' => $parent_id))->row('password');
        
            if ($current_password == $current_password_db && $new_password == $confirm_new_password) {
                // Las contraseñas coinciden, puedes cambiar la contraseña
                $this->db->where('parent_id', $parent_id);
                $this->db->update('parent', array('password' => $new_password));
                $this->session->set_flashdata('flash_message', get_phrase('Contraseña cambiada correctamente'));
            } elseif ($current_password != $current_password_db) {
                // Contraseña actual incorrecta
                $this->session->set_flashdata('error_message', get_phrase('contraseña actual incorrecta'));
            } else {
                // Las nuevas contraseñas no coinciden
                $this->session->set_flashdata('error_message', get_phrase('nuevas contraseñas no coinciden'));
            }
    
            $page_data['page_name']     = 'manage_profile';
            $page_data['page_title']    = get_phrase('Editar perfil');
            $page_data['edit_profile']  = $this->db->get_where('parent', array('parent_id' => $this->session->userdata('parent_id')))->result_array();
            $this->load->view('backend/index', $page_data);
        }

    }
        function subject (){

            $parent_profile = $this->db->get_where('student', array('parent_id' => $this->session->userdata('parent_id')))->row();
            $select_student_class_id = $parent_profile->class_id;

            $page_data['page_name']     = 'subject';
            $page_data['page_title']    = get_phrase('Class Subjects');
            $page_data['select_subject']  = $this->db->get_where('subject', array('class_id' => $select_student_class_id))->result_array();
            $this->load->view('backend/index', $page_data);
        }

        function teacher (){


            $parent_profile = $this->db->get_where('student', array('parent_id' => $this->session->userdata('parent_id')))->row();
            $select_student_class_id = $parent_profile->class_id;

            $return_teacher_id = $this->db->get_where('subject', array('class_id' => $select_student_class_id))->row()->teacher_id;


            $page_data['page_name']     = 'teacher';
            $page_data['page_title']    = get_phrase('Class Teachers');
            $page_data['select_teacher']  = $this->db->get_where('teacher', array('teacher_id' => $return_teacher_id))->result_array();
            $this->load->view('backend/index', $page_data);
        }

        function class_mate (){

            $parent_student_profile = $this->db->get_where('student', array('parent_id' => $this->session->userdata('parent_id')))->row();
            $page_data['select_student_parent_class_mate']  = $parent_student_profile->class_id;
            $page_data['page_name']     = 'class_mate';
            $page_data['page_title']    = get_phrase('Class Mate');
            $this->load->view('backend/index', $page_data);
        }

        function class_routine(){

            $parent_profile = $this->db->get_where('student', array('parent_id' => $this->session->userdata('parent_id')))->row();
            $page_data['class_id']  = $parent_profile->class_id;

            $page_data['page_name']     = 'class_routine';
            $page_data['page_title']    = get_phrase('Class Timetable');
            $this->load->view('backend/index', $page_data);


        }

        function invoice($param1 = null, $param2 = null, $param3 = null){

            if($param1 == 'make_payment'){

                $invoice_id = $this->input->post('invoice_id');
                $payment_email = $this->db->get_where('settings', array('type' => 'paypal_email'))->row();
                $select_invoice = $this->db->get_where('invoice', array('invoice_id' => $invoice_id))->row();

                // SENDING USER TO PAYPAL TERMINAL.
                $this->paypal->add_field('rm', 2);
                $this->paypal->add_field('no_note', 0);
                $this->paypal->add_field('item_name', $select_invoice->title);
                $this->paypal->add_field('amount', $select_invoice->due);
                $this->paypal->add_field('custom', $select_invoice->invoice_id);
                $this->paypal->add_field('business', $payment_email->description);
                $this->paypal->add_field('notify_url', base_url('invoice/paypal_ipn'));
                $this->paypal->add_field('cancel_return', base_url('invoice/paypal_cancel'));
                $this->paypal->add_field('return', site_url('invoice/paypal_success'));

                $this->paypal->submit_paypal_post();
                //submitting info to the paypal teminal
            }


            if($param1 == 'paypal_ipn'){
                if($this->paypal->validate_ipn() == true){
                        $ipn_response = '';
                        foreach ($_POST as $key => $value){
                            $value = urlencode(stripslashes($value));
                            $ipn_response .= "\n$key=$value";
                        }

                    $page_data['payment_details']   = $ipn_response;
                    $page_data['payment_timestamp'] = strtotime(date("m/d/Y"));
                    $page_data['payment_method']    = '1';
                    $page_data['status']            = 'paid';
                    $invoice_id                = $_POST['custom'];
                    $this->db->where('invoice_id', $invoice_id);
                    $this->db->update('invoice', $page_data);

                    $data2['method']       =   '1';
                    $data2['invoice_id']   =   $_POST['custom'];
                    $data2['timestamp']    =   strtotime(date("m/d/Y"));
                    $data2['payment_type'] =   'income';
                    $data2['title']        =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->title;
                    $data2['description']  =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->description;
                    $data2['student_id']   =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->student_id;
                    $data2['amount']       =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->amount;
                    $this->db->insert('payment' , $data2);

                }
            }

            if($param1 == 'paypal_cancel'){
                $this->session->set_flashdata('error_message', get_phrase('Payment Cancelled'));
                redirect(base_url() . 'parents/invoice', 'refresh');
                }
    
            if($param1 == 'paypal_success'){
                $this->session->set_flashdata('flash_message', get_phrase('Payment Successful'));
                redirect(base_url() . 'parents/invoice', 'refresh');
            }
           

            $parent_profile = $this->db->get_where('student', array('parent_id' => $this->session->userdata('parent_id')))->row();
            $student_profile = $parent_profile->student_id;

            $page_data['invoices']     = $this->db->get_where('invoice', array('student_id' => $student_profile))->result_array();
            $page_data['page_name']     = 'invoice';
            $page_data['page_title']    = get_phrase('All Invoices');
            $this->load->view('backend/index', $page_data);
        }

        function payment_history(){

            $parent_profile = $this->db->get_where('student', array('parent_id' => $this->session->userdata('parent_id')))->row();
            $parent_student_profile = $parent_profile->student_id;

            $page_data['invoices']     = $this->db->get_where('invoice', array('student_id' => $parent_student_profile))->result_array();
            $page_data['page_name']     = 'payment_history';
            $page_data['page_title']    = get_phrase('parent History');
            $this->load->view('backend/index', $page_data);
        }

        function submit_testimony($param1 = null, $param2 = null, $param3 = null){

            if($param1 == 'save'){

                $page_data['parent_id'] =    $this->db->get_where('parent', array('parent_id' => $this->session->userdata('parent_id')))->row()->parent_id;
                $page_data['content']   =    html_escape($this->input->post('content'));
                $page_data['status']   =    'Pending';
                $this->db->insert('testimony_table', $page_data);
                $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
                redirect(base_url() . 'parents/submit_testimony', 'refresh');
            }


            $page_data['page_name']     = 'submit_testimony';
            $page_data['page_title']    = get_phrase('Submit Testimony');
            $this->load->view('backend/index', $page_data);

        }
		
		/********** this function load student *******************/
    function search_student($student_id = '', $param2 = '', $sparam3 = '')
    {
		if ($this->session->userdata('parent_login') != 1)
		redirect('login', 'refresh');
			
		if ($this->input->post('operation') == 'selection') 
		{
		$page_data['student_id'] = $this->input->post('student_id');
		if ($page_data['student_id'] > 0 ) 
		{
		redirect(base_url() . 'parents/search_student/' . $page_data['student_id'], 'refresh');
		} 
		else 
		{
		$this->session->set_flashdata('info', 'please_student_name');
		redirect(base_url() . 'parents/search_student/', 'refresh');
		}
		}
		$class_id = $this->db->get_where('student', array('student_id' => $student_id))->row()->class_id;	// this code load student specific class ID
		$student_name = $this->db->get_where('student', array('student_id' => $student_id))->row()->name;	// this code load student specific name of the above class
		$class_name = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;    		// this code load class name
		
		$page_data['student_id'] = $student_id;				//student ID
		$page_data['class_id'] = $class_id;					//class ID
	
		$page_data['page_name'] = 'search_student';
		$page_data['page_title'] = get_phrase('search_students');
		$this->load->view('backend/index', $page_data);
	}
	/********** this function load student *******************/
	
    public function generateStudentReport($student_id, $exam_id) {
        // Asegúrate de que el acudiente esté autenticado y tenga permisos
        if ($this->session->userdata('parent_login') != 1) {
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
        $this->load->view('backend/parent/generate_student_report', $page_data); // Ajusta la vista según tus necesidades
    }

    public function generateStudentReport2($student_id, $exam_id) {
        // Asegúrate de que el maestro esté autenticado y tenga permisos
        if ($this->session->userdata('parent_login') != 1) {
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
        $this->load->view('backend/parent/generate_student_report2', $page_data); // Ajusta la vista según tus necesidades
    }

    public function generateStudentReport3($student_id, $exam_id) {
        // Asegúrate de que el maestro esté autenticado y tenga permisos
        if ($this->session->userdata('parent_login') != 1) {
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
        $this->load->view('backend/parent/generate_student_report3', $page_data); // Ajusta la vista según tus necesidades
    }

    public function generateStudentReport4($student_id, $exam_id) {
        // Asegúrate de que el maestro esté autenticado y tenga permisos
        if ($this->session->userdata('parent_login') != 1) {
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
        $this->load->view('backend/parent/generate_student_report4', $page_data); // Ajusta la vista según tus necesidades
    }

	/********************* Print and view tabulation sheet **********************/
		function printResultSheet($student_id , $exam_id)
		{
		 if ($this->session->userdata('parent_login') != 1)
		 redirect(base_url(), 'refresh');
		 
		 
		 $class_id     = $this->db->get_where('student' , array('student_id' => $student_id))->row()->class_id;
		 $class_name   = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
		
		$page_data['student_id'] =   $student_id;
		$page_data['class_id']   =   $class_id;
		$page_data['exam_id']    =   $exam_id;
		$page_data['page_name']  = 'printResultSheet';
		$page_data['page_title'] = get_phrase('reporte_final');
		$this->load->view('backend/index', $page_data);
        $subjects = $this->db->get_where('subject', array('class_id' => $class_id))->result_array();
        $total_subjects = count($subjects);

		}
		/********************* Print and view tabulation sheet ends here **********************/



}