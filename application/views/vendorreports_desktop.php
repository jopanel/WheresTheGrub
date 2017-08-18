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
                                    <li>
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
                                    <li class="active">
                                        <a href="<?=base_url()?>vendor/reports/<?=$rid?>">
                                            <i class="fa fa-bar-chart"></i>
                                            <span>Business Reports</span>
                                        </a>
                                    </li>
                                </ul>
                            </aside>
                        </div>
                        <?php
                        /*  
                            Things To Include (on this page):
                            -> Desktop Device Stats: bizstats
                            - How many times viewed on listing  (all time, month, 7 day) - done
                            - How many times viewed on map (all time, month, 7 day) - done
                            - How many times clicked on map (all time, month, 7 day) - done
                            - How many times clicked on listing (all time, month, 7 day) - done
                            - How many times viewed on PPC-BASED listing  (all time, month, 7 day) - done
                            - How many times viewed on PPC-BASED map (all time, month, 7 day) - done
                            - How many times clicked on PPC-BASED map (all time, month, 7 day) - done
                            - How many times clicked on PPC-BASED listing (all time, month, 7 day) - done
                        */
                        ?>
                        <div class="col-md-9 col-sm-9">

                        <?php if ($premiumstatus["premium"] == 0) { ?>
                        <div class="jumbotron">
                          <h1>THIS IS A PREMIUM SECTION. GET PREMIUM TODAY</h1>
                          <p>Stay ahead of the competition, get more customers, enjoy more features, keep your business reputation in good standing.</p>
                          <p><a class="btn btn-primary btn-lg" href="<?=base_url()?>vendor/premium/<?=$rid?>" role="button">Learn more</a></p>
                        </div>
                        <?php } else { ?>
                            <header>
                                <ul class="nav nav-pills">
                                    <li><a href="<?=base_url()?>vendor/reports/<?=$rid?>/"><h1 class="page-title">Overview</h1></a></li>
                                    <li><a href="<?=base_url()?>vendor/reports/<?=$rid?>/followers"><h1 class="page-title">Followers</h1></a></li>
                                    <li><a href="<?=base_url()?>vendor/reports/<?=$rid?>/reviews"><h1 class="page-title">Reviews</h1></a></li>
                                    <li class="active"><a href="<?=base_url()?>vendor/reports/<?=$rid?>/desktop"><h1 class="page-title">Desktop</h1></a></li>
                                    <li><a href="<?=base_url()?>vendor/reports/<?=$rid?>/mobile"><h1 class="page-title">Mobile</h1></a></li>
                                    <li><a href="<?=base_url()?>vendor/reports/<?=$rid?>/adwords"><h1 class="page-title">Adwords</h1></a></li>
                                </ul>
                            </header> 
                            <header>
                                <h1 class="page-title">Reports: Desktop Device Stats</h1>
                            </header>  
                            <div class="row"> 
                                <div class="rol-lg-3 col-md-6"> 
                                      <p>Overall</p>
                                      <ul class="list-group">  
                                      <?php foreach ($bizstats["total"] as $v) { ?>
                                        <li class="list-group-item "><?=$v["typename"]?> <?=$v["count"]?></li> 
                                      <?php } ?> 
                                        </ul> 
                                </div>
                                <div class="rol-lg-3 col-md-6"> 
                                      <p>7 Days</p>
                                      <ul class="list-group">  
                                      <?php foreach ($bizstats["7"] as $v) { ?>
                                        <li class="list-group-item "><?=$v["typename"]?> <?=$v["count"]?></li> 
                                      <?php } ?> 
                                        </ul> 
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="rol-lg-3 col-md-6"> 
                                      <p>30 Days</p>
                                      <ul class="list-group">  
                                      <?php foreach ($bizstats["30"] as $v) { ?>
                                        <li class="list-group-item "><?=$v["typename"]?> <?=$v["count"]?></li> 
                                      <?php } ?> 
                                        </ul> 
                                </div>
                                <div class="rol-lg-3 col-md-6"> 
                                      <p>1 Year</p>
                                      <ul class="list-group">  
                                      <?php foreach ($bizstats["1y"] as $v) { ?>
                                        <li class="list-group-item "><?=$v["typename"]?> <?=$v["count"]?></li> 
                                      <?php } ?> 
                                        </ul> 
                                </div>
                            </div>

                        <?php } ?>

                        </div>
                    </div>
                </section>
            </div>