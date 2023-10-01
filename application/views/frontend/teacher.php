<?php include 'css.php';?>

<!--Wrapper Start-->  
<div class="ct_wrapper">
	
<?php include 'header.php';?>
        
<?php include 'navigation.php';?>
    </header>
    <!--Header Wrap End-->
    
    <!--Banner Wrap Start-->
    <section class="sub_banner_wrap">
    	<div class="container">
        	<div class="row">
            	<div class="col-md-6">
                	<div class="sub_banner_hdg">
                    	<h3>Nuestros docentes</h3>
                    </div>
                </div>
                <div class="col-md-6">
                	<div class="ct_breadcrumb">
                    	<ul>
                        	<li><a href="#">Inicio</a></li>
                            <li><a href="#">Nuestros docentes</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Banner Wrap End-->
    
    <!--Content Wrap Start-->
    <div class="ct_content_wrap">
    	<section>
        	<div class="container">
                <div class="row">
				
					<div class="ct_heading_1_wrap">
                	<h3><?php echo get_phrase('Conoce a nuestros docentes');?></h3>
					<span><img src="<?php echo base_url();?>uploads/hdg-01.png" alt=""></span>
                     </div>
                   
        
        <?php $teachers = $this->website_model->select_all_teachers_from_teache_table();
                    foreach ($teachers as $key => $teacher):?>
					<!-- .col -->
                    <div class="col-md-4 col-sm-4">
                        <div class="white-box">
                            <div class="row">
                                <div class="col-md-4 col-sm-4 text-center">
                                    <a href=""><img src="<?php echo base_url();?>uploads/teacher_image/<?php echo $teacher['teacher_id'] . '.jpg';?>" alt="user" class="img-circle img-responsive"></a>
                                </div>
                                <div class="col-md-8 col-sm-8">
                                    <h3 class="box-title m-b-0"><?php echo $teachers['name'];?></h3> <small><?php echo $teacher['qualification'];?></small>
                                    <p>
                                        <address>
                                        <?php if($teacher['role']== 1) echo 'Director de grupo';?>
                                        <?php if($teacher['role']== 2) echo 'Docente asignatura';?>
                                            <br/>
                                            <br/>
                                            <abbr title="Phone">P:</abbr> <a href="tel:<?php echo $this->db->get_where('settings', array('type' => 'phone'))->row()->description;?>">Telefono</a>
                                        </address>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <?php endforeach;?>
					
                </div>
            </div>
        </section>
        
    </div>
    <!--Content Wrap End-->
    
    <?php include 'footer.php';?>
        
</div>
<!--Wrapper End-->




<?php include 'javascript.php';?>
