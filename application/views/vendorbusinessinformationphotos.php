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
                                                    <li class="active"><a href="http://<?=$_SERVER["SERVER_NAME"]?>/vendor/businessinformation/<?=$rid?>/photos"><h1 class="page-title">Manage Photos</h1></a></li>
                                                    <li><a href="http://<?=$_SERVER["SERVER_NAME"]?>/vendor/businessinformation/<?=$rid?>/seo"><h1 class="page-title">Manage SEO</h1></a></li>
                                                </ul>
                                            </header> 
                                            <header>
                                                <h1 class="page-title">Manages Photos</h1>
                                            </header>  
                                                
                                                <section>
                                                    <h3>Gallery (.jpg, .png only)</h3>
                                                    <form action="http://<?=$_SERVER["SERVER_NAME"]?>/vendor/businessinformation/<?=$rid?>/photos/upload" method="post" class="dropzone">
                                                    <div id="file-submit" class="dropzone">
                                                        <input name="file" type="file" multiple>
                                                        <div class="dz-default dz-message"><span>Click or Drop Images Here</span></div>
                                                    </div>
                                                    </form>

                                                <form role="form" id="form-register" method="post" action="">
                                                <input type="hidden" name="infopage" value="photos">
                                                </form>
                                                </section>
                                                <section class="block" id="the-team">
                                                    <div class="container">
                                                        <header class="no-border"><h3>Your Photos</h3></header>
                                                        <div class="row">
                                                            <?php
                                                            $counter = 0;
                                                            foreach ($vendorphotos as $v) {
                                                                $counter += 1;
                                                                if ($counter == 5) {
                                                                    echo "</div><div class='row'>";
                                                                }
                                                                ?>
                                                                <div id="pic-<?=$v["id"]?>" class="col-md-3 col-sm-3">
                                                                    <div class="member">
                                                                        <img src="<?=$v["url"]?>" alt="">
                                                                        <figure><a href="#"  onClick="deletePhoto(<?=$v["id"]?>)">Delete</a></figure>
                                                                    </div>
                                                                    <!--/.member-->
                                                                </div>
                                                                <?php
                                                            }
                                                            ?>
                                                        </div>
                                                        <!--/.row-->
                                                    </div>
                                                    <!--/.container-->
                                                </section>  



                        </div>
                    </div>
                </section>
            </div>

            <script type="text/javascript">
            function deletePhoto(id) {
                var http = new XMLHttpRequest();
                var url = "http://"+"<?=$_SERVER['SERVER_NAME']?>/vendor/businessinformation/<?=$rid?>/photos";
                var params = "action=deletephoto&id="+id;
                http.open("POST", url, true);
                http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                http.onreadystatechange = function() {
                    if(http.readyState == 4 && http.status == 200) {
                        $("#pic-"+id).hide();
                    }
                }
                http.send(params);  
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
<script type="text/javascript" src="http://<?=$_SERVER['SERVER_NAME']?>/resources/js/dropzone.js"></script>
<script type="text/javascript" src="http://<?=$_SERVER['SERVER_NAME']?>/resources/js/jquery.ui.timepicker.js"></script>
<script type="text/javascript" src="http://<?=$_SERVER['SERVER_NAME']?>/resources/js/custom.js"></script> 