<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>

<table id="example" class="table display">

                	<thead>
                		<tr>
                    		<th><div>Numero de documento</div></th>
                            <th><div><?php echo get_phrase('Imagen');?></div></th>
                            <th><div><?php echo get_phrase('Numero de admision');?></div></th>
                            <th><div><?php echo get_phrase('Nombre');?></div></th>
                    		<th><div><?php echo get_phrase('clase');?></div></th>
                    		<th><div><?php echo get_phrase('genero');?></div></th>
                            <th><div><?php echo get_phrase('correo electronico');?></div></th>
                            <th><div><?php echo get_phrase('telefono');?></div></th>
                            <th><div><?php echo get_phrase('acudiente');?></div></th>
                    		<th><div><?php echo get_phrase('acciones');?></div></th>
						</tr>
					</thead>
                    <tbody>
    
                    <?php $counter = 1; $students =  $this->db->get_where('student', array('class_id' => $class_id))->result_array();
                    foreach($students as $key => $student):?>         
                        <tr>
                            <td><?php echo $student['student_id'];?></td>
                            <td><img src="<?php echo $this->crud_model->get_image_url('student', $student['student_id']);?>" class="img-circle" width="30"></td>
                            <td><?php echo $student['roll'];?></td>
                            <td><?php echo $student['name'];?></td>
                            <td><?php echo $this->crud_model->get_type_name_by_id('class', $student['class_id']);?></td>
							<td><?php echo $student['sex'];?></td>
                            <td><?php echo $student['email'];?></td>
                            <td><?php echo $student['phone'];?></td>
                            <td><?php echo $this->crud_model->get_type_name_by_id('parent', $student['parent_id']);?></td>
							<td>
							
				     <a href="<?php echo base_url();?>admin/edit_student/<?php echo $student['student_id'];?>" ><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-pencil"></i></button></a>
					 <a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/new_student/delete/<?php echo $student['student_id'];?>');"><button type="button" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-times"></i></button></a>
                     <a onclick="showAjaxModal('<?php echo base_url();?>modal/popup/resetstudentPassword/<?php echo $student['student_id'];?>')" class="btn btn-success btn-circle btn-xs"><i class="fa fa-key"></i></a>
                     <a onclick="showAjaxModal('<?php echo base_url();?>modal/popup/studentIdentityCard/<?php echo $student['student_id'];?>')" class="btn btn-info btn-circle btn-xs"><i class="fa fa-hospital-o"></i></a>

			
                           
        					</td>
                        </tr>
    <?php endforeach;?>
                    </tbody>
                </table>



<script>
    var table = $('#example').DataTable();

    // Verifica si DataTables ya se ha inicializado en la tabla
    if ($.fn.dataTable.isDataTable('#example')) {
        // Si ya se ha inicializado, destruye la instancia actual
        table.destroy();
    }

    // Luego, inicializa DataTables nuevamente con las nuevas opciones
    table = $('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copy',
                text: 'Copiar', // traducción personalizada
            },
            'csv', 'excel', 'pdf', 
            {
                extend: 'print',
                text: 'Imprimir'
            }
        ],
        language: {
            search: 'Buscar', // Traducción personalizada para el texto de búsqueda
        }
    });

</script>


