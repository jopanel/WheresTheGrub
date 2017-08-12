<?php $rid = $res["id"]; ?>
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
                                        <h1><?=$res["name"]?>
                                        <follow id="followbtn">
                                        <?php 
                                        if ($this->session->userdata('loggedin')) {
                                            if ($isfollowing == TRUE) { ?>
                                                <button class="followbtn" class="btn btn-default" onClick="request(<?php echo $res["id"]; ?>,1)">Follow</button>
                                           <?php  } else { ?>
                                                <button class="followbtn" class="btn btn-default" onClick="request(<?php echo $res["id"]; ?>,2)">Un-Follow</button>
                                           <?php } ?>
                                           </follow>
                                         </h1>
                                        }
                                        ?>
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
                                        }
            ?></figure>
                                    </div>
                                    <div class="info">
                                        <div class="type">
                                            <i><img src="../resources/icons/restaurants-bars/restaurants/restaurant.png" alt=""></i>
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
                                                    <div class="form-group">
                                                        <label for="item-detail-name">Name</label>
                                                        <input type="text" class="form-control framed" id="contactname" name="item-detail-name" required="">
                                                    </div>
                                                    <!-- /.form-group -->
                                                    <div class="form-group">
                                                        <label for="item-detail-email">Email</label>
                                                        <input type="email" class="form-control framed" id="contactemail" name="item-detail-email" required="">
                                                    </div>
                                                    <!-- /.form-group -->
                                                    <div class="form-group">
                                                        <label for="item-detail-message">Message</label>
                                                        <textarea class="form-control framed" id="item-detail-message" name="contactmessage"  rows="3" required=""></textarea>
                                                    </div>
                                                    <!-- /.form-group -->
                                                    <div class="form-group">
                                                        <button type="submit" onClick="request(<?=$res["id"]?>,4);" class="btn framed icon">Send<i class="fa fa-angle-right"></i></button> <p id="contactsuccess"></p>
                                                    </div>
                                                    <!-- /.form-group -->
                                            </figure>
                                        </section>
                                        <!--end Contact Form-->
                                        <?php    } else { ?>
                                            <section>
                                                <header><h3>Is This Your Business?</h3></header>
                                                <figure>
                                                    <form id="item-detail-form" role="form" method="post" action="../claim">
                                                    <input type="hidden" name="action" value="claim">
                                                    <input type="hidden" name="rid" value="<?=$res["id"]?>">
                                                        <div class="form-group"> 
                                                            <button type="submit" class="btn framed icon">Claim<i class="fa fa-angle-right"></i></button>
                                                        </div>
                                                        <!-- /.form-group -->
                                                    </form>
                                                </figure>
                                            </section>
                                        <?php }?>
                                        
                                    </aside>
                                    <!--end Detail Sidebar-->
                                    <!--Content-->
                                    <div class="col-md-8 col-sm-8">
                                        <section>
                                            <article class="item-gallery">
                                                <div class="owl-carousel item-slider">
                                                <?php 
                                                if (!empty($res["photos"])) {
                                                    $counter1 = 0;
                                                    foreach ($res["photos"] as $url) { $counter1+=1; ?>
                                                    <div class="slide"><img src="<?=$url?>" data-hash="<?=$counter1?>" alt="<?=$res["name"]?>"></div>
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
                                                                    <a href="#<?=$countp?>" id="thumbnail-<?=$countp?>" class="active"><img style="width:70px;" src="<?$review["photo"]?>" alt="<?=$res["name"]?>"></a>
                                                                <?php } else { ?>
                                                                    <a href="#<?=$countp?>" id="thumbnail-<?=$countp?>"><img style="width:70px;" src="<?$review["photo"]?>" alt="<?=$res["name"]?>"></a>
                                                                <?php }
                                                                 } ?>
                                                            <?php } ?>
                                                        <?php } ?> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                            <!-- /.item-gallery -->
                                            <?php

                                            if (isset($res["description"]) && !empty($res["description"])) {
                                                ?>
                                                <article class="block">
                                                    <header><h2>Description</h2></header>
                                                    <p>
                                                        <?=$res["description"]?>
                                                    </p>
                                                </article>
                                                <?php
                                            }
                                            ?>
                                            <?php

                                            if (isset($res["menu"]) && !empty($res["menu"])) {
                                                ?>
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
                                                <?php
                                            } 
                                            ?>
                                           
                                            <!-- /.block -->
                                            <article class="block">
                                                <header><h2>Features</h2></header>
                                                <ul class="bullets">
                                                    <?php
                                                    foreach ($res as $key=>$value) {
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
                                                    $r = json_decode($res["hours"], true);
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
                                            <section class="reviews">
 
                                            <?php
                                            foreach ($res["reviews"] as $r) { ?>
                                                <article class="review">
                                                    <figure class="author">
                                                        <img src="<?=$r["avatar"]?>" alt="">
                                                        <div class="date"><?=$r["date"]?></div>
                                                    </figure>
                                                    <!-- /.author-->
                                                    <div class="wrapper">
                                                        <h5><?=$r["user"]?></h5>
                                                        <figure class="rating big color" data-rating="<?=$r["rating"]?>"></figure>
                                                        <p>
                                                            <?=$r["review"]?>
                                                        </p>
                                                        <div class="individual-rating">
                                                            <span>Rating</span>
                                                            <figure class="rating" data-rating="<?=$r["rating"]?>"></figure>
                                                        </div>
                                                        <!-- /.user-rating --> 
                                                    </div>
                                                    <!-- /.wrapper-->
                                                </article>
                                                <!-- /.review -->
                                            <?php } 
                                            if (count($res["reviews"]) == 0) {
                                                echo "<p>There are currently no reviews to show. You can be the first!</p>";
                                            }
                                            ?> 
 
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
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label for="form-review-message">Message</label>
                                                            <textarea class="form-control" id="reviewmessage" name="reviewmessage"  rows="3" required=""></textarea>
                                                            <p id="reviewsuccess"></p>
                                                        </div>
                                                        <!-- /.form-group -->
                                                        <div class="form-group">
                                                            <button type="submit" onClick="request(<?=$res["id"]?>,3);" class="btn btn-default">Submit Review</button>
                                                        </div>
                                                        <!-- /.form-group -->
                                                    </div>
                                                    <div class="col-md-4">
                                                        <aside class="user-rating">
                                                            <label>Ratings</label>
                                                            <figure class="rating active" name="reviewrating" id="reviewrating" data-name="rating"></figure>
                                                        </aside>
                                                    </div>
                                                </div> 
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
                                            if (isset($br["category_labels"]) && !empty($br["category_labels"])) { 
                                                $categoryarray = json_decode($br["category_labels"], true);
                                                foreach ($categoryarray[0] as $labels) {
                                                    $label .= $labels." ";
                                                }
                                            } else {
                                            $label = "Restaurant";
                                            }
                                            if ($br["premium"] == 1) { $pre = 1; } else { $pre = 0; }
                                            ?>
                                        <a href="#" onClick="competitorClick(<?=$br["id"]?>,<?=$pre?>,'<?=$br["url"]?>');" class="item-horizontal small">
                                            <h3><?=$br["name"];?></h3>
                                            <figure><?=$br["address"]?></figure>
                                            <div class="wrapper">
                                                <div class="image"><img src="../resources/img/items/<?=$br["rating"]?>.jpg" alt=""></div>
                                                <div class="info">
                                                    <div class="type">
                                                        <div class="rating" data-rating="<?=$br["rating"]?>"></div>
                                                        <?php 
                                            if (isset($br["hours"]) && !empty($br["hours"])) {
                                                $hoursarray = json_decode($br["hours"], true);
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
                                                if ($open == 0) { $hours = "<span>Currently Closed</span>"; } else { $hours = "<span>Open until ".$until."</span>"; }
                                            } else {
                                                $hours = "<span>Currently Closed</span>";
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
                                    <a href="#"><img src="../resources/img/ad-banner-sidebar.png" alt=""></a>
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

            <script>
            var hascontacted = 0;
            var hasreviewed = 0;
            function writeReview() {
                $("#write-review").show();
            }
            function request(rid, action) { 
                
                if (hascontacted == 1) { document.getElementById("contactsuccess").innerHTML = "You have already contacted this business.";}
                if (hasreviewed == 1) { document.getElementById("reviewsuccess").innerHTML = "You have made a review already."; }

               if (action == 1) { var action2 = "updatefollow"; var display = '<button class="followbtn" class="btn btn-default" onClick="request(<?php echo $res["id"]; ?>,1)">Follow</button>';}
               if (action == 2) { var action2 = "updatefollow"; var display = '<button class="followbtn" class="btn btn-default" onClick="request(<?php echo $res["id"]; ?>,2)">Un-Follow</button>'; }
               if (action == 3) { var action2 = "review"; 
                    var review = document.getElementById("reviewmessage").value;
                    var rating = document.getElementById("reviewrating").value;
                }
               if (action == 4) { var action2 = "contact"; 
                    var contactname = document.getElementById("contactname").value;
                    var contactemail = document.getElementById("contactemail").value;
                    var contactmessage = document.getElementById("contactmessage").value;
                }

               if (action == 1 || action == 2) {
                var postData = { "rid": rid, "action": action2 };
                $.ajax({
                    type: 'POST',
                    url: '<?=base_url()?>place/request/<?=$rid?>/'+action2,
                    data: postData,
                    cache: false,
                    success: function (data) { 
                       document.getElementById("followbtn").innerHTML = display;
                    }
                });
               }
               if (action == 3 && hasreviewed == 0) {
                hasreviewed = 1;
                var postData = { "rid": rid, "action": action2, "reviewmessage": review, "reviewrating": rating };
                $.ajax({
                    type: 'POST',
                    url: '<?=base_url()?>place/request/<?=$rid?>/'+action2,
                    data: postData,
                    cache: false,
                    success: function (data) { 
                       if (action == "review") { document.getElementById("reviewsuccess").innerHTML = "Your review will be available shortly. Thank you"; }
                    }
                });
               }
               if (action == 4 && hascontacted == 0) {
                hascontacted = 1;
                var postData = { "rid": rid, "action": action2, "contactname": contactname, "contactemail": contactemail, "contactmessage": contactmessage };
                $.ajax({
                    type: 'POST',
                    url: '<?=base_url()?>place/request/<?=$rid?>/'+action2,
                    data: postData,
                    cache: false,
                    success: function (data) { 
                       if (action == "contact") { document.getElementById("contactsuccess").innerHTML = "Your contact request has been submitted."; }
                    }
                });
               }


               
            }

            function openCompetitor(rid,pre,url) {
                if (pre == 1) { var uri = "openCompetitorPPC"; } else { var uri = "openCompetitor"; }
                var postData = { "rid": rid }
                $.ajax({
                    type: 'POST',
                    url: '<?=base_url()?>place/'+uri+,
                    data: postData,
                    cache: false,
                    success: function (data) { 
                       window.location.href = "<?=base_url()?>place/"+url;
                    }
                });
            }
            
            function getXmlHttpObject() {
                var xmlHttp;
                try {
                    // Firefox, Opera 8.0+, Safari
                    xmlHttp = new XMLHttpRequest();
                } catch (e) {
                    // Internet Explorer
                    try {
                        xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
                    } catch (e) {
                        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                }
                if (!xmlHttp) {
                    showprompt("Your browser does not support AJAX!", "Hold Up");
                }
                return xmlHttp;
            }


            function ajax(url, postdata, onSuccess, onError) {
            
                var xmlHttp = getXmlHttpObject();
                
                xmlHttp.onreadystatechange = function() {
                    if (this.readyState === 4) {
                        
                        // onSuccess
                        if (this.status === 200 && typeof onSuccess == 'function') {
                            onSuccess(this.responseText);
                            
                        }
                        
                        // onError
                        else if(typeof onError == 'function') {
                            onError();
                        }
                        
                    }
                };
                xmlHttp.open("POST", url, true);
                xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlHttp.send(postdata);
                return xmlHttp;
            }
            </script>
