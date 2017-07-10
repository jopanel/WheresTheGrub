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
                                    <li>
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
                                    <li class="active">
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



                            <div class="container">
                                <header class="no-border"><h3>Create Promotion</h3></header>
                                    <form role="form" method="post" action="">
                                        <input type="hidden" name="action" value="add"> 
                                        <input type="hidden" name="type" value="item">
                                        <div class="form-group">
                                            <label>Promotion Name:</label>
                                            <input type="text" class="form-control" name="subject" required>
                                        </div><!-- /.form-group -->
                                        <div class="form-group">    
                                            <label>Cost Without Sale <i>(-1 to hide cost)</i></label>
                                            <input type="text" class="form-control" name="cost" value="-1" required>
                                        </div><!-- /.form-group -->
                                        <div class="form-group">    
                                            <label>Discount Cost<i>(-1 to hide cost)</i></label>
                                            <input type="text" class="form-control" name="cost" value="-1" required>
                                        </div><!-- /.form-group -->
                                        <div class="form-group">    
                                            <label>Total Vouchers<i>(0 for unlimited)</i></label>
                                            <input type="text" class="form-control" name="numvouchers" value="0" required>
                                        </div><!-- /.form-group -->
                                        <div class="form-group">
                                            <label>Promotion Information:</label>
                                            <textarea class="form-control" name="body"></textarea>
                                        </div><!-- /.form-group --> 
                                        <br><br>
                                        <div class="form-group clearfix">
                                            <button type="submit" class="btn btn-default">Create Promotion</button>
                                        </div><!-- /.form-group -->
                                    </form>
                            </div>



                        </div>
                    </div>
                </section>
            </div>