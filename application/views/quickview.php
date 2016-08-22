<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

<div class="modal-window fade_in">
    <div class="modal-wrapper"><h2><?=$arraydata["name"]?></h2>
        <figure>
            <?php
                                            if (isset($arraydata["hours"]) && !empty($arraydata["hours"])) {
                                                $hoursarray = json_decode($arraydata["hours"], true);
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
            ?>
        </figure>
        <div class="rating" data-rating="<?=$arraydata["rating"]?>"></div>
        <div class="modal-body">
            <div class="gallery">
                <div class="image">
                    <div class="price">
                    <?php
                    if ($arraydata["price"] == 1) { echo "$1-$10"; }
                    if ($arraydata["price"] == 2) { echo "$10-$25"; }
                    if ($arraydata["price"] == 3) { echo "$25-$50"; }
                    if ($arraydata["price"] == 4) { echo "$50-$100"; }
                    ?></div>
                    <div class="type"><i><img src="resources/icons/restaurants-bars/restaurants/restaurant.png" alt=""></i><span><?php 
                    $catarray = json_decode($arraydata["category_labels"], true);
                    foreach ($catarray[0] as $type) { 
                    echo $type." ";
                     } 
                        ?></span></div>
                    <div class="owl-carousel gallery">
                        <img src="resources/img/items/1.jpg">
                        <img src="resources/img/items/5.jpg">
                        <img src="resources/img/items/4.jpg">
                    </div>
                </div>
                <div class="features"><h3>Features</h3>
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
                </div>
            </div>
            <div class="modal-content">
                <section><h3>Information</h3>
                    <p>
                        <b>Address</b><br><br>
                        <span><?=$arraydata["address"]?><br> 
                            <?=$arraydata["postcode"]?> <?=$arraydata["region"]?></span>
                            <br>
                            <a href="<?=$arraydata["website"]?>"><?=$arraydata["website"]?></a><br><br>

                            <b>Phone</b><br><br>
                            <a href="tel:<?=$arraydata["tel"]?>"><?=$arraydata["tel"]?></a>
                    </p>
                </section>
                <section><h3>Hours Of Operation (<?=$hours?>)</h3>
                    <dl>
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
                </section>
                <section><h3>Last Review</h3>
                    <div class="rating" data-rating="5"></div>
                    <p>Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet</p>
                </section>
                <a href="item-detail.html" class="btn btn-default btn-large">Show Detail</a></div>
        </div>
        <div class="modal-close"><img src="resources/img/close.png"></div>
    </div>
    <div class="modal-background fade_in"></div>
</div>

<script>
    // Render Owl carousel gallery

    var _rtl = false;
    drawOwlCarousel(_rtl);

    // Render Rating stars

    rating('.modal-window');

    // Remove modal element form DOM

    $('.modal-window .modal-background, .modal-close').live('click',  function(e){
        $('.modal-window').addClass('fade_out');
        setTimeout(function() {
            $('.modal-window').remove();
        }, 300);
    });
</script>

<!--[if lte IE 9]>
<script type="text/javascript" src="resources/js/ie-scripts.js"></script>
<![endif]-->
</body>
</html>