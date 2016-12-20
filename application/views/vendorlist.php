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
                        <!--
                        <div class="col-md-3 col-sm-3">
                            <aside id="sidebar">
                                <ul class="navigation-sidebar list-unstyled">
                                    <li class="active">
                                        <a href="">
                                            <i class="fa fa-folder"></i>
                                            <span></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <i class="fa fa-check"></i>
                                            <span></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <i class="fa fa-clock-o"></i>
                                            <span></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <i class="fa fa-eye-slash"></i>
                                            <span></span>
                                        </a>
                                    </li>
                                </ul>
                            </aside>
                        </div> -->
                        <div class="col-md-9 col-sm-9">
                            <section id="items">

                            <?php foreach ($biz as $k => $v) { ?>
                                <div class="item list admin-view">
                                    <div class="image">
                                        <div class="quick-view" data-toggle="modal" data-target="#modal-bar"><i class="fa fa-eye"></i><span>Quick View</span></div>
                                        <a href="item-detail.html">
                                            <div class="overlay">
                                                <div class="inner">
                                                    <div class="content">
                                                        <h4>Description</h4>
                                                        <p><?=$k["description"]?></p>   
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-specific">
                                                <span><?php if ($k["premium"] == 1) { echo "Premium"; } else { echo "FREE"; } ?></span>
                                            </div>
                                            <img src="../resources/img/items/2.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="wrapper">
                                        <a href="item-detail.html"><h3><?=$k["name"]?></h3></a>
                                        <figure><?=$k["address"]?></figure>
                                        <div class="info">
                                            <div class="type">
                                                <i><img src="../resources/icons/restaurants-bars/restaurants/cafetaria.png" alt=""></i>
                                                <span><?php 
                                        foreach ($res["competitors"] as $br) { 
                                            $label = "";
                                            if (isset($br["category_labels"]) && !empty($br["category_labels"])) { 
                                                $categoryarray = json_decode($br["category_labels"], true);
                                                foreach ($categoryarray[0] as $labels) {
                                                    $label .= $labels." ";
                                                }
                                            } else {
                                            $label = "Restaurant";
                                            }
                                            ?></span>
                                            </div>
                                            <div class="rating" data-rating="5"></div>
                                        </div>
                                    </div>
                                    <div class="in-queue">
                                        <a href="http://<?=$_SERVER["SERVER_NAME"]?>/vendor/managebusiness/<?=$k["id"]?>"><p class="btn framed icon">Manage Business <i class="fa fa-angle-right"></i></p></a>
                                    </div>
                                </div>
                               <?php } }?>
                                



                            </section>
                        </div>
                    </div>
                </section>
            </div>