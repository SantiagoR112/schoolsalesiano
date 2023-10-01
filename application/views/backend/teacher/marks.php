<div class="row">
    <div class="col-sm-12">
		<div class="panel panel-info">
            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('Reporte nota de estudiantes');?></div>
                <div class="panel-body table-responsive">
			
                    <!----CREATION FORM STARTS---->

                	<?php echo form_open(base_url() . 'teacher/marks' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
                    
                            <div class="form-group">
                                    <label class="col-md-12" for="example-text"><?php echo get_phrase('Revision');?></label>
                                <div class="col-sm-12">
                                    <select name="exam_id" class="form-control select2">
                                        <option value=""><?php echo get_phrase('seleccionar');?></option>

                                        <?php $exams =  $this->db->get('exam')->result_array();
                                        foreach($exams as $key => $exam):?>
                                        <option value="<?php echo $exam['exam_id'];?>"<?php if($exam_id == $exam['exam_id']) echo 'selected="selected"' ;?>><?php echo $exam['name'];?></option>
                                        <?php endforeach;?>
                                </select>

                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-12" for="example-text"><?php echo get_phrase('clase');?></label>
                                <div class="col-sm-12">
                                    <select name="class_id" class="form-control select2" onchange="show_students(this.value)">
                                        <option value=""><?php echo get_phrase('select_class');?></option>

                                        <?php
                                        $current_teacher_id = $this->session->userdata('teacher_id');

                                        $classes = $this->db->get_where('class', array('teacher_id' => $current_teacher_id))->result_array();
                                        foreach ($classes as $key => $class):?>
                                            <option value="<?php echo $class['class_id'];?>"<?php if($class_id == $class['class_id']) echo 'selected="selected"' ;?>>Clase: <?php echo $class['name'];?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>


								
                            <div class="form-group">
                                    <label class="col-md-12" for="example-text"><?php echo get_phrase('Estudiante');?></label>
                                <div class="col-sm-12">

                                <?php $classes = $this->crud_model->get_classes();
                                        foreach ($classes as $key => $row): ?>

                                    <select name="<?php if($class_id == $row['class_id']) echo 'student_id'; else echo 'temp';?>" id="student_id_<?php echo $row['class_id'];?>" style="display:<?php if($class_id == $row['class_id']) echo 'block'; else echo 'none';?>"  class="form-control">
                                        <option value="">Estudiante de: <?php echo $row['name'] ;?></option>

                                        <?php $students = $this->crud_model->get_students($row['class_id']);
                                        foreach ($students as $key => $student): ?>
                                        <option value="<?php echo $student['student_id'];?>"<?php if(isset($student_id) && $student_id == $student['student_id']) echo 'selected="selected"';?>><?php echo $student['name'];?></option>
                                        <?php endforeach;?>
                                    </select>
                                <?php endforeach;?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <select name="" id="student_id_0" style="display:<?php if(isset($student_id) && $student_id > 0) echo 'none'; else echo 'block';?>"  class="form-control">
                                        <option value=""><?php echo get_phrase('Selecciona Clase primero');?></option>
                                    </select>
                                </div>
                            </div>
                            
                            <input class="" type="hidden" value="selection" name="operation">
                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-search"></i>&nbsp;<?php echo get_phrase('obtener detalles');?></button>
                        </div>
		
                    </form>                
            </div>                
		</div>
	</div>
</div>


        <?php if ($class_id > 0 && $student_id > 0 && $exam_id > 0): ?>

        <?php
        $current_teacher_id = $this->session->userdata('teacher_id');

        $select_subject_with_class_id = $this->crud_model->get_subjects_by_class_and_teacher($class_id, $current_teacher_id);
        foreach ($select_subject_with_class_id as $key => $class_subject_exam_student): 

            $verify_data = array(
                'exam_id' => $exam_id,
                'class_id' => $class_id,
                'student_id' => $student_id,
                'subject_id' => $class_subject_exam_student['subject_id']
            );

            $query = $this->db->get_where('mark', $verify_data);

            if ($query->num_rows() < 1) {
                $this->db->insert('mark', $verify_data);
            }

        endforeach;?>


       					
    
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-info">
                    <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('Reportes');?></div>
                        <div class="panel-body table-responsive">
                            <div class="form-group">
                                <a href="<?php echo base_url();?>teacher/generateStudentReport/<?php echo $student_id;?>/<?php echo $exam_id;?>" 
                                    class="btn btn-info btn-rounded btn-sm pull-left" style="color:white">
                                    <i class="entypo-print"></i>&nbsp;<?php echo get_phrase('Primer periodo');?>
                                </a>
                                <a href="<?php echo base_url();?>teacher/generateStudentReport2/<?php echo $student_id;?>/<?php echo $exam_id;?>" 
                                    class="btn btn-info btn-rounded btn-sm pull-left" style="color:white">
                                    <i class="entypo-print"></i>&nbsp;<?php echo get_phrase('Segundo periodo');?>
                                </a>
                                <a href="<?php echo base_url();?>teacher/generateStudentReport3/<?php echo $student_id;?>/<?php echo $exam_id;?>" 
                                    class="btn btn-info btn-rounded btn-sm pull-left" style="color:white">
                                    <i class="entypo-print"></i>&nbsp;<?php echo get_phrase('Tercer periodo');?>
                                </a>
                                <a href="<?php echo base_url();?>teacher/generateStudentReport4/<?php echo $student_id;?>/<?php echo $exam_id;?>" 
                                    class="btn btn-info btn-rounded btn-sm pull-left" style="color:white">
                                    <i class="entypo-print"></i>&nbsp;<?php echo get_phrase('Cuarto periodo');?>
                                </a>
                                <a href="<?php echo base_url();?>teacher/printResultSheet/<?php echo $student_id;?>/<?php echo $exam_id;?>" 
                                    class="btn btn-info btn-rounded btn-sm pull-left" style="color:white">
                                    <i class="entypo-print"></i>&nbsp;<?php echo get_phrase('Reporte todos los periodos');?>
                                </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
 


       

<?php endif;?>



<script type="text/javascript">
    function show_students(class_id){
            for(i=0;i<=50;i++){
                try{
                    document.getElementById('student_id_'+i).style.display = 'none' ;
                    document.getElementById('student_id_'+i).setAttribute("name" , "temp");
                }
                catch(err){}
            }
            if (class_id == "") {
                class_id = "0";
        }
        document.getElementById('student_id_'+class_id).style.display = 'block' ;
        document.getElementById('student_id_'+class_id).setAttribute("name" , "student_id");
        var student_id = $(".student_id");
        for(var i = 0; i < student_id.length; i++)
            student_id[i].selected = "";
    }

</script>