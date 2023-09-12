
<div class="row">
    <div class="col-sm-12">
		<div class="panel panel-info">
            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('Enter Student Score');?></div>
                <div class="panel-body table-responsive">
			
                    <!----CREATION FORM STARTS---->

                	<?php echo form_open(base_url() . 'teacher/student_marksheet_subject' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
                    
                            <div class="form-group">
                                    <label class="col-md-12" for="example-text"><?php echo get_phrase('Exam');?></label>
                                <div class="col-sm-12">
                                    <select name="exam_id" class="form-control select2">
                                        <option value=""><?php echo get_phrase('select_class');?></option>

                                        <?php $exams =  $this->db->get('exam')->result_array();
                                        foreach($exams as $key => $exam):?>
                                        <option value="<?php echo $exam['exam_id'];?>"<?php if($exam_id == $exam['exam_id']) echo 'selected="selected"' ;?>><?php echo $exam['name'];?></option>
                                        <?php endforeach;?>
                                </select>

                                </div>
                            </div>


                            <div class="form-group">
                                    <label class="col-md-12" for="example-text"><?php echo get_phrase('Clase');?></label>
                                <div class="col-sm-12">
                                    <select name="class_id"  class="form-control select2" onchange="show_subjects(this.value)">
                                        <option value=""><?php echo get_phrase('select_class');?></option>

                                        <?php $classes =  $this->db->get('class')->result_array();
                                        foreach($classes as $key => $class):?>
                                        <option value="<?php echo $class['class_id'];?>"<?php if($class_id == $class['class_id']) echo 'selected="selected"' ;?>>Class: <?php echo $class['name'];?></option>
                                        <?php endforeach;?>
                                </select>

                                </div>
                            </div>

								
                            <div class="form-group">
                                <label class="col-md-12" for="example-text"><?php echo get_phrase('Asignatura');?></label>
                                <div class="col-sm-12">
                                    <?php
                                    $current_teacher_id = $this->session->userdata('teacher_id');

                                    $classes = $this->crud_model->get_classes();
                                    foreach ($classes as $key => $row): ?>

                                        <select name="<?php if($class_id == $row['class_id']) echo 'subject_id'; else echo 'temp';?>" id="subject_id_<?php echo $row['class_id'];?>" style="display:<?php if($class_id == $row['class_id']) echo 'block'; else echo 'none';?>" class="form-control">
                                            <option value="">Subject of: <?php echo $row['name'] ;?></option>

                                            <?php
                                            $select_subject_from_model = $this->crud_model->get_subjects_by_class_and_teacher($row['class_id'], $current_teacher_id);
                                            foreach ($select_subject_from_model as $key => $subject_selected_from_model):
                                                // Solo muestra las asignaturas que tengan el mismo teacher_id que el docente actual
                                                if ($subject_selected_from_model['teacher_id'] == $current_teacher_id): ?>
                                                    <option value="<?php echo $subject_selected_from_model['subject_id'];?>"<?php if(isset($subject_id) && $subject_id == $subject_selected_from_model['subject_id']) echo 'selected="selected"';?>><?php echo $subject_selected_from_model['name'];?></option>
                                                <?php endif;
                                            endforeach;?>
                                        </select>
                                    <?php endforeach;?>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-12">
                                    <select name="" id="subject_id_0" style="display:<?php if(isset($subject_id) && $subject_id > 0) echo 'none'; else echo 'block';?>"  class="form-control">
                                        <option value=""><?php echo get_phrase('Selecciona la clase primero');?></option>
                                    </select>
                                </div>
                            </div>
                            
                            <input class="" type="hidden" value="selection" name="operation">
                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-search"></i>&nbsp;<?php echo get_phrase('Get Details');?></button>
                        </div>
		
                    </form>                
            </div>                
		</div>
	</div>
</div>


<?php if($class_id > 0 && $subject_id > 0 && $exam_id > 0):?>	

    <?php $select_student_with_class_id  =   $this->crud_model->get_students($class_id);
            foreach ($select_student_with_class_id as $key => $student_selected_with_class): 

                $verify_data = array('exam_id' => $exam_id, 'class_id' => $class_id, 'subject_id' => $subject_id, 'student_id' => $student_selected_with_class['student_id']);
                $query = $this->db->get_where('mark', $verify_data);

                if($query->num_rows() < 1) {
                    $this->db->insert('mark', $verify_data);
                }
                else {
                    // Calcular el promedio de las 4 notas
                    $marks = $query->result_array();
                    $total_marks = 0;
            
                    foreach ($marks as $mark) {
                        $total_marks += $mark['mark_obtained'];
                    }
            
                    $average_mark = $total_marks / count($marks);
                }
            endforeach;?>


					
    <div class="row">
	<div class="col-sm-12">
		<div class="panel panel-info">
            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('enter_subject_score'); ?></div>
                <div class="panel-body table-responsive">
							   
    					<table cellpadding="0" cellspacing="0" border="0" class="table">
								<thead>
									<tr>
										<td><?php echo get_phrase('Estudiante');?></td>
										<td><?php echo get_phrase('Primer periodo');?></td>
										<td><?php echo get_phrase('Segundo periodo');?></td>
										<td><?php echo get_phrase('Tercer periodo');?></td>
										<td><?php echo get_phrase('Cuarto periodo');?></td>
										<td><?php echo get_phrase('Observaciones');?></td>
                                        <td><?php echo get_phrase('Definitiva');?></td>
									</tr>
								</thead>
                    				<tbody>

        <?php $select_student_with_class_id  =   $this->crud_model->get_students($class_id);
            foreach ($select_student_with_class_id as $key => $student_selected_with_class): 

                $verify_data = array('exam_id' => $exam_id, 'class_id' => $class_id, 'subject_id' => $subject_id, 'student_id' => $student_selected_with_class['student_id']);
                $query = $this->db->get_where('mark', $verify_data);
                $update_student_marks = $query->result_array();

                foreach ($update_student_marks as $key => $general_select):

               
           ?>


<?php
               $this->load->database();

               $query = $this->db->where('id', 1)
                                 ->get('periodtime');
               
               if ($query->num_rows() > 0) {
                   $row = $query->row();
                   $deadline_date_str1 = $row->deadline_date; // Obtener la fecha en formato de cadena
                   $deadline_date_unix1 = strtotime($deadline_date_str1); // Convertir a tiempo Unix
               
                   // Aquí puedes usar la variable $deadline_date_unix como necesites
                   // Por ejemplo, comparar con la fecha actual
               } else {
                   // No se encontraron filas
               }
               
               $currentDate = time();
               
               $disableFields1 = ($currentDate > $deadline_date_unix1);
               
            ?>
            
            <?php
               $this->load->database();

               $query = $this->db->where('id', 2)
                                 ->get('periodtime');
               
               if ($query->num_rows() > 0) {
                   $row = $query->row();
                   $deadline_date_str2 = $row->deadline_date; // Obtener la fecha en formato de cadena
                   $deadline_date_unix2 = strtotime($deadline_date_str2); // Convertir a tiempo Unix
               
                   // Aquí puedes usar la variable $deadline_date_unix como necesites
                   // Por ejemplo, comparar con la fecha actual
               } else {
                   // No se encontraron filas
               }
               
               $currentDate = time();
               
               $disableFields2 = ($currentDate > $deadline_date_unix2);
               
            ?>

            <?php
               $this->load->database();

               $query = $this->db->where('id', 3)
                                 ->get('periodtime');
               
               if ($query->num_rows() > 0) {
                   $row = $query->row();
                   $deadline_date_str3 = $row->deadline_date; // Obtener la fecha en formato de cadena
                   $deadline_date_unix3 = strtotime($deadline_date_str3); // Convertir a tiempo Unix
               
                   // Aquí puedes usar la variable $deadline_date_unix como necesites
                   // Por ejemplo, comparar con la fecha actual
               } else {
                   // No se encontraron filas
               }
               
               $currentDate = time();
               
               $disableFields3 = ($currentDate > $deadline_date_unix3);
               
            ?>

            <?php
               $this->load->database();

               $query = $this->db->where('id', 4)
                                 ->get('periodtime');
               
               if ($query->num_rows() > 0) {
                   $row = $query->row();
                   $deadline_date_str4 = $row->deadline_date; // Obtener la fecha en formato de cadena
                   $deadline_date_unix4 = strtotime($deadline_date_str4); // Convertir a tiempo Unix
               
                   // Aquí puedes usar la variable $deadline_date_unix como necesites
                   // Por ejemplo, comparar con la fecha actual
               } else {
                   // No se encontraron filas
               }
               
               $currentDate = time();
               
               $disableFields4 = ($currentDate > $deadline_date_unix4);
               
            ?>
                    	
										
			<?php echo form_open(base_url() . 'teacher/student_marksheet_subject/'. $exam_id . '/' . $class_id);?>
						<tr>
											<td>
												<?php echo $student_selected_with_class['name'];?>
											</td>
											<td>
                                                <?php if ($disableFields1): ?>
                                                    <input type="hidden" 
                                                        value="<?php echo $general_select['class_score1']; ?>" 
                                                        name="class_score1_<?php echo $student_selected_with_class['student_id']; ?>">
                                                    <input type="number" class="class_score form-control" 
                                                        value="<?php echo $general_select['class_score1']; ?>"
                                                        name="class_score1_disabled_<?php echo $student_selected_with_class['student_id']; ?>" 
                                                        disabled>
                                                <?php else: ?>
                                                    <input type="number" class="class_score form-control" 
                                                        value="<?php echo $general_select['class_score1']; ?>" step="0.1" lang="en"
                                                        name="class_score1_<?php echo $student_selected_with_class['student_id']; ?>" 
                                                        onchange="class_score_change()">
                                                <?php endif; ?>
                                            </td>

                                            <td>
                                                <?php if ($disableFields2): ?>
                                                    <input type="hidden" 
                                                        value="<?php echo $general_select['class_score2']; ?>" 
                                                        name="class_score2_<?php echo $student_selected_with_class['student_id']; ?>">
                                                    <input type="number" class="class_score form-control" 
                                                        value="<?php echo $general_select['class_score2']; ?>"
                                                        name="class_score2_disabled_<?php echo $student_selected_with_class['student_id']; ?>" 
                                                        disabled>
                                                <?php else: ?>
                                                    <input type="number" class="class_score form-control" 
                                                        value="<?php echo $general_select['class_score2']; ?>" step="0.1" lang="en"
                                                        name="class_score2_<?php echo $student_selected_with_class['student_id']; ?>" 
                                                        onchange="class_score_change()">
                                                <?php endif; ?>
                                            </td>

                                            <td>
                                                <?php if ($disableFields3): ?>
                                                    <input type="hidden" 
                                                        value="<?php echo $general_select['class_score3']; ?>" 
                                                        name="class_score3_<?php echo $student_selected_with_class['student_id']; ?>">
                                                    <input type="number" class="class_score form-control" 
                                                        value="<?php echo $general_select['class_score3']; ?>"
                                                        name="class_score3_disabled_<?php echo $student_selected_with_class['student_id']; ?>" 
                                                        disabled>
                                                <?php else: ?>
                                                    <input type="number" class="class_score form-control" 
                                                        value="<?php echo $general_select['class_score3']; ?>" step="0.1" lang="en"
                                                        name="class_score3_<?php echo $student_selected_with_class['student_id']; ?>" 
                                                        onchange="class_score_change()">
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($disableFields4): ?>
                                                    <input type="hidden" 
                                                        value="<?php echo $general_select['exam_score']; ?>" 
                                                        name="exam_score_<?php echo $student_selected_with_class['student_id']; ?>">
                                                    <input type="number" class="exam_score form-control" 
                                                        value="<?php echo $general_select['exam_score']; ?>"
                                                        name="exam_score_disabled_<?php echo $student_selected_with_class['student_id']; ?>" 
                                                        disabled>
                                                <?php else: ?>
                                                    <input type="number" class="exam_score form-control" 
                                                        value="<?php echo $general_select['exam_score']; ?>" step="0.1" lang="en"
                                                        name="exam_score_<?php echo $student_selected_with_class['student_id']; ?>" 
                                                        onchange="exam_score_change()">
                                                <?php endif; ?>
                                            </td>
			
											<td>
												<textarea name="comment_<?php echo $student_selected_with_class['student_id'];?>" class="form-control"><?php echo $general_select['comment'];?></textarea>
											</td>
                                            <td>
                                                <?php
                                                    // Calcular el promedio de las 4 notas
                                                    $total_marks = (
                                                        $general_select['class_score1'] + 
                                                        $general_select['class_score2'] + 
                                                        $general_select['class_score3'] + 
                                                        $general_select['exam_score']
                                                    );
                                                    $average_mark = $total_marks / 4;
                                                    echo number_format($average_mark, 1); // Mostrar el promedio con dos decimales
                                                ?>
                                            </td>
												<input type="hidden" name="mark_id_<?php echo $student_selected_with_class['student_id'] ;?>" value="<?php echo $general_select['mark_id'];?>" />
												
												<input type="hidden" name="exam_id" value="<?php echo $exam_id;?>" />
												<input type="hidden" name="class_id" value="<?php echo $class_id;?>" />
												<input type="hidden" name="subject_id" value="<?php echo $subject_id;?>" />
												
												<input type="hidden" name="operation" value="update_student_subject_score" />
						</tr>

        <?php 
            endforeach;
                endforeach;
        ?>

                            
                         	
                    </tbody>
               </table>
              <h5 id="error_message" class="alert alert-warning" style="display:none">La nota no debe ser menor a 1 ni mayor a 5</h5>
                      <button type="submit" class="btn btn-sm btn-rounded btn-block  btn-info"><i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('update_marks');?></button>
                 
                  <?php echo form_close();?>
            
			</div>
        </div>
	</div>
 </div>

<?php endif;?>



<script type="text/javascript">
    function show_subjects(class_id){
            for(i=0;i<=50;i++){
                try{
                    document.getElementById('subject_id_'+i).style.display = 'none' ;
                    document.getElementById('subject_id_'+i).setAttribute("name" , "temp");
                }
                catch(err){}
            }
            if (class_id == "") {
                class_id = "0";
        }
        document.getElementById('subject_id_'+class_id).style.display = 'block' ;
        document.getElementById('subject_id_'+class_id).setAttribute("name" , "subject_id");
        var subject_id = $(".subject_id");
        for(var i = 0; i < subject_id.length; i++)
            subject_id[i].selected = "";
    }


function class_score_change() {
  var class_scores = document.getElementsByClassName('class_score');
    for (var i = class_scores.length - 1; i >= 0; i--) {
      var value = class_scores[i].value;
        if (value < 1 || value > 5) {
            class_scores[i].value = 0;
                $('#error_message').show();
        }
    }
}
 

function exam_score_change() {
  var exam_scores = document.getElementsByClassName('exam_score');
    for (var i = exam_scores.length - 1; i >= 0; i--) {
      var value = exam_scores[i].value;
        if (value < 1 || value > 5) {
            exam_scores[i].value = 0;
                $('#error_message').show();
        }
    }
}
</script>