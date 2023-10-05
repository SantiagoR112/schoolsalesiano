    <!-- Left navbar-header -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse slimscrollsidebar">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                        <!-- input-group -->
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search..."> <span class="input-group-btn">
            <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
            </span> </div>
                        <!-- /input-group -->
                    </li>
                    <li class="user-pro">

                        <?php
                            $key = $this->session->userdata('login_type') . '_id';
                            $face_file = 'uploads/' . $this->session->userdata('login_type') . '_image/' . $this->session->userdata($key) . '.jpg';
                            if (!file_exists($face_file)) {
                                $face_file = 'uploads/default.jpg';                                 
                            }
                            ?>

                    <a href="#" class="waves-effect"><img src="<?php echo base_url() . $face_file;?>" alt="user-img" class="img-circle"> <span class="hide-menu">

                       <?php 
                                $account_type   =   $this->session->userdata('login_type');
                                $account_id     =   $account_type.'_id';
                                $name           =   $this->crud_model->get_type_name_by_id($account_type , $this->session->userdata($account_id), 'name');
                                echo $name;
                        ?>


                        <span class="fa arrow"></span></span>
                    
                    </a>
                        <ul class="nav nav-second-level">
                            <li><a href="javascript:void(0)"><i class="ti-user"></i> My Profile</a></li>
                            <li><a href="javascript:void(0)"><i class="ti-email"></i> Inbox</a></li>
                            <li><a href="javascript:void(0)"><i class="ti-settings"></i> Account Setting</a></li>
                            <li><a href="<?php echo base_url();?>login/logout"><i class="fa fa-power-off"></i> Logout</a></li>
                        </ul>
                    </li>


     <!---  Permission for Admin Dashboard starts here ------>
        <?php $check_admin_permission = $this->db->get_where('admin_role', array('admin_id' => $this->session->userdata('admin_id')))->row()->dashboard;?>
        <?php if($check_admin_permission == '1'):?>
            <li> <a href="<?php echo base_url();?>admin/dashboard" class="waves-effect"><i class="ti-dashboard p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('Panel') ;?></span></a> </li>
        <?php endif;?> 
    <!---  Permission for Admin Dashboard ends here ------>
                    
     <!---  Permission for Admin Manage Academics starts here ------>
     <?php $check_admin_permission = $this->db->get_where('admin_role', array('admin_id' => $this->session->userdata('admin_id')))->row()->manage_academics;?>
     <?php if($check_admin_permission == '1'):?>   
        <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-mortar-board" data-icon="7"></i> <span class="hide-menu"> <?php echo get_phrase('Administrar académicos');?> <span class="fa arrow"></span></span></a>
                        <ul class=" nav nav-second-level<?php
            if (    $page_name == 'enquiry_category'||
                    $page_name == 'list_enquiry'||
                    $page_name == 'club'||
                    $page_name == 'circular'||
                    $page_name == 'academic_syllabus') echo 'opened active';
            ?> ">
                            

        <li class="<?php if ($page_name == 'circular') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>admin/circular">
                <i class="fa fa-angle-double-right p-r-10"></i>
                 <span class="hide-menu"> <?php echo get_phrase('Gestión de circulares'); ?></span>
                </a>
        </li>

         
                           
        </ul>
    </li>
    <?php endif;?> <!---  Permission for Admin Manage Academics ends here ------>
                   




    <!---  Permission for Admin Manage Employee starts here ------>
    <?php $check_admin_permission = $this->db->get_where('admin_role', array('admin_id' => $this->session->userdata('admin_id')))->row()->manage_employee;?>
    <?php if($check_admin_permission == '1'):?> 

        <li class="staff"> <a href="javascript:void(0);" class="waves-effect"><i data-icon="&#xe006;" class="fa fa-angle-double-right p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('Gestionar empleados');?><span class="fa arrow"></span></span></a>
        
                        <ul class=" nav nav-second-level<?php
            if ($page_name == 'teacher' ||
                    $page_name == 'librarian'|| $page_name == 'hrm'||
                    $page_name == 'accountant'||
                    $page_name == 'hostel')
                echo 'opened active';
            ?> ">



                        
            <li class="<?php if ($page_name == 'teacher') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>admin/teacher">
                <i class="fa fa-angle-double-right p-r-10"></i>
                     <span class="hide-menu"><?php echo get_phrase('Docentes'); ?></span>
                </a>
            </li>


     
                 </ul>
    </li>
    <?php endif;?> <!---  Permission for Admin Manage Employee ends here ------>






    <!---  Permission for Admin Manage Student starts here ------>
    <?php $check_admin_permission = $this->db->get_where('admin_role', array('admin_id' => $this->session->userdata('admin_id')))->row()->manage_student;?>
    <?php if($check_admin_permission == '1'):?>          
                
        <li class="student"> <a href="#" class="waves-effect"><i data-icon="&#xe006;" class="fa fa-users p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('Gestionar estudiantes');?><span class="fa arrow"></span></span></a>
        
                        <ul class=" nav nav-second-level<?php
            if ($page_name == 'new_student' ||
                    $page_name == 'student_class' ||
                    $page_name == 'student_information' ||
                    $page_name == 'view_student' ||
                    $page_name == 'studentMassIdentityCard' ||
                    $page_name == 'searchStudent')
                echo 'opened active has-sub';
            ?> ">


                        
                    <li class="<?php if ($page_name == 'new_student') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>admin/new_student">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                              <span class="hide-menu"><?php echo get_phrase('Formulario de admisión'); ?></span>
                        </a>
                    </li>


                    
                     <li class="<?php if ($page_name == 'student_information' || $page_name == 'student_information' || $page_name == 'view_student') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>admin/student_information">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                              <span class="hide-menu"><?php echo get_phrase('Lista de estudiantes'); ?></span>
                        </a>
                    </li>


    
     
                 </ul>
    </li>
    <?php endif;?> <!---  Permission for Admin Manage Student ends here ------>





    
                
                



    
                                   


    <!---  Permission for Admin Download Parent Page starts here ------>
    <?php $check_admin_permission = $this->db->get_where('admin_role', array('admin_id' => $this->session->userdata('admin_id')))->row()->manage_parent;?>
    <?php if($check_admin_permission == '1'):?> 

        <li class=" <?php if($page_name == 'parent')echo 'active';?>">
                    <a href="<?php echo base_url();?>admin/parent" >
                    <i class="fa fa-users p-r-10"></i>
                    <span class="hide-menu"><?php echo get_phrase('Gestionar acudientes');?></span>
                    </a>    
        </li>
    <?php endif;?> <!---  Permission for Admin Download Page  ends here ------>

    <!---  Permission for Admin periodtime Page starts here ------>

        <li class=" <?php if($page_name == 'periodtime')echo 'active';?>">
                    <a href="<?php echo base_url();?>admin/periodtime" >
                    <i class="fa fa-clock-o p-r-10"></i>
                    <span class="hide-menu"><?php echo get_phrase('Plazos periodos');?></span>
                    </a>    
        </li>



    
                
        

                



                         <li class="<?php if ($page_name == 'subject') echo 'active'; ?>">
                            <a href="<?php echo base_url(); ?>subject/subject/">
                            <i class="fa fa-book p-r-10"></i>
                                 <span class="hide-menu"><?php echo get_phrase('Gestionar asignaturas'); ?></span>
                            </a>
                        </li>

         
         


           
                    
                    
        
				
				
				 

                
                
                    
                    
                
                                    
                

                
                
          
                
                
            <li> <a href="#" class="waves-effect"><i data-icon="&#xe006;" class="fa fa-car p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('Transporte');?><span class="fa arrow"></span></span></a>
        
                        <ul class=" nav nav-second-level<?php
            if ($page_name == 'transport' ||
                    $page_name == 'transport_route' ||
                    $page_name == 'vehicle' )
                echo 'opened active';
            ?>">
                

        
                <li class="<?php if ($page_name == 'transport') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>transportation/transport">
                <i class="fa fa-angle-double-right p-r-10"></i>
                   <span class="hide-menu"><?php echo get_phrase('Transportes'); ?></span>
                </a>
            </li>


                    <li class="<?php if ($page_name == 'transport_route') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>transportation/transport_route">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                            <span class="hide-menu"><?php echo get_phrase('Rutas de transporte'); ?></span>
                        </a>
                    </li>


                    
                     <li class="<?php if ($page_name == 'vehicle') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>transportation/vehicle">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                            <span class="hide-menu"><?php echo get_phrase('Gestionar vehículos'); ?></span>
                        </a>
                    </li>

     
                 </ul>
                </li>

        
        <li> <a href="#" class="waves-effect"><i data-icon="&#xe006;" class="fa fa-gears p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('Ajustes del sistema');?><span class="fa arrow"></span></span></a>
        
        <ul class=" nav nav-second-level<?php
                if ($page_name == 'system_settings' ||
                    $page_name == 'manage_language' ||
                    $page_name == 'paymentSetting' ||
                    $page_name == 'sms_settings')
                    echo 'opened active';
                ?>">  

 
                 <li class="<?php if ($page_name == 'system_settings') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>systemsetting/system_settings">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                             <span class="hide-menu"><?php echo get_phrase('Ajustes generales'); ?></span>
                        </a>
                    </li>

  

                    <li class="<?php if ($page_name == 'websiteSetting') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>admin/websiteSetting">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                             <span class="hide-menu"><?php echo get_phrase('Ajustes del sitio web'); ?></span>
                        </a>
                    </li>
     
                 </ul>
                </li>
                
                
        


        <?php $checking_level = $this->db->get_where('admin', array('admin_id' => $this->session->userdata('login_user_id')))->row()->level;?>
        <?php if($checking_level == '1'):?>
        <li> <a href="#" class="waves-effect"><i data-icon="&#xe006;" class="fa fa-cubes p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('Gestión administradores');?><span class="fa arrow"></span></span></a>
        
            <ul class=" nav nav-second-level<?php
                        if ($page_name == 'newAdministrator') echo 'opened active'; ?>">

                        <li class="<?php if ($page_name == 'admin_add') echo 'active'; ?> ">
                            <a href="<?php echo base_url(); ?>admin/newAdministrator">
                            <i class="fa fa-angle-double-right p-r-10"></i>
                                 <span class="hide-menu"><?php echo get_phrase('Nuevo administrador'); ?></span>
                            </a>
                        </li>

     
                 </ul>
            </li>
        <?php endif;?>

        <?php $checking_level = $this->db->get_where('admin', array('admin_id' => $this->session->userdata('login_user_id')))->row()->level;?>
        <?php if($checking_level == '2'):?>
       

                        <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
                            <a href="<?php echo base_url(); ?>admin/manage_profile">
                            <i class="fa fa-gears p-r-10"></i>
                                 <span class="hide-menu"><?php echo get_phrase('Gestionar perfil'); ?></span>
                            </a>
                        </li>
        <?php endif;?>


                <li class="">
                        <a href="<?php echo base_url(); ?>login/logout">
                        <i class="fa fa-sign-out p-r-10"></i>
                             <span class="hide-menu"><?php echo get_phrase('Cerrar sesión'); ?></span>
                        </a>
                </li>
                  
                  
                </ul>
            </div>
        </div>
<!-- Left navbar-header end -->