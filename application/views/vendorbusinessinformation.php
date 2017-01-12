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
                                                    <div class="checkbox">
                                                <label>$ ($1-$13) <input type="radio" name="price" value="1" <?php if (isset($l["price"]) && $l["price"] == "1") { echo 'checked="checked"'; } ?>></label></div> 
                                                    <div class="checkbox">
                                                <label>$$ ($14-$40) <input type="radio" name="price" value="2" <?php if (isset($l["price"]) && $l["price"] == "2") { echo 'checked="checked"'; } ?>></label></div> 
                                                    <div class="checkbox">
                                                <label>$$$ ($41+) <input type="radio" name="price" value="3" <?php if (isset($l["price"]) && $l["price"] == "3") { echo 'checked="checked"'; } ?>></label></div> 
                                                </div><!-- /.form-group -->  
                                                <hr>
                                                <section>
                                                    <h3>Opening Hours</h3>
                                                    <div class="opening-hours">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <tbody>
                                                                <tr class="day">
                                                                    <td class="day-name">Monday</td>
                                                                    <td class="from"><input class="oh-timepicker" type="text" placeholder="From" name="open-hour-from[]"></td>
                                                                    <td class="to"><input class="oh-timepicker" type="text" placeholder="To" name="open-hour-to[]"></td>
                                                                    <td class="non-stop"><div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox">Non-stop
                                                                        </label>
                                                                    </div>
                                                                    </td>
                                                                </tr>
                                                                <!--/.day-->
                                                                <tr class="day">
                                                                    <td class="day-name">Tuesday</td>
                                                                    <td class="from"><input class="oh-timepicker" type="text" placeholder="From" name="open-hour-from[]"></td>
                                                                    <td class="to"><input class="oh-timepicker" type="text" placeholder="To" name="open-hour-to[]"></td>
                                                                    <td class="non-stop"><div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox">Non-stop
                                                                        </label>
                                                                    </div>
                                                                    </td>
                                                                </tr>
                                                                <!--/.day-->
                                                                <tr class="day">
                                                                    <td class="day-name">Wednesday</td>
                                                                    <td class="from"><input class="oh-timepicker" type="text" placeholder="From" name="open-hour-from[]"></td>
                                                                    <td class="to"><input class="oh-timepicker" type="text" placeholder="To" name="open-hour-to[]"></td>
                                                                    <td class="non-stop"><div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox">Non-stop
                                                                        </label>
                                                                    </div>
                                                                    </td>
                                                                </tr>
                                                                <!--/.day-->
                                                                <tr class="day">
                                                                    <td class="day-name">Thursday</td>
                                                                    <td class="from"><input class="oh-timepicker" type="text" placeholder="From" name="open-hour-from[]"></td>
                                                                    <td class="to"><input class="oh-timepicker" type="text" placeholder="To" name="open-hour-to[]"></td>
                                                                    <td class="non-stop"><div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox">Non-stop
                                                                        </label>
                                                                    </div>
                                                                    </td>
                                                                </tr>
                                                                <!--/.day-->
                                                                <tr class="day">
                                                                    <td class="day-name">Friday</td>
                                                                    <td class="from"><input class="oh-timepicker" type="text" placeholder="From" name="open-hour-from[]"></td>
                                                                    <td class="to"><input class="oh-timepicker" type="text" placeholder="To" name="open-hour-to[]"></td>
                                                                    <td class="non-stop"><div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox">Non-stop
                                                                        </label>
                                                                    </div>
                                                                    </td>
                                                                </tr>
                                                                <!--/.day-->
                                                                <tr class="day weekend">
                                                                    <td class="day-name">Saturday</td>
                                                                    <td class="from"><input class="oh-timepicker" type="text" placeholder="From" name="open-hour-from[]"></td>
                                                                    <td class="to"><input class="oh-timepicker" type="text" placeholder="To" name="open-hour-to[]"></td>
                                                                    <td class="non-stop"><div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox">Non-stop
                                                                        </label>
                                                                    </div>
                                                                    </td>
                                                                </tr>
                                                                <!--/.day-->
                                                                <tr class="day weekend">
                                                                    <td class="day-name">Sunday</td>
                                                                    <td class="from"><input class="oh-timepicker" type="text" placeholder="From" name="open-hour-from[]"></td>
                                                                    <td class="to"><input class="oh-timepicker" type="text" placeholder="To" name="open-hour-to[]"></td>
                                                                    <td class="non-stop"><div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox">Non-stop
                                                                        </label>
                                                                    </div>
                                                                    </td>
                                                                </tr>
                                                                <!--/.day-->
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </section>
                                                <hr>
                                                <section>
                                                    <h3>Gallery</h3>
                                                    <div id="file-submit" class="dropzone">
                                                        <input name="file" type="file" multiple>
                                                        <div class="dz-default dz-message"><span>Click or Drop Images Here</span></div>
                                                    </div>
                                                </section>
                                                <hr>
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
                                                    <button type="submit" class="btn btn-default" id="account-submit">Save Changes</button>
                                                </div><!-- /.form-group -->
                                            </form>



                        </div>
                    </div>
                </section>
            </div>




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