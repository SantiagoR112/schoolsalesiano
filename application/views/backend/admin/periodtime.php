<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-list"></i>&nbsp; <?php echo get_phrase('list_enquiry');?></div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body table-responsive">
                    <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Periodo</th>
                                <th><div><?php echo get_phrase('Plazo maximo');?></div></th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($select_periodtime as $periodtime):?>
                                <tr>
                                    <td><?php echo $periodtime['id'];?></td>
                                    <td>
                                        <input type="date" class="editable" value="<?php echo $periodtime['deadline_date'];?>" name="deadline_date" data-id="<?php echo $periodtime['id'];?>" onchange="updateDeadlineDate(this)">
                                    </td>
                                    <td>
                                        <button class="btn btn-info btn-circle btn-xs update-deadline" data-id="<?php echo $periodtime['id'];?>"><i class="fa fa-edit"></i></button>
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

<script>
    function updateDeadlineDate(inputElement) {
        var id = inputElement.getAttribute('data-id');
        var newDate = inputElement.value;

        // Realizar la solicitud AJAX para actualizar la fecha en el controlador
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('admin/update_deadline_date');?>',
            data: {
                pk: id,
                value: newDate
            },
            success: function(response) {
                var result = JSON.parse(response);
                if (result.status === 'success') {
                    // Mostrar el mensaje de éxito
                    alert(result.message);

                    // Recargar la página
                    location.reload();
                } else {
                    // Hubo un error en la actualización
                }
            },
            error: function() {
                // Manejar el error en la solicitud AJAX
            }
        });
    }
</script>








