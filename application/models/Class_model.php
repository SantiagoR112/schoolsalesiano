<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class   Class_model extends CI_Model { 
	
	function __construct()
    {
        parent::__construct();
    }



    // The function below insert into class table //
    function createClassFunction() {
        $name = $this->input->post('name');
        $name_numeric = $this->input->post('name_numeric');
        $teacher_id = $this->input->post('teacher_id');
    
        // Verificar si el docente ya tiene asignada una clase
        $existing_class_for_teacher = $this->db->get_where('class', array('teacher_id' => $teacher_id))->row();
    
        if ($existing_class_for_teacher) {
            // Si el docente ya tiene asignada una clase, muestra un mensaje de error
            $this->session->set_flashdata('error_message', 'El docente ya es director de grupo de otra clase.');
            redirect(base_url() . 'admin/classes', 'refresh'); // Reemplaza 'ruta_de_redireccion' con la URL a la que deseas redirigir
        } else {
            // Verificar si ya existe una clase con el mismo nombre o nombre numérico
            $existing_class_name = $this->db->get_where('class', array('name' => $name))->row();
            $existing_class_numericname = $this->db->get_where('class', array('name_numeric' => $name_numeric))->row();
    
            if ($existing_class_name) {
                // Si ya existe una clase con el mismo nombre, muestra un mensaje de error
                $this->session->set_flashdata('error_message', 'Ya existe una clase con el mismo nombre.');
                redirect(base_url() . 'admin/classes', 'refresh'); // Reemplaza 'ruta_de_redireccion' con la URL a la que deseas redirigir
            } elseif ($existing_class_numericname) {
                // Si ya existe una clase con el mismo nombre numérico, muestra un mensaje de error
                $this->session->set_flashdata('error_message', 'Ya existe una clase con el mismo nombre numérico.');
                redirect(base_url() . 'admin/classes', 'refresh'); // Reemplaza 'ruta_de_redireccion' con la URL a la que deseas redirigir
            } else {
                // Si no existe una clase con el mismo nombre ni con el mismo nombre numérico y el docente no tiene asignada ninguna clase, procede a insertar la nueva clase
                $page_data = array(
                    'name' => $name,
                    'name_numeric' => $name_numeric,
                    'teacher_id' => $teacher_id
                );
    
                $this->db->insert('class', $page_data);
            }
        }
    }
    
    

    // The function below update class table //
    function updateClassFunction($param2) {
        $new_name = $this->input->post('name');
        $new_name_numeric = $this->input->post('name_numeric');
        $teacher_id = $this->input->post('teacher_id');

        // Obtén los datos actuales de la clase
        $current_class = $this->db->get_where('class', array('class_id' => $param2))->row();

        // Verifica si los nuevos valores son diferentes de los valores actuales
        if ($new_name !== $current_class->name || $new_name_numeric !== $current_class->name_numeric) {
            // Verifica si ya existe otra clase con el mismo name
            $existing_name = $this->db->get_where('class', array('name' => $new_name))->row();
            if ($existing_name) {
                // Si ya existe una clase con el mismo name, muestra un mensaje de error
                $this->session->set_flashdata('error_message', 'Ya existe una clase con el mismo nombre.');
                redirect(base_url(). 'admin/classes', 'refresh'); // Reemplaza 'ruta_de_redireccion' con la URL a la que deseas redirigir
                return; // Detiene la ejecución para evitar la actualización
            }

            // Verifica si ya existe otra clase con el mismo name_numeric
            $existing_name_numeric = $this->db->get_where('class', array('name_numeric' => $new_name_numeric))->row();
            if ($existing_name_numeric) {
                // Si ya existe una clase con el mismo name_numeric, muestra un mensaje de error
                $this->session->set_flashdata('error_message', 'Ya existe una clase con el mismo nombre numérico.');
                redirect(base_url(). 'admin/classes', 'refresh'); // Reemplaza 'ruta_de_redireccion' con la URL a la que deseas redirigir
                return; // Detiene la ejecución para evitar la actualización
            }
        }

        // Verifica si el docente ya tiene asignada otra clase con un teacher_id diferente
        $existing_teacher_class = $this->db->get_where('class', array('teacher_id' => $teacher_id))->row();
        if ($existing_teacher_class && $existing_teacher_class->class_id !== $param2) {
            // Si el docente ya tiene asignada otra clase con teacher_id diferente, muestra un mensaje de error
            $this->session->set_flashdata('error_message', 'El docente ya es director de grupo de otra clase.');
            redirect(base_url(). 'admin/classes', 'refresh'); // Reemplaza 'ruta_de_redireccion' con la URL a la que deseas redirigir
            return; // Detiene la ejecución para evitar la actualización
        }

        // Si no hay duplicados, el docente no tiene otra clase con teacher_id diferente y los valores no han cambiado, procede con la actualización de la clase
        $page_data = array(
            'name' => $new_name,
            'name_numeric' => $new_name_numeric,
            'teacher_id' => $teacher_id
        );

        $this->db->where('class_id', $param2);
        $this->db->update('class', $page_data);
    }



    // The function below delete from class table //
    function deleteClassFunction($param2) {
        // Verifica si hay estudiantes asociados a esta clase
        $students_exist = $this->db->where('class_id', $param2)->get('student')->num_rows() > 0;
    
        // Verifica si hay notas asociadas a esta clase
        $marks_exist = $this->db->where('class_id', $param2)->get('mark')->num_rows() > 0;
    
        if ($students_exist || $marks_exist) {
            // Si hay estudiantes o notas asociadas, muestra un mensaje de error en JavaScript
            echo '<script>alert("No se puede eliminar esta clase debido a que tiene estudiantes o notas asociadas.");</script>';
            redirect(base_url() . 'admin/classes', 'refresh');
        }
    
        // Si no hay estudiantes ni notas asociadas, intenta eliminar el registro de la clase
        $this->db->where('class_id', $param2);
        $this->db->delete('class');
    }
    
	


	
	
}

