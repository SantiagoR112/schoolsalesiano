<?php

$selecting_id_from_admin_table = array('admin_id' => $this->session->userdata('login_user_id'), 
'dashboard' => '1', 
'manage_academics' => '1', 'manage_employee' => '1', 
'manage_student' => '1', 'manage_attendance' => '1', 
'download_page' => '1', 'manage_parent' => '1', 
'manage_alumni' => '1');
$query_admin_role_table = $this->db->get_where('admin_role', $selecting_id_from_admin_table);

if($query_admin_role_table->num_rows() < 1)

    $this->db->insert('admin_role', $selecting_id_from_admin_table);
?>



<div class="row">
    <div class="col-sm-5">
		<div class="panel panel-info">
            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('agregar_administrador'); ?></div>

                <?php echo form_open(base_url() . 'admin/newAdministrator/create', array('class' => 'form-horizontal form-goups-bordered validate'));?>
					<div class="panel-body table-responsive">

					    <div class="form-group">
                 	        <label class="col-md-12" for="example-text"><?php echo get_phrase('nombre');?></label>
                                <div class="col-sm-12">
				                    <input name="name" type="text" class="form-control"/ required>
                                </div>
                        </div>

                        <div class="form-group">
                 	        <label class="col-md-12" for="example-text"><?php echo get_phrase('Email');?></label>
                                <div class="col-sm-12">
				                    <input name="email" type="text" class="form-control"/ required>
                                </div>
                        </div>

                        <div class="form-group">
                 	        <label class="col-md-12" for="example-text"><?php echo get_phrase('telefono');?></label>
                                <div class="col-sm-12">
				                    <input name="phone" type="text" class="form-control"/ required>
                                </div>
                        </div>

                    <div class="form-group">
                 	        <label class="col-md-12" for="example-text"><?php echo get_phrase('Seleccionar rol');?></label>
                        <div class="col-sm-12">
                            <select name="level" class="form-control">
                                <option value="1"><?php echo get_phrase('Super Admin');?>
                                <option value="2"><?php echo get_phrase('Normal Admin');?>
                             </select>
                        </div>
                    </div>

                        <div class="form-group">
                 	        <label class="col-md-12" for="example-text"><?php echo get_phrase('Contraseña');?></label>
                                <div class="col-sm-12">
				                    <input name="password" type="password" class="form-control"/ required>
                                </div>
                        </div>

                        <div class="form-group">
                 	        <label class="col-md-12" for="example-text"><?php echo get_phrase('Seleccionar Imagen');?></label>
                                <div class="col-sm-12">
                                <input type='file' class="form-control" name="admin_image" onChange="readURL(this);">
                                </div>
                        </div>

                           <div class="form-group">
                                  <button type="submit" class="btn btn-block btn-info btn-rounded btn-sm "><i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('agregar_admin');?></button>
							</div>
                <?php echo form_close();?>
                </div>                
			</div>
		</div>
	
    <!----CREATION FORM ENDS-->
	
    <div class="col-sm-7">
		<div class="panel panel-info">
            <div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;<?php echo get_phrase('Listado'); ?></div>
                <div class="panel-body table-responsive">
 					<table id="example23" class="display nowrap" cellspacing="0" width="100%">
				        <thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div><?php echo get_phrase('nombre');?></div></th>
                    		<th><div><?php echo get_phrase('Email');?></div></th>
                    		<th><div><?php echo get_phrase('telefono');?></div></th>
                            <th><div><?php echo get_phrase('opciones');?></div></th>
						</tr>
					</thead>
                    <tbody>

                <?php $counter = 1;  $get_all_admin_from_model = $this->admin_model->select_all_the_administrator_from_admin_table();
                        foreach ($get_all_admin_from_model as $key => $all_selected_administrator):?>
                        <tr>
                            <td><?php echo $counter++;?></td>
                            <td><?php echo $all_selected_administrator['name'];?></td>
							<td><?php echo $all_selected_administrator['email'];?></td>
							<td><?php echo $all_selected_administrator['phone'];?></td>
							<td>
                
                            <?php if($all_selected_administrator['level'] == '2'):?>
                            <a onclick="showAjaxModal('<?php echo base_url();?>modal/popup/assign_role_for_admin/<?php echo $all_selected_administrator['admin_id'];?>')" class="btn btn-info btn-rounded btn-xs">Asignar Rol <i class="fa fa-edit"></i></a>
                            <a href="<?php echo base_url();?>admin/newAdministrator/delete/<?php echo $all_selected_administrator['admin_id'];?>" onclick="return confirm('¿Estas seguro que deseas eliminar?');" class="btn btn-danger btn-circle btn-xs" style="color:white"><i class="fa fa-times"></i></a>
                            <?php endif;?>
                            </td>
                        </tr>
                <?php endforeach;?>
                   
                    </tbody>
                </table>
			</div>
		</div>
	</div>
</div>
<!----TABLE LISTING ENDS--->
			