<?php $select_periodtime = $this->db->get_where('periodtime', array('periodtime_id' => $param2))->result_array();

foreach ($select_periodtime as $key => $periodtime):
?>




<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading">
				<?php echo get_phrase('Update periodtime');?></div>
                        <div class="panel-body">

<?php echo form_open(base_url().'admin/periodtime/update/' . $periodtime['periodtime_id'], array('class' => 'form-horizontal form-groups-bordered validate', 'enctype'=>'multipart/form-data'));?>

                    <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('Plazo maximo');?></label>
                        <div class="col-sm-12">
                            <input type="date" name="deadline_date" value="<?php echo $periodtime ['deadline_date'];?>" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
							<button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Save</button>
					</div>

			<?php echo form_close();?>
            </div>
		</div>
    </div>
</div>
<?php endforeach;?>