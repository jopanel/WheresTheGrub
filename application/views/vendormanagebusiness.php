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
                                        <a href="<?=base_url()?>vendor/managebusiness/<?=$rid?>">
                                            <i class="fa fa-info"></i>
                                            <span>Overview</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=base_url()?>vendor/businessinformation/<?=$rid?>">
                                            <i class="fa fa-edit"></i>
                                            <span>Information</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=base_url()?>vendor/managemenu/<?=$rid?>">
                                            <i class="fa fa-align-justify"></i>
                                            <span>Menu</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=base_url()?>vendor/managepromos/<?=$rid?>">
                                            <i class="fa fa-bolt"></i>
                                            <span>Promotions</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=base_url()?>vendor/managereviews/<?=$rid?>">
                                            <i class="fa fa-bullhorn"></i>
                                            <span>Reviews</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=base_url()?>vendor/ppc/<?=$rid?>">
                                            <i class="fa fa-dollar"></i>
                                            <span>Adwords</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=base_url()?>vendor/reports/<?=$rid?>">
                                            <i class="fa fa-bar-chart"></i>
                                            <span>Business Reports</span>
                                        </a>
                                    </li>
                                </ul>
                            </aside>
                        </div>
                        <div class="col-md-9 col-sm-9">
                        <?php if ($premiumstatus["premium"] == 0) { ?>
                        <div class="jumbotron">
                          <h1>GET PREMIUM TODAY</h1>
                          <p>Stay ahead of the competition, get more customers, enjoy more features, keep your business reputation in good standing.</p>
                          <p><a class="btn btn-primary btn-lg" href="<?=base_url()?>vendor/premium/<?=$rid?>" role="button">Learn more</a></p>
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
                                                    <div class="huge"><?=$totalreviews?></div>
                                                    <div>Reviews</div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="<?=base_url()?>vendor/managereviews/<?=$rid?>">
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
                                                    <div class="huge"><?=$bizinfo["rating"]?></div>
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
                                                    <i class="fa fa-group fa-5x"></i>
                                                </div>
                                                <div class="col-xs-9 text-right">
                                                    <div class="huge"><?=$impressions?></div>
                                                    <div>Impressions<br>(Last 7 Days)</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>

                        <div class="row">
                            <div class="rol-lg-3 col-md-6">
                                <div class="panel panel-default">
                                  <div class="panel-body">
                                  <h3>Things Left To Do:</h3> 
                                    <div class="progress">
                                      <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?=$percentcomplete["percentage"]?>%;">
                                        <?=$percentcomplete["percentage"]?>%
                                      </div>
                                    </div>
                                    <?php
                                    if (count($percentcomplete[0]) > 0) {
                                        foreach ($percentcomplete[0] as $v) {
                                            echo "<p>".$v."</p>";
                                        }
                                    } else {
                                        echo "<p>Nothing left to do</p>";
                                    }
                                    ?>
                                  </div>
                                </div>
                            </div>

                            <div class="rol-lg-3 col-md-6"> 
                                  <ul class="list-group">
                                  <?php
                                  if ($premiumstatus["premium"] == 1) { ?>
                                      <li class="list-group-item list-group-item-success">Premium Membership: Active</li>
                                      <li class="list-group-item ">Reviews Past 7 Days: <?=$reviewstats["reviews_total"]?></li> 
                                      <li class="list-group-item ">Rating Power Past 7 Days: <?=$reviewstats["rating_powertotal"]?></li> 
                                      <li class="list-group-item ">Rating Past 7 Days: <?=$reviewstats["rating_total"]?></li> 
                                 <?php } else { ?>
                                      <li class="list-group-item list-group-item-danger">Premium Membership: Not Active</li>
                                    <?php } ?>
                                      
                                      
                                    </ul> 
                            </div>


                        </div>
                        

                            

                        </div>
                    </div>
                </section>
            </div>