<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Transportation extends CI_Controller { 

            function __construct() {
                parent::__construct();
                        $this->load->database();
                        $this->load->library('session');	
                        $this->load->model('transportation_model');                      // Load Model Here	
            }


            function transport ($param1 = '', $param2 ='', $param3 =''){

                if($param1 == 'insert'){
                    $this->transportation_model->insertTransportFunction();
                    $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
                    redirect(base_url(). 'transportation/transport', 'refresh');
                }
        
                if($param1 == 'update'){
                    $this->transportation_model->updateTransportFunction($param2);
                    $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
                    redirect(base_url(). 'transportation/transport', 'refresh');
                }
        
        
                if($param1 == 'delete'){
                    $this->transportation_model->deleteTransportFunction($param2);
                    $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
                    redirect(base_url(). 'transportation/transport', 'refresh');
                    }
        
        
                $page_data['page_name']     = 'transport';
                $page_data['page_title']    = get_phrase('Gestion de transporte');
                $this->load->view('backend/index', $page_data);
        
                }

            

                function transport_route ($param1 = '', $param2 ='', $param3 =''){

                    if($param1 == 'insert'){
                        $this->transportation_model->insertTransportRoute();
                        $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
                        redirect(base_url(). 'transportation/transport_route', 'refresh');
                    }
            
                    if($param1 == 'update'){
                        $this->transportation_model->updateTransportRoute($param2);
                        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
                        redirect(base_url(). 'transportation/transport_route', 'refresh');
                    }
            
            
                    if($param1 == 'delete'){
                        $this->transportation_model->deleteTransportRoute($param2);
                        $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
                        redirect(base_url(). 'transportation/transport_route', 'refresh');
                        }
            
            
                    $page_data['page_name']     = 'transport_route';
                    $page_data['page_title']    = get_phrase('Ruta de transporte');
                    $this->load->view('backend/index', $page_data);
            
                    }

                    function vehicle ($param1 = '', $param2 ='', $param3 =''){

                        if ($param1 == 'insert') {
                            $vehicle_number = $this->input->post('vehicle_number');
                        
                            // Verificar si el número de placa ya existe en la tabla
                            $existing_vehicle = $this->db->get_where('vehicle', array('vehicle_number' => $vehicle_number))->row();
                        
                            if ($existing_vehicle) {
                                // Si el número de placa ya existe, muestra un mensaje de error
                                $this->session->set_flashdata('error_message', 'El número de placa ya se encuentra registrado');
                                redirect(base_url() . 'transportation/vehicle', 'refresh');
                            } else {
                                // Si no existe, procede a insertar el nuevo vehículo
                                $this->transportation_model->insertVehicle();
                                $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
                                redirect(base_url() . 'transportation/vehicle', 'refresh');
                            }
                        }
                        
                
                        if ($param1 == 'update') {
                            $vehicle_number = $this->input->post('vehicle_number');
                            $vehicle_id = $param2; // Obtener el vehicle_id del parámetro
                        
                            // Obtén los datos actuales del vehículo
                            $current_vehicle = $this->db->get_where('vehicle', array('vehicle_id' => $vehicle_id))->row();
                        
                            // Verifica si los nuevos valores son diferentes de los valores actuales
                            if ($vehicle_number !== $current_vehicle->vehicle_number) {
                                // Verificar si el nuevo número de placa ya existe en la tabla
                                $existing_vehicle = $this->db->get_where('vehicle', array('vehicle_number' => $vehicle_number))->row();
                        
                                if ($existing_vehicle) {
                                    // Si el número de placa ya existe y no es el mismo vehicle_id, muestra un mensaje de error
                                    $this->session->set_flashdata('error_message', 'El número de placa ya se encuentra registrado');
                                    redirect(base_url() . 'transportation/vehicle', 'refresh');
                                    return; // Detiene la ejecución para evitar la actualización
                                }
                            }
                        
                            // Si no hay duplicados o si los valores no han cambiado, procede con la actualización del vehículo
                            $this->transportation_model->updateVehicle($param2);
                            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
                            redirect(base_url() . 'transportation/vehicle', 'refresh');
                        }
                        
                
                
                        if($param1 == 'delete'){
                            $this->transportation_model->deleteVehicle($param2);
                            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
                            redirect(base_url(). 'transportation/vehicle', 'refresh');
                            }
                
                
                        $page_data['page_name']     = 'vehicle';
                        $page_data['page_title']    = get_phrase('Gestion de vehiculos');
                        $this->load->view('backend/index', $page_data);
                
            }





}