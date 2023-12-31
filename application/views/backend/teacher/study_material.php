<div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
							
							MATERIAL DE ESTUDIO
						   
						   
                                <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="fa fa-plus"></i>&nbsp;&nbsp;AGREGAR NUEVO MATERIAL DE ESTUDIO<i class="btn btn-info btn-xs"></i></a> <a href="#" data-perform="panel-dismiss"></a> </div>
                            </div>
                            <div class="panel-wrapper collapse out" aria-expanded="true">
                                <div class="panel-body">
                <?php echo form_open(base_url().'studymaterial/study_material/insert' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	


                <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('nombre');?></label>
                    <div class="col-sm-12">
                                    <input type="text" class="form-control" name="name" / required>
                        </div>
                    </div>


                    <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('clase');?></label>
                    <div class="col-sm-12">
                    <select name="class_id" id="class_id" class="form-control select2" onchange="return get_class_subject(this.value)">
                    <option value=""><?php echo get_phrase('seleccionar_clase');?></option>

                    <?php $class =  $this->db->get('class')->result_array();
                    foreach($class as $key => $class):?>
                    <option value="<?php echo $class['class_id'];?>"><?php echo $class['name'];?></option>
                    <?php endforeach;?>
                   </select>

                  </div>
                 </div>

								
					<div class="form-group">
                            <label class="col-md-12" for="example-text"><?php echo get_phrase('asignatura');?></label>
                            <div class="col-sm-12">
                                <select name="subject_id" class="form-control" id="subject_selector_holder">
                                <option value=""><?php echo get_phrase('seleccionar_asignatura');?></option>
                                </select>
                            </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-12" for="example-text"><?php echo get_phrase('fecha');?></label>
                        <div class="col-sm-12">
                            <input type="date" name="timestamp" class="form-control datepicker" id="example-date-input" required readonly>
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

                           
                                    		<option value="pdf">PDF</option>
                                            <option value="xlsx">Excel</option>
                                            <option value="docx">Documento de word</option>
                                            <option value="img">Imagen</option>
                                            <option value="txt">Archivo texto</option>
                          
                                     
                                    </select>              
					    
						
                    </div> 
                </div>


				
				
				<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('descripcion');?></label>
                    <div class="col-sm-12">
                                <textarea  name="description" class="form-control textarea_editor"></textarea>
                            </div>
                        </div>
				
				
							
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('seleccionar_documento');?></label>
                    <div class="col-sm-12">
                    <input type="file" name="file_name" class="dropify" required>
                    </div></div>
							
						

                    
                    <div class="form-group">
							<button type="submit" class="btn btn-info btn-block btn-sm btn-rounded"> <i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('agregar_material');?></button>
					</div>
					<br>
                <?php echo form_close();?>	
									
									
                                </div>
                            </div>
                        </div>
                    </div>
				</div>  
  
  
  
  
  <div class="row">
                    <div class="col-sm-12">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;<?php echo get_phrase('lista material de estudio');?></div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body table-responsive">
								
<table id="example23" class="display nowrap" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>#</th>
            <th><?php echo get_phrase('tipo_archivo');?></th>
            <th><?php echo get_phrase('titulo');?></th>
            <th><?php echo get_phrase('clase');?></th>
            <th><?php echo get_phrase('asignatura');?></th>
            <th><?php echo get_phrase('docente');?></th>
            <th><?php echo get_phrase('descripcion');?></th>
            <th><?php echo get_phrase('opciones');?></th>
        </tr>
    </thead>

    <tbody>

    <?php
        $counter = 1;
        $teacher_id = $this->session->userdata('teacher_id'); // Obtener el ID del docente de la sesión actual
        $materials = $this->db->get_where('material', array('teacher_id' => $teacher_id))->result_array();

        foreach ($materials as $key => $material):
        ?>
        <tr>
            <td><?php echo $counter++; ?></td>
            <td>
                <?php if ($material['file_type'] == 'img' || $material['file_type'] == 'jpg' || $material['file_type'] == 'png') { ?>
                    <img src="<?php echo base_url(); ?>optimum/images/image.png" style="max-height:40px;">
                <?php } ?>
                <?php if ($material['file_type'] == 'docx') { ?>
                    <img src="<?php echo base_url(); ?>optimum/images/doc.jpg" style="max-height:40px;">
                <?php } ?>
                <?php if ($material['file_type'] == 'pdf') { ?>
                    <img src="<?php echo base_url(); ?>optimum/images/pdf.jpg" style="max-height:40px;">
                <?php } ?>
                <?php if ($material['file_type'] == 'xlsx') { ?>
                    <img src="<?php echo base_url(); ?>optimum/images/text.png" style="max-height:40px;">
                <?php } ?>
                <?php if ($material['file_type'] == 'txt') { ?>
                    <img src="<?php echo base_url(); ?>optimum/images/text.png" style="max-height:40px;">
                <?php } ?>

            </td>
            <td><?php echo $material['name']; ?></td>
            <td><?php echo $this->db->get_where('class', array('class_id' => $material['class_id']))->row()->name; ?></td>
            <td><?php echo $this->db->get_where('subject', array('subject_id' => $material['subject_id']))->row()->name; ?></td>
            <td><?php echo $this->db->get_where('teacher', array('teacher_id' => $material['teacher_id']))->row()->name; ?></td>
            <td><?php echo $material['description']; ?></td>
            <td>
                <a href="<?php echo base_url() . 'uploads/study_material/' . $material['file_name']; ?>"><button type="button"
                        class="btn btn-info btn-circle btn-xs"><i class="fa fa-download"></i></button></a>
                <a onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/edit_study_material/<?php echo $material['material_id']; ?>');"><button
                        type="button" class="btn btn-success btn-circle btn-xs"><i class="fa fa-pencil"></i></button></a>
                <a href="<?php echo base_url(); ?>studymaterial/study_material/delete/<?php echo $material['material_id']; ?>"><button
                        type="button" class="btn btn-danger btn-circle btn-xs"
                        onclick="return confirm('¿Estas seguro de eliminar esto?');"><i class="fa fa-times"></i></button></a>


            </td>
        </tr>
        <?php endforeach; ?>

    </tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<script type="text/javascript">

function get_class_subject(class_id) {
    // Obtener la ID del docente de la sesión de PHP
    var teacher_id = <?php echo $this->session->userdata('teacher_id'); ?>;
    
    $.ajax({
        url: '<?php echo base_url();?>teacher/get_class_subject/' + class_id + '/' + teacher_id,
        success: function (response) {
            jQuery('#subject_selector_holder').html(response);
        }
    });
}


</script>


<script type="text/javascript">
    // Obtén la fecha y hora actual en UTC
    var currentDateUTC = new Date();

    // Calcula la diferencia horaria para Bogotá (UTC-5)
    var offset = -5 * 60; // 5 horas menos en minutos

    // Calcula la fecha y hora en Bogotá agregando la diferencia horaria
    var currentDateBogota = new Date(currentDateUTC.getTime() + offset * 60000);

    // Formatea la fecha como "YYYY-MM-DD" (similar al formato de entrada del campo date)
    var formattedDate = currentDateBogota.toISOString().substr(0, 10);

    // Establece la fecha actual en el campo de fecha (readonly)
    document.getElementById("example-date-input").value = formattedDate;
</script>







