<?php $material = $this->db->get_where('material', array('material_id' => $param2))->result_array();
            foreach($material as $key => $material):?>
<div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">EDITAR MATERIAL DE ESTUDIO</div>
                                <div class="panel-body">
                <?php echo form_open(base_url().'studymaterial/study_material/update/'. $param2 , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	


                <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('nombre');?></label>
                    <div class="col-sm-12">
                                    <input type="text" class="form-control" value="<?php echo $material['name'];?>" name="name" / required>
                        </div>
                    </div>


                    <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('clase');?></label>
                    <div class="col-sm-12">
                    <select name="class_id" id="class_id" class="form-control select2" onchange="return get_class_subject(this.value)">
                    <option value=""><?php echo get_phrase('select_class');?></option>

                    <?php $class =  $this->db->get('class')->result_array();
                    foreach($class as $key => $class):?>
                    <option value="<?php echo $class['class_id'];?>"<?php if($material['class_id'] == $class['class_id']) echo 'selected';?>><?php echo $class['name'];?></option>
                    <?php endforeach;?>
                   </select>

                  </div>
                 </div>

								
                 <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('asignatura');?></label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="subject_name" readonly>
                        <!-- Campo oculto para almacenar la ID de la asignatura -->
                        <input type="hidden" name="subject_id" id="subject_id" value="<?php echo $material['subject_id']; ?>">
                    </div>
                </div>




                <?php
                // Obtén la información del material que estás editando (de tu base de datos)
                $material_id = 123; // Reemplaza esto con el ID real del material que estás editando
                $material_info = $this->db->get_where('material', array('material_id' => $material_id))->row_array();

                // Si el material existe, configura la fecha actual en el campo "timestamp"
                if (!empty($material_info)) {
                    $material_info['timestamp'] = date('Y-m-d'); // Establece la fecha actual en formato 'YYYY-MM-DD'
                    
                    // Carga la vista de edición con la información actualizada
                    $this->load->view('editar_material', $material_info); // Reemplaza 'editar_material' con la vista real
                } else {
                    // Maneja el caso en el que el material no existe
                }
                ?>


                <?php
                // Establece la zona horaria a Bogotá
                date_default_timezone_set('America/Bogota');

                // Obtiene la fecha actual en el formato deseado (YYYY-MM-DD)
                $currentDate = date('Y-m-d');
                ?>

                <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('fecha');?></label>
                    <div class="col-sm-12">
                        <input type="date" name="timestamp" class="form-control datepicker" id="example-date-input" required readonly value="<?php echo $currentDate; ?>">
                    </div>
                </div>


               <div class="form-group">
                        <label class="col-md-12" for="example-text"><?php echo get_phrase('docente');?></label>
                        <div class="col-sm-12">
                            <input type="hidden" name="teacher_id" value="<?php echo $this->session->userdata('teacher_id'); ?>">
                            <label><?php echo $this->session->userdata('name'); ?></label>
                        </div>
                    </div>


                <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('tipo de archivo');?></label>
                    <div class="col-sm-12">
                       
					   <select name="file_type" class="form-control select2" style="width:100%;" required>
										<option value=""><?php echo get_phrase('file_type');?></option>

                           
                                    		<option value="pdf"<?php if($material['file_type'] == 'pdf') echo 'selected';?>>PDF</option>
                                            <option value="xlsx"<?php if($material['file_type'] == 'xlsx') echo 'selected';?>>Excel</option>
                                            <option value="docx"<?php if($material['file_type'] == 'docx') echo 'selected';?>>Word Document</option>
                                            <option value="img"<?php if($material['file_type'] == 'img') echo 'selected';?>>Image</option>
                                            <option value="txt"<?php if($material['file_type'] == 'txt') echo 'selected';?>>Text File</option>
                          
                                     
                                    </select>              
					    
						
                    </div> 
                </div>


				
				
				<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('descripcion');?></label>
                    <div class="col-sm-12">
                                <textarea  name="description" class="form-control"><?php echo $material['description'];?></textarea>
                            </div>
                        </div>
			

                    
                    <div class="form-group">
							<button type="submit" class="btn btn-info btn-block btn-sm btn-rounded"> <i class="fa fa-edit"></i>&nbsp;<?php echo get_phrase('edit');?></button>
					</div>
					
                <?php echo form_close();?>	
									
									
                            </div>
                        </div>
                    </div>
				</div>  
<?php endforeach;?>



<script type="text/javascript">
    $(document).ready(function() {
        var subjectId = <?php echo $material['subject_id']; ?>;
        $.ajax({
            url: '<?php echo base_url();?>teacher/get_subject_name/' + subjectId,
            success: function(response) {
                $('#subject_name').val(response);

                // Actualiza el valor del campo oculto con la ID de la asignatura
                $('#subject_id').val(subjectId);
            },
            error: function() {
                $('#subject_name').val('Asignatura no encontrada');
            }
        });
    });
</script>



