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
                                                    <li class="active"><a href="http://<?=$_SERVER["SERVER_NAME"]?>/vendor/businessinformation/<?=$rid?>/"><h1 class="page-title">Manage Information</h1></a></li>
                                                    <li><a href="http://<?=$_SERVER["SERVER_NAME"]?>/vendor/businessinformation/<?=$rid?>/photos"><h1 class="page-title">Manage Photos</h1></a></li>
                                                    <li><a href="http://<?=$_SERVER["SERVER_NAME"]?>/vendor/businessinformation/<?=$rid?>/seo"><h1 class="page-title">Manage SEO</h1></a></li>
                                                </ul>
                                            </header> 
                                            <header>
                                                <h1 class="page-title">Update Business Information</h1>
                                            </header>  
                                            <form role="form" id="info-form" method="post" action="">
                                            <input type="hidden" name="infopage" value="information">
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
                                                <?php
                                                    $hourscreator = 0;
                                                    $hours = [];
                                                    // setup the hours array
                                                    if (isset($l["hours"]) && !empty($l["hours"])) {
                                                        $hoursarray = json_decode($l["hours"], true);
                                                        if (isset($hoursarray["monday"]) && !empty($hoursarray["monday"])) {
                                                            $hours["monday"]["show"] = "";
                                                            $hours["monday"]["hours"] = $hoursarray["monday"];
                                                        } else { $hours["monday"]["show"] = "display:none;"; }
                                                        if (isset($hoursarray["tuesday"]) && !empty($hoursarray["tuesday"])) {
                                                            $hours["tuesday"]["show"] = "";
                                                            $hours["tuesday"]["hours"] = $hoursarray["tuesday"];
                                                        } else { $hours["tuesday"]["show"] = "display:none;"; }
                                                        if (isset($hoursarray["wednesday"]) && !empty($hoursarray["wednesday"])) {
                                                            $hours["wednesday"]["show"] = "";
                                                            $hours["wednesday"]["hours"] = $hoursarray["wednesday"];
                                                        } else { $hours["wednesday"]["show"] = "display:none;"; }
                                                        if (isset($hoursarray["thursday"]) && !empty($hoursarray["thursday"])) {
                                                            $hours["thursday"]["show"] = "";
                                                            $hours["thursday"]["hours"] = $hoursarray["thursday"];
                                                        } else { $hours["thursday"]["show"] = "display:none;"; }
                                                        if (isset($hoursarray["friday"]) && !empty($hoursarray["friday"])) {
                                                            $hours["friday"]["show"] = "";
                                                            $hours["friday"]["hours"] = $hoursarray["friday"];
                                                        } else { $hours["friday"]["show"] = "display:none;"; }
                                                        if (isset($hoursarray["saturday"]) && !empty($hoursarray["saturday"])) {
                                                            $hours["saturday"]["show"] = "";
                                                            $hours["saturday"]["hours"] = $hoursarray["saturday"];
                                                        } else { $hours["saturday"]["show"] = "display:none;"; }
                                                        if (isset($hoursarray["sunday"]) && !empty($hoursarray["sunday"])) {
                                                            $hours["sunday"]["show"] = "";
                                                            $hours["sunday"]["hours"] = $hoursarray["sunday"];
                                                        } else { $hours["sunday"]["show"] = "display:none;"; }
                                                    } else {
                                                        // no hours just create blank arrays
                                                        $hours["monday"]["show"] = "display:none;"; $hours["monday"]["hours"] = [];
                                                        $hours["tuesday"]["show"] = "display:none;"; $hours["tuesday"]["hours"] = [];
                                                        $hours["wednesday"]["show"] = "display:none;"; $hours["wednesday"]["hours"] = [];
                                                        $hours["thursday"]["show"] = "display:none;"; $hours["thursday"]["hours"] = [];
                                                        $hours["friday"]["show"] = "display:none;"; $hours["friday"]["hours"] = [];
                                                        $hours["saturday"]["show"] = "display:none;"; $hours["saturday"]["hours"] = [];
                                                        $hours["sunday"]["show"] = "display:none;"; $hours["sunday"]["hours"] = [];
                                                    }

                                                ?>
                                                <section>
                                                    <h3>Opening Hours</h3>
                                                    <div class="opening-hours">
                                                        <div class="table-responsive">
                                                            <table class="table" id="hours-table">
                                                                <tbody>
                                                                <tr class="day" id="monday">
                                                                    <td class="day-name">Monday</td>
                                                                    <td class="from"><input class="oh-timepicker" type="text" placeholder="From" id="monday-from" ></td>
                                                                    <td class="to"><input class="oh-timepicker" type="text" placeholder="To" id="monday-to"></td>
                                                                    <td class="non-stop">
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input type="checkbox" id="monday-24hr">Non-stop <a href="#" class="btn btn-default" onClick="addTime('monday');">Add Time</a>
                                                                            </label>
                                                                        </div>
                                                                    </td>

                                                                    <div id="monday-additionalhours" >
                                                                        <?php 
                                                                        foreach ($hours["monday"]["hours"] as $k => $v) {
                                                                            $hourscreator += 1;
                                                                            $time1arr = explode(":", $v[0]); $time2arr = explode(":", $v[1]);
                                                                            if ($time1arr[0] < 12) { $ampm1 = "AM";} else { $ampm1 = "PM"; }
                                                                            if ($time2arr[0] < 12) { $ampm2 = "AM";} else { $ampm2 = "PM"; }
                                                                            $display1 = date("h:i", strtotime($v[0])).$ampm1;
                                                                            $display2 = date("h:i", strtotime($v[1])).$ampm2;
                                                                            ?>
                                                                            <tr id="dateadd-<?=$hourscreator?>" class="day">
                                                                                <td></td>
                                                                                <td class="from"><input type="hidden" name="open-hour-from-monday[]" value="<?=$v[0]?>"><?=$display1?></td>
                                                                                <td class="to"><input type="hidden" name="open-hour-to-monday[]" value="<?=$v[1]?>"><?=$display2?></td>
                                                                                <td class="non-stop">
                                                                                    <div class="checkbox">
                                                                                        <label>
                                                                                            <a href="#" class="btn btn-default" onClick="removeDate(<?=$hourscreator?>)">Remove</a>
                                                                                        </label>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>

                                                                        <?php
                                                                        }
                                                                        ?> 
                                                                    </div>
                                                                </tr>
                                                                
                                                                <!--/.day-->
                                                                <tr class="day" id="tuesday">
                                                                    <td class="day-name">Tuesday</td>
                                                                    <td class="from"><input class="oh-timepicker" type="text" placeholder="From" id="tuesday-from" ></td>
                                                                    <td class="to"><input class="oh-timepicker" type="text" placeholder="To" id="tuesday-to"></td>
                                                                    <td class="non-stop">
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input type="checkbox" id="tuesday-24hr">Non-stop <a href="#" class="btn btn-default" onClick="addTime('tuesday');">Add Time</a>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <div id="tuesday-additionalhours" >
                                                                    <?php 
                                                                        foreach ($hours["tuesday"]["hours"] as $k => $v) {
                                                                            $hourscreator += 1;
                                                                            $time1arr = explode(":", $v[0]); $time2arr = explode(":", $v[1]);
                                                                            if ($time1arr[0] < 12) { $ampm1 = "AM";} else { $ampm1 = "PM"; }
                                                                            if ($time2arr[0] < 12) { $ampm2 = "AM";} else { $ampm2 = "PM"; }
                                                                            $display1 = date("h:i", strtotime($v[0])).$ampm1;
                                                                            $display2 = date("h:i", strtotime($v[1])).$ampm2;
                                                                            ?>
                                                                            <tr id="dateadd-<?=$hourscreator?>" class="day">
                                                                                <td></td>
                                                                                <td class="from"><input type="hidden" name="open-hour-from-tuesday[]" value="<?=$v[0]?>"><?=$display1?></td>
                                                                                <td class="to"><input type="hidden" name="open-hour-to-tuesday[]" value="<?=$v[1]?>"><?=$display2?></td>
                                                                                <td class="non-stop">
                                                                                    <div class="checkbox">
                                                                                        <label>
                                                                                            <a href="#" class="btn btn-default" onClick="removeDate(<?=$hourscreator?>)">Remove</a>
                                                                                        </label>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>

                                                                        <?php
                                                                        }
                                                                        ?> 
                                                                    </div> 
                                                                </tr>
                                                                <!--/.day-->
                                                                <tr class="day" id="wednesday">
                                                                    <td class="day-name">Wednesday</td>
                                                                    <td class="from"><input class="oh-timepicker" type="text" placeholder="From" id="wednesday-from" ></td>
                                                                    <td class="to"><input class="oh-timepicker" type="text" placeholder="To" id="wednesday-to"></td>
                                                                    <td class="non-stop">
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input type="checkbox" id="wednesday-24hr">Non-stop <a href="#" class="btn btn-default" onClick="addTime('wednesday');">Add Time</a>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <div id="wednesday-additionalhours" style="<?=$hours["wednesday"]["show"]?>">
                                                                    <?php 
                                                                        foreach ($hours["wednesday"]["hours"] as $k => $v) {
                                                                            $hourscreator += 1;
                                                                            $time1arr = explode(":", $v[0]); $time2arr = explode(":", $v[1]);
                                                                            if ($time1arr[0] < 12) { $ampm1 = "AM";} else { $ampm1 = "PM"; }
                                                                            if ($time2arr[0] < 12) { $ampm2 = "AM";} else { $ampm2 = "PM"; }
                                                                            $display1 = date("h:i", strtotime($v[0])).$ampm1;
                                                                            $display2 = date("h:i", strtotime($v[1])).$ampm2;
                                                                            ?>
                                                                            <tr id="dateadd-<?=$hourscreator?>" class="day">
                                                                                <td></td>
                                                                                <td class="from"><input type="hidden" name="open-hour-from-wednesday[]" value="<?=$v[0]?>"><?=$display1?></td>
                                                                                <td class="to"><input type="hidden" name="open-hour-to-wednesday[]" value="<?=$v[1]?>"><?=$display2?></td>
                                                                                <td class="non-stop">
                                                                                    <div class="checkbox">
                                                                                        <label>
                                                                                            <a href="#" class="btn btn-default" onClick="removeDate(<?=$hourscreator?>)">Remove</a>
                                                                                        </label>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>

                                                                        <?php
                                                                        }
                                                                        ?> 
                                                                    </div> 
                                                                </tr>
                                                                <!--/.day-->
                                                                <tr class="day" id="thursday">
                                                                    <td class="day-name">Thursday</td>
                                                                    <td class="from"><input class="oh-timepicker" type="text" placeholder="From" id="thursday-from" ></td>
                                                                    <td class="to"><input class="oh-timepicker" type="text" placeholder="To" id="thursday-to"></td>
                                                                    <td class="non-stop">
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input type="checkbox" id="thursday-24hr">Non-stop <a href="#" class="btn btn-default" onClick="addTime('thursday');">Add Time</a>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <div id="thursday-additionalhours" style="<?=$hours["thursday"]["show"]?>">
                                                                    <?php 
                                                                        foreach ($hours["thursday"]["hours"] as $k => $v) {
                                                                            $hourscreator += 1;
                                                                            $time1arr = explode(":", $v[0]); $time2arr = explode(":", $v[1]);
                                                                            if ($time1arr[0] < 12) { $ampm1 = "AM";} else { $ampm1 = "PM"; }
                                                                            if ($time2arr[0] < 12) { $ampm2 = "AM";} else { $ampm2 = "PM"; }
                                                                            $display1 = date("h:i", strtotime($v[0])).$ampm1;
                                                                            $display2 = date("h:i", strtotime($v[1])).$ampm2;
                                                                            ?>
                                                                            <tr id="dateadd-<?=$hourscreator?>" class="day">
                                                                                <td></td>
                                                                                <td class="from"><input type="hidden" name="open-hour-from-thursday[]" value="<?=$v[0]?>"><?=$display1?></td>
                                                                                <td class="to"><input type="hidden" name="open-hour-to-thursday[]" value="<?=$v[1]?>"><?=$display2?></td>
                                                                                <td class="non-stop">
                                                                                    <div class="checkbox">
                                                                                        <label>
                                                                                            <a href="#" class="btn btn-default" onClick="removeDate(<?=$hourscreator?>)">Remove</a>
                                                                                        </label>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>

                                                                        <?php
                                                                        }
                                                                        ?> 
                                                                    </div> 
                                                                </tr>
                                                                <!--/.day-->
                                                                <tr class="day" id="friday">
                                                                    <td class="day-name">Friday</td>
                                                                    <td class="from"><input class="oh-timepicker" type="text" placeholder="From" id="friday-from" ></td>
                                                                    <td class="to"><input class="oh-timepicker" type="text" placeholder="To" id="friday-to"></td>
                                                                    <td class="non-stop">
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input type="checkbox" id="friay-24hr">Non-stop <a href="#" class="btn btn-default" onClick="addTime('friday');">Add Time</a>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <div id="friday-additionalhours" >
                                                                    <?php 
                                                                        foreach ($hours["friday"]["hours"] as $k => $v) {
                                                                            $hourscreator += 1;
                                                                            $time1arr = explode(":", $v[0]); $time2arr = explode(":", $v[1]);
                                                                            if ($time1arr[0] < 12) { $ampm1 = "AM";} else { $ampm1 = "PM"; }
                                                                            if ($time2arr[0] < 12) { $ampm2 = "AM";} else { $ampm2 = "PM"; }
                                                                            $display1 = date("h:i", strtotime($v[0])).$ampm1;
                                                                            $display2 = date("h:i", strtotime($v[1])).$ampm2;
                                                                            ?>
                                                                            <tr id="dateadd-<?=$hourscreator?>" class="day">
                                                                                <td></td>
                                                                                <td class="from"><input type="hidden" name="open-hour-from-friday[]" value="<?=$v[0]?>"><?=$display1?></td>
                                                                                <td class="to"><input type="hidden" name="open-hour-to-friday[]" value="<?=$v[1]?>"><?=$display2?></td>
                                                                                <td class="non-stop">
                                                                                    <div class="checkbox">
                                                                                        <label>
                                                                                            <a href="#" class="btn btn-default" onClick="removeDate(<?=$hourscreator?>)">Remove</a>
                                                                                        </label>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>

                                                                        <?php
                                                                        }
                                                                        ?> 
                                                                    </div> 
                                                                </tr>
                                                                <!--/.day-->
                                                                <tr class="day weekend" id="saturday">
                                                                    <td class="day-name">Saturday</td>
                                                                    <td class="from"><input class="oh-timepicker" type="text" placeholder="From" id="saturday-from" ></td>
                                                                    <td class="to"><input class="oh-timepicker" type="text" placeholder="To" id="saturday-to"></td>
                                                                    <td class="non-stop">
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input type="checkbox" id="saturday-24hr">Non-stop <a href="#" class="btn btn-default" onClick="addTime('saturday');">Add Time</a>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <div id="saturday-additionalhours" >
                                                                    <?php 
                                                                        foreach ($hours["saturday"]["hours"] as $k => $v) {
                                                                            $hourscreator += 1;
                                                                            $time1arr = explode(":", $v[0]); $time2arr = explode(":", $v[1]);
                                                                            if ($time1arr[0] < 12) { $ampm1 = "AM";} else { $ampm1 = "PM"; }
                                                                            if ($time2arr[0] < 12) { $ampm2 = "AM";} else { $ampm2 = "PM"; }
                                                                            $display1 = date("h:i", strtotime($v[0])).$ampm1;
                                                                            $display2 = date("h:i", strtotime($v[1])).$ampm2;
                                                                            ?>
                                                                            <tr id="dateadd-<?=$hourscreator?>" class="day">
                                                                                <td></td>
                                                                                <td class="from"><input type="hidden" name="open-hour-from-saturday[]" value="<?=$v[0]?>"><?=$display1?></td>
                                                                                <td class="to"><input type="hidden" name="open-hour-to-saturday[]" value="<?=$v[1]?>"><?=$display2?></td>
                                                                                <td class="non-stop">
                                                                                    <div class="checkbox">
                                                                                        <label>
                                                                                            <a href="#" class="btn btn-default" onClick="removeDate(<?=$hourscreator?>)">Remove</a>
                                                                                        </label>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>

                                                                        <?php
                                                                        }
                                                                        ?> 
                                                                    </div> 
                                                                </tr>
                                                                <!--/.day-->
                                                                <tr class="day weekend" id="sunday">
                                                                    <td class="day-name">Sunday</td>
                                                                    <td class="from"><input class="oh-timepicker" type="text" placeholder="From" id="sunday-from" ></td>
                                                                    <td class="to"><input class="oh-timepicker" type="text" placeholder="To" id="sunday-to" ></td>
                                                                    <td class="non-stop">
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input type="checkbox" id="sunday-24hr">Non-stop <a href="#" class="btn btn-default" onClick="addTime('sunday');">Add Time</a>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <div id="sunday-additionalhours" >
                                                                    <?php 
                                                                        foreach ($hours["sunday"]["hours"] as $k => $v) {
                                                                            $hourscreator += 1;
                                                                            $time1arr = explode(":", $v[0]); $time2arr = explode(":", $v[1]);
                                                                            if ($time1arr[0] < 12) { $ampm1 = "AM";} else { $ampm1 = "PM"; }
                                                                            if ($time2arr[0] < 12) { $ampm2 = "AM";} else { $ampm2 = "PM"; }
                                                                            $display1 = date("h:i", strtotime($v[0])).$ampm1;
                                                                            $display2 = date("h:i", strtotime($v[1])).$ampm2;
                                                                            ?>
                                                                            <tr id="dateadd-<?=$hourscreator?>" class="day">
                                                                                <td></td>
                                                                                <td class="from"><input type="hidden" name="open-hour-from-sunday[]" value="<?=$v[0]?>"><?=$display1?></td>
                                                                                <td class="to"><input type="hidden" name="open-hour-to-sunday[]" value="<?=$v[1]?>"><?=$display2?></td>
                                                                                <td class="non-stop">
                                                                                    <div class="checkbox">
                                                                                        <label>
                                                                                            <a href="#" class="btn btn-default" onClick="removeDate(<?=$hourscreator?>)">Remove</a>
                                                                                        </label>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>

                                                                        <?php
                                                                        }
                                                                        ?> 
                                                                    </div> 
                                                                </tr>
                                                                <!--/.day-->
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </section>
                                                <div class="form-group clearfix">
                                                    <a href="#" onClick="saveChanges(<?=$rid?>);" class="btn btn-default" >Save Changes</a>
                                                </div><!-- /.form-group -->
                                            </form>



                        </div>
                    </div>
                </section>
            </div>
            <script>
            var hourscreator = <?=$hourscreator?>;

            function saveChanges(rid) {
                var apiData = $("#info-form").serialize();
                apiData = JSON.stringify(apiData); 
                $.ajax({
                    type: 'POST',
                    url: 'http://<?=$_SERVER["SERVER_NAME"]?>/vendor/updateBasicInfo/'+rid+'/basic',
                    data: apiData,
                    cache: false,
                    success: function (data) { 
                        location.reload();
                    }
                });
            }

            function addTime(day) {
                hourscreator += 1;
                //check if 24 hours
                //else get to and from time, populate data onto the form
                //reset fields
                var from = document.getElementById(day+"-from").value;
                var to = document.getElementById(day+"-to").value;
                var go = 1;
                if (document.getElementById(day+"-24hr").checked) {
                    // 24 hours
                    from = "00:00";
                    to = "23:59";
                } else {
                    if (from == "" || from == "undefined" || from == null) { go = 0; }
                    if (to == "" || to == "undefined" || to == null) { go = 0; }
                }
                if (go == 1) {
                    var insert = '<tr id="dateadd-'+hourscreator+'" class="day"><td></td><td class="from"><input type="hidden" name="open-hour-from-sunday[]" value="'+from+'">'+from+'</td><td class="to"><input type="hidden" name="open-hour-to-sunday[]" value="'+to+'">'+to+'</td><td class="non-stop"><div class="checkbox"><label><button class="btn btn-default" onClick="removeDate('+hourscreator+')">Remove</button></label></div></td></tr>';
                    $('#hours-table > tbody > #'+day).after(insert); 
                } 
                document.getElementById(day+"-from").value = "";
                document.getElementById(day+"-to").value = "";
                document.getElementById(day+"-24hr").checked = false;
                

            }

            function removeDate(counter) {
                document.getElementById("dateadd-"+counter).innerHTML = "";
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
                    alert("Your browser does not support AJAX!", "Hold Up");
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