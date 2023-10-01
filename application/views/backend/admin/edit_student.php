<style>
	.required {
    color: red; /* Cambia el color del asterisco según tus preferencias */
    margin-left: 5px; /* Agrega espacio entre el texto y el asterisco */
}
</style>
<?php $students = $this->db->get_where('student', array('student_id' => $student_id))->result_array();
        foreach($students as $key => $student):?>

<div class="row">
<div class="col-sm-12">
<div class="panel panel-info">
                          
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body table-responsive">
								
								
				  	<div class="row panel-body">
                    <div class="col-sm-6">
						

				
                <?php echo form_open(base_url() . 'admin/new_student/update/' .$student_id , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
				<div class="form-group"> 
					 <div class="col-sm-12">
  		  			  <input type='file' name="userfile" onChange="readURL(this);" style="color:red">
       				 <img id="blah"  src="<?php echo base_url();?>uploads/student_image/<?php echo $student['student_id'].'.jpg';?>" alt="your image" height="150" width="150"/ style="border:1px dotted red">
					 
					</div>
					</div>	
					
		
				
						<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('nombre_completo');?><span class="required">*</span></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" value="<?php echo $student['name'];?>" name="name" required autofocus>
						</div>
					</div>

					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('acudiente');?><span class="required">*</span></label>
                    <div class="col-sm-12">
							<select name="parent_id" class="form-control select2" style="width:100%" required>
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
								$parents = $this->db->get('parent')->result_array();
								foreach($parents as $parent):
									?>
                            		<option value="<?php echo $parent['parent_id'];?>"<?php if($student['parent_id'] == $parent['parent_id']) echo 'selected';?>>
										<?php echo $parent['name'];?>
                                    </option>
                                <?php
								endforeach;
							  ?>
                          </select>
						 	<a href="<?php echo base_url();?>admin/parent/"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-plus"></i></button></a>

						</div> 
						</div>
					
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('clase');?><span class="required">*</span></label>
                    <div class="col-sm-12">
							<select name="class_id" class="form-control select2" style="width:100%"id="class_id" 
								data-message-required="<?php echo get_phrase('value_required');?>"
									onchange="return get_class_sections(this.value)">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
								$classes = $this->db->get('class')->result_array();
								foreach($classes as $key => $class):
									?>
                            		<option value="<?php echo $class['class_id'];?>"<?php if($student['class_id'] == $class['class_id']) echo 'selected';?>>
											<?php echo $class['name'];?>
                                            </option>
                                <?php
								endforeach;
							  ?>
                          </select>
		<a href="<?php echo base_url();?>admin/classes/"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-plus"></i></button></a>


						</div> 
					</div>

					<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('calendario');?><span class="required">*</span></label>
                    <div class="col-sm-12">
		                        <select name="section_id" class="form-control select2" style="width:100%" id="section_selector_holder">
		                            <option value=""><?php echo get_phrase('select_class_first');?></option>
			                        
			                    </select>
	                            <a href="<?php echo base_url();?>admin/section/"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-plus"></i></button></a>
			                </div>
					</div>						
					

					<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('fecha_de_nacimiento');?><span class="required">*</span></label>
                    <div class="col-sm-12">
							<input type="text"  value="<?php echo $student['birthday'];?>" class="form-control" name="birthday" required>
						</div> 
					</div>
					
					
					<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('edad');?></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="age" id="age" value="<?php echo $student['age'];?>" readonly="true" / required>
						</div> 
					</div>
					
					<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('lugar de nacimiento');?><span class="required">*</span></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" value="<?php echo $student['place_birth'];?>" name="place_birth" value="" required>
						</div> 
					</div>
					
					<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('genero');?><span class="required">*</span></label>
                    <div class="col-sm-12">
							<select name="sex" class="form-control select2" style="width:100%">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="masculino"<?php if($student['sex']== 'masculino') echo 'selected';?>><?php echo get_phrase('masculino');?></option>
                              <option value="femenino" <?php if($student['femenino']== 'female') echo 'selected';?>><?php echo get_phrase('femenino');?></option>
							  <option value="otro"<?php if($student['otro']== 'otro') echo 'selected';?>><?php echo get_phrase('otro');?></option>
                          </select>
						</div> 
					</div>
					
					<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('lengua_materna');?></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" value="<?php echo $student['m_tongue'];?>" name="m_tongue" value="" >
						</div> 
					</div>
					
					<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('religion');?></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" value="<?php echo $student['religion'];?>" name="religion" value="" >
						</div> 
					</div>
					
					<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('grupo_sanguineo');?><span class="required">*</span></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control"  value="<?php echo $student['blood_group'];?>" name="blood_group" value="" required>
						</div> 
					</div>
					
					<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('direccion');?><span class="required">*</span></label>
                    <div class="col-sm-12">
					<textarea name="address" cols="" class="form-control" rows="" required><?php echo $student['address'];?></textarea>
						</div> 
					</div>
					
					
					<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('municipio');?><span class="required">*</span></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" value="<?php echo $student['city'];?>" name="city" value="" required>
						</div> 
					</div>
					
					<div class="form-group">
                
					</div>
						
			</div>
					
					
					<div class="col-sm-6">
					
				<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('departamento');?><span class="required">*</span></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" value="<?php echo $student['state'];?>" name="state" value="" >
						</div> 
					</div>
					
						<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('nacionalidad');?><span class="required">*</span></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" value="<?php echo $student['nationality'];?>" name="nationality" value="" >
						</div> 
					</div>
					
					<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('telefono');?></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" value="<?php echo $student['phone'];?>" name="phone" value="" >
						</div> 
					</div>
					
					<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('correo electronico');?><span class="required">*</span></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" value="<?php echo $student['email'];?>" name="email" value="" required>
						</div>
					</div>
					

						<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('nombre_colegio_anterior');?></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" value="<?php echo $student['ps_attended'];?>" name="ps_attended" data-validate="required" value="" autofocus>
						</div>
					</div>
					
					<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('direccion_colegio_anterior');?></label>
                    <div class="col-sm-12">
						<textarea name="ps_address" cols=""  class="form-control" rows=""><?php echo $student['ps_address'];?></textarea>
						</div>
					</div>
					
						<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('motivo_de_salida');?></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="ps_purpose" data-validate="required" value="<?php echo $student['ps_purpose'];?>" autofocus>
						</div>
					</div>

						<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('clase_que_cursaba');?></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" value="<?php echo $student['class_study'];?>" name="class_study" data-validate="required" value="" autofocus>
						</div>
					</div>

					<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('fecha_salida');?></label>
                    <div class="col-sm-12">
							<input type="date" value="<?php echo $student['date_of_leaving'];?>" id="example-date-input"  class="form-control datepicker" name="date_of_leaving">

						</div> 
					</div>
					
						<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('fecha_de_admision');?></label>
                    <div class="col-sm-12">
							<input type="date" value="<?php echo $student['am_date'];?>" id="example-date-input" class="form-control datepicker" name="am_date">

						</div> 
					</div>

				<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('certificado_transferencia');?></label>
                    <div class="col-sm-12">
							<select name="tran_cert" class="form-control select2" style="width:100%">
                              <option value=""><?php echo get_phrase('select');?></option>
                              
                            <option value="Si"<?php if($student['tran_cert']== 'Si') echo 'selected';?>>Si</option>
                            <option value="No"<?php if($student['tran_cert']== 'No') echo 'selected';?>>No</option> 
                          </select>
						</div> 
					</div>
					

				<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('hoja_de_calificaciones');?></label>
                    <div class="col-sm-12">
							<select name="mark_join" class="form-control select2" style="width:100%">
                              <option value=""><?php echo get_phrase('select');?></option>
                              
							<option value="Si"<?php if($student['mark_join']== 'Si') echo 'selected';?>>Si</option>
                            <option value="No"<?php if($student['mark_join']== 'No') echo 'selected';?>>No</option> 
                          </select>
							
						</div> 
					</div>

						<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('discapacidad_fisica');?><span class="required">*</span></label>
                    <div class="col-sm-12">
							<select name="physical_h" class="form-control select2" style="width:100%">
                              <option value=""><?php echo get_phrase('select');?></option>
                              
							  <option value="Si"<?php if($student['physical_h']== 'Si') echo 'selected';?>>Si</option>
                            <option value="No"<?php if($student['physical_h']== 'No') echo 'selected';?>>No</option> 
                          </select>
						</div> 
					</div>

						


	<div class="form-group">
                 	<label class="col-md-9" for="example-text"><?php echo get_phrase('ruta_de_transporte');?></label>
                    <div class="col-sm-12">
							<select name="transport_id" class="form-control select2" style="width:100%">
                              <option value=""><?php echo get_phrase('select');?></option>
	                              <?php 
	                              	$transports = $this->db->get('transport')->result_array();
	                              	foreach($transports as $transport):
	                              ?>
                              		<option value="<?php echo $transport['transport_id'];?>"<?php if($student['transport_id']== $transport['transport_id']) echo 'selected';?>><?php echo $transport['name'];?></option>
                          		<?php endforeach;?>
                          </select>
	<a href="<?php echo base_url();?>admin/transport/"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-plus"></i></button></a>

						</div> 
					</div>
					
					

					
					</div>
					</div>
					
					


 <div class="form-group">
						
			<button type="submit" class="btn btn-success btn-sm btn-rounded btn-block"> <i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('editar_estudiante');?></button>
			<img id="install_progress" src="<?php echo base_url() ?>assets/images/loader-2.gif" style="margin-left: 20px; display: none"/>
						
					</div>
					
					
                <?php echo form_close();?>
	
				</div>
			</div>		
		</div>	
    </div> 
</div>

<?php endforeach;?>



<script type="text/javascript">

	function get_class_sections(class_id) {

    	$.ajax({
            url: '<?php echo base_url();?>admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });

    }

</script>


<script type="text/javascript">

	function CheckPasswordStrength(password) {
	var password_strength = document.getElementById("password_strength");

        //TextBox left blank.
        if (password.length == 0) {
            password_strength.innerHTML = "";
            return;
        }

        //Regular Expressions.
        var regex = new Array();
        regex.push("[A-Z]"); //Uppercase Alphabet.
        regex.push("[a-z]"); //Lowercase Alphabet.
        regex.push("[0-9]"); //Digit.
        regex.push("[$@$!%*#?&]"); //Special Character.

        var passed = 0;

        //Validate for each Regular Expression.
        for (var i = 0; i < regex.length; i++) {
            if (new RegExp(regex[i]).test(password)) {
                passed++;
            }
        }

        //Display status.
        var color = "";
        var strength = "";
        switch (passed) {
            case 0:
            case 1:
            case 2:
                strength = "Weak";
                color = "red";
                break;
            case 3:
                 strength = "Medium";
                color = "orange";
                break;
            case 4:
                 strength = "Strong";
                color = "green";
                break;
               
        }
        password_strength.innerHTML = strength;
        password_strength.style.color = color;

if(passed <= 2){
         document.getElementById('show').disabled = true;
        }else{
            document.getElementById('show').disabled = false;
        }

    }

</script>

<script type="text/javascript">
    $(function() {
        $('input[name="birthday"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            maxDate: moment().subtract(5, 'years') // Restricción de fecha máxima a 5 años antes de la fecha actual
        }, 
        function(start, end, label) {
            var years = moment().diff(start, 'years');
            if (years < 5) {
                alert("Debe tener al menos 5 años de edad.");
                // Puedes agregar más lógica aquí para manejar la restricción
            } else {
                $("#age").val(years);
            }
        });
    });
</script>