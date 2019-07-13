<?php include "includes/admin_header.php" ?>
<?php include "includes/admin_navigation.php" ?>
   
    
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to admin
                            
                            <small>
                            
                            <?php showUsername(); ?> 
                             </small>
                        </h1>
                        
                        <div class="col-xs-6">
                           
                        </div> 
                        
                        
                        
                        <div class="col-xs-6">   
                        </div>
                        
                    </div>
                </div>
                <!-- /.row -->
                
                <!-- /.row -->
                
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        
                        <?php postCountQueryDashboard(); ?>
                                   
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="./posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    
                      <?php commentCountQueryDashboard(); ?>
                     
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="./comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        
                        <?php userCountQueryDashboard(); ?>
                        
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="./users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    
                    <?php categoryCountQueryDashboard(); ?>                       
                    
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="./categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
                <!-- /.row -->
                
                
                
    <?php

        publishedPostCountQuery();
        draftPostCountQuery();
        unapprovedCommentCountQuery();
        subscriberCountQuery();

    ?>
               
                
                
                
    <div class="row">
     <script type="text/javascript">
         google.charts.load('current', {'packages':['bar']});
         google.charts.setOnLoadCallback(drawChart);
         
         function drawChart() {
             var data = google.visualization.arrayToDataTable([
                 ['Data', 'Count'],
                 <?php chartElements(); ?>]);
             
             var options = {
                 chart: {
                 title: '',
                 subtitle: '',
                 }
             };

             var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
             
             chart.draw(data, google.charts.Bar.convertOptions(options));
         }
    </script>

    <div id="columnchart_material" style="width: auto; height: auto"></div>
    </div>
</div>
            <!-- /.container-fluid -->

</div>
        <!-- /#page-wrapper -->
        
<?php include "includes/admin_footer.php"?>

