<!DOCTYPE html>
<html>
<head>
    <title>Reporte primer periodo</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script>
        // Función para ajustar el zoom de la página al 90%
        function setZoom() {
            document.body.style.zoom = "90%";
        }
    </script>
    <style>
        .thumbnail {
            display: block;
            max-width: 100%;
            height: auto;
        }

        .pdf-button {
            width: auto; /* Ajustar el ancho del botón según el contenido */
            max-width: 100%; /* Establecer el ancho máximo para evitar que se expanda demasiado */
            margin: 0 auto; /* Centrar el botón horizontalmente */
            display: block; /* Convertir el botón en un bloque para que ocupe solo el ancho necesario */
        }
    </style>
</head>
<body onload="setZoom()">
    <div class="printableArea">
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            PRIMER PERIODO
                        </div>
                        <div class="card-body">
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
                                            <span style="font-size: 22px;">REPORTE PRIMER PERIODO</span>
                                        </div>
                                        <div class="year">
                                            <span id="currentYear"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <img src="<?php echo $student_info->image_url; ?>" class="thumbnail" height="120">
                                    </div>
                                </div>
                            </div>
                            <div class="card-header bg-info text-white">
                                INFORMACION ESTUDIANTE
                            </div>
                            <div class="card-body">
                                    <?php
                                        $class_info = $this->db->get_where('class', array('class_id' => $class_id))->row();
                                        $teacher_id = $class_info->teacher_id;
                                        $director_info = $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->row();
                                    ?>
                                <p><strong>Nombre:</strong> <?php echo $student_info->name; ?></p>
                                <p><strong>Numero de adminision:</strong> <?php echo $student_info->roll; ?></p>
                                <p><strong>Clase: </strong><?php $class_name = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name; echo $class_name;?></p>
                                <p><strong>Director de grupo:</strong> <?php echo $director_info->name; ?></p>

                                <table class="table table-bordered">
                                    <thead class="bg-light">
                                        <tr>
                                            <th style="background-color: #17ABCC; color: white;">Asignaturas</th>
                                            <th style="background-color: #17ABCC; color: white;">Calificacion</th>
                                            <th style="background-color: #17ABCC; color: white;">Desempeño</th> <!-- Columna para la escala -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Función para obtener la escala según la calificación
                                        function obtenerEscala($calificacion) {
                                            if ($calificacion >= 1 && $calificacion <= 2.9) {
                                                return "Bajo";
                                            } else if ($calificacion >= 3 && $calificacion <= 3.9) {
                                                return "Básico";
                                            } else if ($calificacion >= 4 && $calificacion <= 4.5) {
                                                return "Alto";
                                            } else if ($calificacion >= 4.6 && $calificacion <= 5) {
                                                return "Superior";
                                            } else {
                                                return ""; // Maneja otros casos si es necesario
                                            }
                                        }
                                        ?>
                                        <?php foreach ($subjects as $row): ?>
                                            <tr>
                                                <td><?php echo $row['name']; ?></td>
                                                <td class="<?php echo ($row['obtained_class_score'] >= 3) ? 'text-success' : 'text-danger'; ?>"><?php echo $row['obtained_class_score']; ?></td>
                                                <td><?php echo obtenerEscala($row['obtained_class_score']); ?></td> <!-- Llama a la función obtenerEscala() -->
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                                <hr>

                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td style="background-color: #17ABCC; color: white;">Asignaturas aprobadas:</td>
                                            <td><?php echo $passed_subjects; ?></td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: #17ABCC; color: white;">Asignaturas reprobadas:</td>
                                            <td><?php echo $failed_subjects; ?></td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: #17ABCC; color: white;">Promedio del periodo:</td>
                                            <td><?php echo ($total_subjects > 0) ? round($total_class_score / $total_subjects, 2) : 0; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div>
                                    <?php
                                        date_default_timezone_set('America/Bogota'); // Configura la zona horaria a Bogotá
                                        echo "Fecha de reporte: " . date('d/m/Y'); // Muestra la fecha en formato día/mes/año
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button id="printButton" class="btn btn-info btn-rounded btn-block btn-sm pdf-button" type="button">
        <span><i class="fa fa-print"></i>&nbsp;Generar PDF</span>
    </button>
    <script type="text/javascript" src="<?php echo base_url();?>js/html2canvas.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/jspdf.min.js"></script>
    
    <script>
        var currentYear = new Date().getFullYear();
        document.getElementById('currentYear').textContent = currentYear;
        var printButton = document.getElementById('printButton');
        var doc = new jsPDF();
        
        printButton.addEventListener('click', function() {
            var printableArea = document.querySelector('.printableArea');
            
            html2canvas(printableArea).then(function(canvas) {
                var img = canvas.toDataURL('image/png');
                var height = canvas.height / 440 * 80;
                doc.addImage(img, 'JPEG', 10, 0, 190, height);
                
                doc.save('Reporte1periodo_<?php echo $student_id ?>.pdf');
            });
        });
    </script>
</body>
</html>
