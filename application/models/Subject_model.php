<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Subject_model extends CI_Model { 
	
	function __construct()
    {
        parent::__construct();
    }


    // The function below insert into subject table //
    function createSubjectFunction() {
        $name = html_escape($this->input->post('name'));
        $class_id = html_escape($this->input->post('class_id'));
        $teacher_id = html_escape($this->input->post('teacher_id'));
    
        // Verificar si ya existe una materia con el mismo nombre y class_id
        $existing_subject = $this->db->get_where('subject', array('name' => $name, 'class_id' => $class_id))->row();
    
        if ($existing_subject) {
            // Si ya existe una materia con el mismo nombre y class_id, muestra un mensaje de error
            $this->session->set_flashdata('error_message', 'Ya existe una asignatura con el mismo nombre para esta clase.');
            redirect(base_url() . 'subject/subject', 'refresh'); // Reemplaza 'ruta_de_redireccion' con la URL a la que deseas redirigir
        } else {
            // Si no existe, procede a insertar la nueva materia
            $page_data = array(
                'name' => $name,
                'class_id' => $class_id,
                'teacher_id' => $teacher_id
            );
    
            $this->db->insert('subject', $page_data);
        }
    }
    

// The function below update subject table //
    function updateSubjectFunction($param2) {
        $new_name = html_escape($this->input->post('name'));
        $class_id = html_escape($this->input->post('class_id'));
        $teacher_id = html_escape($this->input->post('teacher_id'));

        // Obtén los datos actuales de la asignatura
        $current_subject = $this->db->get_where('subject', array('subject_id' => $param2))->row();

        // Verifica si los nuevos valores son diferentes de los valores actuales
        if ($new_name !== $current_subject->name || $class_id !== $current_subject->class_id) {
            // Verifica si ya existe otra asignatura con el mismo nombre en la misma clase
            $existing_subject = $this->db->get_where('subject', array('name' => $new_name, 'class_id' => $class_id))->row();
            if ($existing_subject) {
                // Si ya existe una asignatura con el mismo nombre en la misma clase, muestra un mensaje de error
                $this->session->set_flashdata('error_message', 'Ya existe una asignatura con el mismo nombre en esta clase.');
                redirect(base_url() . 'subject/subject', 'refresh'); // Reemplaza 'ruta_de_redireccion' con la URL a la que deseas redirigir
                return; // Detiene la ejecución para evitar la actualización
            }
        }

        // Si no hay duplicados o si los valores no han cambiado, procede con la actualización de la asignatura
        $page_data = array(
            'name' => $new_name,
            'class_id' => $class_id,
            'teacher_id' => $teacher_id
        );

        $this->db->where('subject_id', $param2);
        $this->db->update('subject', $page_data);
    }


    // The function below delete from subject table //
    function deleteSubjectFunction($param2) {
        // Verifica si hay notas asociadas a esta asignatura
        $marks_exist = $this->db->where('subject_id', $param2)->get('mark')->num_rows() > 0;
    
        if ($marks_exist) {
            // Si hay notas asociadas, muestra un mensaje de error en JavaScript
            $this->session->set_flashdata('error_message', get_phrase('No se puede eliminar esta asignatura debido a que existen notas asociadas'));
            redirect(base_url() . 'subject/subject', 'refresh');
        }
    
        // Si no hay notas asociadas, intenta eliminar el registro de la asignatura
        $this->db->where('subject_id', $param2);
        $this->db->delete('subject');
    }	
}

