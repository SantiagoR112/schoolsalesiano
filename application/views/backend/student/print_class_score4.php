<!DOCTYPE html>
<html>
<head>
    <title>Reporte cuarto periodo</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .thumbnail {
            display: block;
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="printableArea">
        <?php 
            $students   =   $this->db->get_where('student', array('student_id'   => $this->session->userdata('student_id')))->result_array();
            foreach($students as $row): 
            $student_id = $row['student_id'];
        ?>
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            CUARTO PERIODO
                        </div>
                        <div class="card-body">
                            <?php
                            $student_info = $this->db->get_where('student', array('student_id' => $student_id))->row();
                            $total_class_score = 0;
                            $total_subjects = 0;
                            ?>

                            <div class="informacion estudiante">
                                <div class="row">
                                    <div class="col-md-2">
                                        <img src="<?php echo base_url();?>uploads/logo.png" class="thumbnail" height="120">
                                    </div>
                                    <div class="col-md-8 text-center">
                                        <div class="tile-stats tile-white tile-white-primary">
                                            <span style="font-size: 29px;"><?php echo $this->db->get_where('settings', array('type' =>'system_name'))->row()->description; ?></span>
                                            <br/>
                                            <span style="font-size: 18px;"><?php echo $this->db->get_where('settings', array('type' =>'address'))->row()->description; ?></span>
                                            <br/>
                                            <span style="font-size: 22px;">REPORTE CUARTO PERIODO</span>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <img src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" class="thumbnail" height="120">
                                    </div>
                                </div>
                        <div class="card-header bg-info text-white">
                            INFORMACION ESTUDIANTE
                        </div>
                        <div class="card-body">
                            <?php
                            $student_info = $this->db->get_where('student', array('student_id' => $student_id))->row();
                            $total_class_score = 0;
                            $total_subjects = 0;
                            ?>

                            <div class="informacion estudiante">
                                <p><strong>Nombre:</strong> <?php echo $student_info->name; ?></p>
                                <p><strong>Numero de adminision:</strong> <?php echo $student_info->roll; ?></p>
                                <p><strong>Clase:</strong><?php $class_name = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;echo $class_name;?></p>
                                <p><strong>Sexo:</strong> <?php echo $student_info->sex; ?></p>

                                <table class="table table-bordered">
                                    <thead class="bg-light">
                                        <tr>
                                            <th style="background-color: #17ABCC; color: white;">Asignaturas</th>
                                            <th style="background-color: #17ABCC; color: white;">Calificacion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $subjects = $this->db->get_where('subject', array('class_id' => $class_id))->result_array();
                                        foreach ($subjects as $row):
                                            $total_subjects++;
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
                                                    $obtained_class_score4 = $obtained_mark_query->row()->exam_score;
                                                    $total_class_score4 += $obtained_class_score4;
                                                }
                                                ?>
                                                <td><?php echo $obtained_class_score4; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                                <hr>

                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td style="background-color: #17ABCC; color: white;">Puntaje total:</td>
                                            <td><?php echo $total_class_score4; ?></td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: #17ABCC; color: white;">Numero de Asignaturas:</td>
                                            <td><?php echo $total_subjects; ?></td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: #17ABCC; color: white;">Promedio del periodo:</td>
                                            <td><?php echo ($total_subjects > 0) ? round($total_class_score4 / $total_subjects, 2) : 0; ?></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <button id="printButton" class="btn btn-info btn-rounded btn-block btn-sm pull-right" type="button">
                                    <span><i class="fa fa-print"></i>&nbsp;Generar PDF</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <?php endforeach;?>
    <script type="text/javascript" src="<?php echo base_url();?>js/html2canvas.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/jspdf.min.js"></script>
    <script>
        var printButton = document.getElementById('printButton');
        var doc = new jsPDF();
        
        printButton.addEventListener('click', function() {
            var printableArea = document.querySelector('.printableArea');
            
            html2canvas(printableArea).then(function(canvas) {
                var img = canvas.toDataURL('image/png');
                var height = canvas.height / 440 * 80;
                doc.addImage(img, 'JPEG', 10, 0, 190, height);
                
                doc.save('Report1.pdf');
            });
        });
    </script>
</body>
</html>



