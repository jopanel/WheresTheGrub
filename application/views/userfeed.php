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
                        <div class="col-md-9">
                            <section id="items">
           


                                <div class="item list admin-view">
                                    <div class="image">
                                        <div class="quick-view" data-toggle="modal" data-target="#modal-bar"><i class="fa fa-eye"></i><span>Quick View</span></div>
                                        <a href="item-detail.html">
                                            <div class="overlay">
                                                <div class="inner">
                                                    <div class="content">
                                                        <h4>Description</h4>
                                                        <p>Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-specific">
                                                <span>Daily menu: $6</span>
                                            </div>
                                            <img src="assets/img/items/2.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="wrapper">
                                        <a href="item-detail.html"><h3>Benny’s Cafeteria</h3></a>
                                        <figure>63 Birch Street</figure>
                                        <div class="info">
                                            <div class="type">
                                                <i><img src="assets/icons/restaurants-bars/restaurants/cafetaria.png" alt=""></i>
                                                <span>Cafeteria</span>
                                            </div>
                                            <div class="rating" data-rating="5"></div>
                                        </div>
                                    </div>
                                    <div class="description">
                                        <ul class="list-unstyled actions">
                                            <li><a href="#"><i class="fa fa-pencil"></i></a></li>
                                            <li><a href="#" class="hide-item"><i class="fa fa-eye"></i></a></li>
                                            <li><a href="#"><i class="fa fa-trash"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="ribbon in-queue">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                                
                                
                            </section>
                        </div>
                    </div>
                </section>
            </div>
            <!-- end Page Content-->