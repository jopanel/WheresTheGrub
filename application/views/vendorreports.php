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
                                    <li class="active">
                                        <a href="http://<?=$_SERVER["SERVER_NAME"]?>/vendor/reports/<?=$rid?>">
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
                            -> Review Stats:
                            - Total Reviews (All-Time, This Month, 7 Days)
                            - How Many Rating Stars (5,4,3,2,1) (All-Time, This Month, 7 Days)
                            - Average Rating

                            -> Follower Stats:
                            - How many total, this month, 7 days
                            - How many average per month
                            - How many un-follow total, this month, 7 days

                            -> Promotional Stats:
                            - How many seen a promotion (impression) total, this month, 7 days (of specific promotion)
                            - How many redeemed voucher total, this month, 7 days

                            -> Mobile Device Stats:
                            - How many times viewed on listing  (all time, month, 7 day)
                            - How many times viewed on map (all time, month, 7 day)
                            - How many times clicked on map (all time, month, 7 day)
                            - How many times clicked on listing (all time, month, 7 day)
                            - How many times viewed on PPC-BASED listing  (all time, month, 7 day)
                            - How many times viewed on PPC-BASED map (all time, month, 7 day)
                            - How many times clicked on PPC-BASED map (all time, month, 7 day)
                            - How many times clicked on PPC-BASED listing (all time, month, 7 day)

                            -> Desktop Device Stats: 
                            - How many times viewed on listing  (all time, month, 7 day)
                            - How many times viewed on map (all time, month, 7 day)
                            - How many times clicked on map (all time, month, 7 day)
                            - How many times clicked on listing (all time, month, 7 day)
                            - How many times viewed on PPC-BASED listing  (all time, month, 7 day)
                            - How many times viewed on PPC-BASED map (all time, month, 7 day)
                            - How many times clicked on PPC-BASED map (all time, month, 7 day)
                            - How many times clicked on PPC-BASED listing (all time, month, 7 day)

                        */
                        ?>
                        <div class="col-md-9 col-sm-9">

                        <?php if ($premiumstatus["premium"] == 0) { ?>
                        <div class="jumbotron">
                          <h1>THIS IS A PREMIUM SECTION. GET PREMIUM TODAY</h1>
                          <p>Stay ahead of the competition, get more customers, enjoy more features, keep your business reputation in good standing.</p>
                          <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
                        </div>
                        <?php } else { ?>

                        

                        <?php } ?>

                        </div>
                    </div>
                </section>
            </div>