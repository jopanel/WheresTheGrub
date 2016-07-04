            
            
            <!-- Map Canvas-->
            <div class="background-color-grey-dark map-canvas list-width-30">
                <div class="search-bar horizontal">
                        <form id="apiSearch" class="main-search border-less-inputs" role="form">
                            <input type="hidden" name="longitude" value="<?=$this->session->userdata('longitude')?>">
                            <input type="hidden" name="latitude" value="<?=$this->session->userdata('latitude')?>">
                            <input type="hidden" name="postcode" value="<?=$this->session->userdata('userdata_zip_code')?>">
                            <input type="hidden" name="timezone" value="<?=$this->session->userdata('userdata_time_zone')?>">
                            <input type="hidden" name="city" value="<?=$this->session->userdata('userdata_city')?>">
                            <input type="hidden" name="statename" value="<?=$this->session->userdata('userdata_state_name')?>">

                            <div class="input-row">  
                                <div class="form-group">
                                    <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Enter Keyword">
                                </div>
                                
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <div class="input-group location">
                                        <input type="text" class="form-control" name="location" id="location" value="<?=$this->session->userdata("userdata_city")?>, <?=$this->session->userdata("userdata_state_name")?> <?=$this->session->userdata("zipcode")?>" placeholder="Enter Location">
                                        <span class="input-group-addon"><i class="fa fa-map-marker geolocation" data-toggle="tooltip" data-placement="bottom" title="Find my position"></i></span>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <select name="distance" class="form-control">
                                                <option disabled selected>Distance</option>
                                                <option value="1">Within 1 Mile</option>
                                                <option value="5">Within 5 Miles</option>
                                                <option value="10">Within 10 Miles</option>
                                                <option value="25">Within 25 Miles</option>
                                                <option value="50">Within 50 Miles</option>
                                    </select>
                                </div>
                                <!-- /.form-group -->
                                <div id="filtersBox" style="display: none; margin: 45px 0px 0px 0px;">
                                    <div class="input-row">
                                        <div class="form-group">
                                        <span style="text-align: center; margin: 10px 0px 0px 0px; position: absolute;">Open Now</span>
                                        <input type="checkbox" value="1" class="form-control" name="opennow" placeholder="textplaceholder" value="1"> 
                                        </div>
                                        <div class="form-group">
                                            <select name="deliverypickup" class="form-control">
                                                <option disabled selected>Takeout or Delivery</option>
                                                <option value="1">Delivery</option>
                                                <option value="2">Takeout</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select name="ratingpopularity" class="form-control">
                                                <option disabled selected>Rating or Popularity</option>
                                                <option value="1">Sort By Rating</option>
                                                <option value="2">Sort By Popularity</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            
                                        </div>
                                    </div>
                                    <div id="moreFilters" style="display: none;">
                                        <div class="input-row">
                                            <div class="form-group">
                                            <span style="text-align: center; margin: 10px 0px 0px 0px; position: absolute;">Has WiFi</span>
                                            <input type="checkbox" value="1" class="form-control" name="wifi" placeholder="textplaceholder" value="1"> 
                                            </div>
                                            <div class="form-group">
                                                <span style="text-align: center; margin: 10px 0px 0px 0px; position: absolute;">Vegetarian Options</span>
                                                <input type="checkbox" value="1" class="form-control" name="options_vegetarian" placeholder="textplaceholder" value="1"> 
                                            </div>
                                            <div class="form-group">
                                                <span style="text-align: center; margin: 10px 0px 0px 0px; position: absolute;">Healthy Options</span>
                                                <input type="checkbox" value="1" class="form-control" name="options_healthy" placeholder="textplaceholder" value="1"> 
                                            </div>
                                            <div class="form-group">
                                                
                                            </div>
                                        </div>
                                        <div class="input-row">
                                            <div class="form-group">
                                            <span style="text-align: center; margin: 10px 0px 0px 0px; position: absolute;">Breakfast</span>
                                            <input type="checkbox" value="1" class="form-control" name="meal_breakfast" placeholder="textplaceholder" value="1"> 
                                            </div>
                                            <div class="form-group">
                                                <span style="text-align: center; margin: 10px 0px 0px 0px; position: absolute;">Lunch</span>
                                                <input type="checkbox" value="1" class="form-control" name="meal_lunch" placeholder="textplaceholder" value="1"> 
                                            </div>
                                            <div class="form-group">
                                                <span style="text-align: center; margin: 10px 0px 0px 0px; position: absolute;">Dinner</span>
                                                <input type="checkbox" value="1" class="form-control" name="meal_dinner" placeholder="textplaceholder" value="1"> 
                                            </div>
                                            <div class="form-group">
                                                
                                            </div>
                                        </div>
                                        <div class="input-row">
                                            <div class="form-group">
                                            <span style="text-align: center; margin: 10px 0px 0px 0px; position: absolute;">Family Friendly</span>
                                            <input type="checkbox" value="1" class="form-control" name="kids_goodfor" placeholder="textplaceholder" value="1"> 
                                            </div>
                                            <div class="form-group">
                                                <span style="text-align: center; margin: 10px 0px 0px 0px; position: absolute;">Wheelchair Access</span>
                                                <input type="checkbox" value="1" class="form-control" name="accessible_wheelchair" placeholder="textplaceholder" value="1"> 
                                            </div>
                                            <div class="form-group">
                                                <span style="text-align: center; margin: 10px 0px 0px 0px; position: absolute;">Open 24 Hours</span>
                                                <input type="checkbox" value="1" class="form-control" name="open_24hrs" placeholder="textplaceholder" value="1"> 
                                            </div>
                                            <div class="form-group">
                                                
                                            </div>
                                        </div>
                                        <div class="input-row">
                                            <div class="form-group">
                                            <span style="text-align: center; margin: 10px 0px 0px 0px; position: absolute;">Full Bar</span>
                                            <input type="checkbox" value="1" class="form-control" name="alcohol" placeholder="textplaceholder" value="1"> 
                                            </div>
                                            <div class="form-group">
                                                <span style="text-align: center; margin: 10px 0px 0px 0px; position: absolute;">Beer Only</span>
                                                <input type="checkbox" value="1" class="form-control" name="alcohol_beer" placeholder="textplaceholder" value="1"> 
                                            </div>
                                            <div class="form-group">
                                                <span style="text-align: center; margin: 10px 0px 0px 0px; position: absolute;">Beer & Wine Only</span>
                                                <input type="checkbox" value="1" class="form-control" name="alcohol_beer_wine" placeholder="textplaceholder" value="1"> 
                                            </div>
                                            <div class="form-group">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="button" style="display: none;" id="morefilterbtn" onClick="getMoreFilters();" class="btn btn-default"><i class="fa fa-filter">ADDITIONAL FILTERS</i></button>
                                    <button type="button" onClick="getFilters();" class="btn btn-default"><i class="fa fa-filter"> FILTERS</i></button>
                                    <button type="button" onClick="getLoad();" class="btn btn-default"><i class="fa fa-search"> SEARCH</i></button>
                                </div>
                                <!-- /.form-group -->
                                
                            </div>
                            <!-- /.input-row -->
                            
                        </form>
                        <!-- /.main-search -->
                    </div>
                    <!-- /.search-bar -->
                <!-- Map -->
                <div class="map">
                    <div class="toggle-navigation">
                        <div class="icon">
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                        </div>
                    </div>

                    <!--/.toggle-navigation-->
                    <div id="map" class="has-parallax"></div>
                    <!--/#map-->
                    
                </div>
                <!-- end Map -->
                <!--Items List-->
                <div class="items-list">
                    <div class="inner">
                        <header>
                            <h3>Restaurants</h3>
                        </header>
                        <ul class="results list">

                        </ul>
                    </div>
                    <!--results-->
                </div>
                <!--end Items List-->
            </div>
            <!-- end Map Canvas-->
                <!--Featured-->
                <section id="featured" class="block background-color-grey-dark equal-height">
                    <div class="container">
                        <header><h2>Featured</h2></header>
                        <div class="row">
                            <div class="col-md-3 col-sm-3">
                                <div class="item featured">
                                    <div class="image">
                                        <div class="quick-view" id="1"><i class="fa fa-eye"></i><span>Quick View</span></div>
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
                                                <span title="Bedrooms"><img src="resources/img/bedrooms.png" alt="">2</span>
                                                <span title="Bathrooms"><img src="resources/img/bathrooms.png" alt="">2</span>
                                                <span title="Area"><img src="resources/img/area.png" alt="">240m<sup>2</sup></span>
                                                <span title="Garages"><img src="resources/img/garages.png" alt="">1</span>
                                            </div>
                                            <div class="icon">
                                                <i class="fa fa-thumbs-up"></i>
                                            </div>
                                            <img src="resources/img/items/1.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="wrapper">
                                        <a href="item-detail.html"><h3>Steak House Restaurant</h3></a>
                                        <figure>63 Birch Street</figure>
                                        <div class="info">
                                            <div class="type">
                                                <i><img src="resources/icons/restaurants-bars/restaurants/restaurant.png" alt=""></i>
                                                <span>Restaurant</span>
                                            </div>
                                            <div class="rating" data-rating="4"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.item-->
                            </div>
                            <!--/.col-sm-4-->
                            <div class="col-md-3 col-sm-3">
                                <div class="item featured">
                                    <div class="image">
                                        <div class="quick-view"><i class="fa fa-eye"></i><span>Quick View</span></div>
                                        <a href="item-detail.html">
                                            <div class="overlay">
                                                <div class="inner">
                                                    <div class="content">
                                                        <h4>Description</h4>
                                                        <p>Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <img src="resources/img/items/2.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="wrapper">
                                        <a href="item-detail.html"><h3>Benny’s Cafeteria</h3></a>
                                        <figure>63 Birch Street</figure>
                                        <div class="info">
                                            <div class="type">
                                                <i><img src="resources/icons/restaurants-bars/restaurants/cafetaria.png" alt=""></i>
                                                <span>Cafeteria</span>
                                            </div>
                                            <div class="rating" data-rating="4"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.item-->
                            </div>
                            <!--/.col-sm-4-->
                            <div class="col-md-3 col-sm-3">
                                <div class="item featured">
                                    <div class="image">
                                        <div class="quick-view"><i class="fa fa-eye"></i><span>Quick View</span></div>
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
                                                <span>Daily menu from: $6</span>
                                            </div>
                                            <img src="resources/img/items/restaurant/9.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="wrapper">
                                        <a href="item-detail.html"><h3>Big Bamboo</h3></a>
                                        <figure>4662 Bruce Street</figure>
                                        <div class="info">
                                            <div class="type">
                                                <i><img src="resources/icons/restaurants-bars/restaurants/japanese-food.png" alt=""></i>
                                                <span>Sushi</span>
                                            </div>
                                            <div class="rating" data-rating="3"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.item-->
                            </div>
                            <!--/.col-sm-4-->
                            <div class="col-md-3 col-sm-3">
                                <div class="item featured">
                                    <div class="image">
                                        <div class="quick-view"><i class="fa fa-eye"></i><span>Quick View</span></div>
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
                                                <span>Daily menu from: $6</span>
                                            </div>
                                            <img src="resources/img/items/restaurant/10.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="wrapper">
                                        <a href="item-detail.html"><h3>Sushi Wooshi Bar</h3></a>
                                        <figure>357 Trainer Avenue</figure>
                                        <div class="info">
                                            <div class="type">
                                                <i><img src="resources/icons/restaurants-bars/restaurants/fishchips.png" alt=""></i>
                                                <span>Sushi Bar</span>
                                            </div>
                                            <div class="rating" data-rating="3"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.item-->
                            </div>
                            <!--/.col-sm-4-->
                        </div>
                        <!--/.row-->
                    </div>
                    <!--/.container-->
                </section>
                <!--end Featured-->

                <section class="block equal-height">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-9">
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

                                <!--Recent-->
                                <section id="recent">
                                    <header><h2>Recent</h2></header>
                                        <div class="item list">
                                        <div class="image">
                                            <div class="quick-view"><i class="fa fa-eye"></i><span>Quick View</span></div>
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
                                                    <span title="Bedrooms"><img src="resources/img/bedrooms.png" alt="">2</span>
                                                    <span title="Bathrooms"><img src="resources/img/bathrooms.png" alt="">2</span>
                                                    <span title="Area"><img src="resources/img/area.png" alt="">240m<sup>2</sup></span>
                                                    <span title="Garages"><img src="resources/img/garages.png" alt="">1</span>
                                                </div>
                                                <div class="icon">
                                                    <i class="fa fa-thumbs-up"></i>
                                                </div>
                                                <img src="resources/img/items/1.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="wrapper">
                                            <a href="item-detail.html"><h3>Cash Cow Restaurante</h3></a>
                                            <figure>63 Birch Street</figure>
                                            <div class="info">
                                                <div class="type">
                                                    <i><img src="resources/icons/restaurants-bars/restaurants/restaurant.png" alt=""></i>
                                                    <span>Restaurant</span>
                                                </div>
                                                <div class="rating" data-rating="4"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.item-->
                                    <div class="item list">
                                        <div class="image">
                                            <div class="quick-view"><i class="fa fa-eye"></i><span>Quick View</span></div>
                                            <a href="item-detail.html">
                                                <div class="overlay">
                                                    <div class="inner">
                                                        <div class="content">
                                                            <h4>Description</h4>
                                                            <p>Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <img src="resources/img/items/2.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="wrapper">
                                            <a href="item-detail.html"><h3>Benny’s Cafeteria</h3></a>
                                            <figure>63 Birch Street</figure>
                                            <div class="info">
                                                <div class="type">
                                                    <i><img src="resources/icons/restaurants-bars/restaurants/cafetaria.png" alt=""></i>
                                                    <span>Cafeteria</span>
                                                </div>
                                                <div class="rating" data-rating="4"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.item-->
                                    <div class="item list">
                                        <div class="image">
                                            <div class="quick-view"><i class="fa fa-eye"></i><span>Quick View</span></div>
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
                                                    <span>Daily menu from: $6</span>
                                                </div>
                                                <img src="resources/img/items/restaurant/9.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="wrapper">
                                            <a href="item-detail.html"><h3>Big Bamboo</h3></a>
                                            <figure>4662 Bruce Street</figure>
                                            <div class="info">
                                                <div class="type">
                                                    <i><img src="resources/icons/restaurants-bars/restaurants/japanese-food.png" alt=""></i>
                                                    <span>Sushi</span>
                                                </div>
                                                <div class="rating" data-rating="3"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.item-->
                                </section>
                                <!--end Recent-->
                            </div>
                            <!--/.col-md-9-->
                            <div class="col-md-3">
                                <aside id="sidebar">
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
                                <!-- /#sidebar-->
                            </div>
                            <!-- /.col-md-3-->
                        </div>
                        <!--/.row-->
                    </div>
                </section>

                <!--Banner-->
                <section>
                    <div class="container">
                        <div class="block">
                            <a href="#"><img src="resources/img/ad-banner.png" alt=""></a>
                        </div>
                    </div>
                </section>
                <!--end Banner-->
<hr>
 <?=var_dump($this->session->userdata())?>