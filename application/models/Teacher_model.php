<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Teacher_model extends CI_Model { 
	
	function __construct()
    {
        parent::__construct();
    }


/**************************** The function below insert into bank and teacher tables   **************************** */
    function insetTeacherFunction (){

        $bank_data['account_holder_name'] = $this->input->post('account_holder_name');
        $bank_data['account_number'] = $this->input->post('account_number');
        $bank_data['bank_name'] = $this->input->post('bank_name');
        $bank_data['branch'] = $this->input->post('branch');

        $this->db->insert('bank', $bank_data);
        $bank_id = $this->db->insert_id();


        $teacher_array = array(
            'name'                  => $this->input->post('name'),
            'role'                  => $this->input->post('role'),
			'teacher_number'        => $this->input->post('teacher_number'),
			'birthday'              => $this->input->post('birthday'),
        	'sex'                   => $this->input->post('sex'),
            'religion'              => $this->input->post('religion'),
            'blood_group'           => $this->input->post('blood_group'),
            'address'               => $this->input->post('address'),
			'phone'                 => $this->input->post('phone'),
			'facebook'              => $this->input->post('facebook'),
        	'twitter'               => $this->input->post('twitter'),
            'googleplus'            => $this->input->post('googleplus'),
            'linkedin'              => $this->input->post('linkedin'),
            'qualification'         => $this->input->post('qualification'),
			'marital_status'        => $this->input->post('marital_status'),
			'password'              => sha1($this->input->post('password')),
        	'department_id'         => $this->input->post('department_id'),
            'designation_id'        => $this->input->post('designation_id'),
            'date_of_joining'       => $this->input->post('date_of_joining'),
            'joining_salary'        => $this->input->post('joining_salary'),
			'status'                => $this->input->post('status'),
			'date_of_leaving'       => $this->input->post('date_of_leaving')
            );
        
            $teacher_array['file_name'] = $_FILES["file_name"]["name"];
            $teacher_array['email'] = $this->input->post('email');
            $teacher_array['teacher_id'] = $this->input->post('teacher_id');
            $teacher_array['bank_id'] = $bank_id;
            $existing_teacher = $this->db->get_where('teacher', array('teacher_id' => $teacher_array['teacher_id']))->row()->teacher_id;
            $check_email = $this->db->get_where('teacher', array('email' => $teacher_array['email']))->row()->email;	// checking if email exists in database
            if($check_email != null) 
            {
            $this->session->set_flashdata('error_message', get_phrase('el email ya esta registrado'));
            redirect(base_url() . 'admin/teacher/', 'refresh');
            }
            elseif ($existing_teacher) {
                $this->session->set_flashdata('error_message', 'El numero de documento ya esta registrado');
                redirect(base_url() . 'admin/teacher/', 'refresh');
            }
            else
            {
            $this->db->insert('teacher', $teacher_array);
            $teacher_id = $this->db->insert_id();
            
                move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/teacher_image/" . $_FILES["file_name"]["name"]);	// upload files
                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $teacher_id . '.jpg');			// image with user ID
            }

    }


    function updateTeacherFunction($param2) {
        $new_email = $this->input->post('email');
        
        // Obtener el correo electrónico actual del maestro
        $current_email = $this->db->get_where('teacher', array('teacher_id' => $param2))->row()->email;
    
        // Verificar si el nuevo correo electrónico es diferente al actual
        if ($new_email !== $current_email) {
            // Verificar si el nuevo correo electrónico ya existe en la tabla
            $existing_teacher = $this->db->get_where('teacher', array('email' => $new_email))->row();
    
            if ($existing_teacher) {
                // Si el nuevo correo electrónico ya existe en la tabla, mostrar un mensaje de error
                $this->session->set_flashdata('error_message', 'El correo electrónico ya esta registrado');
                redirect(base_url() . 'admin/teacher/', 'refresh'); // Cambia 'admin/teacher/' a la URL deseada
            }
        }
    
        // Los datos de maestro se actualizarán solo si no hay problemas de correo electrónico duplicado
        $teacher_data = array(
            'name' => $this->input->post('name'),
            'role' => $this->input->post('role'),
            'birthday' => $this->input->post('birthday'),
            'sex' => $this->input->post('sex'),
            'religion' => $this->input->post('religion'),
            'blood_group' => $this->input->post('blood_group'),
            'address' => $this->input->post('address'),
            'phone' => $this->input->post('phone'),
            'email' => $new_email, // Usar el nuevo correo electrónico aquí
            'facebook' => $this->input->post('facebook'),
            'twitter' => $this->input->post('twitter'),
            'googleplus' => $this->input->post('googleplus'),
            'linkedin' => $this->input->post('linkedin'),
            'qualification' => $this->input->post('qualification'),
            'marital_status' => $this->input->post('marital_status')
        );
    
        $this->db->where('teacher_id', $param2);
        $this->db->update('teacher', $teacher_data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $param2 . '.jpg'); // imagen con ID de usuario
    }
    


    function deleteTeacherFunction($param2) {
        // Verifica si el docente está asociado a asignaturas o clases
        $subject_exists = $this->db->where('teacher_id', $param2)->get('subject')->num_rows() > 0;
        $class_exists = $this->db->where('teacher_id', $param2)->get('class')->num_rows() > 0;
    
        if ($subject_exists || $class_exists) {
            // Si el docente está asociado a asignaturas o clases, muestra un mensaje de error en JavaScript
            echo '<script>alert("No se puede eliminar este docente debido a que está asociado a asignaturas o clases.");</script>';
            redirect(base_url() . 'admin/teacher/', 'refresh');
        }
    
        // Si no está asociado a asignaturas o clases, intenta eliminar el registro del docente
        $this->db->where('teacher_id', $param2);
        $this->db->delete('teacher');
    }
    
	


	
	
}
