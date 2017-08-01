<link href="http://<?=$_SERVER['SERVER_NAME']?>/resources/css/sb-admin-2.css" rel="stylesheet">
<div id="page-content">
                <section class="container">
                    <header>
                        <ul class="nav nav-pills">
                            <li class="active"><a href="http://<?=$_SERVER['SERVER_NAME']?>/vendor/"><h1 class="page-title">Manage Businesses</h1></a></li>
                            <li><a href="http://<?=$_SERVER['SERVER_NAME']?>/vendor/manageusers/"><h1 class="page-title">Add/Edit Vendor Users</h1></a></li>
                            <li><a href="http://<?=$_SERVER['SERVER_NAME']?>/vendor/marketingtools/"><h1 class="page-title">Marketing Tools</h1></a></li>
                            <li><a href="http://<?=$_SERVER['SERVER_NAME']?>/vendor/addlisting/"><h1 class="page-title">Add Business Listing</h1></a></li> 
                        </ul>
                    </header> 
                    <div class="row"> 
                        <div class="col-md-3 col-sm-3">
                            <aside id="sidebar">
                                <ul class="navigation-sidebar list-unstyled"> 
                                    <li class="active">
                                        <a href="http://<?=$_SERVER["SERVER_NAME"]?>/vendor/managebusiness/<?=$rid?>">
                                            <i class="fa fa-info"></i>
                                            <span>Overview</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://<?=$_SERVER["SERVER_NAME"]?>/vendor/businessinformation/<?=$rid?>">
                                            <i class="fa fa-edit"></i>
                                            <span>Information</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://<?=$_SERVER["SERVER_NAME"]?>/vendor/managemenu/<?=$rid?>">
                                            <i class="fa fa-align-justify"></i>
                                            <span>Menu</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://<?=$_SERVER["SERVER_NAME"]?>/vendor/managepromos/<?=$rid?>">
                                            <i class="fa fa-bolt"></i>
                                            <span>Promotions</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://<?=$_SERVER["SERVER_NAME"]?>/vendor/managereviews/<?=$rid?>">
                                            <i class="fa fa-bullhorn"></i>
                                            <span>Reviews</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://<?=$_SERVER["SERVER_NAME"]?>/vendor/ppc/<?=$rid?>">
                                            <i class="fa fa-dollar"></i>
                                            <span>Adwords</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://<?=$_SERVER["SERVER_NAME"]?>/vendor/reports/<?=$rid?>">
                                            <i class="fa fa-bar-chart"></i>
                                            <span>Business Reports</span>
                                        </a>
                                    </li>
                                </ul>
                            </aside>
                        </div>
                        <div class="col-md-9 col-sm-9">
                        <?php 

                        /*
                            Premium Functions:
                                
                            - PPC clicks today, Website Clicks Today, Mobile Clicks Today [ possible line graph of month ] -- got model
                            - PPC balance left
                            - Premium Member Since [date]
                            - Clicks today [all types] 

                            Non Premium Functions:
                            
                            - Premium status -- model done
                            - sign up for premium shit


                            Both Premium/Non Premium Functions:

                            - % completion of profile (added menu?, filled out all restaurant information?, Added promotions/coupons?)
                            - If promotions are expired and to update
                            - show how many reviews this week
                            - impressions (how many times been listed in a search result or competitor)

                        */

                        ?>

                        <?php if ($premiumstatus["premium"] == 0) { ?>
                        <div class="jumbotron">
                          <h1>GET PREMIUM TODAY</h1>
                          <p>Stay ahead of the competition, get more customers, enjoy more features, keep your business reputation in good standing.</p>
                          <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
                        </div>
                        <?php } else { ?>

                        <?php } ?>
                        <div class="row">
                                <div class="col-lg-3 col-md-6">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <i class="fa fa-comments fa-5x"></i>
                                                </div>
                                                <div class="col-xs-9 text-right">
                                                    <div class="huge">26</div>
                                                    <div>Reviews</div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="#">
                                            <div class="panel-footer">
                                                <span class="pull-left">See Reviews</span>
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
                                                    <i class="fa fa-user fa-5x"></i>
                                                </div>
                                                <div class="col-xs-9 text-right">
                                                    <div class="huge">12</div>
                                                    <div>Followers</div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="panel panel-yellow">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <i class="fa fa-star fa-5x"></i>
                                                </div>
                                                <div class="col-xs-9 text-right">
                                                    <div class="huge">124</div>
                                                    <div>Rating</div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="panel panel-red">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <i class="fa fa-support fa-5x"></i>
                                                </div>
                                                <div class="col-xs-9 text-right">
                                                    <div class="huge">13</div>
                                                    <div>Support Tickets!</div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="#">
                                            <div class="panel-footer">
                                                <span class="pull-left">View Details</span>
                                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                <div class="clearfix"></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        

                        </div>
                    </div>
                </section>
            </div>