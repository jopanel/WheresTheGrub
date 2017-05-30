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
                                        <a href="http://<?=$_SERVER["SERVER_NAME"]?>/vendor/managebusiness/<?=$rid?>">
                                            <i class="fa fa-info"></i>
                                            <span>Overview</span>
                                        </a>
                                    </li>
                                    <li class="active">
                                        <a href="http://<?=$_SERVER["SERVER_NAME"]?>/vendor/businessinformation/<?=$rid?>">
                                            <i class="fa fa-edit"></i>
                                            <span>Information</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://<?=$_SERVER["SERVER_NAME"]?>/vendor/managemenu/<?=$rid?>">
                                            <i class="fa fa-align-justify"></i>
                                            <span>Menu</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://<?=$_SERVER["SERVER_NAME"]?>/vendor/managepromos/<?=$rid?>">
                                            <i class="fa fa-bolt"></i>
                                            <span>Promotions</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://<?=$_SERVER["SERVER_NAME"]?>/vendor/managereviews/<?=$rid?>">
                                            <i class="fa fa-bullhorn"></i>
                                            <span>Reviews</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://<?=$_SERVER["SERVER_NAME"]?>/vendor/ppc/<?=$rid?>">
                                            <i class="fa fa-dollar"></i>
                                            <span>Adwords</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://<?=$_SERVER["SERVER_NAME"]?>/vendor/reports/<?=$rid?>">
                                            <i class="fa fa-bar-chart"></i>
                                            <span>Business Reports</span>
                                        </a>
                                    </li>
                                </ul>
                            </aside>
                        </div>
                        <div class="col-md-9 col-sm-9">

                                            <header>
                                                <ul class="nav nav-pills">
                                                    <li><a href="http://<?=$_SERVER["SERVER_NAME"]?>/vendor/businessinformation/<?=$rid?>/"><h1 class="page-title">Manage Information</h1></a></li>
                                                    <li><a href="http://<?=$_SERVER["SERVER_NAME"]?>/vendor/businessinformation/<?=$rid?>/photos"><h1 class="page-title">Manage Photos</h1></a></li>
                                                    <li class="active"><a href="http://<?=$_SERVER["SERVER_NAME"]?>/vendor/businessinformation/<?=$rid?>/seo"><h1 class="page-title">Manage SEO</h1></a></li>
                                                </ul>
                                            </header> 
                                            <header>
                                                <h1 class="page-title">Update Search Attributes</h1>
                                            </header>  
                                            <form role="form" id="attributeform" method="post" action="">
                                            <input type="hidden" name="infopage" value="seo">
                                                <div class="form-group">
                                                <label>Search Options and Attributes</label>
                                                <div class="checkbox">
                                                <label>
                                               <strong>Delivery</strong> <input type="checkbox" name="meal_deliver" value="1" <?php if (isset($l["meal_deliver"]) && $l["meal_deliver"] == 1) { echo "checked"; } ?>>
                                               </label>
                                               </div>
                                               <br>
                                                <div class="checkbox">
                                                <label>
                                               <strong>Takeout</strong> <input type="checkbox" name="meal_takeout" value="1" <?php if (isset($l["meal_takeout"]) && $l["meal_takeout"] == 1) { echo "checked"; } ?> >
                                               </label>
                                               </div><br>
                                                <div class="checkbox">
                                                <label>
                                               <strong>Cash Only</strong> <input type="checkbox" name="payment_cashonly" value="1" <?php if (isset($l["payment_cashonly"]) && $l["payment_cashonly"] == 1) { echo "checked"; } ?> >
                                               </label>
                                               </div><br>
                                                <div class="checkbox">
                                                <label>
                                               Wheelchair Accessible <input type="checkbox" name="accessible_wheelchair" value="1" <?php if (isset($l["accessible_wheelchair"]) && $l["accessible_wheelchair"] == 1) { echo "checked"; } ?> >
                                               </label>
                                               </div><br>
                                                <div class="checkbox">
                                                <label>
                                               Serve Beer <input type="checkbox" name="alcohol_beer" value="1" <?php if (isset($l["alcohol_beer"]) && $l["alcohol_beer"] == 1) { echo "checked"; } ?> >
                                               </label>
                                               </div><br>
                                                <div class="checkbox">
                                                <label>
                                               Serve Alcohol & Beer <input type="checkbox" name="alcohol" value="1" <?php if (isset($l["alcohol"]) && $l["alcohol"] == 1) { echo "checked"; } ?> >
                                               </label>
                                               </div><br>
                                               <div class="checkbox">
                                                <label>
                                               Serve Alcohol/Wine <input type="checkbox" name="alcohol_beer_wine" value="1" <?php if (isset($l["alcohol_beer_wine"]) && $l["alcohol_beer_wine"] == 1) { echo "checked"; } ?> >
                                               </label>
                                               </div><br> 
                                                <div class="checkbox">
                                                <label>
                                               Good For Kids <input type="checkbox" name="kids_goodfor" value="1" <?php if (isset($l["kids_goodfor"]) && $l["kids_goodfor"] == 1) { echo "checked"; } ?> >
                                               </label>
                                               </div><br> 
                                                <div class="checkbox">
                                                <label>
                                               Serve Breakfast <input type="checkbox" name="meal_breakfast" value="1" <?php if (isset($l["meal_breakfast"]) && $l["meal_breakfast"] == 1) { echo "checked"; } ?> >
                                               </label>
                                               </div><br>
                                                <div class="checkbox">
                                                <label>
                                               Serve Dinner <input type="checkbox" name="meal_dinner" value="1" <?php if (isset($l["meal_dinner"]) && $l["meal_dinner"] == 1) { echo "checked"; } ?> >
                                               </label>
                                               </div><br>
                                                <div class="checkbox">
                                                <label>
                                               Serve Lunch <input type="checkbox" name="meal_lunch" value="1" <?php if (isset($l["meal_lunch"]) && $l["meal_lunch"] == 1) { echo "checked"; } ?> >
                                               </label>
                                               </div><br>
                                                <div class="checkbox">
                                                <label>
                                               Catering <input type="checkbox" name="meal_cater" value="1" <?php if (isset($l["meal_cater"]) && $l["meal_cater"] == 1) { echo "checked"; } ?> >
                                               </label>
                                               </div><br> 
                                                <div class="checkbox">
                                                <label> 
                                               Open 24-Hours <input type="checkbox" name="open_24hrs" value="1" <?php if (isset($l["open_24hrs"]) && $l["open_24hrs"] == 1) { echo "checked"; } ?> >
                                               </label>
                                               </div><br>
                                                <div class="checkbox">
                                                <label>
                                               Healthy Options <input type="checkbox" name="options_healthy" value="1" <?php if (isset($l["options_healthy"]) && $l["options_healthy"] == 1) { echo "checked"; } ?> >
                                               </label>
                                               </div><br>
                                                <div class="checkbox">
                                                <label>
                                               Vegetarian Options <input type="checkbox" name="options_vegetarian" value="1" <?php if (isset($l["options_vegetarian"]) && $l["options_vegetarian"] == 1) { echo "checked"; } ?> >
                                               </label>
                                               </div><br>
                                                <div class="checkbox">
                                                <label>
                                               Available Parking <input type="checkbox" name="parking" value="1" <?php if (isset($l["parking"]) && $l["parking"] == 1) { echo "checked"; } ?> >
                                               </label>
                                               </div><br>
                                                <div class="checkbox">
                                                <label>
                                               Parking Lot <input type="checkbox" name="parking_lot" value="1" <?php if (isset($l["parking_lot"]) && $l["parking_lot"] == 1) { echo "checked"; } ?> >
                                               </label>
                                               </div><br>
                                                <div class="checkbox">
                                                <label>
                                               Street Parking <input type="checkbox" name="parking_street" value="1" <?php if (isset($l["parking_street"]) && $l["parking_street"] == 1) { echo "checked"; } ?> >
                                               </label>
                                               </div><br>
                                                <div class="checkbox">
                                                <label>
                                               Reservations <input type="checkbox" name="reservations" value="1" <?php if (isset($l["reservations"]) && $l["reservations"] == 1) { echo "checked"; } ?> >
                                               </label>
                                               </div><br>
                                                <div class="checkbox">
                                                <label>
                                               Outdoor Seating <input type="checkbox" name="seating_outdoor" value="1" <?php if (isset($l["seating_outdoor"]) && $l["seating_outdoor"] == 1) { echo "checked"; } ?> >
                                               </label>
                                               </div><br>
                                                <div class="checkbox">
                                                <label>
                                               Smoking Seating <input type="checkbox" name="smoking" value="1" <?php if (isset($l["smoking"]) && $l["smoking"] == 1) { echo "checked"; } ?> >
                                               </label>
                                               </div><br>
                                                <div class="checkbox">
                                                <label>
                                               Wifi Available <input type="checkbox" name="wifi" value="1" <?php if (isset($l["wifi"]) && $l["wifi"] == 1) { echo "checked"; } ?> >
                                               </label>
                                               </div><br>
                                                <div class="checkbox">
                                                <label>
                                                </div>
                                                <div class="form-group clearfix">
                                                    <a href="#" onClick="saveChanges(<?=$rid?>);" class="btn btn-default" >Save Changes</a>
                                                </div><!-- /.form-group -->
                                            </form>



                        </div>
                    </div>
                </section>
            </div>
<script>

            function saveChanges(rid) {
              var attribs = $("#attributeform").serialize();
              attribs = JSON.stringify(attribs); 
              $.ajax({
                  type: 'POST',
                  url: 'http://<?=$_SERVER["SERVER_NAME"]?>/vendor/updateBasicInfo/'+rid+'/seo',
                  data: attribs,
                  cache: false,
                  success: function (data) { 
                      location.reload();
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
                    alert("Your browser does not support AJAX!");
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



<script type="text/javascript" src="http://<?=$_SERVER['SERVER_NAME']?>/resources/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="http://<?=$_SERVER['SERVER_NAME']?>/resources/js/before.load.js"></script>
<script type="text/javascript" src="http://<?=$_SERVER['SERVER_NAME']?>/resources/js/jquery-ui.min.js"></script> 
<script type="text/javascript" src="http://<?=$_SERVER['SERVER_NAME']?>/resources/js/richmarker-compiled.js"></script>
<script type="text/javascript" src="http://<?=$_SERVER['SERVER_NAME']?>/resources/js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="http://<?=$_SERVER['SERVER_NAME']?>/resources/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://<?=$_SERVER['SERVER_NAME']?>/resources/js/smoothscroll.js"></script>
<script type="text/javascript" src="http://<?=$_SERVER['SERVER_NAME']?>/resources/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="http://<?=$_SERVER['SERVER_NAME']?>/resources/js/icheck.min.js"></script>
<script type="text/javascript" src="http://<?=$_SERVER['SERVER_NAME']?>/resources/js/jquery.hotkeys.js"></script>
<script type="text/javascript" src="http://<?=$_SERVER['SERVER_NAME']?>/resources/js/dropzone.min.js"></script>
<script type="text/javascript" src="http://<?=$_SERVER['SERVER_NAME']?>/resources/js/jquery.ui.timepicker.js"></script>
<script type="text/javascript" src="http://<?=$_SERVER['SERVER_NAME']?>/resources/js/custom.js"></script> 