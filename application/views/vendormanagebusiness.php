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
                                        <a href="">
                                            <i class="fa fa-user-md"></i>
                                            <span>Welcome, <?=$this->session->userdata("fullname")?></span>
                                        </a>
                                    </li> 
                                    <li>
                                        <a href="http://<?=$_SERVER["SERVER_NAME"]?>/vendor/businessinformation/<?=$rid?>">
                                            <i class="fa fa-gear"></i>
                                            <span>Manage Business Information</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <i class="fa fa-gear"></i>
                                            <span>Manage Promotions</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <i class="fa fa-gear"></i>
                                            <span>Manage Reviews</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <i class="fa fa-gear"></i>
                                            <span>Manage PPC Campaigns</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <i class="fa fa-gear"></i>
                                            <span>Manage Business Reports</span>
                                        </a>
                                    </li>
                                </ul>
                            </aside>
                        </div>
                        <div class="col-md-9 col-sm-9">
                            <section id="items">
                            <?php
                            //echo "<pre>";
                            //var_dump($biz);
                            //echo "</pre>";
                            ?>
                            <?php foreach ($biz as $k => $v) { ?>
                                <div class="item list admin-view">
                                    <div class="image">
                                        <div class="quick-view" data-toggle="modal" data-target="#modal-bar"><i class="fa fa-eye"></i><span>Quick View</span></div>
                                        <a href="item-detail.html">
                                            <div class="overlay">
                                                <div class="inner">
                                                    <div class="content">
                                                        <h4>Description</h4>
                                                        <p><?=$v["description"]?></p>   
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-specific">
                                                <span><?php if ($v["premium"] == 1) { echo "PREMIUM ACCESS"; } else { echo "FREE ACCESS"; } ?></span>
                                            </div>
                                            <img src="../resources/img/items/2.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="wrapper">
                                        <a href="item-detail.html"><h3><?=$v["name"]?></h3></a>
                                        <figure><?=$v["address"]?></figure>
                                        <div class="info">
                                            <div class="type">
                                                <i><img src="../resources/icons/restaurants-bars/restaurants/cafetaria.png" alt=""></i>
                                                <span><?php 
                                            $label = "";
                                            if (isset($v["category_labels"]) && !empty($v["category_labels"])) { 
                                                $categoryarray = json_decode($v["category_labels"], true);
                                                foreach ($categoryarray[0] as $labels) {
                                                    $label .= $labels." ";
                                                }
                                            } else {
                                            $label = "Restaurant";
                                            }
                                            ?></span>
                                            </div>
                                            <div class="rating" data-rating="<?=$v["rating"]?>"></div>
                                        </div>
                                    </div>
                                    <div class="in-queue">
                                        <a href="http://<?=$_SERVER["SERVER_NAME"]?>/vendor/managebusiness/<?=$v["id"]?>"><p class="btn framed icon">Manage Business <i class="fa fa-angle-right"></i></p></a>
                                        <?php 
                                        if ($v["premium"] == 1) { ?> <a href="http://<?=$_SERVER["SERVER_NAME"]?>/vendor/managebusiness/<?=$v["id"]?>"><p class="btn framed icon">Premium Access</p></a> <?php } else { ?> <a href="http://<?=$_SERVER["SERVER_NAME"]?>/vendor/managebusiness/<?=$v["id"]?>"><p class="btn framed icon" style="border-color: green;">Sign Up For Premium!</p></a> <?php } ?> 
                                    </div>
                                </div>
                               <?php }?>
                                



                            </section>
                        



                        </div>
                    </div>
                </section>
            </div>