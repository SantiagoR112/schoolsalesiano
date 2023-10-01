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
                            
        <li class="<?php if ($page_name == 'enquiry_category') echo 'active';?>"> 

            <a href="<?php echo base_url();?>admin/enquiry_category">
                <i class="fa fa-angle-double-right p-r-10"></i>
                <span class="hide-menu"><?php echo get_phrase('Categoría de equidad');?></span>

            </a> 
        </li>

       <li class="<?php if ($page_name == 'enquiry') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>admin/list_enquiry">
                <i class="fa fa-angle-double-right p-r-10"></i>
                      <span class="hide-menu"><?php echo get_phrase('Lista de consultas'); ?></span>
                </a>
        </li>

        <li class="<?php if ($page_name == 'club') echo 'active'; ?>">
                <a href="<?php echo base_url(); ?>admin/club">
                <i class="fa fa-angle-double-right p-r-10"></i>
                      <span class="hide-menu"><?php echo get_phrase('Clubes escolares'); ?></span>
                </a>
        </li>

        <li class="<?php if ($page_name == 'circular') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>admin/circular">
                <i class="fa fa-angle-double-right p-r-10"></i>
                 <span class="hide-menu"> <?php echo get_phrase('Gestión de circulares'); ?></span>
                </a>
        </li>

         

         <li class="<?php if ($page_name == 'academic_syllabus') echo 'active'; ?>">
                <a href="<?php echo base_url(); ?>admin/academic_syllabus">
                <i class="fa fa-angle-double-right p-r-10"></i>
                     <span class="hide-menu"><?php echo get_phrase('Programa de estudios'); ?></span>
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

                    


            <li class="<?php if ($page_name == 'librarian') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>admin/librarian">
                <i class="fa fa-angle-double-right p-r-10"></i>
                      <span class="hide-menu"><?php echo get_phrase('Bibliotecarios'); ?></span>
                </a>
            </li>





            <li class="<?php if ($page_name == 'accountant') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>admin/accountant">
                <i class="fa fa-angle-double-right p-r-10"></i>
                      <span class="hide-menu"><?php echo get_phrase('Contadores'); ?></span>
                </a>
            </li>



            <li class="<?php if ($page_name == 'hostel') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>admin/hostel">
                <i class="fa fa-angle-double-right p-r-10"></i>
                      <span class="hide-menu"><?php echo get_phrase('Geente del albergue'); ?></span>
                </a>
            </li>


            
            <li class="<?php if ($page_name == 'hrm') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>admin/hrm">
                <i class="fa fa-angle-double-right p-r-10"></i>
                      <span class="hide-menu"><?php echo get_phrase('Recursos humanos'); ?></span>
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


    <li class="<?php if ($page_name == 'studentCategory') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>studentcategory/studentCategory">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                             <span class="hide-menu"><?php echo get_phrase('Categorías de estudiantes'); ?></span>
                        </a>
     </li>
     
     <li class="<?php if ($page_name == 'studentHouse') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>studenthouse/studentHouse">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                             <span class="hide-menu"><?php echo get_phrase('Casa del estudiante'); ?></span>
                        </a>
     </li>
     
     <li class="<?php if ($page_name == 'clubActivity') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>activity/clubActivity">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                             <span class="hide-menu"><?php echo get_phrase('Actividad del estudiante'); ?></span>
                        </a>
     </li>
     
     <li class="<?php if ($page_name == 'socialCategory') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>socialcategory/socialCategory">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                             <span class="hide-menu"><?php echo get_phrase('Categoría social'); ?></span>
                        </a>
     </li>

     <li class="<?php if ($page_name == 'studentMassIdentityCard') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>admin/studentMassIdentityCard">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                             <span class="hide-menu"><?php echo get_phrase('Identificación del estudiante'); ?></span>
                        </a>
     </li>
        
     
                 </ul>
    </li>
    <?php endif;?> <!---  Permission for Admin Manage Student ends here ------>





    <!---  Permission for Admin Manage Attendance starts here ------>
    <?php $check_admin_permission = $this->db->get_where('admin_role', array('admin_id' => $this->session->userdata('admin_id')))->row()->manage_attendance;?>
    <?php if($check_admin_permission == '1'):?> 

        <li class="attendance"> <a href="#" class="waves-effect"><i data-icon="&#xe006;" class="fa fa-hospital-o p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('Gestionar asistencia');?><span class="fa arrow"></span></span></a>
        
                        <ul class=" nav nav-second-level<?php
            if ($page_name == 'manage_attendance' || $page_name == 'staff_attendance' ||
                    $page_name == 'attendance_report')
                echo 'opened active';
            ?>">
                        

                    <li class="<?php if ($page_name == 'manage_attendance') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>admin/manage_attendance/<?php echo date("d/m/Y"); ?>">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                              <span class="hide-menu"><?php echo get_phrase('Marcar asistencia'); ?></span>
                        </a>
                    </li>


                    <li class="<?php if ($page_name == 'attendance_report') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>admin/attendance_report">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                              <span class="hide-menu"><?php echo get_phrase('Ver asistencia'); ?></span>
                        </a>
                    </li>

                
                 </ul>
                </li>
            <?php endif;?> <!---  Permission for Admin Manage Attendance ends here ------>
                
                



    <!---  Permission for Admin Manage Download Page starts here ------>
    <?php $check_admin_permission = $this->db->get_where('admin_role', array('admin_id' => $this->session->userdata('admin_id')))->row()->download_page;?>
    <?php if($check_admin_permission == '1'):?> 

        <li> <a href="#" class="waves-effect"><i data-icon="&#xe006;" class="fa fa-download p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('Página de descarga');?><span class="fa arrow"></span></span></a>
        
                        <ul class=" nav nav-second-level<?php
            if ($page_name == 'assignment' ||
                    $page_name == 'study_material')
                echo 'opened active';
            ?> ">
                                     

            <li class="<?php if ($page_name == 'assignment') echo 'active'; ?>">
                <a href="<?php echo base_url(); ?>assignment/assignment">
                <i class="fa fa-angle-double-right p-r-10"></i>
                    <span class="hide-menu"><?php echo get_phrase('Asignaciones'); ?></span>
                </a>
            </li>

   

                <li class="<?php if ($page_name == 'study_material') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>studymaterial/study_material">
                <i class="fa fa-angle-double-right p-r-10"></i>
                      <span class="hide-menu"><?php echo get_phrase('Materiales de estudio'); ?></span>
                </a>
            </li>

     
                 </ul>
        </li>

        <?php endif;?> <!---  Permission for Admin Download Page  ends here ------>
                                   


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



    <!---  Permission for Admin Manage Alumni starts here ------>
    <?php $check_admin_permission = $this->db->get_where('admin_role', array('admin_id' => $this->session->userdata('admin_id')))->row()->manage_alumni;?>
    <?php if($check_admin_permission == '1'):?> 

            <li class="<?php if($page_name == 'alumni')echo 'active';?>">
                <a href="<?php echo base_url();?>admin/alumni" >
                    <i class="fa fa-users p-r-10"></i>
                    <span class="hide-menu"><?php echo get_phrase('Gestionar estudiante');?></span>
                </a>    
            </li>
    <?php endif;?> <!---  Permission for Admin Manage Alumni ends here ------>

                
        <li> <a href="#" class="waves-effect"><i data-icon="&#xe006;" class="fa fa-university p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('Información de la clase');?><span class="fa arrow"></span></span></a>
        
            <ul class=" nav nav-second-level<?php
            if ($page_name == 'class' ||
                    $page_name == 'section' ||
                    $page_name == 'class_routine')
                echo 'opened active';
            ?>">


                        
                         <li class="<?php if ($page_name == 'class') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>admin/classes">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                           <span class="hide-menu"><?php echo get_phrase('Gestionar clases'); ?></span>
                        </a>
                    </li>


                    <li class="<?php if ($page_name == 'section') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>admin/section">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                            <span class="hide-menu"><?php echo get_phrase('Gestionar secciones'); ?></span>
                        </a>
                    </li>   
                    
                    
                    <li class="<?php if ($page_name == 'class_routine_add' ) echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>admin/class_routine_add/">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                             <span class="hide-menu"><?php echo get_phrase('Agregar horario'); ?> </span>
                        </a>
                    </li>
                    
                     <li class="<?php if ($page_name == 'class_routine_view' ) echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>admin/listStudentTimetable/">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                             <span class="hide-menu"><?php echo get_phrase('Lista de horarios'); ?> </span>
                        </a>
                    </li>
             
           
                 </ul>
                </li>

                



                         <li class="<?php if ($page_name == 'subject') echo 'active'; ?>">
                            <a href="<?php echo base_url(); ?>subject/subject/">
                            <i class="fa fa-book p-r-10"></i>
                                 <span class="hide-menu"><?php echo get_phrase('Gestionar asignaturas'); ?></span>
                            </a>
                        </li>

         
         <li> <a href="#" class="waves-effect"><i data-icon="&#xe006;" class="fa fa-medkit p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('Gestionar exámenes');?><span class="fa arrow"></span></span></a>
        
        <ul class=" nav nav-second-level<?php
        if ($page_name == 'submit_exam' || $page_name == 'grade' ||  $page_name == 'createExamination' || 
            $page_name == 'examQuestion') echo 'opened active';
        ?>">
                    
    
                    <li class="<?php if ($page_name == 'examQuestion') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>admin/examQuestion">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                           <span class="hide-menu"><?php echo get_phrase('Papel de preguntas'); ?></span>
                        </a>
                    </li>

                    <!--<li class="<?php if ($page_name == 'grade') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>admin/grade">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                           <span class="hide-menu"><?php echo get_phrase('Calificaciones de exámenes'); ?></span>
                        </a>
                    </li>-->

                    <li class="<?php if ($page_name == 'createExamination') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>admin/createExamination">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                           <span class="hide-menu"><?php echo get_phrase('Agregar examen'); ?></span>
                        </a>
                    </li>

     
                 </ul>
                </li>


           <li> <a href="#" class="waves-effect"><i data-icon="&#xe006;" class="fa fa-bar-chart-o p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('Boletas de calificaciones');?><span class="fa arrow"></span></span></a>
        
                        <ul class=" nav nav-second-level<?php
            if ($page_name == 'marks' ||
                    $page_name == 'exam_marks_sms'||
                    $page_name == 'tabulation_sheet')
                echo 'opened active';
            ?>">
    
                    <li class="<?php if ($page_name == 'marks') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>admin/marks">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                           <span class="hide-menu"><?php echo get_phrase('Docente de la clase'); ?></span>
                        </a>
                    </li>
            
                    <li class="<?php if ($page_name == 'student_marksheet_subject') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>admin/student_marksheet_subject">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                           <span class="hide-menu"><?php echo get_phrase('Docente de la asignatura'); ?></span>
                        </a>
                    </li>


                    <li class="<?php if ($page_name == 'exam_marks_sms') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>admin/exam_marks_sms">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                            <span class="hide-menu"><?php echo get_phrase('Puntuaciones por sms'); ?></span>
                        </a>
                    </li>


                    <li class="<?php if ($page_name == 'tabulation_sheet') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>admin/tabulation_sheet">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                            <span class="hide-menu"><?php echo get_phrase('Informe final'); ?></span>
                        </a>
                    </li>
     
                 </ul>
                </li>
                    
                    
        <li class="collect_fee"> <a href="#" class="waves-effect"><i data-icon="&#xe006;" class="fa fa-paypal p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('Cobro de tarifas');?><span class="fa arrow"></span></span></a>
        
                        <ul class=" nav nav-second-level<?php
            if ($page_name == 'income' ||
                        $page_name == 'student_payment'||
                        $page_name == 'view_invoice_details'||
                        $page_name == 'invoice_add'||
                        $page_name == 'list_invoice'||
                        $page_name == 'studentSpecificPaymentQuery'||
                        $page_name == 'student_invoice')
                echo 'opened active';
            ?>">

                 <li class="<?php if ($page_name == 'student_payment') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>admin/student_payment">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                             <span class="hide-menu"><?php echo get_phrase('Cobrar tarifas'); ?></span>
                        </a>
                    </li>
                    
                     <li class="<?php if ($page_name == 'student_invoice') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>admin/student_invoice">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                             <span class="hide-menu"><?php echo get_phrase('Gestionar factura'); ?></span>
                        </a>
                    </li>
     
                 </ul>
                </li>
				
				
				 <li> <a href="#" class="waves-effect"><i data-icon="&#xe006;" class="fa fa-edit p-r-10"></i> <span class="hide-menu">
				 	<?php echo get_phrase('Prueba basada en computadora');?><span class="fa arrow"></span></span></a>
		
                      <ul class=" nav nav-second-level<?php
							if ($page_name == 'exam_list' ||
									$page_name == 'exam_add' ||
									$page_name == 'exam_view' ||
									$page_name == 'exam_result_list')
								echo 'opened active';
							?> ">

							<li class="<?php if ($page_name == 'add_online_exam') echo 'active'; ?> ">
							  <a href="<?php echo site_url($account_type.'/create_online_exam'); ?>">
									<i class="fa fa-angle-double-right p-r-10"></i>
									<span class="hide-menu"><?php echo get_phrase('Agregar exámenes'); ?></span>
							  </a>
							</li>
							
							 <li class="<?php if ($page_name == 'manage_online_exam' || 
							 $page_name == 'edit_online_exam' || $page_name == 'manage_online_exam_question' || $page_name == 'view_online_exam_results') echo 'active'; ?> ">
								<a href="<?php echo site_url($account_type.'/manage_online_exam'); ?>">
									<i class="fa fa-angle-double-right p-r-10"></i>
									<span class="hide-menu"><?php echo get_phrase('Gestionar exámenes'); ?></span>
							  </a>
							</li>

                 	</ul>
                </li>

                
                
                    
                    <li> <a href="#" class="waves-effect"><i data-icon="&#xe006;" class="fa fa-credit-card p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('Recursos humanos');?><span class="fa arrow"></span></span></a>
        
                        <ul class=" nav nav-second-level<?php
            if ($page_name == 'department' ||
                    $page_name == 'vacancy'|| $page_name == 'award'||
                     $page_name == 'application'||
                      $page_name == 'leave'||
                      $page_name == 'create_payslip'||
                    $page_name == 'payroll_list')
                echo 'opened active';
            ?>">
   
                    <li class="<?php if ($page_name == 'department') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>department/department">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                             <span class="hide-menu"><?php echo get_phrase('Departamento'); ?></span>
                        </a>
                    </li>
   
                    
<li> <a href="#" class="waves-effect"<i data-icon="&#xe006;"></i> <span class="hide-menu"><i class="fa fa-university p-r-10"></i><?php echo get_phrase('Reclutamiento');?><span class="fa arrow"></span></span></a>
                                <ul class=" nav nav-second-level">
              
                    <li class="<?php if ($page_name == 'vacancy') echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>admin/vacancy">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                             <span class="hide-menu"><?php echo get_phrase('Vacantes'); ?></span>
                        </a>
                    </li>
                    
                     <li class="<?php if ($page_name == 'application') echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>admin/application">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                             <span class="hide-menu"><?php echo get_phrase('Aplicaciones'); ?></span>
                        </a>
                    </li>
                
                    </ul>
                     </li>

                    
                    <li class="<?php if ($page_name == 'leave') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>admin/leave">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                            <span class="hide-menu"><?php echo get_phrase('Abandonar'); ?></span>
                        </a>
                    </li>
                    

<li> <a href="#" class="waves-effect"<i data-icon="&#xe006;"></i> <span class="hide-menu"><i class="fa fa-university p-r-10"></i><?php echo get_phrase('Nómina');?><span class="fa arrow"></span></span></a>
                                <ul class=" nav nav-second-level">
              
                    <li class="<?php if ($page_name == 'create_payslip') echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>admin/payroll">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                             <span class="hide-menu"><?php echo get_phrase('Agregar nómina'); ?></span>
                        </a>
                    </li>
                    
                     <li class="<?php if ($page_name == 'payroll_list') echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>admin/payroll_list">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                             <span class="hide-menu"><?php echo get_phrase('Listado de nómina'); ?></span>
                        </a>
                    </li>
                
                    </ul>
                     </li>


                    
                     <li class="<?php if ($page_name == 'award') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>admin/award">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                             <span class="hide-menu"><?php echo get_phrase('Gestionar premios'); ?></span>
                        </a>
                    </li>

                 </ul>
                </li>
                
                                    
                    <li> <a href="#" class="waves-effect"><i data-icon="&#xe006;" class="fa fa-fax p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('Gastos');?><span class="fa arrow"></span></span></a>
        
                        <ul class=" nav nav-second-level<?php
            if ($page_name == 'expense' ||
                    $page_name == 'expense_category' )
                echo 'opened active';
            ?> ">
                     
                 <li class="<?php if ($page_name == 'expense') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>expense/expense">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                             <span class="hide-menu"><?php echo get_phrase('Gastos'); ?></span>
                        </a>
                    </li>



                    <li class="<?php if ($page_name == 'expense_category') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>expense/expense_category">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                             <span class="hide-menu"><?php echo get_phrase('Categoría de gastos'); ?></span>
                        </a>
                    </li>
     
                 </ul>
                </li>
                

        <li> <a href="#" class="waves-effect"><i data-icon="&#xe006;" class="fa fa-book p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('Gestionar biblioteca');?><span class="fa arrow"></span></span></a>
        
                        <ul class=" nav nav-second-level<?php
            if ($page_name == 'book' ||
                    $page_name == 'publisher' ||
                    $page_name == 'search_student' ||
                    $page_name == 'book_category' || $page_name == 'request_book' ||
                    $page_name == 'author' )
                echo 'opened active';
            ?>">


        
                 <li class="<?php if ($page_name == 'book') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>admin/book">
                <i class="fa fa-angle-double-right p-r-10"></i>
                   <span class="hide-menu"><?php echo get_phrase('Datos maestros'); ?></span>
                </a>
            </li>


                    <li class="<?php if ($page_name == 'publisher') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>admin/publisher">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                            <span class="hide-menu"><?php echo get_phrase('Editor de libros'); ?></span>
                        </a>
                    </li>

                    
                    <li class="<?php if ($page_name == 'book_category') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>admin/book_category">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                            <span class="hide-menu"><?php echo get_phrase('Categoría de libro'); ?></span>
                        </a>
                    </li>

                    
                    <li class="<?php if ($page_name == 'author') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>admin/author">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                            <span class="hide-menu"><?php echo get_phrase('Autor de libro'); ?></span>
                        </a>
                    </li>

                    <li class="<?php if ($page_name == 'studentRequestBook') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>admin/studentRequestBook">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                            <span class="hide-menu"><?php echo get_phrase('Solicitar libro'); ?></span>
                        </a>
                    </li>
 
                    <!--
                    <li class="<?php if ($page_name == 'search_student') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>admin/search_student">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                            <span class="hide-menu"><?php echo get_phrase('Registrar estudiante'); ?></span>
                        </a>
                    </li>

                    <li class="<?php if ($page_name == 'request_book') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>admin/request_book">
                            <i class="fa fa-angle-double-right p-r-10"></i>
                            <span class="hide-menu"><?php echo get_phrase('Solicitar libro'); ?></span>
                        </a>
                    </li>
                    -->

                 </ul>
                </li>
                
        <li> <a href="#" class="waves-effect"><i data-icon="&#xe006;" class="fa fa-university p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('Información del albergue');?><span class="fa arrow"></span></span></a>
            <ul class=" nav nav-second-level<?php
            if ($page_name == 'dormitory' ||
                    $page_name == 'hostel_category' ||
                    $page_name == 'room_type' ||
                    $page_name == 'hostel_room' )
                echo 'opened active';
            ?>">

                <li class="<?php if ($page_name == 'dormitory') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>admin/dormitory">
                <i class="fa fa-angle-double-right p-r-10"></i>
                   <span class="hide-menu"><?php echo get_phrase('Gestionar albergues'); ?></span>
                </a>
            </li>


                    <li class="<?php if ($page_name == 'hostel_category') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>admin/hostel_category">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                            <span class="hide-menu"><?php echo get_phrase('Categoría de albergues'); ?></span>
                        </a>
                    </li>

                    
                    <li class="<?php if ($page_name == 'hostel_room') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>admin/hostel_room">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                            <span class="hide-menu"><?php echo get_phrase('Habitación de albergue'); ?></span>
                        </a>
                    </li>
     
                 </ul>
                </li>
                
           <li> <a href="#" class="waves-effect"><i data-icon="&#xe006;" class="fa fa-envelope p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('communications');?><span class="fa arrow"></span></span></a>
        
                        <ul class=" nav nav-second-level<?php
            if ($page_name == 'noticeboard' ||
                    $page_name == 'message')
                echo 'opened active';
            ?>">
        
                <li class="<?php if ($page_name == 'noticeboard') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>admin/noticeboard">
                <i class="fa fa-angle-double-right p-r-10"></i>
                   <span class="hide-menu"><?php echo get_phrase('Gestionar eventos'); ?></span>
                </a>
            </li>

<!--
            <li class="<?php if ($page_name == 'message') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>admin/message">
                <i class="fa fa-angle-double-right p-r-10"></i>
                    <span class="hide-menu"><?php echo get_phrase('Mensajes privados'); ?></span>
                </a>
            </li>
-->


        <li class="<?php if ($page_name == 'sendEmailMessage') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>emailmessage/sendEmailMessage">
                <i class="fa fa-angle-double-right p-r-10"></i>
                   <span class="hide-menu"><?php echo get_phrase('Enviar mensaje por correo electrónico'); ?></span>
                </a>
        </li>
 <!--           
        <li class="<?php if ($page_name == 'sendSMSMessage') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>smsmessage/sendSMSMessage">
                <i class="fa fa-angle-double-right p-r-10"></i>
                   <span class="hide-menu"><?php echo get_phrase('Enviar mensaje por sms'); ?></span>
                </a>
        </li>
-->
     
                 </ul>
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

  

                    <li class="<?php if ($page_name == 'sms_settings') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>smssetting/sms_settings">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                             <span class="hide-menu"><?php echo get_phrase('Gestionar api de sms'); ?></span>
                        </a>
                    </li>



                    <li class="<?php if ($page_name == 'manage_language') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>admin/manage_language">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                             <span class="hide-menu"><?php echo get_phrase('Gestionar idioma'); ?></span>
                        </a>
                    </li>


                    <li class="<?php if ($page_name == 'paymentSetting') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>payment/paymentSetting">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                             <span class="hide-menu"><?php echo get_phrase('Ajustes de pago'); ?></span>
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
                
                
        <li> <a href="#" class="waves-effect"><i data-icon="&#xe006;" class="fa fa-bar-chart-o p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('Generar reportes');?><span class="fa arrow"></span></span></a>
        
                        <ul class=" nav nav-second-level">  
   
                <li class="<?php if ($page_name == 'studentPaymentReport') echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>report/studentPaymentReport">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                           <span class="hide-menu"><?php echo get_phrase('Pagos de estudiantes'); ?></span>
                        </a>
                </li>

                
                <li class="<?php if ($page_name == 'classAttendanceReport') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>report/classAttendanceReport">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                             <span class="hide-menu"><?php echo get_phrase('Reporte de asistencia'); ?></span>
                        </a>
                </li>
                
                <li class="<?php if ($page_name == 'examMarkReport') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>report/examMarkReport">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                             <span class="hide-menu"><?php echo get_phrase('Informe de notas del examen'); ?></span>
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