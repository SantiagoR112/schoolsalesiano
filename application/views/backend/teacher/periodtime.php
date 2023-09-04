<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-list"></i>&nbsp; <?php echo get_phrase('Fechas_limites');?></div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body table-responsive">
                    <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Periodo</th>
                                <th><div><?php echo get_phrase('Fecha limite');?></div></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($select_periodtime as $periodtime):?>
                                <tr>
                                    <td><?php echo $periodtime['id'];?></td>
                                    <td>
                                    <label data-id="<?php echo $periodtime['id'];?>">
                                        <?php echo $periodtime['deadline_date'];?>
                                    </label>
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









