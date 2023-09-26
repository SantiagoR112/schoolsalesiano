					
            <div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <i class="fa fa-list"></i>&nbsp;&nbsp;<?php echo get_phrase('Director de grupo');?>
            </div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body table-responsive">
                    <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width="80"><div><?php echo get_phrase('foto de perfil');?></div></th>
                                <th><div><?php echo get_phrase('nombre');?></div></th>
                                <th><div><?php echo get_phrase('email');?></div></th>
                                <th><div><?php echo get_phrase('clase');?></div></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($select_teacher as $teacher) { ?>
                                <tr>
                                    <td><img src="<?php echo $this->crud_model->get_image_url('teacher', $teacher['teacher_id']);?>" class="img-circle" width="30px"></td>
                                    <td><?php echo $teacher['name'];?></td>
                                    <td><?php echo $teacher['email'];?></td>
                                    <td><?php echo $teacher['class_name'];?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

