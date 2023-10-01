<div class="row">
                    <div class="col-sm-5">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('agregar_asignatura');?></div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body table-responsive">
			
<!----CREATION FORM STARTS---->

                	<?php echo form_open(base_url() . 'subject/subject/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                            <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('nombre');?></label>
                    <div class="col-sm-12">
                                    <input type="text" class="form-control" name="name" / required>
                                </div>
                            </div>

                    
                    <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('clase');?></label>
                    <div class="col-sm-12">
                    <select name="class_id" class="form-control select2" required>
                    <option value=""><?php echo get_phrase('seleccionar_clase');?></option>

                    <?php $class =  $this->db->get('class')->result_array();
                    foreach($class as $key => $class):?>
                    <option value="<?php echo $class['class_id'];?>"><?php echo $class['name'];?></option>
                    <?php endforeach;?>
                   </select>

                  </div>
                 </div>

								
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('docente');?></label>
                    <div class="col-sm-12">
                    <select name="teacher_id" class="form-control select2" required>
                    <option value=""><?php echo get_phrase('seleccionar_docente');?></option>

                    <?php $teacher =  $this->db->get('teacher')->result_array();
                    foreach($teacher as $key => $teacher):?>
                    <option value="<?php echo $teacher['teacher_id'];?>"><?php echo $teacher['name'];?></option>
                    <?php endforeach;?>
                   </select>

                  </div>
                 </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-book"></i>&nbsp;<?php echo get_phrase('agregar_asignatura');?></button>
					</div>
							
                    </form>                
                </div>                
			</div>
			</div>
			</div>
			<!----CREATION FORM ENDS-->

                    <div class="col-sm-7">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('listado_asignaturas');?></div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body table-responsive">
                    
                                <div class="form-group">
                    <div class="col-sm-12">
                    <select id="class_id" class="form-control">
                    <option value=""><?php echo get_phrase('seleccionar_clase');?></option>

                    <?php $class =  $this->db->get('class')->result_array();
                    foreach($class as $key => $class):?>
                    <option value="<?php echo $class['class_id'];?>"
                    <?php if($class_id == $class['class_id']) echo 'selected';?>><?php echo $class['name'];?></option>
                    <?php endforeach;?>
                   </select>

                  </div>
                 </div>
                 <button type="button" id="find" class="btn btn-success btn-rounded btn-sm btn-block">Obtener asignaturas</button>
                 <hr>
				
 				<!-- PHP that includes table for subject starts here  ------>
                <div id="data">
                <?php include 'dispalySubjectClasswise.php';?>
                </div>
                <!-- PHP that includes table for subject ends here  ------>


				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {

		$('#class_id').select2();
		$('#find').on('click', function() 
		{
			var class_id = $('#class_id').val();
			 if (class_id == "") {
           $.toast({
            text: 'Please select class before clicking get subject button',
            position: 'top-right',
            loaderBg: '#f56954',
            icon: 'warning',
            hideAfter: 3500,
            stack: 6
        })
            return false;
        }
			$.ajax({
				url: '<?php echo site_url('subject/getsubjectbyClasswise/');?>' + class_id
			}).done(function(response) {
				$('#data').html(response);
			});
		});

	});


</script>
			





            