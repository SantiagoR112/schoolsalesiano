<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Section_model extends CI_Model { 
	
	function __construct()
    {
        parent::__construct();
    }


    // The function below insert into section table //
    function createSectionFunction(){

        $name = html_escape($this->input->post('name'));
        $nick_name = html_escape($this->input->post('nick_name'));
        $class_id = html_escape($this->input->post('class_id'));
        $teacher_id = html_escape($this->input->post('teacher_id'));


        $existing_section_name = $this->db->get_where('section', array('name' => $name, 'class_id' => $class_id))->row();
        $existing_section_nick_name = $this->db->get_where('section', array('nick_name' => $nick_name, 'class_id' => $class_id))->row();

        if ($existing_section_name) {
            // Si ya existe una materia con el mismo nombre y class_id, muestra un mensaje de error
            $this->session->set_flashdata('error_message', get_phrase('Ya existe una seccion con el mismo nombre para esta clase.'));
            redirect(base_url() . 'admin/section', 'refresh'); // Reemplaza 'ruta_de_redireccion' con la URL a la que deseas redirigir
        } 
        elseif($existing_section_nick_name) {
            $this->session->set_flashdata('error_message', get_phrase('Ya existe una seccion con el mismo nombre numerico para esta clase.'));
            redirect(base_url() . 'admin/section', 'refresh'); // Reemplaza 'ruta_de_redireccion' con la URL a la que deseas redirigir
        }
        
        else {
            // Si no existe, procede a insertar la nueva seccion
            $page_data = array(
                'name' => $name,
                'nick_name' => $nick_name,
                'class_id' => $class_id,
                'teacher_id' => $teacher_id
            );
    
            $this->db->insert('section', $page_data);
        
        }
    }


    // The function below update section table //
    function updateSectionFunction($param2){
        $page_data = array(
            'name'          => html_escape($this->input->post('name')),
            'nick_name'     => html_escape($this->input->post('nick_name')),
            'class_id'      => html_escape($this->input->post('class_id')),
            'teacher_id'    => html_escape($this->input->post('teacher_id'))
	    );

        $this->db->where('section_id', $param2);
        $this->db->update('section', $page_data);
    }

    // The function below delete from section table //
    function deleteSectionFunction($param2) {
        // Verificar si existe una clase asociada a esta sección
        $section = $this->db->get_where('section', array('section_id' => $param2))->row();
        if ($section) {
            $class_id = $section->class_id;
    
            // Verificar si existen registros de clases con este class_id
            $class_exists = $this->db->get_where('clases', array('class_id' => $class_id))->row();
            
            if ($class_exists) {
                // Si existe una clase asociada, muestra un mensaje de error o maneja la lógica como desees
                $this->session->set_flashdata('error_message', get_phrase('No se puede eliminar esta sección porque está asociada a una clase.'));
                redirect(base_url() . 'admin/section', 'refresh');
            } else {
                // Si no existe una clase asociada, procede a eliminar la sección
                $this->db->where('section_id', $param2);
                $this->db->delete('section');
            }
        }
    }
    
	
	
}

