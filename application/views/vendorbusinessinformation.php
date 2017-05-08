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
                                            <form role="form" id="form-register" method="post" action="">
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
                                                <section>
                                                    <h3>Opening Hours</h3>
                                                    <div class="opening-hours">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <tbody>
                                                                <tr class="day">
                                                                    <td class="day-name">Monday</td>
                                                                    <td class="from"><input class="oh-timepicker" type="text" placeholder="From" name="open-hour-from-monday[]"></td>
                                                                    <td class="to"><input class="oh-timepicker" type="text" placeholder="To" name="open-hour-to-monday[]"></td>
                                                                    <td class="non-stop"><div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox">Non-stop <a href="#" onClick="showAdditionalHours(">
                                                                        </label>
                                                                    </div>
                                                                    <div id="monday-additionalhours">
                                                                    </div>
                                                                    </td>
                                                                </tr>
                                                                <!--/.day-->
                                                                <tr class="day">
                                                                    <td class="day-name">Tuesday</td>
                                                                    <td class="from"><input class="oh-timepicker" type="text" placeholder="From" name="open-hour-from-tuesday[]"></td>
                                                                    <td class="to"><input class="oh-timepicker" type="text" placeholder="To" name="open-hour-to-tuesday[]"></td>
                                                                    <td class="non-stop"><div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox">Non-stop
                                                                        </label>
                                                                    </div>
                                                                    <div id="tuesday-additionalhours">
                                                                    </div>
                                                                    </td>
                                                                </tr>
                                                                <!--/.day-->
                                                                <tr class="day">
                                                                    <td class="day-name">Wednesday</td>
                                                                    <td class="from"><input class="oh-timepicker" type="text" placeholder="From" name="open-hour-from-wednesday[]"></td>
                                                                    <td class="to"><input class="oh-timepicker" type="text" placeholder="To" name="open-hour-to-wednesday[]"></td>
                                                                    <td class="non-stop"><div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox">Non-stop
                                                                        </label>
                                                                    </div>
                                                                    <div id="wednesday-additionalhours">
                                                                    </div>
                                                                    </td>
                                                                </tr>
                                                                <!--/.day-->
                                                                <tr class="day">
                                                                    <td class="day-name">Thursday</td>
                                                                    <td class="from"><input class="oh-timepicker" type="text" placeholder="From" name="open-hour-from-thursday[]"></td>
                                                                    <td class="to"><input class="oh-timepicker" type="text" placeholder="To" name="open-hour-to-thursday[]"></td>
                                                                    <td class="non-stop"><div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox">Non-stop
                                                                        </label>
                                                                    </div>
                                                                    <div id="thursday-additionalhours">
                                                                    </div>
                                                                    </td>
                                                                </tr>
                                                                <!--/.day-->
                                                                <tr class="day">
                                                                    <td class="day-name">Friday</td>
                                                                    <td class="from"><input class="oh-timepicker" type="text" placeholder="From" name="open-hour-from-friday[]"></td>
                                                                    <td class="to"><input class="oh-timepicker" type="text" placeholder="To" name="open-hour-to-friday[]"></td>
                                                                    <td class="non-stop"><div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox">Non-stop
                                                                        </label>
                                                                    </div>
                                                                    <div id="friday-additionalhours">
                                                                    </div>
                                                                    </td>
                                                                </tr>
                                                                <!--/.day-->
                                                                <tr class="day weekend">
                                                                    <td class="day-name">Saturday</td>
                                                                    <td class="from"><input class="oh-timepicker" type="text" placeholder="From" name="open-hour-from-saturday[]"></td>
                                                                    <td class="to"><input class="oh-timepicker" type="text" placeholder="To" name="open-hour-to-saturday[]"></td>
                                                                    <td class="non-stop"><div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox">Non-stop
                                                                        </label>
                                                                    </div>
                                                                    <div id="saturday-additionalhours">
                                                                    </div>
                                                                    </td>
                                                                </tr>
                                                                <!--/.day-->
                                                                <tr class="day weekend">
                                                                    <td class="day-name">Sunday</td>
                                                                    <td class="from"><input class="oh-timepicker" type="text" placeholder="From" name="open-hour-from-sunday[]"></td>
                                                                    <td class="to"><input class="oh-timepicker" type="text" placeholder="To" name="open-hour-to-sunday[]"></td>
                                                                    <td class="non-stop"><div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox">Non-stop
                                                                        </label>
                                                                    </div>
                                                                    <div id="sunday-additionalhours">
                                                                    </div>
                                                                    </td>
                                                                </tr>
                                                                <!--/.day-->
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </section>
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