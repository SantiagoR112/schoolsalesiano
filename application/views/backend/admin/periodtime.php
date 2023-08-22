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
                        </tr>
                    </thead>

    <tbody>

    <?php
   $count = 1; foreach ($select_periodtime as $key => $periodtime):?>

        			
            <tr>
            <td><?php echo $count++;?></td>
            <td><?php echo $periodtime ['deadline_date'];?></td>
                <td>
                
                <a onclick="showAjaxModal('<?php echo base_url();?>modal/popup/edit_periodtime/<?php echo $periodtime['periodtime_id'];?>')" class="btn btn-info btn-circle btn-xs"><i class="fa fa-edit"></i></a>
                
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



