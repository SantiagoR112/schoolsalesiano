<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><?php echo $page_title;?></h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> <a href="<?php echo base_url();?>website/index/"  class="btn btn-info btn-sm pull-right m-l-20 btn-rounded hidden-xs hidden-sm waves-effect waves-light">Sitio web colegio</a>
                        <ol class="breadcrumb">
                            <li><a href=""><?php echo $system_name;?></a></li>
                            <?php date_default_timezone_set('America/Bogota');
                                echo '<li class="active">' . date('d M, Y') . '</li>';
                            ?>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
            </div>