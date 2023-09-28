<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Student_model extends CI_Model { 
	
	function __construct()
    {
        parent::__construct();
    }



    // The function below insert into student house //
    function createStudentHouse(){

        $page_data = array(
            'name'          => html_escape($this->input->post('name')),
            'description'      => html_escape($this->input->post('description'))
	    );

        $this->db->insert('house', $page_data);
    }

// The function below update student house //
    function updateStudentHouse($param2){
        $page_data = array(
            'name'         => html_escape($this->input->post('name')),
            'description'  => html_escape($this->input->post('description'))
	    );

        $this->db->where('house_id', $param2);
        $this->db->update('house', $page_data);
    }

    // The function below delete from student house table //
    function deleteStudentHouse($param2){
        $this->db->where('house_id', $param2);
        $this->db->delete('house');
    }



    // The function below insert into student category //
    function createstudentCategory(){

        $page_data = array(
            'name'        => html_escape($this->input->post('name')),
            'description' => html_escape($this->input->post('description'))
	    );
        $this->db->insert('student_category', $page_data);
    }

// The function below update student category //
    function updatestudentCategory($param2){
        $page_data = array(
            'name'        => html_escape($this->input->post('name')),
            'description' => html_escape($this->input->post('description'))
	    );

        $this->db->where('student_category_id', $param2);
        $this->db->update('student_category', $page_data);
    }

    // The function below delete from student category table //
    function deletestudentCategory($param2){
        $this->db->where('student_category_id', $param2);
        $this->db->delete('student_category');
    }




    //  the function below insert into student table
    function createNewStudent(){

        $student_array = array(
            'name'          => html_escape($this->input->post('name')),
            'birthday'      => html_escape($this->input->post('birthday')),
            'age'           => html_escape($this->input->post('age')),
            'place_birth'   => html_escape($this->input->post('place_birth')),
            'sex'           => html_escape($this->input->post('sex')),
            'm_tongue'      => html_escape($this->input->post('m_tongue')),
            'religion'      => html_escape($this->input->post('religion')),
            'blood_group'   => html_escape($this->input->post('blood_group')),
            'address'       => html_escape($this->input->post('address')),
            'city'          => html_escape($this->input->post('city')),
            'state'         => html_escape($this->input->post('state')),
            'nationality'   => html_escape($this->input->post('nationality')),
            'phone'         => html_escape($this->input->post('phone')),
            'ps_attended'   => html_escape($this->input->post('ps_attended')),
            'ps_address'    => html_escape($this->input->post('ps_address')),
            'ps_purpose'    => html_escape($this->input->post('ps_purpose')),
            'class_study'   => html_escape($this->input->post('class_study')),
            'date_of_leaving' => html_escape($this->input->post('date_of_leaving')),
            'am_date'         => html_escape($this->input->post('am_date')),
            'tran_cert'       => html_escape($this->input->post('tran_cert')),
            'dob_cert'        => html_escape($this->input->post('dob_cert')),
            'mark_join'        => html_escape($this->input->post('mark_join')),
            'physical_h'      => html_escape($this->input->post('physical_h')),
            'password'        => sha1($this->input->post('password')),
            'class_id'        => html_escape($this->input->post('class_id')),
            'section_id'      => html_escape($this->input->post('section_id')),
            'parent_id'       => html_escape($this->input->post('parent_id')),
            'roll'            => html_escape($this->input->post('roll')),
            'transport_id'    => html_escape($this->input->post('transport_id')),
            'dormitory_id'    => html_escape($this->input->post('dormitory_id')),
            'house_id'        => html_escape($this->input->post('house_id')),
            'student_category_id' => html_escape($this->input->post('student_category_id')),
            'club_id'             => html_escape($this->input->post('club_id')),
            'session'             => html_escape($this->input->post('session'))
        );

        $student_array['email'] = $this->input->post('email');
        $student_array['student_id'] = $this->input->post('student_id');
        $existing_student = $this->db->get_where('student', array('student_id' => $student_array['student_id']))->row()->student_id;
        $check_email = $this->db->get_where('student', array('email' => $student_array['email']))->row()->email;	// checking if email exists in database
        if($check_email != null) 
        {
            $this->session->set_flashdata('error_message', get_phrase('el email ya esta registrado'));
            redirect(base_url(). 'admin/student_information', 'refresh');
        }
        elseif ($existing_student) {
            $this->session->set_flashdata('error_message', 'El numero de documento ya esta registrado');
            redirect(base_url(). 'admin/student_information', 'refresh');
        }
        else
        {
            $this->db->insert('student', $student_array);
            $student_id = $this->db->insert_id();
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $student_id . '.jpg');			// image with user ID
        }
        
  
    

    }


    //the function below update student
    function updateNewStudent($param2){

        $new_email = $this->input->post('email');
        
        // Obtener el correo electrónico actual del maestro
        $current_email = $this->db->get_where('student', array('student_id' => $param2))->row()->email;
    
        // Verificar si el nuevo correo electrónico es diferente al actual
        if ($new_email !== $current_email) {
            // Verificar si el nuevo correo electrónico ya existe en la tabla
            $existing_student = $this->db->get_where('student', array('email' => $new_email))->row();
    
            if ($existing_student) {
                // Si el nuevo correo electrónico ya existe en la tabla, mostrar un mensaje de error
                $this->session->set_flashdata('error_message', 'El correo electrónico ya esta registrado');
                redirect(base_url() . 'admin/student_information', 'refresh'); // Cambia 'admin/teacher/' a la URL deseada
            }
        }


        // Los datos de estudiante se actualizarán solo si no hay problemas de correo electrónico duplicado
        $student_data = array(
            'name'          => html_escape($this->input->post('name')),
            'birthday'      => html_escape($this->input->post('birthday')),
            'age'           => html_escape($this->input->post('age')),
            'place_birth'   => html_escape($this->input->post('place_birth')),
            'sex'           => html_escape($this->input->post('sex')),
            'm_tongue'      => html_escape($this->input->post('m_tongue')),
            'religion'      => html_escape($this->input->post('religion')),
            'blood_group'   => html_escape($this->input->post('blood_group')),
            'address'       => html_escape($this->input->post('address')),
            'city'          => html_escape($this->input->post('city')),
            'state'         => html_escape($this->input->post('state')),
            'nationality'   => html_escape($this->input->post('nationality')),
            'phone'         => html_escape($this->input->post('phone')),
            'email' => $new_email, // Usar el nuevo correo electrónico aquí
            'ps_attended'   => html_escape($this->input->post('ps_attended')),
            'ps_address'    => html_escape($this->input->post('ps_address')),
            'ps_purpose'    => html_escape($this->input->post('ps_purpose')),
            'class_study'   => html_escape($this->input->post('class_study')),
            'date_of_leaving' => html_escape($this->input->post('date_of_leaving')),
            'am_date'         => html_escape($this->input->post('am_date')),
            'tran_cert'       => html_escape($this->input->post('tran_cert')),
            'dob_cert'        => html_escape($this->input->post('dob_cert')),
            'mark_join'        => html_escape($this->input->post('mark_join')),
            'physical_h'      => html_escape($this->input->post('physical_h')),
            'class_id'        => html_escape($this->input->post('class_id')),
            'section_id'      => html_escape($this->input->post('section_id')),
            'parent_id'       => html_escape($this->input->post('parent_id')),
            'transport_id'    => html_escape($this->input->post('transport_id')),
            'dormitory_id'    => html_escape($this->input->post('dormitory_id')),
            'house_id'        => html_escape($this->input->post('house_id')),
            'student_category_id' => html_escape($this->input->post('student_category_id')),
            'club_id'             => html_escape($this->input->post('club_id'))
	    );
        $this->db->where('student_id', $param2);
        $this->db->update('student', $student_data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $param2 . '.jpg');

    }

    // the function below deletes from student table
    function deleteNewStudent($param2) {
        // Verifica si el estudiante tiene notas asociadas
        $marks_exist = $this->db->where('student_id', $param2)->get('mark')->num_rows() > 0;
    
        if ($marks_exist) {
            // Si el estudiante tiene notas asociadas, muestra un mensaje de error en JavaScript
            echo '<script>alert("No se puede eliminar este estudiante debido a que tiene notas asociadas.");</script>';
            redirect(base_url() . 'admin/student', 'refresh');
        }
    
        // Si no tiene notas asociadas, intenta eliminar el registro del estudiante
        $this->db->where('student_id', $param2);
        $this->db->delete('student');
    }
    


    function create_student_request_book(){

        $page_data['book_id'] = $this->input->post('book_id');
        $page_data['request_date'] =strtotime($this->input->post('request_date'));
        $page_data['return_date'] = strtotime($this->input->post('return_date'));
        $page_data['status'] = 2;
        $page_data['student_id'] = $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row()->student_id;
        
        $this->db->insert('book_request', $page_data);
    }

	


	
	
}

