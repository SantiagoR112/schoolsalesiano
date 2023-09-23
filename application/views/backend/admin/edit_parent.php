<?php $select_parent = $this->db->get_where('parent', array('parent_id' => $param2))->result_array();

foreach ($select_parent as $key => $parent):
?>




<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading">
				<?php echo get_phrase('Editar acudiente');?></div>
                        <div class="panel-body">

<?php echo form_open(base_url().'admin/parent/update/' . $parent['parent_id'], array('class' => 'form-horizontal form-groups-bordered validate', 'enctype'=>'multipart/form-data'));?>


 					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('nombre completo');?></label>
                    <div class="col-sm-12">
                            <input type="text" name="name" value="<?php echo $parent ['name'];?>" class="form-control">
                        </div>
                    </div>
					
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('Email');?></label>
                    <div class="col-sm-12">

                            <input type="email" name="email" value="<?php echo $parent ['email'];?>" class="form-control" >
                        </div>
                    </div>

                    <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('telefono');?></label>
                    <div class="col-sm-12">

                            <input type="text" name="phone"  value="<?php echo $parent ['phone'];?>" class="form-control" >
                        </div>
                    </div>


                    <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('Profesion');?></label>
                    <div class="col-sm-12">

                            <input type="text" name="profession" value="<?php echo $parent ['profession'];?>" class="form-control" >
                        </div>
                    </div>


                    <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('direccion');?></label>
                    <div class="col-sm-12">

                            <textarea class="form-control" name="address"><?php echo $parent['address'];?></textarea>
                           
                        </div>
                    </div>

                    <div class="form-group">
							<button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Guardar</button>
					</div>
			<?php echo form_close();?>
            </div>
		</div>
    </div>
</div>
<?php endforeach;?>