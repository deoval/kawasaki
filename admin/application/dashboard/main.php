<?php
include_once("../../../inc_config.php");  //Configuraçõe, defines, objetos e classes comuns
include_once("../../inc_start.php");  //Script de descontinuidade de sessão

$menu = 1;
$title = 'Dashboard';
$titleIcon = 'icon-home';
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?> :: Amatriz Admin</title>
        <?php include('../../_assets/inc/head.php') ?>
    </head>
    <body class="dash">
        <?php
        include('../../_assets/inc/navbar.php');
        include('../../_assets/inc/menu.php');
        ?>
            <link href="../../_assets/js/plugins/cirque/cirque.css" rel="stylesheet">
            <style>
            .chart-holder {
                height: 325px;
            }
            
            .cirque-stats {
                text-align: center;
            }
            
            .cirque-stats .cirque-container {   
                margin-top: 1.5em;
                margin-bottom: 1.5em;   
                margin-right: 2em;
                margin-left: 2em;
            }
            
            </style>
        <div class="main">
            
            <div class="container">

                
            
                <div class="row">
                
                    <div class="col-md-6">
                    
                            <div class="widget stacked">
                                
                                <div class="widget-header">
                                    <i class="icon-bar-chart"></i>
                                    <h3>Bar Chart</h3>
                                </div> <!-- /widget-header -->
                                
                                <div class="widget-content">
                                
                                    <div id="bar-chart" class="chart-holder"></div> <!-- /bar-chart -->
                                
                                </div> <!-- /widget-content -->
                            
                            </div> <!-- /widget -->     
                        
                    </div> <!-- /.span6 -->
                        
                
                    <div class="col-md-6">
                        
                        <div class="widget stacked">
                            
                            <div class="widget-header">
                                <i class="icon-bar-chart"></i>
                                <h3>Cirque Stats</h3>
                            </div> <!-- /widget-header -->
                            
                            <div class="widget-content">
                                
                                <div class="cirque-stats">
                                    <div class="ui-cirque" data-value="2875" data-total="3245" data-arc-color="#FF9900" data-label="ratio"></div>
                                    <div class="ui-cirque" data-value="13" data-arc-color="#222222"></div>
                                    <div class="ui-cirque" data-value="63" data-total="225" data-arc-color="#888888" data-label="ratio"></div>
                                    <div class="ui-cirque" data-value="40" data-arc-color="#222222"></div>
                                    <div class="ui-cirque" data-value="72" data-arc-color="#888888" data-label="ratio"></div>
                                    <div class="ui-cirque" data-value="57" data-arc-color="#FF9900"></div>
                                </div> <!-- /.cirque-stats -->
                            
                            </div> <!-- /widget-content -->
                        
                        </div> <!-- /widget --> 
                        
                    </div> <!-- /.span6 -->
                    
                </div> <!-- /.row -->
                
                
                <div class="row">           
                    
                    <div class="col-md-6">              
                    
                        <div class="widget stacked">
                            
                            <div class="widget-header">
                                <i class="icon-bar-chart"></i>
                                <h3>Area Chart</h3>
                            </div> <!-- /widget-header -->
                            
                            <div class="widget-content">
                            
                                <div id="area-chart" class="chart-holder"></div> <!-- /area-chart -->
                            
                            </div> <!-- /widget-content -->
                        
                        </div> <!-- /widget --> 
                        
                    </div> <!-- /.span6 -->
                        
                        
                        
                    
                    <div class="col-md-6">  
                    
                        <div class="widget stacked">
                            
                            <div class="widget-header">
                                <i class="icon-bar-chart"></i>
                                <h3>Pie Chart</h3>
                            </div> <!-- /widget-header -->
                            
                            <div class="widget-content">
                            
                                <div id="pie-chart" class="chart-holder"></div> <!-- /pie-chart -->
                            
                            </div> <!-- /widget-content -->
                        
                        </div> <!-- /widget -->         
                    
                    </div> <!-- /span6 -->
                    
                </div> <!-- /.row -->
                
                
                
                    <div class="row">   
                
                    <div class="col-md-6">
                    
                        <div class="widget stacked">
                            
                            <div class="widget-header">
                                <i class="icon-bar-chart"></i>
                                <h3>Donut Chart</h3>
                            </div> <!-- /widget-header -->
                            
                            <div class="widget-content">
                            
                                <div id="donut-chart" class="chart-holder"></div> <!-- /bar-chart -->
                            
                            </div> <!-- /widget-content -->
                        
                        </div> <!-- /widget -->         
                    
                    </div> <!-- /span6 -->
                        
                        
                
                    <div class="col-md-6">
                    
                        <div class="widget stacked">
                            
                            <div class="widget-header">
                                <i class="icon-bar-chart"></i>
                                <h3>Line Chart</h3>
                            </div> <!-- /widget-header -->
                            
                            <div class="widget-content">
                            
                                <div id="line-chart" class="chart-holder"></div> <!-- /line-chart -->
                            
                            </div> <!-- /widget-content -->
                        
                        </div> <!-- /widget -->             
                    
                    </div> <!-- /span6 -->

                </div>

                
                   <div class="col-md-4">
                                
                                    <div class="widget stacked widget-table">
                                    
                                    <div class="widget-header">
                                        <span class="icon-list-alt"></span>
                                        <h3>Top Referrers</h3>
                                    </div> <!-- .widget-header -->
                                    
                                    <div class="widget-content">
                                        <table class="table table-bordered table-striped">
                                            
                                            <thead><tr>                             
                                                <th>Referrer</th>
                                                <th>Uniques</th>                                
                                            </tr></thead>
                                    
                                        <tbody><tr>
                                            <td class="description"><a href="http://google.com">http://google.com</a></td>
                                            <td class="value"><span>1123</span></td>
                                        </tr>
                                        <tr>
                                            <td class="description"><a href="http://yahoo.com">http://yahoo.com</a></td>
                                            <td class="value"><span>927</span></td>
                                        </tr>
                                        <tr>
                                            <td class="description"><a href="http://themeforest.net">http://themeforest.net</a></td>
                                            <td class="value"><span>834</span></td>
                                        </tr>
                                        <tr>
                                            <td class="description"><a href="http://codecanyon.net">codecanyon.net</a></td>
                                            <td class="value"><span>625</span></td>
                                        </tr>
                                        <tr>
                                            <td class="description"><a href="http://graphicriver.net">http://graphicriver.net</a></td>
                                            <td class="value"><span>593</span></td>
                                        </tr>
                                        
                                        <tr>
                                            <td class="description"><a href="http://bing.com">http://bing.com</a></td>
                                            <td class="value"><span>324</span></td>
                                        </tr>
                                        
                                        
                                    </tbody></table>
                                        
                                    </div> <!-- .widget-content -->
                                    
                                </div> <!-- /widget --> 
                                    
                                </div> <!-- /span4 -->
                                
                                
                                
                                <div class="col-md-4">
                                    
                                    <div class="widget stacked widget-table">
                                    
                                    <div class="widget-header">
                                        <span class="icon-file"></span>
                                        <h3>Most Visited Pages</h3>
                                    </div> <!-- .widget-header -->
                                    
                                    <div class="widget-content">
                                        <table class="table table-bordered table-striped">
                                            
                                            <thead><tr>                             
                                                <th>Page</th>
                                                <th>Visits</th>                             
                                            </tr></thead>
                                    
                                        <tbody><tr>
                                            <td class="description"><a href="javascript:;">Homepage</a></td>
                                            <td class="value"><span>1123</span></td>
                                        </tr>
                                        <tr>
                                            <td class="description"><a href="javascript:;">Portfolio</a></td>
                                            <td class="value"><span>927</span></td>
                                        </tr>
                                        <tr>
                                            <td class="description"><a href="javascript:;">Services</a></td>
                                            <td class="value"><span>834</span></td>
                                        </tr>
                                        <tr>
                                            <td class="description"><a href="javascript:;">Contact Us</a></td>
                                            <td class="value"><span>625</span></td>
                                        </tr>
                                        <tr>
                                            <td class="description"><a href="javascript:;">Testimonials</a></td>
                                            <td class="value"><span>593</span></td>
                                        </tr>
                                        
                                        <tr>
                                            <td class="description"><a href="javascript:;">Signup</a></td>
                                            <td class="value"><span>456</span></td>
                                        </tr>
                                        
                                        
                                    </tbody></table>
                                        
                                    </div> <!-- .widget-content -->
                                    
                                </div>
                                    
                                </div> <!-- /span4 -->
                                
                                
                                
                                <div class="col-md-4">
                                    
                                    <div class="widget stacked widget-table">
                                    
                                    <div class="widget-header">
                                        <span class="icon-external-link"></span>
                                        <h3>Browsers</h3>
                                    </div> <!-- .widget-header -->
                                    
                                    <div class="widget-content">
                                        <table class="table table-bordered table-striped">
                                            
                                            <thead><tr>                             
                                                <th>Browser</th>
                                                <th>Visits</th>                             
                                            </tr></thead>
                                    
                                        <tbody><tr>
                                            <td class="description">Firefox</td>
                                            <td class="value"><span>1123</span></td>
                                        </tr>
                                        <tr>
                                            <td class="description">Chrome</td>
                                            <td class="value"><span>927</span></td>
                                        </tr>
                                        <tr>
                                            <td class="description">Internet Explorer</td>
                                            <td class="value"><span>834</span></td>
                                        </tr>
                                        <tr>
                                            <td class="description">Safari</td>
                                            <td class="value"><span>625</span></td>
                                        </tr>
                                        <tr>
                                            <td class="description">Opera</td>
                                            <td class="value"><span>593</span></td>
                                        </tr>
                                        
                                        <tr>
                                            <td class="description">Netscape</td>
                                            <td class="value"><span>123</span></td>
                                        </tr>
                                        
                                        
                                    </tbody></table>
                                        
                                    </div> <!-- .widget-content -->
                                    
                                </div>
                                    
                                </div> <!-- /span4 -->
                </div> <!-- /row -->
            
            
            </div> <!-- /container -->
            
        </div> <!-- /main -->
                    
            

            

                    
                  
       

        <?php
        include '../../_assets/inc/footer.php';
        include '../../_assets/inc/scripts.php';
        include '../../inc_util.php';
        ?>
        
        <script src="../../_assets/js/plugins/cirque/cirque.js"></script>
  
        <script src="../../_assets/js/plugins/flot/jquery.flot.js"></script>
        <script src="../../_assets/js/plugins/flot/jquery.flot.pie.js"></script>
        <script src="../../_assets/js/plugins/flot/jquery.flot.resize.js"></script>

        <script src="../../_assets/js/componente/charts/bar.js"></script>
        <script src="../../_assets/js/componente/charts/donut.js"></script>
        <script src="../../_assets/js/componente/charts/line.js"></script>
        <script src="../../_assets/js/componente/charts/pie.js"></script>
        <script src="../../_assets/js/componente/charts/area.js"></script>
        <!--<script src="especific.js"></script>
        <script type="text/javascript">Dashboard.lista();</script>-->
    </body>
</html>