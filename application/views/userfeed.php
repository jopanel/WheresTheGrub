 <!--Page Content-->
            <div id="page-content">
                <section class="container">
                    <header>
                        <ul class="nav nav-pills">
                            <li class="active"><a href="http://<?=$_SERVER['SERVER_NAME']?>/user/feed"><h1 class="page-title">Coupons & Deals</h1></a></li>
                            <li><a href="http://<?=$_SERVER['SERVER_NAME']?>/user/following"><h1 class="page-title">Following</h1></a></li>
                            <li><a href="http://<?=$_SERVER['SERVER_NAME']?>/user/reviews"><h1 class="page-title">My Reviews</h1></a></li>
                            <li><a href="http://<?=$_SERVER['SERVER_NAME']?>/user/"><h1 class="page-title">My Profile</h1></a></li>
                            <li><a href="http://<?=$_SERVER['SERVER_NAME']?>/user/profile"><h1 class="page-title">Settings</h1></a></li>
                            <li><a href="http://<?=$_SERVER['SERVER_NAME']?>/user/logout"><h1 class="page-title">Logout</h1></a></li>
                        </ul>
                    </header>
                    <div class="row">
                        <div class="col-md-9">
                            <section id="items">
           

                            <?php 
                            foreach ($feed as $f) { ?>

                                <div class="item list admin-view">
                                    <div class="image">
                                        <div class="quick-view" data-toggle="modal" data-target="#modal-bar"><i class="fa fa-eye"></i><span>Quick View</span></div>
                                        <a href="<?=$f["url"]?>">
                                            <div class="overlay">
                                                <div class="inner">
                                                    <div class="content">
                                                        <h4><?=$f["subject"]?></h4>
                                                        <p><?=$f["body"]?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-specific">
                                                <span>Discount: <?=$f["discount"]?></span>
                                            </div>
                                            <img src="assets/img/items/2.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="wrapper">
                                        <a href="<?=$f["url"]?>"><h3><?=$f["name"]?></h3></a>
                                        <figure><?=$f["address"]?></figure>
                                        <div class="info"> 
                                        </div>
                                    </div>
                                    <div class="ribbon in-queue">
                                        Ends <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>

                            <?php } ?>
                                
                                
                                
                            </section>
                        </div>
                    </div>
                </section>
            </div>
            <!-- end Page Content-->