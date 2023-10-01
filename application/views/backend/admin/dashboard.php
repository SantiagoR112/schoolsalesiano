 <!--row -->
            <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="white-box bg-danger">
                            <div class="r-icon-stats">
                               <i class="ti-user bg-danger"></i>
                                <div class="bodystate">
                                    <h4>
									<strong style="color:white"><?php echo $this->db->count_all_results('student');?>
									 </strong>
									 </h4>
                                    <span class="text-muted"><a href="#" style="color:white"><?php echo get_phrase('Estudiantes');?></a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="white-box bg-info">
                            <div class="r-icon-stats">
                              <i class="ti-user bg-info"></i>
                                <div class="bodystate">
                                    <h4>
									<strong style="color:white"><?php echo $this->db->count_all_results('teacher');?>
									 </strong>
									 </h4>
                                    <span class="text-muted"><a href="#" style="color:white"><?php echo get_phrase('Docentes');?></a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                       <div class="white-box bg-success">
                            <div class="r-icon-stats">
                                <i class="ti-user bg-success"></i>
                                <div class="bodystate">
                                   <h4>
								   <strong style="color:white"><?php echo $this->db->count_all_results('parent');?>
								    </strong>
									</h4>
                                    <span class="text-muted"><a href="#" style="color:white"><?php echo get_phrase('Acudientes');?></a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                   
                    
                    <div class="col-md-3 col-sm-6">
                        <div class="white-box bg-purple">
                            <div class="r-icon-stats">
                                <i class="ti-wallet bg-purple"></i>
                                <div class="bodystate">
                                   <h4><strong style="color:white">
								   <?php echo $this->db->count_all_results('admin');?>
								    </strong>
									</h4>
                                    <span class="text-muted"><a href="#" style="color:white"><?php echo get_phrase('Admins');?></a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                  

            </div>
                <!--/row -->
                <!-- .row -->
                <!-- /.row -->
               
                <div class="row">
                    <div class="col-sm-6">
                        <div class="white-box">
                            <h3 class="box-title m-b-0"><?php echo get_phrase('Docentes añadidos recientemente');?></h3>
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
                            <?php $get_teacher_from_model = $this->crud_model->list_all_teacher_and_order_with_teacher_id();
                                    foreach ($get_teacher_from_model as $key => $teacher):?>
                                            <td><img src="<?php echo $teacher['face_file'];?>" class="img-circle" width="40px"></td>
                                            <td><?php echo $teacher['name'];?></td>
                                            <td><?php echo $teacher['email'];?></td>
                                            <td><?php echo $teacher['phone'];?></td>
                                        </tr>
                                    <?php endforeach;?>
                               
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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