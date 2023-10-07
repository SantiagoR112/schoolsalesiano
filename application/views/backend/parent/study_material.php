<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <i class="fa fa-list"></i>&nbsp;&nbsp;<?php echo get_phrase('lista material de estudio');?>
            </div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body table-responsive">
                    <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo get_phrase('tipo_archivo');?></th>
                                <th><?php echo get_phrase('titulo');?></th>
                                <th><?php echo get_phrase('clase');?></th>
                                <th><?php echo get_phrase('asignatura');?></th>
                                <th><?php echo get_phrase('docente');?></th>
                                <th><?php echo get_phrase('descripcion');?></th>
                                <th><?php echo get_phrase('opciones');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $counter = 1; 

                                // Se obtiene el parent_id de la sesión actual (asegúrate de que tengas el parent_id en tu sesión)
                                $parent_id = $this->session->userdata('parent_id');

                                // Se obtienen todos los hijos del acudiente en función del parent_id de la sesión
                                $this->db->where('parent_id', $parent_id);
                                $student_profiles = $this->db->get('student')->result();

                                // Crear un array para almacenar todos los class_id de los hijos
                                $child_class_ids = array();

                                // Obtener los class_id de todos los hijos
                                foreach ($student_profiles as $student_profile) {
                                    $child_class_ids[] = $student_profile->class_id;
                                }

                                // Obtener el material de estudio asociado a los class_id de los hijos
                                $this->db->where_in('class_id', $child_class_ids);
                                $material = $this->db->get('material')->result_array();

                                foreach ($material as $key => $material):
                            ?>

                            <tr>
                                <td><?php echo $counter++;?></td>
                                <td>
                                    <?php if($material['file_type']=='img' || $material['file_type']== 'jpg' || $material['file_type']== 'png'){?>
                                        <img src="<?php echo base_url();?>optimum/images/image.png" style="max-height:40px;">
                                    <?php }?>

                                    <?php if($material['file_type']=='docx'){?>
                                        <img src="<?php echo base_url();?>optimum/images/doc.jpg" style="max-height:40px;">
                                    <?php }?>

                                    <?php if($material['file_type']=='pdf'){?>
                                        <img src="<?php echo base_url();?>optimum/images/pdf.jpg" style="max-height:40px;">
                                    <?php }?>

                                    <?php if($material['file_type']=='xlsx'){?>
                                        <img src="<?php echo base_url();?>optimum/images/text.png" style="max-height:40px;">
                                    <?php }?>

                                    <?php if($material['file_type']=='txt'){?>
                                        <img src="<?php echo base_url();?>optimum/images/text.png" style="max-height:40px;">
                                    <?php }?>
                                </td>
                                <td><?php echo $material['name'];?></td>
                                <td><?php echo $this->db->get_where('class', array('class_id' => $material['class_id']))->row()->name;?></td>
                                <td><?php echo $this->db->get_where('subject', array('subject_id' => $material['subject_id']))->row()->name;?></td>
                                <td><?php echo $this->db->get_where('teacher', array('teacher_id' => $material['teacher_id']))->row()->name;?></td>
                                <td><?php echo $material['description'];?></td>
                                <td>
                                    <a href="<?php echo base_url().'uploads/study_material/'. $material['file_name'];?>">
                                        <button type="button" class="btn btn-info btn-circle btn-xs" ><i class="fa fa-download"></i></button>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
