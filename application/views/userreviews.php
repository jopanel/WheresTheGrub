 <!--Page Content-->
            <div id="page-content">
                <section class="container">
                    <header>
                        <ul class="nav nav-pills">
                            <li><a href="http://<?=$_SERVER['SERVER_NAME']?>/user/feed"><h1 class="page-title">Coupons & Deals</h1></a></li>
                            <li><a href="http://<?=$_SERVER['SERVER_NAME']?>/user/following"><h1 class="page-title">Following</h1></a></li>
                            <li class="active"><a href="http://<?=$_SERVER['SERVER_NAME']?>/user/reviews"><h1 class="page-title">My Reviews</h1></a></li>
                            <li><a href="http://<?=$_SERVER['SERVER_NAME']?>/user/"><h1 class="page-title">My Profile</h1></a></li>
                            <li><a href="http://<?=$_SERVER['SERVER_NAME']?>/user/profile"><h1 class="page-title">Settings</h1></a></li>
                            <li><a href="http://<?=$_SERVER['SERVER_NAME']?>/user/logout"><h1 class="page-title">Logout</h1></a></li>
                        </ul>
                    </header>
                    <div class="row">
                        <div class="col-md-3 col-sm-3">
                            <aside id="sidebar">
                                <ul class="navigation-sidebar list-unstyled">
                                    <li class="active">
                                        <a href="#">
                                            <i class="fa fa-folder"></i>
                                            <span>My Reviews</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-check"></i>
                                            <span>Following</span>
                                        </a>
                                    </li>
                                </ul>
                            </aside>
                        </div>
                        <div class="col-md-9 col-sm-9">
                            <section id="items">
           

                            <?php foreach ($userreviews as $r) { ?>
                                <div class="item list admin-view">
                                    <div class="wrapper">
                                        <a href="<?=$r["url"]?>"><h3><?=$r["name"]?></h3></a>
                                        <figure><?=$r["review"]?></figure>
                                        <div class="info">
                                            <div class="rating" data-rating="<?=$r["rating"]?>"></div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                                
                                
                                
                            </section>
                        </div>
                    </div>
                </section>
            </div>
            <!-- end Page Content-->