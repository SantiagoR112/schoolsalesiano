<div class="col-sm-12">
	<div class="panel panel-info">
        <div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;<?php echo get_phrase('listado_circulares'); ?></div>	
            <div class="panel-body table-responsive">
			
 					<table id="example23" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><div>#</div></th>
                                <th><div><?php echo get_phrase('titulo');?></div></th>
                                <th><div><?php echo get_phrase('referencia');?></div></th>
                                <th><div><?php echo get_phrase('contenido');?></div></th>
                                <th><div><?php echo get_phrase('fecha');?></div></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 1;  foreach($select_circular as $key => $circular):?>
                                <tr>
                                    <td><?php echo $count++;?></td>
                                    <td><?php echo $circular ['title'];?></td>
                                    <td><?php echo $circular ['reference'];?></td>
                                    <td><?php echo $circular ['content'];?></td>
                                    <td><?php echo $circular ['date'];?></td>
                                </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
			</div>
		</div>
	</div>
</div>