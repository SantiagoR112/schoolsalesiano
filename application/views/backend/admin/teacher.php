<style>
	.required {
    color: red; /* Cambia el color del asterisco según tus preferencias */
    margin-left: 5px; /* Agrega espacio entre el texto y el asterisco */
}
</style>

  <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-info">
                            <div class="panel-heading"><?php echo get_phrase('Nuevo_docente');?>
                                <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="fa fa-plus"></i>&nbsp;&nbsp;Agregar Nuevo docente aqui<i class="btn btn-info btn-xs"></i></a> <a href="#" data-perform="panel-dismiss"></a> </div>
                            </div>
                            <div class="panel-wrapper collapse out" aria-expanded="true">
                                <div class="panel-body">
                                    
									
								 <?php echo form_open(base_url() . 'admin/teacher/insert/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
					<div class="row">
                    <div class="col-sm-6">

                    <div class="form-group">
                 	<label class="col-md-12" for="example-text">Numero de documento<span class="required">*</span></label>
                    <div class="col-sm-12">
							<input type="number" class="form-control" name="teacher_id" value="" required autofocus>
						</div> 
					</div>

					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('nombre');?><span class="required">*</span></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="name" required>
							<input type="text" class="form-control" value="<?php echo substr(md5(uniqid(rand(), true)), 0, 7); ?>" name="teacher_number" readonly="true">
						</div>
					</div>
					
					
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('rol');?><span class="required">*</span></label>
                    <div class="col-sm-12">
							<select name="role" class="form-control select2" style="width:100%" required>
                              <option value=""><?php echo get_phrase('seleccionar');?></option>
                              <option value="1"><?php echo get_phrase('director_de_grupo');?></option>
                              <option value="2"><?php echo get_phrase('docente_asignatura');?></option>
                          </select>
						</div> 
					</div>
					
					<div class="form-group">
                        <label class="col-md-12" for="example-text"><?php echo get_phrase('fecha de nacimiento');?><span class="required">*</span></label>
                        <div class="col-sm-12">
                            <input class="form-control m-r-10" name="birthday" type="date" value="2000-08-19" id="example-date-input" max="<?php echo date('Y-m-d', strtotime('-18 years'));?>" required>
                        </div> 
					</div>
					
						<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('genero');?><span class="required">*</span></label>
                    <div class="col-sm-12">
							<select name="sex" class="form-control select2" style="width:100%" required>
                              <option value=""><?php echo get_phrase('seleccionar');?></option>
                              <option value="masculino"><?php echo get_phrase('masculino');?></option>
                              <option value="femenino"><?php echo get_phrase('femenino');?></option>
                          </select>
						</div> 
					</div>
					
						<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('religion');?></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="religion" value="" >
						</div> 
					</div>
					
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('grupo_sanguineo');?><span class="required">*</span></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="blood_group" value="" required>
						</div> 
					</div>
					
						<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('direccion');?><span class="required">*</span></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="address" value="" required>
						</div> 
					</div>
				<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('telefono');?><span class="required">*</span></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="phone" value="" required >
						</div> 
					</div>
                    
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('correo electronico');?><span class="required">*</span></label>
                    <div class="col-sm-12">
							<input type="email" class="form-control" name="email" value="" required>
						</div>
					</div>
					
					
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('titulo');?></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="qualification" value="">
						</div>
					</div>
					
					<div class="form-group">
                                    <label class="col-sm-12"><?php echo get_phrase('estado_civil');?>*</label>
                                    <div class="col-sm-12">
                                       <select class=" form-control select2" name="marital_status" style="width:100%" required>
                                         <option data-tokens=""><?php echo get_phrase('seleccionar_estado_civil');?></option>
										<option data-tokens="casado(a)"><?php echo get_phrase('casado(a)');?></option>
                                        <option data-tokens="soltero(a)"><?php echo get_phrase('soltero(a)');?></option>
                                        <option data-tokens="divorciado(a)"><?php echo get_phrase('divorciado(a)');?></option>
                                        <option data-tokens="comprometido(a)"><?php echo get_phrase('comprometido(a)');?></option>
                                    </select>
                                    </div>
                                </div>
					
				<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('facebook');?></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="facebook" value="">
						</div>
					</div>
					
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('twitter');?></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="twitter" value="">
						</div>
					</div>
					
						<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('googleplus');?></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="googleplus" value="">
						</div>
					</div>
					
						<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('linkedin');?></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="linkedin" value="">
						</div>
					</div>
					
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('documento');?>&nbsp;(Hoja de vida u otro)<span class="required">*</span></label>
                    <div class="col-sm-12">
             	<input type="file" name="file_name" class="dropify" required>
			 
			  <p style="color:red">Se acepta zip, pdf, word, excel, rar y otros</p>
			  
					</div>
					</div>
					
				
					</div>	
					
					 <div class="col-sm-6">
					 
					 
					
						<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('Contraseña');?><span class="required">*</span></label>
                    <div class="col-sm-12">
						<input type="password" class="form-control" name="password" value="" onkeyup="CheckPasswordStrength(this.value)" required>
					<strong id="password_strength"></strong>
						</div> 
						</div>

					<div class="form-group"> 
					 <label class="col-sm-12"><?php echo get_phrase('buscar_imagen');?><span class="required">*</span></label>        
					 <div class="col-sm-12">
  		  			  <input type='file' name="userfile" class="dropify" onChange="readURL(this);" / required>
					 
					</div>
					</div>	
					 
					 
		<hr>

<div class="form-group">
    <label class="col-sm-12"><?php echo get_phrase('fecha_de_ingreso'); ?><span class="required">*</span></label>

    <div class="col-sm-12">
        <input type="date" class="form-control datepicker" name="date_of_joining" value="<?php echo date('Y-d-m');?>" required>
    </div> 
</div>

<div class="form-group">
    <label class="col-sm-12"><?php echo get_phrase('estado'); ?><span class="required">*</span></label>

    <div class="col-sm-12">
        <select name="status" class="form-control select2" required>
            <option value="1"><?php echo get_phrase('activo'); ?></option>
            <option value="2"><?php echo get_phrase('inactivo'); ?></option>
        </select>
    </div> 
</div>
<div class="form-group">
    <label class="col-sm-12"><?php echo get_phrase('Fecha_de_salida'); ?><span class="required">*</span></label>

    <div class="col-sm-12">
        <input type="date" class="form-control datepicker" name="date_of_leaving" value="" required>
    </div> 
</div>



</div>
</div>
					
					

<div class="form-group">			
<button type="submit" class="btn btn-primary btn-rounded btn-block btn-sm"> <i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('agregar_docente');?></button>
<img id="install_progress" src="<?php echo base_url() ?>assets/images/loader-2.gif" style="margin-left: 20px; display: none"/>					
</div>			
                    
                    
                <?php echo form_close();?>	
									
									
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
					
            <div class="row">
                    <div class="col-sm-12">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;<?php echo get_phrase('listado_docentes');?></div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body table-responsive">
			
                                <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><div><?php echo get_phrase('N. de documento');?></div></th>
                            <th width="80"><div><?php echo get_phrase('imagen');?></div></th>
                            <th><div><?php echo get_phrase('nombre');?></div></th>
                            <th><div><?php echo get_phrase('rol');?></div></th>
                            <th><div><?php echo get_phrase('correo electronico');?></div></th>
                            <th><div><?php echo get_phrase('genero');?></div></th>
                            <th><div><?php echo get_phrase('direccion');?></div></th>
                            <th><div><?php echo get_phrase('opciones');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
        <?php foreach($select_teacher as $key => $teacher){ ?>
                        <tr>
                            <td><?php echo $teacher['teacher_id'];?></td>
                            <td><img src="<?php echo $this->crud_model->get_image_url('teacher', $teacher['teacher_id']);?>" class="img-circle" width="30px"></td>
                            <td><?php echo $teacher['name'];?></td>
                            <td>
                                
                           <?php if($teacher['role']== 1) echo 'Director de grupo';?>
                           <?php if($teacher['role']== 2) echo 'Docente asignatura';?>
                        
                            </td>
                            <td><?php echo $teacher['email'];?></td>
                            <td><?php echo $teacher['sex'];?></td>
                            <td><?php echo $teacher['address'];?></td>

                            <td>
														
                            <a onclick="showAjaxModal('<?php echo base_url();?>modal/popup/edit_teacher/<?php echo $teacher['teacher_id'];?>')" class="btn btn-info btn-circle btn-xs"><i class="fa fa-edit"></i></a>
							
<a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/teacher/delete/<?php echo $teacher['teacher_id'];?>');"><button type="button" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-times"></i></button></a>


<a href="<?php echo base_url().'uploads/teacher_image/'.  $teacher['file_name'];?>"><button type="button" class="btn btn-warning btn-circle btn-xs"><i class="fa fa-download"></i></button></a>

                            </td>
                        </tr>

        <?php } ?>
						
                    </tbody>
                </table>



</div>
</div>
</div>
</div>
</div>


<script type="text/javascript">
    
    function get_designation_val(department_id) {
        if(department_id != '')
            $.ajax({
                url: '<?php echo base_url();?>admin/get_designation/' + department_id,
                success: function(response)
                {
                    console.log(response);
                    jQuery('#designation_holder').html(response);
                }
            });
        else
            jQuery('#designation_holder').html('<option value=""><?php echo get_phrase("select_a_department_first"); ?></option>');
    }
    
</script>
