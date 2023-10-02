<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Transportation_model extends CI_Model { 
	
	function __construct()
    {
        parent::__construct();
    }

     // The function below insert into transport table //
     function insertTransportFunction(){
        $page_data = array(
            'name'                      => html_escape($this->input->post('name')),
            'transport_route_id'        => html_escape($this->input->post('transport_route_id')),
            'vehicle_id'                => html_escape($this->input->post('vehicle_id')),
            'route_fare'                => html_escape($this->input->post('route_fare')),
            'description'               => html_escape($this->input->post('description')),
		);

        $this->db->insert('transport', $page_data);
    }

// The function below update transport table //
    function updateTransportFunction($param2){
        $page_data = array(
            'name'                      => html_escape($this->input->post('name')),
            'transport_route_id'        => html_escape($this->input->post('transport_route_id')),
            'vehicle_id'                => html_escape($this->input->post('vehicle_id')),
            'route_fare'                => html_escape($this->input->post('route_fare')),
            'description'               => html_escape($this->input->post('description')),
		);

        $this->db->where('transport_id', $param2);
        $this->db->update('transport', $page_data);
    }

    // The function below delete from transport table //
    function deleteTransportFunction($param2) {
        // Verifica si hay estudiantes asociados a este transporte
        $students_exist = $this->db->where('transport_id', $param2)->get('student')->num_rows() > 0;
    
        if ($students_exist) {
            // Si hay estudiantes asociados, muestra un mensaje de error en JavaScript
            $this->session->set_flashdata('error_message', get_phrase('No se puede eliminar este transporte debido a que tiene estudiantes asociados'));
            redirect(base_url() . 'transportation/transport', 'refresh');
        }
    
        // Si no hay estudiantes asociados, intenta eliminar el registro del transporte
        $this->db->where('transport_id', $param2);
        $this->db->delete('transport');
    }
    


// The function below insert into transort_route table //
      function insertTransportRoute(){
        $page_data = array(
            'name'               => html_escape($this->input->post('name')),
            'description'        => html_escape($this->input->post('description'))
		);
        $this->db->insert('transport_route', $page_data);
    }

// The function below update transort_route table //
    function updateTransportRoute($param2){
        $page_data = array(
            'name'               => html_escape($this->input->post('name')),
            'description'        => html_escape($this->input->post('description'))
		);

        $this->db->where('transport_route_id', $param2);
        $this->db->update('transport_route', $page_data);
    }

    // The function below delete from transort_route table //
    function deleteTransportRoute($param2) {
        // Verifica si hay transportes asociados a esta ruta
        $transport_exist = $this->db->where('transport_route_id', $param2)->get('transport')->num_rows() > 0;
    
        if ($transport_exist) {
            // Si hay transportes asociados, muestra un mensaje de error en JavaScript
            $this->session->set_flashdata('error_message', get_phrase('No se puede eliminar esta ruta de transporte debido a que tiene transportes asociados'));
            redirect(base_url() . 'transportation/transport_route', 'refresh');
        }
    
        // Si no hay transportes asociados, intenta eliminar el registro de la ruta de transporte
        $this->db->where('transport_route_id', $param2);
        $this->db->delete('transport_route');
    }
    


// The function below insert into vehicle table //
         function insertVehicle(){
            $page_data = array(
                'name'                          => html_escape($this->input->post('name')),
                'vehicle_number'                => html_escape($this->input->post('vehicle_number')),
                'vehicle_model'                 => html_escape($this->input->post('vehicle_model')),
                'vehicle_quantity'              => html_escape($this->input->post('vehicle_quantity')),
                'year_made'                     => html_escape($this->input->post('year_made')),
                'driver_name'                   => html_escape($this->input->post('driver_name')),
                'driver_license'                => html_escape($this->input->post('driver_license')),
                'driver_contact'                => html_escape($this->input->post('driver_contact')),
                'description'                   => html_escape($this->input->post('description')),
                'status'                        => html_escape($this->input->post('status'))
            );
    $this->db->insert('vehicle', $page_data);
        }
    
    // The function below update vehicle table //
        function updateVehicle($param2){
            $page_data = array(
                'name'                          => html_escape($this->input->post('name')),
                'vehicle_number'                => html_escape($this->input->post('vehicle_number')),
                'vehicle_model'                 => html_escape($this->input->post('vehicle_model')),
                'vehicle_quantity'              => html_escape($this->input->post('vehicle_quantity')),
                'year_made'                     => html_escape($this->input->post('year_made')),
                'driver_name'                   => html_escape($this->input->post('driver_name')),
                'driver_license'                => html_escape($this->input->post('driver_license')),
                'driver_contact'                => html_escape($this->input->post('driver_contact')),
                'description'                   => html_escape($this->input->post('description')),
                'status'                        => html_escape($this->input->post('status'))
            );
    
            $this->db->where('vehicle_id', $param2);
            $this->db->update('vehicle', $page_data);
        }
    
        // The function below delete from vehicle table //
        function deleteVehicle($param2) {
            // Verifica si hay transportes asociados a este vehículo
            $transport_exist = $this->db->where('vehicle_id', $param2)->get('transport')->num_rows() > 0;
        
            if ($transport_exist) {
                // Si hay transportes asociados, muestra un mensaje de error en JavaScript
                $this->session->set_flashdata('error_message', get_phrase('No se puede eliminar este vehículo debido a que tiene transportes asociados'));
                redirect(base_url() . 'transportation/vehicle', 'refresh');
            }
        
            // Si no hay transportes asociados, intenta eliminar el registro del vehículo
            $this->db->where('vehicle_id', $param2);
            $this->db->delete('vehicle');
        }
        
	


	
	
}

