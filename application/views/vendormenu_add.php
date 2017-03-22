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
                                    <li class="active">
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
                                                <h1 class="page-title">Create Menu Items</h1>
                                            </header> 
                                            <form role="form" method="post" action="">
                                                <input type="hidden" name="action" value="add"> 
                                                <input type="hidden" name="group" value="group">
                                                <div class="form-group">
                                                    <label for="form-register-full-name">Add Category:</label>
                                                    <input type="text" class="form-control" name="name" required>
                                                </div><!-- /.form-group -->
                                                <div class="form-group clearfix">
                                                    <button type="submit" class="btn btn-default" id="account-submit">Create Category</button>
                                                </div><!-- /.form-group -->
                                            </form>
                                            <form role="form" method="post" action="">
                                                <input type="hidden" name="action" value="add"> 
                                                <input type="hidden" name="group" value="item">
                                                <div class="form-group">
                                                    <label for="form-register-full-name">Item Name:</label>
                                                    <input type="text" class="form-control" name="phone"  id="form-register-full-name" required>
                                                </div><!-- /.form-group -->
                                                <div class="form-group">
                                                    <label for="form-register-full-name">In Category</label>
                                                    <hr>
                                                    <?php
                                                        foreach ($res as $v) {
                                                            echo $v["name"].'<br><select name="master[]"><option selected>No Access</option><option value="'.$v["rid"].'-0">Access No Master Account</option><option value="'.$v["rid"].'-1">Access With Master Account</option></select><hr>';
                                                        }
                                                    ?>
                                                    
                                                </div>
                                                <br><br>
                                                <div class="form-group clearfix">
                                                    <button type="submit" class="btn btn-default" id="account-submit">Create User</button>
                                                </div><!-- /.form-group -->
                                            </form>
                                            <hr>
                                            <div class="center">
                                                <figure class="note">By clicking the “Create an Account” button you agree with our Terms and conditions. All permissions, access, and modifications made by the created account will be tied with this account.</figure>
                                            </div>

                        </div>
                    </div>
                </section>
            </div>