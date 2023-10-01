<div class="row">

	<div class="col-sm-7">
		<div class="panel panel-info">

			<div class="panel-heading"><i class="fa fa-gear"></i>  <?php echo get_phrase('Configuracion del sistema');?></div>
			<div class="panel-body table-responsive">

				<?php echo form_open(base_url(). 'systemsetting/system_settings/do_update', array('class' => 'form-horizontal form-groups-bordered', 'enctype'=> 'multipart/form-data'));?>



				<div class="form-group">
					<label class="col-md-12" for="example-text"><?php echo get_phrase('Nombre del sistema');?></label>
					<div class="col-sm-12">
						<input type="text" class="form-control" name="system_name" value="<?php echo $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;?>">
					</div>
				</div>


				<div class="form-group">
					<label class="col-md-12" for="example-text"><?php echo get_phrase('Nombre de la institucion');?></label>
					<div class="col-sm-12">
						<input type="text" class="form-control" name="system_title" value="<?php echo $this->db->get_where('settings', array('type' => 'system_title'))->row()->description;?>">
					</div>
				</div>


				<div class="form-group">
					<label class="col-md-12" for="example-text"><?php echo get_phrase('Direccion');?></label>
					<div class="col-sm-12">
						<input type="text" class="form-control" name="address" value="<?php echo $this->db->get_where('settings', array('type' => 'address'))->row()->description;?>">
					</div>
				</div>


				<div class="form-group">
					<label class="col-md-12" for="example-text"><?php echo get_phrase('Telefono');?></label>
					<div class="col-sm-12">
						<input type="text" class="form-control" name="phone" value="<?php echo $this->db->get_where('settings', array('type' => 'phone'))->row()->description;?>">
					</div>
				</div>

				<div class="form-group" hidden>
					<label class="col-md-12" for="example-text"><?php echo get_phrase('Paypal Email');?></label>
					<div class="col-sm-12">
						<input type="text" class="form-control" name="paypal_email" value="<?php echo $this->db->get_where('settings', array('type' => 'paypal_email'))->row()->description;?>">
					</div>
				</div>

				<div class="form-group" hidden>
					<label class="col-md-12" for="example-text"><?php echo get_phrase('Currency');?></label>
					<div class="col-sm-12">
						<input type="text" class="form-control" name="currency" value="<?php echo $this->db->get_where('settings', array('type' => 'currency'))->row()->description;?>">
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-12" for="example-text"><?php echo get_phrase('Correo electronico');?></label>
					<div class="col-sm-12">
						<input type="text" class="form-control" name="system_email" value="<?php echo $this->db->get_where('settings', array('type' => 'system_email'))->row()->description;?>">
					</div>
				</div>

		
				<div class="form-group" hidden>
					<label class="col-md-12" for="example-text"><?php echo get_phrase('Text Alignment');?></label>
					<div class="col-sm-12">
						
						<select name="text_align" class="form-control">
							<?php $align =  $this->db->get_where('settings', array('type' => 'text_align'))->row()->description;?>
								<option value="left-to-right" <?php if ($align == 'left-to-right') echo 'selected';?>> Left to right</option>
								<option value="right-to-left" <?php if ($align == 'right-to-left') echo 'selected';?>> Right to left</option>
						</select>
					</div>
				</div>
				
				<div class="form-group" hidden>
                   <label class="col-md-12" for="example-text"><?php echo get_phrase('language'); ?></label>
                    <div class="col-sm-12">
                        <select name="language" class="form-control select2">
                            <?php
                            $fields = $this->db->list_fields('language');
                            foreach ($fields as $key => $field) {
                                if ($field == 'phrase_id' || $field == 'phrase')
                                    continue;

                                $current_default_language = $this->db->get_where('settings', array('type' => 'language'))->row()->description;
                                ?>
                                <option value="<?php echo $field; ?>"
                                        <?php if ($current_default_language == $field) echo 'selected'; ?>> <?php echo $field; ?> </option>
                                        <?php
                                    }
                                    ?>
                        </select>
                    </div>
                </div>
				


				<div class="form-group">
					<label class="col-md-12" for="example-text"><?php echo get_phrase('Año en curso');?></label>
					<div class="col-sm-12">
						<select name="running_session" class="form-control select2" >
							<?php $running_session = $this->db->get_where('settings', array('type' => 'session'))->row()->description; ?>
							<option value=""><?php echo get_phrase('Seleccionar año en curso');?></option>
							<?php for($i = 0; $i < 10; $i++):?>
								<option value="<?php echo (2019+$i);?>"
									<?php if($running_session == (2019+$i)) echo 'selected';?>>
									<?php echo (2019+$i);?>
								</option>
							<?php endfor;?>
						</select>
					</div>
				</div>




				<div class="form-group">
					<label class="col-md-12" for="example-text"><?php echo get_phrase('Pie de pagina');?></label>
					<div class="col-sm-12">
						<input type="text" class="form-control" name="footer" value="<?php echo $this->db->get_where('settings', array('type' => 'footer'))->row()->description;?>">
					</div>
				</div>


				<div class="form-group">
					<button type="submit" class="btn btn-success btn-rounded btn-block btn-sm"><i class="fa fa-save"></i>  <?php echo get_phrase('guardar');?></button>
				</div>



				<?php echo form_close();?>







			</div>

		</div>

	</div>


<div class="col-sm-5">
<div class="panel panel-info">
<div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;<?php echo get_phrase('Logo'); ?></div>
<div class="panel-wrapper collapse in" aria-expanded="true">
<div class="panel-body table-responsive">

<?php echo form_open(base_url() . 'systemsetting/system_settings/upload_logo', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top', 'enctype' => 'multipart/form-data'));
        ?>			
					<div class="form-group"> 
					 <label class="col-sm-12"><?php echo get_phrase('buscar_imagen');?>*</label>        
					 <div class="col-sm-12">
  		  			 <input type='file' class="form-control" name="userfile" onChange="readURL(this);" /required>
       				 <img id="blah" src="<?php echo base_url(); ?>uploads/logo.png" alt="" height="200" width="200"/>
					</div>
					</div>	
					
				<div class="form-group">
                     <button class="btn btn-block btn-info btn-rounded btn-sm"><i class="fa fa-save"></i>&nbsp;<?php echo get_phrase('Actualizar Logo');?></button>
                
                </div>
		
				<?php echo form_close(); ?>




				TEMA
				<hr>
				
				<?php echo form_open(base_url() . 'systemsetting/system_settings/themeSettings', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top', 'enctype' => 'multipart/form-data'));
        ?>
                
				<div class="radio radio-custom">
                  <input type="radio" <?php if($skin = $this->db->get_where('settings' , array('type'=>'skin_colour'))->row()->description == 'default') echo 'checked';?> name="skin_colour" id="radio2" value="default">
                  <label for="radio2"> Predeterminado </label>
				</div>

				<div class="radio radio-success">
                  <input type="radio" <?php if($skin = $this->db->get_where('settings' , array('type'=>'skin_colour'))->row()->description == 'green') echo 'checked';?> name="skin_colour" id="radio3" value="green">
                  <label for="radio3"> Verde </label>
				</div>

				<div class="radio radio-gray">
                  <input type="radio" <?php if($skin = $this->db->get_where('settings' , array('type'=>'skin_colour'))->row()->description == 'gray') echo 'checked';?> name="skin_colour" id="radio4" value="gray">
                  <label for="radio4"> Gris </label>
				</div>

				<div class="radio radio-black">
                  <input type="radio" <?php if($skin = $this->db->get_where('settings' , array('type'=>'skin_colour'))->row()->description == 'black') echo 'checked';?> name="skin_colour" id="radio5" value="black">
                  <label for="radio5"> Negro </label>
				</div>

				<div class="radio radio-purple">
                  <input type="radio" <?php if($skin = $this->db->get_where('settings' , array('type'=>'skin_colour'))->row()->description == 'purple') echo 'checked';?> name="skin_colour" id="radio6" value="purple">
                  <label for="radio6"> Morado </label>
				</div>

				<div class="radio radio-info">
                  <input type="radio" <?php if($skin = $this->db->get_where('settings' , array('type'=>'skin_colour'))->row()->description == 'blue') echo 'checked';?> name="skin_colour" id="radio7" value="blue">
                  <label for="radio7"> Azul </label>
				</div>
				
				
               
				
		<br>		
				
                <div class="form-group">
                          <button type="submit" class="btn btn-block btn-info btn-rounded btn-sm"><i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('cambiar_tema');?></button>
                    </div>
                    <?php echo form_close();?>

</div>
</div>

</div>
</div>

</div>