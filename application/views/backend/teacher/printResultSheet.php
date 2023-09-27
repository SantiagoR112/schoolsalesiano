<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-body">
                <?php
                $class_name = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
                $section_name = $this->db->get_where('section', array('section_id' => $section_id))->row()->name;
                $system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
                $running_year = $this->db->get_where('settings', array('type' => 'session'))->row()->description;
                $exam_name = $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->name;
                //$nextterm  	   =   $this->db->get_where('general_settings' , array('type'=>'nextterm'))->row()->value;
                ?>

                <?php
                $teacher_id = $this->session->userdata('login_user_id'); // Obtener el ID del maestro desde la sesión

                // Consulta para obtener la información del estudiante utilizando el ID del maestro
                $students = $this->db->get_where('student', array('student_id' => $student_id))->result_array();

                foreach ($students as $row) :
                    $student_id = $row['student_id'];
                    $roll = $row['roll'];
                    $sex = $row['sex'];
                    $total_marks = 0;
                    $total_class_score = 0;

                    $total_grade_point = 0;
                    ?>
                    <div class="print" style="border:1px solid #000; padding-left:5px; padding-right:5px; padding-bottom:5px; padding-top:5px;">
                        <div class="printableArea">
                        <table width="1000" border="0">
                            <tr>
                                <td>
                                        <div class="col-md-2">
                                            <img src="<?php echo base_url();?>uploads/logo.png" class="thumbnail pull-left" height="120">			</div>
                                        
                                        <div class="col-md-8" style="text-align: center;">
                                            <div class="tile-stats tile-white tile-white-primary">
                                                <span style="text-align: center;font-size: 29px;"><?php echo $this->db->get_where('settings' , array('type' =>'system_name'))->row()->description;?></span>
                                                <br/>
                                                <span style="text-align: center;font-size: 18px;"><?php echo $this->db->get_where('settings' , array('type' =>'address'))->row()->description;?></span>
                                                <br/>
                                                <span style="text-align: center;font-size: 22px;">REPORTE FINAL</span>                </div>
                                        </div>
                                        <div class="col-md-2 logo" >
                                            <img src="<?php echo $this->crud_model->get_image_url('student',$row['student_id']);?>" class="thumbnail pull-right" height="120">				</div>
                                    </div></td>
                            </tr>
                        </table>

                        <table width="1000" border="0">
                            <tr>
                                <td style="background:black">&nbsp;</td>
                            </tr>
                        </table>

                        <table width="1000" border="1">

                            <tr>
                                <td>CALENDARIO:</td>
                                <td><?php $section_name = $this->db->get_where('section' , array('class_id' => $class_id))->row()->name; echo $section_name;?></td>
                                <td>AÑO ACADEMICO:</td>
                                <td><?php echo $this->db->get_where('settings' , array('type' =>'session'))->row()->description;?></td>
                                <td>SEXO:</td>
                                <td><?php echo $sex;?></td>
                                <td>INASISTENCIAS:</td>
                                <td><?php echo $this->db->get_where('attendance', array('session' => $running_year, 'student_id' => $student_id))->num_rows(); ?></td>
                            </tr>
                            
                            <tr>
                                <td>NOMBRE ESTUDIANTE:</td>
                                <td><?php echo $row['name'];?></td>
                                <td>NUMERO DE ADMISION:</td>
                                <td><?php echo $roll;?></td>
                                <td>CLASE:</td>
                                <td><?php $class_name = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;echo $class_name;?></td>
                                <td>DIRECTOR DE GRUPO:</td>
                                <td>
                                    <?php
                                    $class_info = $this->db->get_where('class', array('class_id' => $class_id))->row();
                                    $teacher_id = $class_info->teacher_id;
                                    $director_info = $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->row();
                                    echo $director_info->name;
                                    ?>
                                </td>
                            </tr>
                        </table>

                            <br />
                            <table width="1000" style="border:1px solid #CCCCCC">
                                <tr style="background:#CCCCCC">
                                    <td><strong>MATERIAS DEL ESTUDIANTE:</strong></td>
                                    <td><strong>PRIMER PERIODO</strong></td>
                                    <td><strong>SEGUNDO PERIODO</strong></td>
                                    <td><strong>TERCER PERIODO</strong></td>
                                    <td><strong>CUARTO PERIODO</strong></td>
                                    <td><strong>NOTA FINAL</strong></td>
                                    <td><strong>DESEMPEÑO</strong></td>
                                    <td><strong>OBSERVACIONES</strong></td>
                                </tr>

                                <?php
                                $subjects = $this->db->get_where('subject', array('class_id' => $class_id))->result_array();
                                $total_subjects = count($subjects);
                                $total_final_score = 0; // Inicializa la suma de las notas finales
                                foreach ($subjects as $row) :
                                ?>
                                    <tr>
                                        <td><?php echo $row['name']; ?></td>
                                        <?php
                                        $obtained_mark_query = $this->db->get_where('mark', array(
                                            'class_id' => $class_id,
                                            'exam_id' => $exam_id,
                                            'subject_id' => $row['subject_id'],
                                            'student_id' => $student_id
                                        ));
                                        if ($obtained_mark_query->num_rows() > 0) {
                                            $obtained_marks = $obtained_mark_query->row()->exam_score;
                                            $obtained_class_score = $obtained_mark_query->row()->class_score1;
                                            $obtained_class_score2 = $obtained_mark_query->row()->class_score2;
                                            $obtained_class_score3 = $obtained_mark_query->row()->class_score3;
                                            $comment = $obtained_mark_query->row()->comment;
                                            $total_marks += $obtained_marks;
                                            $total_class_score += $obtained_class_score;
                                            $total_class_score2 += $obtained_class_score2;
                                            $total_class_score3 += $obtained_class_score3;
                                            $final_score = ($obtained_marks + $obtained_class_score + $obtained_class_score2 + $obtained_class_score3) / 4;
                                            $total_final_score += $final_score; // Sumar al total de notas finales
                                        }
                                        ?>
                                        <td><?php echo $obtained_class_score; ?></td>
                                        <td><?php echo $obtained_class_score2; ?></td>
                                        <td><?php echo $obtained_class_score3; ?></td>
                                        <td><?php echo $obtained_marks; ?></td>
                                        <td><?php
                                            $a = $obtained_marks;
                                            $b = $obtained_class_score;
                                            $c = $obtained_class_score2;
                                            $d = $obtained_class_score3;

                                            $sum = $a + $b + $c + $d;
                                            $average = $sum / 4;

                                            echo number_format($average,1);
                                            ?></td>
                                        <td>
                                            <?php if ($average >= 1 && $average <= 2.9) : ?>
                                                <p style="color:red"><?php echo 'Bajo'; ?></p>
                                            <?php endif; ?>
                                            <?php if ($average >= 3 && $average <= 3.9) : ?>
                                                <p style="color:green"><?php echo 'Basico'; ?></p>
                                            <?php endif; ?>
                                            <?php if ($average >= 4 && $average <= 4.5) : ?>
                                                <p style="color:green"><?php echo 'Alto'; ?></p>
                                            <?php endif; ?>
                                            <?php if ($average >= 4.6 && $average <= 5) : ?>
                                                <p style="color:green"><?php echo 'Superior'; ?></p>
                                            <?php endif; ?>                                           
                                        </td>

                                        <td><?php echo $comment; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>

                            <table width="1000" style="border:1px solid #CCCCCC">
                                    <tr>
                                        <td style="background:#CCCCCC">&nbsp;</td>
                                    </tr>
                                </table>
						    <br>
			
							<table width="1000" style="border:1px solid #CCCCCC">
								<tr>
									<td>FIRMA:</td>
									<td><div> _______________ </div></td>
									<td>FECHA:</td>
                                    <td><div><?php echo date('d/m/Y'); ?></div></td>
                                    <td>PROMEDIO FINAL:</td>
                                    <td style="text-align: left;">
                                        <?php
                                            $average_final_score = $total_final_score / $total_subjects; // Calcular el promedio de notas finales
                                            echo number_format($average_final_score, 1); // Mostrar el promedio con dos decimales
                                        ?>
                                    </td>

  
								</tr>
							</table>

                        </div>
                    </div>
                    <hr>
                <?php endforeach; ?>
                <button id="print" class="btn btn-info btn-rounded btn-block btn-sm pull-right" type="button"> <span><i class="fa fa-print"></i>&nbsp;Imprimir</span> </button>

                <script type="text/javascript" src="<?php echo base_url(); ?>js/html2canvas.min.js"></script>
                <script type="text/javascript" src="<?php echo base_url(); ?>js/jspdf.min.js"></script>
                <script type="text/javascript">
                    var pages = $('.print');
                    var doc = new jsPDF('landscape'); // Establecer la orientación a horizontal
                    var j = 0;

                    for (var i = 0; i < pages.length; i++) {
                        html2canvas(pages[i]).then(function(canvas) {
                            var img = canvas.toDataURL("image/png");
                            var height = canvas.height / 440 * 80;
                            doc.addImage(img, 'JPEG', 10, 0, 280, height); // Ajustar el ancho para paisaje (landscape)
                            
                            if (j < (pages.length - 1)) doc.addPage();
                            if (j == (pages.length - 1)) {
                                doc.save('Reporte_final_<?php echo $student_id ?>.pdf');
                            }
                            j++;
                        });
                    }
                </script>

            </div>
        </div>
    </div>
</div>
