<!--Page Content-->
            <div id="page-content">

                <div id="map-detail"></div>
                <section class="container">
                    <div class="row">
                        <!--Item Detail Content-->
                        <div class="col-md-9">
                            <section class="block" id="main-content">
                                <header class="page-title">
                                    <div class="title">
                                        <h1><?=$res["name"]?></h1>
                                        <figure><?php
                                            if (isset($res["hours"]) && !empty($res["hours"])) {
                                                $hoursarray = json_decode($res["hours"], true);
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
                                                if ($open == 0) { $hours = "CURRENTY CLOSED"; } else { $hours = "OPEN UNTIL ".$until; }
                                            } else {
                                                $hours = "CURRENTLY CLOSED";
                                            }
                                            echo $hours;
            ?></figure>
                                    </div>
                                    <div class="info">
                                        <div class="type">
                                            <i><img src="assets/icons/restaurants-bars/restaurants/restaurant.png" alt=""></i>
                                            <span>Restaurant</span>
                                        </div>
                                    </div>
                                </header>
                                <div class="row">
                                    <!--Detail Sidebar-->
                                    <aside class="col-md-4 col-sm-4" id="detail-sidebar">
                                        <!--Contact-->
                                        <section>
                                            <header><h3>Contact</h3></header>
                                            <address>
                                                <div><?=$res["name"]?></div>
                                                <div><?=$res["address"]?></div>
                                                <div><?=$res["postcode"]?></div>
                                                <figure> 
                                                <?php if (isset($res["tel"]) && !empty($res["tel"])) { ?>
                                                    <div class="info">
                                                        <i class="fa fa-phone"></i>
                                                        <span><a href="tel:1<?=$res["tel"]?>">+1 <?=$res["tel"]?></a></span>
                                                    </div>
                                               <?php } ?>
                                               <?php if (isset($res["website"]) && !empty($res["website"])) { ?>
                                                <div class="info">
                                                        <i class="fa fa-globe"></i>
                                                        <a href="<?=$res["website"]?>"><?=$res["website"]?></a>
                                                    </div>
                                               <?php } ?>
                                                    
                                                    
                                                </figure>
                                            </address>
                                        </section>
                                        <!--end Contact-->
                                        <!--Rating-->
                                        <?php if (!isset($res["rating"]) || empty($res["rating"])) { $rating = 0; } else { $rating = $res["rating"]; } ?>
                                        <section class="clearfix">
                                            <header class="pull-left"><a href="#reviews" class="roll"><h3>Rating</h3></a></header>
                                            <figure class="rating big pull-right" data-rating="<?=$rating?>"></figure>
                                        </section>
                                        <!--end Rating--> 
                                        <?php 
                                        if (isset($res["claimed"]) && !empty($res["claimed"])) { ?>
                                            <!--Contact Form-->
                                        <section>
                                            <header><h3>Contact Form</h3></header>
                                            <figure>
                                                <form id="item-detail-form" role="form" method="post" action="?">
                                                <input type="hidden" name="action" value="contact">
                                                    <div class="form-group">
                                                        <label for="item-detail-name">Name</label>
                                                        <input type="text" class="form-control framed" id="item-detail-name" name="item-detail-name" required="">
                                                    </div>
                                                    <!-- /.form-group -->
                                                    <div class="form-group">
                                                        <label for="item-detail-email">Email</label>
                                                        <input type="email" class="form-control framed" id="item-detail-email" name="item-detail-email" required="">
                                                    </div>
                                                    <!-- /.form-group -->
                                                    <div class="form-group">
                                                        <label for="item-detail-message">Message</label>
                                                        <textarea class="form-control framed" id="item-detail-message" name="item-detail-message"  rows="3" required=""></textarea>
                                                    </div>
                                                    <!-- /.form-group -->
                                                    <div class="form-group">
                                                        <button type="submit" class="btn framed icon">Send<i class="fa fa-angle-right"></i></button>
                                                    </div>
                                                    <!-- /.form-group -->
                                                </form>
                                            </figure>
                                        </section>
                                        <!--end Contact Form-->
                                        <?php    } ?>
                                        
                                    </aside>
                                    <!--end Detail Sidebar-->
                                    <!--Content-->
                                    <div class="col-md-8 col-sm-8">
                                        <section>
                                            <article class="item-gallery">
                                                <div class="owl-carousel item-slider">
                                                <?php 
                                                if (!empty($res["photos"])) {
                                                    foreach ($res["photos"] as $url) { ?>
                                                    <div class="slide"><img src="<?=$url?>" data-hash="1" alt="<?=$res["name"]?>"></div>
                                                    <?php } ?>
                                                <?php } ?> 
                                                </div>
                                                <!-- /.item-slider -->
                                                <div class="thumbnails">
                                                    <span class="expand-content btn framed icon" data-expand="#gallery-thumbnails" >More<i class="fa fa-plus"></i></span>
                                                    <div class="expandable-content height collapsed show-70" id="gallery-thumbnails">
                                                        <div class="content">
                                                        <?php 
                                                        if (!empty($res["reviews"])) {
                                                            $countp = 0;
                                                            foreach ($res["reviews"] as $review) { 
                                                                if (!empty($review)) {  
                                                                $countp += 1;
                                                                if ($countp == 1) { ?>
                                                                    <a href="#<?=$countp?>" id="thumbnail-<?=$countp?>" class="active"><img src="<?$review["photo"]?>" alt="<?=$res["name"]?>"></a>
                                                                <?php } else { ?>
                                                                    <a href="#<?=$countp?>" id="thumbnail-<?=$countp?>"><img src="<?$review["photo"]?>" alt="<?=$res["name"]?>"></a>
                                                                <?php }
                                                                 } ?>
                                                            <?php } ?>
                                                        <?php } ?> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                            <!-- /.item-gallery -->
                                            <article class="block">
                                                <header><h2>Description</h2></header>
                                                <p>
                                                    Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam.
                                                    Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris.
                                                    Proin sit amet scelerisque risus. Donec semper semper erat ut mollis.
                                                    Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin
                                                    consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae,
                                                    euismod arcu. Suspendisse potenti. Integer ut diam venenatis, pellentesque
                                                    felis eget, elementum enim. Suspendisse sit amet massa commodo nulla iaculis
                                                    fermentum. Integer eget tincidunt est, in imperdiet risus.
                                                    Morbi sit amet urna purus.
                                                </p>
                                            </article>
                                            <!-- /.block -->
                                            <article class="block">
                                                <header><h2>Daily Menu</h2></header>
                                                <div class="list-slider owl-carousel">
                                                    <div class="slide">
                                                        <header>
                                                            <h3><i class="fa fa-calendar"></i>Monday (today)</h3>
                                                        </header>
                                                        <div class="list-item">
                                                            <div class="left">
                                                                <h4>Chicken wings</h4>
                                                                <figure>Curabitur odio nibh, luctus non pulvinar</figure>
                                                            </div>
                                                            <div class="right">$4.50</div>
                                                        </div>
                                                        <!-- /.list-item -->
                                                        <div class="list-item">
                                                            <div class="left">
                                                                <h4>Mushroom ragout</h4>
                                                                <figure>Donec a odio rutrum, hendrerit sapien</figure>
                                                            </div>
                                                            <div class="right">$3.60</div>
                                                        </div>
                                                        <!-- /.list-item -->
                                                        <div class="list-item">
                                                            <div class="left">
                                                                <h4>Nice salad with tuna, beans and hard-boiled egg</h4>
                                                                <figure>Urabitur suscipit, justo eu dignissim lacinia </figure>
                                                            </div>
                                                            <div class="right">$1.20</div>
                                                        </div>
                                                        <!-- /.list-item -->
                                                    </div>
                                                    <!-- /.slide -->
                                                    <div class="slide">
                                                        <header>
                                                            <h3><i class="fa fa-calendar"></i>Tuesday</h3>
                                                        </header>
                                                        <div class="list-item">
                                                            <div class="left">
                                                                <h4>Chicken wings</h4>
                                                                <figure>Curabitur odio nibh, luctus non pulvinar</figure>
                                                            </div>
                                                            <div class="right">$4.50</div>
                                                        </div>
                                                        <!-- /.list-item -->
                                                        <div class="list-item">
                                                            <div class="left">
                                                                <h4>Mushroom ragout</h4>
                                                                <figure>Donec a odio rutrum, hendrerit sapien</figure>
                                                            </div>
                                                            <div class="right">$3.60</div>
                                                        </div>
                                                        <!-- /.list-item -->
                                                        <div class="list-item">
                                                            <div class="left">
                                                                <h4>Nice salad with tuna, beans and hard-boiled egg</h4>
                                                                <figure>Urabitur suscipit, justo eu dignissim lacinia </figure>
                                                            </div>
                                                            <div class="right">$1.20</div>
                                                        </div>
                                                        <!-- /.list-item -->
                                                    </div>
                                                    <!-- /.slide -->
                                                </div>
                                                <!-- /.list-slider -->
                                            </article>
                                            <!-- /.block -->
                                            <article class="block">
                                                <header><h2>Features</h2></header>
                                                <ul class="bullets">
                                                    <?php
                                                    foreach ($arraydata as $key=>$value) {
                                                            if ($value == 1) {
                                                                $key = str_replace('_', ' ', $key);
                                                                $use = 1;
                                                                if (ucwords($key) == "Kids Goodfor") { $key = "Goodfor Kids"; }
                                                                if (ucwords($key) == "Active") { $use = 0; }
                                                                if (ucwords($key) == "Meal Cater") { $key = str_replace('Meal ', '', ucwords($key)); }
                                                                if (ucwords($key) == "Meal Lunch") { $key = str_replace('Meal ', '', ucwords($key)); }
                                                                if (ucwords($key) == "Meal Dinner") { $key = str_replace('Meal ', '', ucwords($key)); }
                                                                if (ucwords($key) == "Meal Takeout") { $key = str_replace('Meal ', '', ucwords($key)); }
                                                                if (ucwords($key) == "Meal Deliver") { $key = str_replace('Meal ', '', ucwords($key)); }
                                                                if (ucwords($key) == "Meal Breakfast") { $key = str_replace('Meal ', '', ucwords($key)); }
                                                                if (ucwords($key) == "Price") { $use = 0; }
                                                                if (ucwords($key) == "Accessible Wheelchair") { $key = "Wheelchair Accessible"; }
                                                                if (ucwords($key) == "Options Vegetarian") { $key = "Vegetarian Options"; }
                                                                if ($use == 1) {
                                                                   echo "<li>".ucwords($key)."</li>"; 
                                                                }
                                                            }
                                                    }
                                                    ?>
                                                </ul>
                                            </article>
                                            <!-- /.block -->
                                            <article class="block">
                                                <header><h2>Opening Hours</h2></header>
                                                <dl class="lines">
                                                    <?php
                                                    $r = json_decode($arraydata["hours"], true);
                                                    foreach ($r as $key=>$value) {
                                                        echo "<dt>".ucwords($key)."</dt>";
                                                        $buildtime = "";
                                                        $counttimes = 0;
                                                        foreach ($value as $values) {
                                                            foreach ($values as $v) {
                                                                $counttimes += 1;
                                                                if ($counttimes == 1) {
                                                                    $buildtime .= date("g a", strtotime($v));
                                                                } else {
                                                                    $buildtime .= " - ".date("g a", strtotime($v))."<br>";
                                                                    $counttimes = 0;
                                                                }
                                                            }
                                                        }
                                                        echo "<dd>".$buildtime."</dd>";
                                                    }
                                                    ?>
                                                </dl>
                                            </article>
                                            <!-- /.block -->
                                        </section>
                                        <!--Reviews-->
                                        <section class="block" id="reviews">
                                            <header class="clearfix">
                                                <h2 class="pull-left">Reviews</h2>
                                                <a href="#write-review" class="btn framed icon pull-right roll">Write a review <i class="fa fa-pencil"></i></a>
                                            </header>
                                            <article class="clearfix overall-rating">
                                                <strong class="pull-left">Over Rating</strong>
                                                <figure class="rating big color pull-right" data-rating="4"></figure>
                                                <!-- /.rating -->
                                            </article><!-- /.overall-rating-->
                                            <section class="reviews">
                                                <article class="review">
                                                    <figure class="author">
                                                        <img src="assets/img/default-avatar.png" alt="">
                                                        <div class="date">12.05.2014</div>
                                                    </figure>
                                                    <!-- /.author-->
                                                    <div class="wrapper">
                                                        <h5>Catherine Brown</h5>
                                                        <figure class="rating big color" data-rating="4"></figure>
                                                        <p>
                                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                            Nulla vestibulum, sem ut sollicitudin consectetur, augue diam ornare massa,
                                                            ac vehicula leo turpis eget purus. Nunc pellentesque vestibulum mauris,
                                                            eget suscipit mauris imperdiet vel. Nulla et massa metus.
                                                        </p>
                                                        <div class="individual-rating">
                                                            <span>Value</span>
                                                            <figure class="rating" data-rating="4"></figure>
                                                        </div>
                                                        <!-- /.user-rating -->
                                                        <div class="individual-rating">
                                                            <span>Service</span>
                                                            <figure class="rating" data-rating="4"></figure>
                                                        </div>
                                                        <!-- /.user-rating -->
                                                    </div>
                                                    <!-- /.wrapper-->
                                                </article>
                                                <!-- /.review -->
                                                <article class="review">
                                                    <figure class="author">
                                                        <img src="assets/img/default-avatar.png" alt="">
                                                        <div class="date">10.05.2014</div>
                                                    </figure>
                                                    <!-- /.author-->
                                                    <div class="wrapper">
                                                        <h5>John Doe</h5>
                                                        <figure class="rating big color" data-rating="5"></figure>
                                                        <p>
                                                            Nunc pellentesque vestibulum mauris, eget suscipit mauris
                                                            imperdiet vel. Nulla et massa metus. Nam porttitor quam eget ante
                                                        </p>
                                                        <div class="individual-rating">
                                                            <span>Value</span>
                                                            <figure class="rating" data-rating="5"></figure>
                                                        </div>
                                                        <!-- /.user-rating -->
                                                        <div class="individual-rating">
                                                            <span>Service</span>
                                                            <figure class="rating" data-rating="5"></figure>
                                                        </div>
                                                        <!-- /.user-rating -->
                                                    </div>
                                                    <!-- /.wrapper-->
                                                </article>
                                                <!-- /.review -->
                                            </section>
                                            <!-- /.reviews-->
                                        </section>
                                        <!-- /#reviews -->
                                        <!--end Reviews-->
                                        <!--Review Form-->
                                        <section id="write-review">
                                            <header>
                                                <h2>Write a Review</h2>
                                            </header>
                                            <form id="form-review" role="form" method="post" action="?" class="background-color-white">
                                            <input type="hidden" name="action" value="review">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label for="form-review-name">Name</label>
                                                            <input type="text" class="form-control" id="form-review-name" name="form-review-name" required="">
                                                        </div>
                                                        <!-- /.form-group -->
                                                        <div class="form-group">
                                                            <label for="form-review-email">Email</label>
                                                            <input type="email" class="form-control" id="form-review-email" name="form-review-email" required="">
                                                        </div>
                                                        <!-- /.form-group -->
                                                        <div class="form-group">
                                                            <label for="form-review-message">Message</label>
                                                            <textarea class="form-control" id="form-review-message" name="form-review-message"  rows="3" required=""></textarea>
                                                        </div>
                                                        <!-- /.form-group -->
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-default">Submit Review</button>
                                                        </div>
                                                        <!-- /.form-group -->
                                                    </div>
                                                    <div class="col-md-4">
                                                        <aside class="user-rating">
                                                            <label>Value</label>
                                                            <figure class="rating active" data-name="value"></figure>
                                                        </aside>
                                                        <aside class="user-rating">
                                                            <label>Service</label>
                                                            <figure class="rating active" data-name="score"></figure>
                                                        </aside>
                                                    </div>
                                                </div>
                                            </form>
                                            <!-- /.main-search -->
                                        </section>
                                        <!--end Review Form-->
                                    </div>
                                    <!-- /.col-md-8-->
                                </div>
                                <!-- /.row -->
                            </section>
                            <!-- /#main-content-->
                        </div>
                        <!-- /.col-md-8-->
                        <!--Sidebar-->
                        <div class="col-md-3">
                            <aside id="sidebar">
                                <section>
                                    <header><h2>You May Also Like</h2></header>
                                    <?php
                                        foreach ($res["competitors"] as $br) { 
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
                                    <!--/.item-horizontal small-->
                                </section>
                                <section>
                                    <a href="#"><img src="assets/img/ad-banner-sidebar.png" alt=""></a>
                                </section>
                            </aside>
                            <!-- /#sidebar-->
                        </div>
                        <!-- /.col-md-3-->
                        <!--end Sidebar-->
                    </div><!-- /.row-->
                </section>
                <!-- /.container-->
            </div>
            <!-- end Page Content-->