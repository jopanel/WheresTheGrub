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
                                                <h1 class="page-title">Update Business Information</h1>
                                            </header>  
                                            <form role="form" id="form-register" method="post" action=""> 
                                                <div class="form-group">
                                                    <label>Address:</label>
                                                    <input type="text" class="form-control" name="address" value="<?=$l["address"]?>" required>
                                                </div><!-- /.form-group -->
                                                <div class="form-group">
                                                    <label>Post Code/Zip:</label>
                                                    <input type="text" class="form-control" name="postcode" value="<?=$l["postcode"]?>" required>
                                                </div><!-- /.form-group -->
                                                <div class="form-group">
                                                    <label>Telephone:</label>
                                                    <input type="text" class="form-control" value="<?=$l["tel"]?>"  name="tel">
                                                </div><!-- /.form-group --> 
                                                <div class="form-group">
                                                    <label>Website:</label>
                                                    <input type="text" class="form-control" value="<?=$l["website"]?>"  name="website">
                                                </div><!-- /.form-group -->  
                                                <div class="form-group">
                                                    <label>Attire:</label>
                                                    <select class="form-control"  name="attire">
                                                    <option value="casual" <?php if (isset($l["attire"]) && $l["attire"] == "casual") { echo "selected"; }?>>Casual</option>
                                                    <option value="business casual" <?php if (isset($l["attire"]) && $l["attire"] == "business casual") { echo "selected"; }?>>Business Casual</option>
                                                    <option value="smart casual" <?php if (isset($l["attire"]) && $l["attire"] == "smart casual") { echo "selected"; }?>>Smart Casual</option>
                                                    <option value="streetwear" <?php if (isset($l["attire"]) && $l["attire"] == "streetwear") { echo "selected"; }?>>Streetwear</option>
                                                    <option value="" <?php if (!isset($l["attire"]) || empty($l["attire"])) { echo "selected"; } ?>>N/A</option>
                                                    </select>
                                                </div><!-- /.form-group --> 
                                                <div class="form-group">
                                                    <label>Description:</label>
                                                    <textarea class="form-control" name="description"><?=$l["description"]?></textarea>
                                                </div><!-- /.form-group -->  
                                                <div class="form-group">
                                                    <label>Price (Per-Person Average Price):</label>
                                                    $ ($1-$13) <input type="radio" name="price" value="1" <?php if (isset($l["price"]) && $l["price"] == "1") { echo 'checked="checked"'; } ?>> 
                                                    $$ ($14-$40) <input type="radio" name="price" value="2" <?php if (isset($l["price"]) && $l["price"] == "2") { echo 'checked="checked"'; } ?>> 
                                                    $$$ ($41+) <input type="radio" name="price" value="3" <?php if (isset($l["price"]) && $l["price"] == "3") { echo 'checked="checked"'; } ?>> 
                                                </div><!-- /.form-group -->  
                                                <hr>
                                                <div class="form-group">
                                                    <label>Set Hours:</label>
                                                    <?php
                                                    /*
                                                    {"monday":[["5:30","17:30"]],"tuesday":[["5:30","17:30"]],"wednesday":[["5:30","17:30"]],"thursday":[["5:30","17:30"]],"friday":[["5:30","17:30"]],"saturday":[["6:30","17:30"]]}
                                                    */
                                                    ?>
                                                    Monday:<br>

                                                    <br>
                                                    Tuesday:<br>

                                                    <br>
                                                    Wednesday:<br>

                                                    <br>
                                                    Thursday:<br>

                                                    <br>
                                                    Friday:<br>

                                                    <br>
                                                    Saturday:<br>

                                                    <br>
                                                    Sunday:<br>

                                                </div>
                                                <hr>
                                                <div class="form-group">
                                                <label>Search Options and Attributes</label>
                                               <strong>Delivery</strong> <input type="checkbox" name="meal_deliver" value="1" ><br>
                                               <strong>Takeout</strong> <input type="checkbox" name="meal_takeout" value="1" ><br>
                                               <strong>Cash Only</strong> <input type="checkbox" name="payment_cashonly" value="1" ><br>
                                               Wheelchair Accessible <input type="checkbox" name="accessible_wheelchair" value="1" ><br>
                                               Serve Beer <input type="checkbox" name="alcohol_beer" value="1" ><br>
                                               Serve Alcohol & Beer <input type="checkbox" name="alcohol" value="1" ><br>
                                               Serve Alcohol/Wine <input type="checkbox" name="alcohol_beer_wine" value="1" ><br> 
                                               Good For Kids <input type="checkbox" name="kids_goodfor" value="1" ><br> 
                                               Serve Breakfast <input type="checkbox" name="meal_breakfast" value="1" ><br>
                                               Serve Dinner <input type="checkbox" name="meal_dinner" value="1" ><br>
                                               Serve Lunch <input type="checkbox" name="meal_lunch" value="1" ><br>
                                               Catering <input type="checkbox" name="meal_cater" value="1" ><br>  
                                               Open 24-Hours <input type="checkbox" name="open_24hrs" value="1" ><br>
                                               Healthy Options <input type="checkbox" name="options_healthy" value="1" ><br>
                                               Vegetarian Options <input type="checkbox" name="options_vegetarian" value="1" ><br>
                                               Available Parking <input type="checkbox" name="parking" value="1" ><br>
                                               Parking Lot <input type="checkbox" name="parking_lot" value="1" ><br>
                                               Street Parking <input type="checkbox" name="parking_street" value="1" ><br>
                                               Reservations <input type="checkbox" name="reservations" value="1" ><br>
                                               Outdoor Seating <input type="checkbox" name="seating_outdoor" value="1" ><br>
                                               Smoking Seating <input type="checkbox" name="smoking" value="1" ><br>
                                               Wifi Available <input type="checkbox" name="wifi" value="1" ><br>
                                                </div>
                                                <div class="form-group clearfix">
                                                    <button type="submit" class="btn btn-default" id="account-submit">Save Changes</button>
                                                </div><!-- /.form-group -->
                                            </form>



                        </div>
                    </div>
                </section>
            </div>