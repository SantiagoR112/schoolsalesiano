<?php $class = $this->db->get_where('class', array('class_id' => $param2))->result_array();
foreach ($class as $key => $class):?>
<div class="row">
                    <div class="col-sm-12">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('editar_clases');?></div>
                                <div class="panel-body table-responsive">
			
<!----CREATION FORM STARTS---->

                	<?php echo form_open(base_url() . 'admin/classes/update/' . $param2 , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                            <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('nombre');?></label>
                    <div class="col-sm-12">
                                    <input type="text" class="form-control" name="name" value="<?php echo $class['name'];?>">
                                </div>
                            </div>

								<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('nombre_numerico');?></label>
                    <div class="col-sm-12">
                                    <input type="text" class="form-control" name="name_numeric" value="<?php echo $class['name_numeric'];?>">
                                </div>
                            </div>

								
				<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('docente');?></label>
                    <div class="col-sm-12">
                    <select name="teacher_id" class="form-control select2" required>
                        <option value=""><?php echo get_phrase('Seleccionar docente');?></option>

                        <?php
                        $teachers = $this->db->where('role', 1)->get('teacher')->result_array();

                        foreach ($teachers as $teacher):
                            $selected = ($class['teacher_id'] == $teacher['teacher_id']) ? 'selected' : '';
                        ?>
                        <option value="<?php echo $teacher['teacher_id'];?>" <?php echo $selected; ?>>
                            <?php echo $teacher['name'];?>
                        </option>
                        <?php endforeach;?>
                    </select>

                            </div>
                        </div>
                        <div class="form-group">
                                  <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-edit"></i>&nbsp;<?php echo get_phrase('editar_clase');?></button>
							</div>
							
                    </form>                
                </div>                
		</div>
	</div>
</div>
<?php endforeach;?>