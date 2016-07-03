<!--Page Content-->
            <div id="page-content">
                <!--Hero Image-->
                <section class="hero-image search-filter-middle height-500">
                    <div class="inner">
                        <div class="container">
                            <h1><?=$phrase?></h1>
                            <div class="search-bar horizontal">
                                <form class="main-search border-less-inputs background-dark narrow" role="form" method="post" action="?">
                                    <div class="input-row">
                                        <div class="form-group">
                                            <label for="keyword">Food</label>
                                            <input type="text" class="form-control" placeholder="Maybe Pizza? BBQ? Sushi? more">
                                        </div>
                                        <div class="form-group">
                                            <label for="location">Location</label>
                                            <div class="input-group location">
                                                <input type="text" class="form-control" value="<?=$this->session->userdata("userdata_city")?>, <?=$this->session->userdata("userdata_state_name")?> <?=$this->session->userdata("zipcode")?>" placeholder="Enter Location">
                                            </div>
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>

                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                </form>
                                <!-- /.main-search -->
                            </div>
                            <!-- /.search-bar -->
                        </div>
                    </div>
                    <div class="background">
                        <img src="resources/img/restaurant-bg.jpg" alt="">
                    </div>
                </section>
                <!--end Hero Image-->

               
                <!--Listing-->
                <section id="listing" class="block">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-9 col-sm-9">
                                <section class="equal-height">
                                    <header><h2>Recommended</h2></header>
                                    <div class="row">
                                        
                                        <?php
                                        foreach ($recommended as $rec) {
                                            if (isset($rec["hours"]) && !empty($rec["hours"])) {
                                                $hoursarray = json_decode($rec["hours"], true);
                                                $day = date("l");
                                                $day = strtolower($day);
                                                $now = date("H:s");
                                                $open = 0;
                                                $until = " ";
                                                foreach ($hoursarray as $theday => $thetimes) {
                                                    if ($theday == $day) {
                                                        foreach ($thetimes as $times) {
                                                            if (strtotime($times[0]) < strtotime($now) && strtotime($now) < strtotime($times[1])) {
                                                                $open = 1;
                                                                $until .= date("h:i a", strtotime($times[1]));
                                                            }
                                                        }
                                                    }
                                                }
                                                if ($open == 0) { $hours = "<p>Closed</p>"; } else { $hours = "<p>Open until ".$until."</p>"; }
                                            } else {
                                                $hours = "<p>Closed</p>";
                                            }
                                            $type = "";
                                            if (isset($rec["cuisine"]) && !empty($rec["cuisine"])) {
                                                $cuisinearray = json_decode($rec["cuisine"], true);
                                                foreach ($cuisinearray as $foodtype) { $type .= $foodtype." ";}
                                                $type = "<p>".$type."</p>";
                                            }
                                            $website = "";
                                            if (isset($rec["website"]) && !empty($rec["website"])) { $website = "<p>".$rec["website"]."</p>"; }
                                            $label = "";
                                            if (isset($rec["category_labels"]) && !empty($rec["category_labels"])) { 
                                                $categoryarray = json_decode($rec["category_labels"], true);
                                                foreach ($categoryarray[0] as $labels) {
                                                    $label .= $labels." ";
                                                }
                                            } else {
                                            $label = "Restaurant";
                                            }
                                            ?>
                                            <div class="col-md-4 col-sm-4">
                                            <div class="item ">
                                                <div class="image">
                                                    <div class="quick-view"><i class="fa fa-eye"></i><span>Quick View</span></div>
                                                    <a href="item-detail.html">
                                                        <div class="overlay">
                                                            <div class="inner">
                                                                <div class="content">
                                                                    <h4>At A Glance</h4>
                                                                    <?=$hours?>
                                                                    <?=$type?>
                                                                    <?=$website?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <img src="resources/img/items/restaurant/11.jpg" alt="">
                                                    </a>
                                                </div>
                                                <div class="wrapper">
                                                    <a href="item-detail.html"><h3><?=$rec["name"]?></h3></a>
                                                    <figure><?=$rec["address"]?></figure>
                                                    <div class="info">
                                                        <div class="type">
                                                            <i><img src="resources/icons/restaurants-bars/restaurants/restaurant.png" alt=""></i>
                                                            <span><?=$label?></span>
                                                        </div>
                                                        <div class="rating" data-rating="<?=$rec["rating"]?>"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <!--/.row-->
                                </section>
                                <!--/.equal-height-->

                              

                            </div>

                            <div class="col-md-3 col-sm-3">
                                <aside id="sidebar">
                                    <section>
                                        <header><h2>Text Widget</h2></header>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque lectus turpis, rutrum
                                            at dictum ac, mollis sed turpis. Integer commodo condimentum quam sit amet pellentesque.
                                            In convallis orci sit amet dictum ultricies. Donec iaculis libero sed euismod blandit
                                        </p>
                                    </section>
                                    <section>
                                        <header><h2>Best Rated</h2></header>
                                        <?php
                                        foreach ($bestrated as $br) { 
                                            $label = "";
                                            if (isset($rec["category_labels"]) && !empty($rec["category_labels"])) { 
                                                $categoryarray = json_decode($rec["category_labels"], true);
                                                foreach ($categoryarray[0] as $labels) {
                                                    $label .= $labels." ";
                                                }
                                            } else {
                                            $label = "Restaurant";
                                            }
                                            ?>
                                        <a href="item-detail.html" class="item-horizontal small">
                                            <h3><?=$br["name"];?></h3>
                                            <figure><?=$br["address"]?></figure>
                                            <div class="wrapper">
                                                <div class="image"><img src="resources/img/items/<?=$br["rating"]?>.jpg" alt=""></div>
                                                <div class="info">
                                                    <div class="type">
                                                        <div class="rating" data-rating="<?=$br["rating"]?>"></div>
                                                        <?php

                                            if (isset($rec["hours"]) && !empty($rec["hours"])) {
                                                $hoursarray = json_decode($rec["hours"], true);
                                                $day = date("l");
                                                $day = strtolower($day);
                                                $now = date("H:s");
                                                $open = 0;
                                                $until = " ";
                                                foreach ($hoursarray as $theday => $thetimes) {
                                                    if ($theday == $day) {
                                                        foreach ($thetimes as $times) {
                                                            if (strtotime($times[0]) < strtotime($now) && strtotime($now) < strtotime($times[1])) {
                                                                $open = 1;
                                                                $until .= date("h:i a", strtotime($times[1]));
                                                            }
                                                        }
                                                    }
                                                }
                                                if ($open == 0) { $hours = "<span>Closed</span>"; } else { $hours = "<span>Open until ".$until."</span>"; }
                                            } else {
                                                $hours = "<span>Closed</span>";
                                            }
                                            echo $hours;
                                            ?>
                                                    </div>
                                                    <div class="type">
                                                        <span><?=$label?></span>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </a>
                                        <?php } ?>
                                    </section>
                                </aside>
                                <!--/#sidebar-->
                            </div>
                            <!--/.col-md-3-->
                        </div>
                        <!--/.row-->
                    </div>
                    <!--/.block-->
                </section>
                <!--end Listing-->

                <hr>

                 <!--Why Us-->
                <section id="why-us" class="block">
                    <div class="container">
                        <header><h2>Why Us?</h2></header>
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="feature-box">
                                    <i class="fa fa-user"></i>
                                    <div class="description">
                                        <h3>Reviews By Popular Anonymity</h3>
                                        <p>
                                            Leave reviews anonymously. Good or bad yours or other reviews will be judged.
                                        </p>
                                    </div>
                                </div>
                                <!--/.feature-box-->
                            </div>
                            <!--/.col-md-4-->
                            <div class="col-md-4 col-sm-4">
                                <div class="feature-box">
                                    <i class="fa fa-heart"></i>
                                    <div class="description">
                                        <h3>Fast Food Not Bad Food</h3>
                                        <p>
                                            Using our food finding tool gets you food fast.
                                        </p>
                                    </div>
                                </div>
                                <!--/.feature-box-->
                            </div>
                            <!--/.col-md-4-->
                            <div class="col-md-4 col-sm-4">
                                <div class="feature-box">
                                    <i class="fa fa-thumbs-up"></i>
                                    <div class="description">
                                        <h3>Recommend Food by You</h3>
                                        <p>
                                            Find the best place to eat by popular demand.
                                        </p>
                                    </div>
                                </div>
                                <!--/.feature-box-->
                            </div>
                            <!--/.col-md-4-->
                        </div>
                    </div>
                </section>
                <!--end Why Us-->

            </div>
            <!-- end Page Content-->
        </div>
        <!-- end Page Canvas-->





<!-- <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1>Finding Your Favorite Foods Is EASY!</h1>
                <hr>
                <p>Find food fast, don't wait, we know you don't want to cook.</p>
                <a href="./search" style="margin-right:30px;" class="btn btn-primary btn-xl page-scroll">Find Food</a> 
                <a href="#about" class="btn btn-primary btn-xl page-scroll">Add Restaurant</a>
            </div>
        </div>
    </header>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Why We Stand Out</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-4 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-user-secret wow bounceIn text-primary"></i>
                        <h3>Reviews By Popular Anonymity</h3>
                        <p class="text-muted">Leave reviews anonymously. Good or bad yours or other reviews will be judged.</p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-beer wow bounceIn text-primary" data-wow-delay=".1s"></i>
                        <h3>No Ads</h3>
                        <p class="text-muted">We don't advertise stupid stuff, give annoying popups, or try to steal precious time.</p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-thumbs-up wow bounceIn text-primary" data-wow-delay=".2s"></i>
                        <h3>Recommend Food by You</h3>
                        <p class="text-muted">Find the best place to eat by popular demand.</p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-heart wow bounceIn text-primary" data-wow-delay=".3s"></i>
                        <h3>Fast Food Not Bad Food</h3>
                        <p class="text-muted">Using our food finding tool gets you food fast.</p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-heart wow bounceIn text-primary" data-wow-delay=".3s"></i>
                        <h3>Fast Food Not Bad Food</h3>
                        <p class="text-muted">Using our food finding tool gets you food fast.</p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-heart wow bounceIn text-primary" data-wow-delay=".3s"></i>
                        <h3>Fast Food Not Bad Food</h3>
                        <p class="text-muted">Using our food finding tool gets you food fast.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <aside class="bg-dark">
        <div class="container text-center">
            <div class="call-to-action">
                <h2>Download Wheres The Grub for iPhone or Android</h2>
                <a href="#" class="btn btn-default btn-xl wow tada">Download Now!</a>
            </div>
        </div>
    </aside>
--> 