<div class="row">
    <div class="col-sm-12">
		<div class="panel panel-info">
            <div class="panel-body table-responsive">
                            <section class="m-t-40">
                                <div class="sttabs tabs-style-linetriangle">
                                    <nav>
                                        <ul>
                                            <li><a href="#section-linetriangle-1"><span><?php echo get_phrase('Ajustes generales');?></span></a></li>
                                            <li><a href="#section-linetriangle-2"><span><?php echo get_phrase('Imagenes banner');?></span></a></li>
                                            <li><a href="#section-linetriangle-3"><span><?php echo get_phrase('Testimonios');?></span></a></li>
                                            <li><a href="#section-linetriangle-4"><span><?php echo get_phrase('Suscriptores');?></span></a></li>
                                            <li><a href="#section-linetriangle-5"><span><?php echo get_phrase('Contactenos');?></span></a></li>
                                        </ul>
                                    </nav>
                                    <div class="content-wrap">
                                        <section id="section-linetriangle-1">
                                         
                                            <?php echo form_open(base_url() . 'admin/websiteSetting/save_generalSetting/' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                                                
                                                <div class="form-group">
                                                    <label class="col-md-12" for="example-text"><?php echo get_phrase('Acerca de');?></label>
                                                        <div class="col-sm-12">
                                                            <textarea id="mymce" name="about_us"><?php echo $this->db->get_where('website_settings', array('type' => 'about_us'))->row()->description;?></textarea>
                                                        </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-12" for="example-text"><?php echo get_phrase('Enlace de video de YouTube');?></label>
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control" name="video_link"><?php echo $this->db->get_where('website_settings', array('type' => 'video_link'))->row()->description;?></textarea>
                                                        </div>
                                                </div>

                                                
                                                <div class="form-group">
                                                    <label class="col-md-12" for="example-text"><?php echo get_phrase('Misión');?></label>
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control" name="mission"><?php echo $this->db->get_where('website_settings', array('type' => 'mission'))->row()->description;?></textarea>
                                                        </div>
                                                </div>

                                                
                                                <div class="form-group">
                                                    <label class="col-md-12" for="example-text"><?php echo get_phrase('Visión');?></label>
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control" name="vission"><?php echo $this->db->get_where('website_settings', array('type' => 'vission'))->row()->description;?></textarea>
                                                        </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-12" for="example-text"><?php echo get_phrase('Meta');?></label>
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control" name="goal"><?php echo $this->db->get_where('website_settings', array('type' => 'goal'))->row()->description;?></textarea>
                                                        </div>
                                                </div>

                                                
                                                <div class="form-group">
                                                    <label class="col-md-12" for="example-text"><?php echo get_phrase('Mensajes de testimonios');?></label>
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control" name="testimony_message"><?php echo $this->db->get_where('website_settings', array('type' => 'testimony_message'))->row()->description;?></textarea>
                                                        </div>
                                                </div>

                                                
                                                <div class="form-group">
                                                    <label class="col-md-12" for="example-text"><?php echo get_phrase('Código del mapa de Google Maps');?></label>
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control" name="map_code"><?php echo $this->db->get_where('website_settings', array('type' => 'map_code'))->row()->description;?></textarea>
                                                        </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-12" for="example-text"><?php echo get_phrase('Enlace de la página de Facebook');?></label>
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control" name="facebook_like_code"><?php echo $this->db->get_where('website_settings', array('type' => 'facebook_like_code'))->row()->description;?></textarea>
                                                            <p style="color:green"> Por favor asegúrese de que su enlace se vea así: "https://www.facebook.com/colegio" DONDE "colegio" es el nombre de su página de Facebook.</P>
                                                        </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-12" for="example-text"><?php echo get_phrase('Contacto - Mensaje de bienvenida');?></label>
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control" name="contact_message"><?php echo $this->db->get_where('website_settings', array('type' => 'contact_message'))->row()->description;?></textarea>
                                                        </div>
                                                </div>

                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('Guardar');?></button>
                                                </div>

                                            <?php echo form_close();?>
                                        </section>
                                        <section id="section-linetriangle-2">
                                        <?php echo form_open(base_url() . 'admin/websiteSetting/save_banner/' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>

                                            <div class="form-group">
                                                <label class="col-md-12" for="example-text"><?php echo get_phrase('Seleccionar banner');?></label>
                                                    <div class="col-sm-12">
                                                        <input type="file" name="banner_image" class="dropify" required>
                                                    <p style="color:red">Asegúrate de cargar una imagen de banner con un tamaño de 1920 x 623.</p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-12" for="example-text"><?php echo get_phrase('Texto del banner');?></label>
                                                    <div class="col-sm-12">
                                                       <input class="form-control" name="banner_text" >
                                                    </div>
                                            </div>

                                            <div class="form-group">
                                                    <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('Guardar');?></button>
                                            </div>
                                            <?php echo form_close();?>
                                        <hr>
                                        <table id="example" class="display nowrap" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th><div><?php echo get_phrase('Imagen del banner');?></div></th>
                                                <th><div><?php echo get_phrase('Texto del banner');?></div></th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $select_banner = $this->db->get('banner_table')->result_array();
                                            foreach($select_banner as $key => $banner):?>
                                                <tr>
                                                    <td><img src="<?php echo base_url();?>uploads/banner_image/<?php echo $banner['banner_image'];?>" class="img-circle" width="50px" height="50px"></td>
                                                    <td><?php echo $banner['banner_text'];?></td>
                                                    
                                                </tr>
                                            <?php endforeach;?>
                                        </tbody>
                                    </table>    
                                        </section>
                                        <section id="section-linetriangle-3">
                                           
                                        <table id="example" class="display nowrap" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th><div><?php echo get_phrase('Nombre del acudiente');?></div></th>
                                                <th><div><?php echo get_phrase('Contenido');?></div></th>
                                                <th><div><?php echo get_phrase('Estado');?></div></th>
                                                <th><div><?php echo get_phrase('Acciones');?></div></th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $select_testimonies = $this->db->get('testimony_table')->result_array();
                                            foreach($select_testimonies as $key => $testimony):?>
                                                <tr>
                                                    <td><?php echo $this->crud_model->get_type_name_by_id('parent', $testimony['parent_id']);?></td>
                                                    <td><?php echo $testimony['content'];?></td>
                                                    <td>
                                                    <span class="label label-<?php if($testimony['status'] == 'Approved') echo 'success'; else echo 'warning';?>"><?php echo $testimony['status'];?></span>
                                                    </td>
                                                    <td>
                                                    <a onclick="showAjaxModal('<?php echo base_url();?>modal/popup/testimony_status/<?php echo $testimony['testimony_id'];?>')" class="btn btn-info btn-circle btn-xs"><i class="fa fa-edit"></i></a>
                                                    <a href="<?php echo base_url();?>admin/websiteSetting/delete/<?php echo $testimony['testimony_id'];?>" onclick="return confirm('¿Estas seguro que deseas eliminar?');" class="btn btn-danger btn-circle btn-xs" style="color:white"><i class="fa fa-times"></i></a>
                                                    </td>
                                                    
                                                </tr>
                                            <?php endforeach;?>
                                        </tbody>
                                    </table>    
                                           
                                           </section>
                                        <section id="section-linetriangle-4">
                                           
                                        <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th><div><?php echo get_phrase('Email');?></div></th>
                                               


                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $counter = 1; $select_subscribers = $this->website_model->sell_all_information_in_subscriber_table();
                                            foreach($select_subscribers as $key => $subscriber):?>
                                                <tr>
                                                    <td><?php echo $subscriber['email'];?></td>   
                                                </tr>
                                            <?php endforeach;?>
                                        </tbody>
                                    </table>    
                                           
                                           
                                        </section>
                                        <section id="section-linetriangle-5">

                                        <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th><?php echo get_phrase('Nombre del isitante');?></div></th>
                                                <th><div><?php echo get_phrase('Correo electrónico del visitante');?></div></th>
                                                <th><div><?php echo get_phrase('Contenido');?></div></th>
                                               


                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $contact_table = $this->db->get('contact_table')->result_array();
                                            foreach($contact_table as $key => $contact_table):?>
                                                <tr>
                                                    <td><?php echo $contact_table['visitor_name'];?></td>
                                                    <td><?php echo $contact_table['visitor_email'];?></td>
                                                    <td><?php echo $contact_table['visitor_content'];?></td>
                                                </tr>
                                            <?php endforeach;?>
                                        </tbody>
                                    </table>       
                                        
                                        </section>
                                    </div>
                                    <!-- /content -->
                                </div>
                                <!-- /tabs -->
                            </section>
            </div>
        </div>
    </div>
</div>