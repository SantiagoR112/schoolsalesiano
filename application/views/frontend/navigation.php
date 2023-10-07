<!--Navigation Wrap Start-->
<div class="logo_nav_outer_wrap">
        	<div class="container">
                <div class="logo_wrap">
                    <a href="#"><img src="<?php echo base_url();?>uploads/logo.png" alt="School Logo" width="40px" height="40px"></a>
                </div>
                
               
                <nav class="main_navigation">
                    <ul>
                        <li><a href="<?php echo base_url();?>website/index"><?php echo get_phrase('Inicio');?><span><?php echo get_phrase('Página principal');?></span></a></li>
                        <li><a href="<?php echo base_url();?>website/about"><?php echo get_phrase('Acerca');?><span><?php echo get_phrase('Acerca de');?></span></a></li>
                        <li><a href="<?php echo base_url();?>website/teacher"><?php echo get_phrase('Docentes');?><span><?php echo get_phrase('Nuestros profesores');?></span></a></li>
						<li><a href="<?php echo base_url();?>website/contact"><?php echo get_phrase('Contacto');?><span><?php echo get_phrase('Contáctanos');?></span></a></li>
						
                        <?php if ($this->session->userdata('admin_id') || $this->session->userdata('teacher_id') || $this->session->userdata('student_id') || $this->session->userdata('parents_id')): ?>
                        <li><a href="<?php echo base_url();?>login"><?php echo get_phrase('Panel');?><span><?php echo get_phrase('Ir al panel');?></span></a></li>
                        <?php else: ?>
                        <li><a href="<?php echo base_url();?>login"><?php echo get_phrase('Iniciar sesión');?><span><?php echo get_phrase('Inicia sesión aquí');?></span></a></li>
                        <?php endif;?>
				                                                      
                    </ul>
                </nav>
                <!--DL Menu Start-->
                <div id="kode-responsive-navigation" class="dl-menuwrapper">
                    <button class="dl-trigger">Abrir Menú</button>
                    <ul class="dl-menu">
                        <li class="active"><a href="<?php echo base_url();?>website/index"><?php echo get_phrase('Inicio');?></a></li>
						 <li class="menu-item kode-parent-menu"><a href="<?php echo base_url();?>website/about"><span><?php echo get_phrase('Acerca de');?></a></li>
                        <li class="menu-item kode-parent-menu"><a href="<?php echo base_url();?>website/teacher"><span><?php echo get_phrase('Docentes');?></a></li>
                        <li class="menu-item kode-parent-menu"><a href="<?php echo base_url();?>website/contact"><span><?php echo get_phrase('Contáctenos');?></a></li>
						<li class="menu-item kode-parent-menu"><a href="<?php echo base_url();?>login"><span><?php echo get_phrase('Iniciar sesión');?></a></li>
						
                    </li>
                    </ul>
                </div>
                <!--DL Menu END-->
            </div>
        </div>
        <!--Navigation Wrap End-->

