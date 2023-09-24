<?php $vehicles = $this->db->get_where('vehicle', array('vehicle_id' => $param2))->result_array();
foreach($vehicles as $key => $vehicle):?>
<div class="row">
                    <div class="col-sm-12">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('edit');?></div>
                                <div class="panel-body table-responsive">
			
<!----CREATION FORM STARTS---->

                	<?php echo form_open(base_url() . 'transportation/vehicle/update/' . $param2 , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                            <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('nombre');?></label>
                    <div class="col-sm-12">
                                    <input type="text" class="form-control"  value="<?php echo $vehicle['name'];?>" name="name" / required>
                                </div>
                            </div>

								<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('placa_vehiculo');?></label>
                    <div class="col-sm-12">
                                    <input type="text" class="form-control" value="<?php echo $vehicle['vehicle_number'];?>" name="vehicle_number"/ required>
                                </div>
                            </div>

                    
				<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('modelo_vehiculo');?></label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" value="<?php echo $vehicle['vehicle_model'];?>" name="vehicle_model"/ required>
                    </div>
                </div>


                <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('cantidad');?></label>
                    <div class="col-sm-12">
                        <input type="number" class="form-control" value="<?php echo $vehicle['vehicle_quantity'];?>" name="vehicle_quantity"/ required>
                    </div>
                </div>

                <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('año_modelo');?></label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" value="<?php echo $vehicle['year_made'];?>" name="year_made"/ required>
                    </div>
                </div>

                <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('nombre_conductor');?></label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" value="<?php echo $vehicle['driver_name'];?>" name="driver_name"/ required>
                    </div>
                </div>


                <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('licencia_conductor');?></label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" value="<?php echo $vehicle['driver_license'];?>" name="driver_license"/ required>
                    </div>
                </div>

                <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('contacto_conductor');?></label>
                    <div class="col-sm-12">
                        <textarea class="form-control" name="driver_contact"><?php echo $vehicle['driver_contact'];?></textarea>
                    </div>
                </div>


                <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('descripcion');?></label>
                    <div class="col-sm-12">
                        <textarea class="form-control" name="description"><?php echo $vehicle['description'];?></textarea>
                    </div>
                </div>


                <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('estado');?></label>
                    <div class="col-sm-12">
                     
                    <select name="status" class="form-control">

                        <option value="disponible" <?php if($vehicle['status']== 'disponible') echo 'selected';?>>Disponible</option>
                        <option value="nodisponible"<?php if($vehicle['status']== 'nodisponible') echo 'selected';?>>No disponible</option>
                    </select>

                    </div>
                </div>



              

								
							
                    <div class="form-group">
                    <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('edit');?></button>
					</div>
							
                    </form>                
                </div>                
			</div>
			</div>
			</div>
			<!----CREATION FORM ENDS-->
<?php endforeach;?>