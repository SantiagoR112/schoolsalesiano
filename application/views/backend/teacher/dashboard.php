 <!--row -->
 <div class="row">
                    <?php
                    // Obtiene el ID del profesor de la sesión actual (asegúrate de tener el ID del profesor en tu sesión)
                    $teacher_id = $this->session->userdata('teacher_id');

                    // Obtiene el número total de materiales de estudio asociados al ID del profesor
                    $number_of_materials = $this->db->where('teacher_id', $teacher_id)->count_all_results('material');
                    ?>

                    <div class="col-md-3 col-sm-6">
                        <div class="white-box">
                            <div class="r-icon-stats">
                                <i class="ti-book bg-megna"></i>
                                <div class="bodystate">
                                    <h4><?php echo $number_of_materials; ?></h4>
                                    <span class="text-muted"><?php echo get_phrase('Material de E.');?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    // Obtiene el número total de asignaturas asociadas al ID del profesor
                    $number_of_subjects = $this->db->where('teacher_id', $teacher_id)->count_all_results('subject');
                    ?>

                    <div class="col-md-3 col-sm-6">
                        <div class="white-box">
                            <div class="r-icon-stats">
                                <i class="ti-agenda bg-info"></i>
                                <div class="bodystate">
                                    <h4><?php echo $number_of_subjects; ?></h4>
                                    <span class="text-muted"><?php echo get_phrase('Asignaturas');?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    // Obtiene el ID del docente de la sesión actual (asegúrate de tener el ID del docente en tu sesión)
                    $teacher_id = $this->session->userdata('teacher_id');

                    // Obtiene las clases relacionadas con el ID del docente
                    $teacher_classes = $this->db->where('teacher_id', $teacher_id)->get('class')->result();

                    // Inicializa una variable para almacenar los nombres de las clases
                    $class_names = array();

                    // Recorre las clases relacionadas y almacena sus nombres en el arreglo
                    foreach ($teacher_classes as $class) {
                        $class_names[] = $class->name;
                    }
                    ?>

                    <div class="col-md-3 col-sm-6">
                        <div class="white-box">
                            <div class="r-icon-stats">
                                <div class="bodystate">
                                <span class="text-muted"></span>
                                    <span class="text-muted"><?php echo get_phrase('Direccion de grupo:');?></span>
                                    <ul>
                                        <?php foreach ($class_names as $class_name): ?>
                                            <?php echo $class_name; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>


                    


                    

            </div>
                <!--/row -->
                <!-- .row -->
                
                <!-- /.row -->
               
                
                    <div class="col-sm-6">
                        <div class="white-box">
                            <h3 class="box-title m-b-0"><?php echo get_phrase('Estudiantes añadidos recientemente');?></h3>
                            <div class="table-responsive">
                            <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Foto</th>
                                            <th>Nombre</th>
                                            <th>Correo electronico</th>
                                            <th>Telefono</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                            <?php $get_student_from_model = $this->crud_model->list_all_student_and_order_with_student_id();
                                    foreach ($get_student_from_model as $key => $student):?>
                                            <td><img src="<?php echo $student['face_file'];?>" class="img-circle" width="40px"></td>
                                            <td><?php echo $student['name'];?></td>
                                            <td><?php echo $student['email'];?></td>
                                            <td><?php echo $student['phone'];?></td>
                                        </tr>
                                    <?php endforeach;?>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->