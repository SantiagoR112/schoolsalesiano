<?php 
$edit_teacher		=	$this->db->get_where('teacher' , array('teacher_id' => $param2) )->result_array();
foreach ( $edit_teacher as $key => $row):
?>
	
            
            
            <div class="row">
                    <div class="col-sm-12">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <?php echo get_phrase('editar_docente');?></div>
						
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                    <?php echo form_open(base_url() . 'admin/teacher/update/'. $row['teacher_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
                        		
                                
                            <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('nombre');?></label>
                    <div class="col-sm-12">
                                    <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"/>
                                </div>
                            </div>
							
							<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('rol');?></label>
                    <div class="col-sm-12">
							<select name="role" class="form-control select2" required>
                                    	<option value="1" <?php if($row['role'] == '1')echo 'selected';?>><?php echo get_phrase('director_de_grupo');?></option>
                                    	<option value="2" <?php if($row['role'] == '2')echo 'selected';?>><?php echo get_phrase('docente_asignatura');?></option>
                          </select>
						</div> 
					</div>
					
					    <div class="form-group">
                            <label class="col-md-12" for="example-text"><?php echo get_phrase('fecha de nacimiento');?></label>
                            <div class="col-sm-12">
                                <input type="date" class="datepicker form-control" name="birthday" value="<?php echo $row['birthday'];?>" max="<?php echo date('Y-m-d', strtotime('-18 years'));?>" />
                            </div>
                        </div>
							
							
                           <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('genero');?></label>
                    <div class="col-sm-12">
                                    <select name="sex" class="form-control selectboxit">
                                    	<option value="masculino" <?php if($row['sex'] == 'masculino')echo 'selected';?>><?php echo get_phrase('masculino');?></option>
                                    	<option value="femenino" <?php if($row['sex'] == 'femenino')echo 'selected';?>><?php echo get_phrase('femenino');?></option>
                                        <option value="otro" <?php if($row['sex'] == 'otro')echo 'selected';?>><?php echo get_phrase('otro');?></option>
                                    </select>
                                </div>
                            </div>
					
					
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('religion');?></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="religion" value="<?php echo $row ['religion']; ?>" >
						</div> 
					</div>
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('direccion');?></label>
                    <div class="col-sm-12">
                                    <input type="text" class="form-control" name="address" value="<?php echo $row['address'];?>"/>
                                </div>
                            </div>
							
					
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('grupo_sanguineo');?></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="blood_group" value="<?php echo $row ['blood_group']; ?>" >
						</div> 
					</div>
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('titulo');?></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="qualification" value="<?php echo $row['qualification'];?>">
						</div>
					</div>
					
					<div class="form-group">
                                    <label class="col-sm-12"><?php echo get_phrase('estado_civil');?>*</label>
                                    <div class="col-sm-12">
														
                                       <select class=" form-control" name="marital_status" required>
									   	<option value="Casado(a)" <?php if($row['marital_status'] == 'casado(a)')echo 'selected';?>><?php echo get_phrase('casado(a)');?></option>
                                    	<option value="soltero(a)" <?php if($row['marital_status'] == 'soltero(a)')echo 'selected';?>><?php echo get_phrase('soltero(a)');?></option>
										<option value="divorciado(a)" <?php if($row['marital_status'] == 'divorciado(a)')echo 'selected';?>><?php echo get_phrase('divorciado(a)');?></option>
                                    	<option value="comprometido(a)" <?php if($row['marital_status'] == 'comprometido(a)')echo 'selected';?>><?php echo get_phrase('comprometido(a)');?></option>
                                    </select>
                                    </div>
                                </div>
					
					
					<div class="form-group"> 
					 <label class="col-sm-12"><?php echo get_phrase('buscar_imagen');?>*</label>        
					 <div class="col-sm-12">
  		  			 <input type='file' class="form-control" name="userfile"/>
       				 <img id="blah" src="<?php echo $this->crud_model->get_image_url('teacher',$row['teacher_id']);?>" alt="" height="200" width="200"/>

					</div>
					</div>	
					
					
					<div class="row">
                    <div class="col-sm-6">
                        <div class="white-box">
                            <h3 class="box-title"><?php echo get_phrase('Informacion de cuenta');?></h3>
                          
                                <div class="form-group">
                                    <label class="col-md-12" for="example-email"><?php echo get_phrase('correo electronico');?>*</span>
                                    </label>
                                    <div class="col-md-12">
                                        <input type="email" id="example-email" name="email" class="form-control m-r-10" value="<?php echo $row['email']; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12" for="example-phone"><?php echo get_phrase('phone');?>*</span>
                                    </label>
                                    <div class="col-md-12">
                               <input type="text" id="example-phone" name="phone" class="form-control" value="<?php echo $row['phone']; ?>" required>
                                    </div>
                                </div>
								
								 <div class="form-group">
                                    <label class="col-md-12" for="inurl"><?php echo get_phrase('linkedin');?></span>
                                    </label>
                                    <div class="col-md-12">
                                        <input type="text" id="inurl" name="linkedin" class="form-control" value="<?php echo $row['linkedin']; ?>">
                                    </div>
                                </div>
								
								
                        </div>
                    </div>
				
						 
						<div class="col-sm-6">
                        <div class="white-box">
                            <h3 class="box-title"><?php echo get_phrase('informacion_social');?></h3>
                          
                                <div class="form-group">
                                    <label class="col-md-12" for="furl"><?php echo get_phrase('facebook');?>*</span>
                                    </label>
                                    <div class="col-md-12">
                                        <input type="text" id="furl" name="facebook" value="<?php echo $row['facebook']; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12" for="turl"><?php echo get_phrase('twitter');?>*</span>
                                    </label>
                                    <div class="col-md-12">
                                        <input type="text" id="turl" name="twitter" class="form-control" value="<?php echo $row['twitter']; ?>" >
                                    </div>
                                </div>
                                <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('googleplus');?></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="googleplus" value="<?php echo $row['googleplus'];?>">
						</div>
					</div>
                              
					
  
<div class="form-group">
<button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-edit"></i>&nbsp;&nbsp;<?php echo get_phrase('Editar docente');?></button>
</div>
                <?php echo form_close();?>
</div>
</div>
</div>
</div>
</div>

<?php endforeach;?>
