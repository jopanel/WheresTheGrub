  <?php $sql2 = "select * from `settings`";
            $result2 =  mysql_query($sql2) or die(mysql_error());
            while($row2 = mysql_fetch_array($result2)){
                $title=$row2['title'];
$desc=$row2['desc'];
$keywords=$row2['keywords'];
}
?>


<!DOCTYPE html>
<head>
<html lang="en" class="app">
<meta charset="utf-8">
<link rel="shortcut icon" href="favicon.png">
<title><?php echo $title; ?></title>
<meta name="keywords" content="<?php echo $keywords; ?>">
<meta name="description" content="<?php echo $desc; ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="css/animate.css" type="text/css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="css/font.css" type="text/css" cache="false" />
    <link rel="stylesheet" href="css/app.css" type="text/css" />
  <!--[if lt IE 9]>
    <script src="js/ie/html5shiv.js" cache="false"></script>
    <script src="js/ie/respond.min.js" cache="false"></script>
    <script src="js/ie/excanvas.js" cache="false"></script>
  <![endif]-->
</head>
<body>
  <section class="vbox">
    <header class="bg-dark dk header navbar navbar-fixed-top-xs">
      <div class="navbar-header aside-md">
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen" data-target="#nav">
          <i class="fa fa-bars"></i>
        </a>
        <a href="#" class="navbar-brand" data-toggle="fullscreen"><img src="images/logo.png" class="m-r-sm">Wheres Grub</a>
        <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".nav-user">
          <i class="fa fa-cog"></i>
        </a>
      </div>
      <!-- maybe in the future

      <ul class="nav navbar-nav hidden-xs">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle dker" data-toggle="dropdown">
            <i class="fa fa-building-o"></i> 
            <span class="font-bold">Activity</span>
          </a>
          <section class="dropdown-menu aside-xl on animated fadeInLeft no-borders lt">
            <div class="wrapper lter m-t-n-xs">
              <a href="#" class="thumb pull-left m-r">
                <img src="images/avatar.jpg" class="img-circle">
              </a>
              <div class="clear">
                <a href="#"><span class="text-white font-bold">@Mike Mcalidek</a></span>
                <small class="block">Art Director</small>
                <a href="#" class="btn btn-xs btn-success m-t-xs">Upgrade</a>
              </div>
            </div>
            <div class="row m-l-none m-r-none m-b-n-xs text-center">
              <div class="col-xs-4">
                <div class="padder-v">
                  <span class="m-b-xs h4 block text-white">245</span>
                  <small class="text-muted">Followers</small>
                </div>
              </div>
              <div class="col-xs-4 dk">
                <div class="padder-v">
                  <span class="m-b-xs h4 block text-white">55</span>
                  <small class="text-muted">Likes</small>
                </div>
              </div>
              <div class="col-xs-4">
                <div class="padder-v">
                  <span class="m-b-xs h4 block text-white">2,035</span>
                  <small class="text-muted">Photos</small>
                </div>
              </div>
            </div>
          </section>
        </li>
        <li>
          <div class="m-t m-l">
            <a href="price.html" class="dropdown-toggle btn btn-xs btn-primary" title="Upgrade"><i class="fa fa-long-arrow-up"></i></a>
          </div>
        </li>
      </ul>      
      <ul class="nav navbar-nav navbar-right hidden-xs nav-user">
        <li class="hidden-xs">
          <a href="#" class="dropdown-toggle dk" data-toggle="dropdown">
            <i class="fa fa-bell"></i>
            <span class="badge badge-sm up bg-danger m-l-n-sm count">2</span>
          </a>
          <section class="dropdown-menu aside-xl">
            <section class="panel bg-white">
              <header class="panel-heading b-light bg-light">
                <strong>You have <span class="count">2</span> notifications</strong>
              </header>
              <div class="list-group list-group-alt animated fadeInRight">
                <a href="#" class="media list-group-item">
                  <span class="pull-left thumb-sm">
                    <img src="images/avatar.jpg" alt="John said" class="img-circle">
                  </span>
                  <span class="media-body block m-b-none">
                    Use awesome animate.css<br>
                    <small class="text-muted">10 minutes ago</small>
                  </span>
                </a>
                <a href="#" class="media list-group-item">
                  <span class="media-body block m-b-none">
                    1.0 initial released<br>
                    <small class="text-muted">1 hour ago</small>
                  </span>
                </a>
              </div>
              <footer class="panel-footer text-sm">
                <a href="#" class="pull-right"><i class="fa fa-cog"></i></a>
                <a href="#notes" data-toggle="class:show animated fadeInRight">See all the notifications</a>
              </footer>
            </section>
          </section>
        </li>
        <li class="dropdown hidden-xs">
          <a href="#" class="dropdown-toggle dker" data-toggle="dropdown"><i class="fa fa-fw fa-search"></i></a>
          <section class="dropdown-menu aside-xl animated fadeInUp">
            <section class="panel bg-white">
              <form role="search">
                <div class="form-group wrapper m-b-none">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search">
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-icon"><i class="fa fa-search"></i></button>
                    </span>
                  </div>
                </div>
              </form>
            </section>
          </section>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="thumb-sm avatar pull-left">
              <img src="images/avatar.jpg">
            </span>
            John.Smith <b class="caret"></b>
          </a>
          <ul class="dropdown-menu animated fadeInRight">
            <span class="arrow top"></span>
            <li>
              <a href="#">Settings</a>
            </li>
            <li>
              <a href="profile.html">Profile</a>
            </li>
            <li>
              <a href="#">
                <span class="badge bg-danger pull-right">3</span>
                Notifications
              </a>
            </li>
            <li>
              <a href="docs.html">Help</a>
            </li>
            <li class="divider"></li>
            <li>
              <a href="modal.lockme.html" data-toggle="ajaxModal" >Logout</a>
            </li>
          </ul>
        </li>
      </ul>     

      --> 
    </header>
    <section>
      <section class="hbox stretch">
        <!-- .aside -->
        <aside class="bg-light lter b-r aside-md hidden-print" id="nav">          
          <section class="vbox">
            <header class="header bg-primary lter text-center clearfix">
              <div class="btn-group">
                <button type="button" class="btn btn-sm btn-dark btn-icon" title="New project"><i class="fa fa-plus"></i></button>
                <div class="btn-group hidden-nav-xs">
                  <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
                    Switch Sites
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu text-left">
                    <li><a href="#">eCommerce Administration</a></li>
                  </ul>
                </div>
              </div>
            </header>
            <section class="w-f scrollable">
              <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
                
                <!-- nav -->
                <nav class="nav-primary hidden-xs">
                  <ul class="nav">
                    <li >
                      <a href="index.php"  >
                        <i class="fa fa-dashboard icon">
                          <b class="bg-danger"></b>
                        </i>
                        <span>Dashboard</span>
                      </a>
                    </li>


                    <li >
                      <a href="#pages"  >
                        <i class="fa fa-file-text icon">
                          <b class="bg-primary"></b>
                        </i>
                        <span class="pull-right">
                          <i class="fa fa-angle-down text"></i>
                          <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span>Account Manager</span>
                      </a>
                      <ul class="nav lt">
                        <li >
                          <a href="index.php?page=accountmanager" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Dashboard</span>
                          </a>
                        </li>
                        <li >
                          <a href="index.php?page=accountmanager&z=vendors" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Vendors</span>
                          </a>
                        </li>
                        <li >
                          <a href="index.php?page=accountmanager&z=sales" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Sales</span>
                          </a>
                        </li>
                        <li >
                          <a href="index.php?page=accountmanager&z=activityreport" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Activity Report</span>
                          </a>
                        </li>


                      </ul>
                    </li>

                    <li >
                      <a href="#pages2"  >
                        <i class="fa fa-file-text icon">
                          <b class="bg-primary"></b>
                        </i>
                        <span class="pull-right">
                          <i class="fa fa-angle-down text"></i>
                          <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span>Call Center</span>
                      </a>
                      <ul class="nav lt">
                        <li >
                          <a href="index.php?page=callcenter" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Dashboard</span>
                          </a>
                        </li>
                        <li >
                          <a href="index.php?page=callcenter&z=leads" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Leads</span>
                          </a>
                        </li>
                        <li >
                          <a href="index.php?page=callcenter&z=followups" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Follow Ups</span>
                          </a>
                        </li>
                        <li >
                          <a href="index.php?page=callcenter&z=calllog" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Call Log</span>
                          </a>
                        </li>
                        

                      </ul>
                    </li>


                     <li >
                      <a href="#pages3"  >
                        <i class="fa fa-file-text icon">
                          <b class="bg-primary"></b>
                        </i>
                        <span class="pull-right">
                          <i class="fa fa-angle-down text"></i>
                          <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span>Docs</span>
                      </a>
                      <ul class="nav lt">
                        <li >
                          <a href="index.php?page=docs&z=productinformation" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Product Information</span>
                          </a>
                        </li>
                        <li >
                          <a href="index.php?page=docs&z=forms" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Forms</span>
                          </a>
                        </li>
                        
                      </ul>
                    </li>


                    <li >
                      <a href="#pages4"  >
                        <i class="fa fa-file-text icon">
                          <b class="bg-primary"></b>
                        </i>
                        <span class="pull-right">
                          <i class="fa fa-angle-down text"></i>
                          <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span>Administration</span>
                      </a>
                      <ul class="nav lt">
                        <li >
                          <a href="index.php?page=admin&z=main" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Dashboard</span>
                          </a>
                        </li>
                        <li >
                          <a href="index.php?page=admin&z=security" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Page Security</span>
                          </a>
                        </li>
                        <li >
                          <a href="index.php?page=admin&z=users" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Users</span>
                          </a>
                        </li>
                        <li >
                          <a href="index.php?page=admin&z=datamanager" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Data Manger</span>
                          </a>
                        </li>


                      </ul>
                    </li>


                  </ul>
                </nav>
                <!-- / nav -->
              </div>
            </section>
            
            <footer class="footer lt hidden-xs b-t b-light">
              <a href="#nav" data-toggle="class:nav-xs" class="pull-right btn btn-sm btn-default btn-icon">
                <i class="fa fa-angle-left text"></i>
                <i class="fa fa-angle-right text-active"></i>
              </a>
            </footer>
          </section>
        </aside>
        <!-- /.aside -->
        <section id="content">
          <section class="vbox">          
            <section class="scrollable wrapper">
              <p class="h4"> <?php
    $page = $_GET["page"]; 
     $page = mysql_real_escape_string($page);
     $sql = "SELECT `activated` FROM `pages` WHERE `page`='$page'";
     $checkmodul=$result = mysql_query($sql) or die(mysql_error());

$modulfound=mysql_num_rows($checkmodul);
if($modulfound){
  $modulrow=mysql_fetch_array($checkmodul);
  if($modulrow['activated']==1){
  
      $invalide = array('\\','/','/\/',':','.');
      $page = str_replace($invalide,' ',$page);
      if(!file_exists($page.".php"));
      include($page.".php");
    }
    
  }
?></p>
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
        <aside class="bg-light lter b-l aside-md hide" id="notes">
          <div class="wrapper">Notification</div>
        </aside>
      </section>
    </section>
  </section>
  <script src="js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="js/bootstrap.js"></script>
  <!-- App -->
  <script src="js/app.js"></script>
  <script src="js/app.plugin.js"></script>
  <script src="js/slimscroll/jquery.slimscroll.min.js"></script>
    <!-- Sparkline Chart -->
  <script src="js/charts/sparkline/jquery.sparkline.min.js" cache="false"></script>
  <!-- Easy Pie Chart -->
  <script src="js/charts/easypiechart/jquery.easy-pie-chart.js" cache="false"></script>
  <!-- datatables -->
<script src="js/datatables/jquery.dataTables.min.js" cache="false"></script>
  <!-- Flot -->
  <script src="js/charts/flot/jquery.flot.min.js" cache="false"></script>
  <script src="js/charts/flot/jquery.flot.tooltip.min.js" cache="false"></script>
  <script src="js/charts/flot/jquery.flot.resize.js" cache="false"></script>
  <script src="js/charts/flot/jquery.flot.orderBars.js" cache="false"></script>
  <script src="js/charts/flot/jquery.flot.pie.min.js" cache="false"></script>
  <script src="js/charts/flot/jquery.flot.grow.js" cache="false"></script>
  <script src="js/charts/flot/demo.js" cache="false"></script>
</body>
</html>