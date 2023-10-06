<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading">
				NUEVO ACUDIENTE
	<div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="fa fa-plus"></i>&nbsp;&nbsp;AGREGAR NUEVO ACUDIENTE AQUI<i class="btn btn-primary btn-xs"></i></a> <a href="#" data-perform="panel-dismiss"></a> </div></div>
    <div class="panel-wrapper collapse out" aria-expanded="true">
                        <div class="panel-body">

<?php echo form_open(base_url().'admin/parent/insert', array('class' => 'form-horizontal form-groups-bordered validate', 'enctype'=>'multipart/form-data'));?>

                    <div class="form-group">
                 	    <label class="col-md-12" for="example-text">Numero de documento</label>
                        <div class="col-sm-12">
                            <input type="number" name="parent_id" class="form-control" required autofocus>
                        </div>
                    </div>


 					<div class="form-group">
                 	<label class="col-md-12" for="example-text">Nombre completo</label>
                    <div class="col-sm-12">
                            <input type="text" name="name" class="form-control" required>
                        </div>
                    </div>
					
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('Correo electronico');?></label>
                    <div class="col-sm-12">

                            <input type="email" name="email" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('telefono');?></label>
                    <div class="col-sm-12">

                            <input type="number" name="phone" class="form-control" required>
                        </div>
                    </div>


                    <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('profesion');?></label>
                    <div class="col-sm-12">

                            <input type="text" name="profession" class="form-control" required>
                        </div>
                    </div>


                    <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('direccion');?></label>
                    <div class="col-sm-12">

                            <textarea class="form-control" name="address" required></textarea>
                           
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-12" for="example-text"><?php echo get_phrase ('contraseña');?></label>
                        <div class="col-sm-12">
                                <input type="password" name="password" class="form-control" onkeyup="CheckPasswordStrength(this.value)" required>
                                <strong id="password_strength"></strong>
                        </div>
                    </div>
		

                    <div class="form-group">
							<button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Agregar acudiente</button>
					</div>
			<?php echo form_close();?>
                </div>
            </div>
		</div>
    </div>
</div>


<div class="row">
                    <div class="col-sm-12">
				  	<div class="panel panel-info">
                            <div class="panel-heading"><i class="fa fa-list"></i>&nbsp; <?php echo get_phrase('listado_acudientes');?></div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body table-responsive">
			
 								<table id="example23" class="display nowrap" cellspacing="0" width="100%">

                                 <thead>
                        <tr>
                            <th><?php echo get_phrase('Numero de documento');?></th>
                            <th><div><?php echo get_phrase('nombre completo');?></div></th>
                            <th><div><?php echo get_phrase('correo electronico');?></div></th>
                            <th><div><?php echo get_phrase('telefono');?></div></th>
                            <th><div><?php echo get_phrase('profesion');?></div></th>
                            <th><div><?php echo get_phrase('opcion');?></div></th>
                        </tr>
                    </thead>

    <tbody>

    <?php
   $count = 1; foreach ($select_parent as $key => $parent):?>

        			
            <tr>
            <td><?php echo $parent ['parent_id'];?></td>
            <td><?php echo $parent ['name'];?></td>
            <td><?php echo $parent ['email'];?></td>
            <td><?php echo $parent ['phone'];?></td>
            <td><?php echo $parent ['profession'];?></td>
                <td>
                
                <a onclick="showAjaxModal('<?php echo base_url();?>modal/popup/edit_parent/<?php echo $parent['parent_id'];?>')" class="btn btn-info btn-circle btn-xs"><i class="fa fa-edit"></i></a>
                <a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/parent/delete/<?php echo $parent['parent_id'];?>');"><button type="button" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-times"></i></button></a>
                
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

<script type="text/javascript">
    function CheckPasswordStrength(password) {
        var password_strength = document.getElementById("password_strength");

            //TextBox left blank.
            if (password.length == 0) {
                password_strength.innerHTML = "";
                return;
            }

            //Regular Expressions.
            var regex = new Array();
            regex.push("[A-Z]"); //Uppercase Alphabet.
            regex.push("[a-z]"); //Lowercase Alphabet.
            regex.push("[0-9]"); //Digit.
            regex.push("[$@$!%*#?&]"); //Special Character.

            var passed = 0;

            //Validate for each Regular Expression.
            for (var i = 0; i < regex.length; i++) {
                if (new RegExp(regex[i]).test(password)) {
                    passed++;
                }
            }

            //Display status.
            var color = "";
            var strength = "";
            switch (passed) {
                case 0:
                case 1:
                case 2:
                    strength = "Debil";
                    color = "red";
                    break;
                case 3:
                    strength = "Medio";
                    color = "orange";
                    break;
                case 4:
                    strength = "Fuerte";
                    color = "green";
                    break;
                
            }
            password_strength.innerHTML = strength;
            password_strength.style.color = color;

    if(passed <= 2){
            document.getElementById('show').disabled = true;
            }else{
                document.getElementById('show').disabled = false;
            }

        }
</script>