<div class="row" align="center">
                    <div class="col-sm-12">
				  	<div class="panel panel-info">

                            <div class="panel-wrapper collapse in" aria-expanded="true">
                            <div class="panel-body">
<div class="printableArea">
        <div align="center">
        <img src="<?php echo base_url();?>uploads/logo.png" width="60px" height="60px" class="img-circle"><br/>
        <span style="text-align:center; font-size:25px"><?php echo $system_name;?></span><br/>
        <span style="text-align:center; font-size:15px"><?php echo $system_address;?></span>
        </div>
        <br>
                                
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
                $classes    =   $this->db->get('class')->result_array();
                foreach ($classes as $key => $class) {
                    if(isset($class_id) && $class_id==$class['class_id']) $class_name = $class['name'];
                }
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
                <h4 style="color: #696969;">Clase <?php echo $class_name; ?><br><?php echo $month_year; ?></h4>
                <?php
                    foreach($students as $key => $student)
                {
                    ?>
                <tr class="gradeA">
                    <td align="left"><!--<img src="<?php //echo $this->crud_model->get_image_url('student', $student['student_id']);?>" class="img-circle" width="30px" height="30px">--><?php echo $student['name'];?></td>
                    <?php 
                    for ($i=1; $i <= $days; $i++) {
                    $full_date = $year."-".$month."/".$i;
                    $verify_data  =  array('student_id' => $student['student_id'], 'date' => $full_date);
                    $attendance = $this->db->get_where('attendance' , $verify_data)->row();
                    $status     = $attendance->status;
                    ?>
                            <td style="text-align: center;">
                                <?php if ($status == "0"):?>
                               <h9 style="color:black">I</h9>
                                <?php endif;?>
                                <?php if ($status == "1"):?>
                                <h9 style="color:green">P</h9>
                                <?php endif;?>
								
								<?php if ($status == "2"):?>
                                <h9 style="color:red">A</h9>
                                <?php endif;?>
								
								<?php if ($status == "3"):?>
                                <h9 style="color:grey">T</h9>
                                <?php endif;?>
								
								<?php if ($status == "4"):?>
                                <h9 style="color:yellow">M</h9>
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
        <hr>
        <div align="center">
        <strong>ETIQUETAS: </strong>
        Presente&nbsp;-&nbsp; P &nbsp;&nbsp;
        Ausente&nbsp;-&nbsp;A&nbsp;&nbsp;
        Media jornada&nbsp;-&nbsp; M&nbsp;&nbsp;
        Tarde&nbsp;-&nbsp; T&nbsp;&nbsp;
        Indefinido&nbsp;-&nbsp;I
        </div>
    </div>

    <br>
    <button id ="print" class="btn btn-info btn-sm btn-rounded btn-block"><i class="fa fa-print"></i> Imprimir</button>

	</div>
	</div>
	</div>
	</div>
	</div>