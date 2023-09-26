<div class="row">
                    <div class="col-sm-12">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('Asignaturas de la clase');?></div>
                                <div class="panel-body table-responsive">

                                
                    <table id="example23" class="table display">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                            <th><div><?php echo get_phrase('clase');?></div></th>
                    		<th><div><?php echo get_phrase('asignatura');?></div></th>
                    		<th><div><?php echo get_phrase('docente');?></div></th>
                            <th><div><?php echo get_phrase('email');?></div></th>
						</tr>
					</thead>
                    <tbody>
    
                    <?php $counter = 1; 
                    foreach($select_subject as $key => $subjects):?>         
                        <tr>
                            <td><?php echo $counter++;?></td>
                            <td><?php echo $this->crud_model->get_type_name_by_id('class', $subjects['class_id']);?></td>
							<td><?php echo $subjects['name'];?></td>
                            <td><?php echo $this->crud_model->get_type_name_by_id('teacher', $subjects['teacher_id']);?></td>
                            <td>
                                <?php
                                $teacher_id = $subjects['teacher_id'];
                                $teacher_email = $this->crud_model->get_type_name_by_id('teacher', $teacher_id, 'email');
                                echo $teacher_email;
                                ?>
                            </td>							
                        </tr>
    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
			




            