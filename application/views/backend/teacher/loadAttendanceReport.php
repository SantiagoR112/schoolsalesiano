<?php if($section_id!=null && $month!=null && $year!=null && $class_id!=null):?>

<div class="row" align="center">
                    <div class="col-sm-12">
				  	<div class="panel panel-info">
                          
						
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
								
            <h3 style="color: #696969;">Hoja de asistencia</h3>
            <?php 
                $classes    =   $this->db->get('class')->result_array();
                foreach ($classes as $key => $class) {
                    if(isset($class_id) && $class_id==$class['class_id']) $class_name = $class['name'];
                }
                $sections    =   $this->db->get('section')->result_array();
                foreach ($sections as $key => $section) {
                    if(isset($section_id) && $section_id==$section['section_id']) $section_name = $section['name'];
                }
            ?>
           <?php
            // Establece el idioma local a español
            setlocale(LC_TIME, 'es_ES.UTF-8');

            $full_date = "1" . "-" . $month . "-" . $year;
            $full_date = date_create($full_date);

            // Formatea la fecha en español con el nombre del mes y el año
            $date_formatter = new IntlDateFormatter('es_ES', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
            $full_date_formatted = $date_formatter->format(date_timestamp_get($full_date));

            // Convierte el nombre del mes a mayúscula inicial
            $full_date_formatted = ucfirst($full_date_formatted);

            // Dividir la fecha en un array
            $date_parts = explode(' ', $full_date_formatted);

            // Obtén solo el mes y el año
            $month_year = $date_parts[2] . ' ' . $date_parts[4];

            ?>

            <h4 style="color: #696969;">Clase <?php echo $class_name; ?> <?php echo $section_name; ?><br><?php echo $month_year; ?></h4>



	</div>
	</div>
	</div>
	</div>
	</div>
<hr/>


<div class="row" align="center">
                    <div class="col-sm-12">
				  	<div class="panel panel-info">

                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                <div align="center">
        ETIQUETA: 
        Presente&nbsp;-&nbsp; <i class="fa fa-circle" style="color: #00a651;"></i>&nbsp;&nbsp;
        Ausente&nbsp;-&nbsp;<i class="fa fa-circle" style="color: #EE4749;"></i>&nbsp;&nbsp;
        Media jornada&nbsp;-&nbsp; <i class="fa fa-circle" style="color: #0000FF;"></i>&nbsp;&nbsp;
        Tarde&nbsp;-&nbsp; <i class="fa fa-circle" style="color: #FF6600;"></i>&nbsp;&nbsp;
        Indefinido&nbsp;-&nbsp;<i class="fa fa-circle" style="color: black;"></i>
        </div>
                                
    <table cellpadding="0" cellspacing="0" border="0" class="table">
            <thead>
                <tr>
                    <td style="text-align: left;">Dia<i class="fa fa-down-thin"></i>| Estudiantes</td>
                    <?php
                    $days = date("t",mktime(0,0,0,$month,1,$year)); 
                        for ($i=0; $i < $days; $i++) { 
                           ?>
                            <td style="text-align: center;"><?php echo ($i+1);?></td>   
                           <?php 
                        }
                    ;?>
                </tr>
            </thead>
            <tbody>
            <?php 
                //STUDENTS ATTENDANCE
                $students   =   $this->db->get_where('student' , array('class_id'=>$class_id))->result_array();
                foreach($students as $key => $student)
                {
                    ?>
                <tr class="gradeA">
                    <td align="left"><?php echo $student['name'];?></td>
                    <?php 
                    for ($i=1; $i <= $days; $i++) {
                    $full_date = $year."-".$month."/".$i;
                    $verify_data  =  array('student_id' => $student['student_id'], 'date' => $full_date);
                    $attendance = $this->db->get_where('attendance' , $verify_data)->row();
                    $status     = $attendance->status;
                    ?>
                            <td style="text-align: center;">
                                <?php if ($status == "0"):?>
                                <i class="fa fa-circle" style="color:black;"></i>
                                <?php endif;?>
                                <?php if ($status == "1"):?>
                                    <i class="fa fa-circle" style="color: green;"></i>
                                <?php endif;?>
								
								<?php if ($status == "2"):?>
                                    <i class="fa fa-circle" style="color: red;"></i>
                                <?php endif;?>
								
								<?php if ($status == "3"):?>
                                    <i class="fa fa-circle" style="color:grey;"></i>
                                <?php endif;?>
								
								<?php if ($status == "4"):?>
                                    <i class="fa fa-circle" style="color: yellow;"></i>
                                <?php endif;?>
								
                            </td>    
                           <?php 
                        }
                    ;?>
                </tr>
                <?php
                }
                ;?>
            </tbody>
        </table>

        <a href="<?php echo base_url();?>teacher/printAttendanceReport/<?php echo $class_id ;?>/<?php echo $section_id ;?>/<?php echo $month ;?>/<?php echo $year ;?>" class="btn btn-success btn-sm btn-rounded btn-block" style="color:white"> <i class="fa fa-print"></i> Imprimir</a>
		
	</div>
	</div>
	</div>
	</div>
	</div>

<?php endif;?>