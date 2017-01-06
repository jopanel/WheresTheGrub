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
                                        <a href="">
                                            <i class="fa fa-user-md"></i>
                                            <span>Welcome, <?=$this->session->userdata("fullname")?></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <i class="fa fa-gear"></i>
                                            <span>Modify My Account</span>
                                        </a>
                                    </li>
                                </ul>
                            </aside>
                        </div>
                        <div class="col-md-9 col-sm-9">


                                            <header>
                                                <h1 class="page-title">Create New Promotion/Coupon</h1>
                                            </header> 
                                            <?php 
                                            if ($problem == 3) { echo "<p>Please fill out both password fields.";}
                                            if ($problem == 4) { echo "<p>Please fill out email field.</p>"; }
                                            if ($problem == 5) { echo "<p>Please fill out the contact persons full name."; }
                                            if ($problem == 6) { echo "<p>Please assign this user specific access to business."; }
                                            if ($problem == 7) { echo "<p>This email is already assigned to a user.</p>"; }
                                            if ($problem == 2) { echo "<p>Your passwords did not match.</p>"; }
                                            ?>
                                            <form role="form" id="form-register" method="post" action="">
                                                <input type="hidden" name="action" value="postclaim"> 
                                                <div class="form-group">
                                                    <label for="form-register-full-name">Contact Full Name:</label>
                                                    <input type="text" class="form-control" name="fullname"  id="form-register-full-name" required>
                                                </div><!-- /.form-group -->
                                                <div class="form-group">
                                                    <label for="form-register-full-name">Contact Phone:</label>
                                                    <input type="text" class="form-control" name="phone"  id="form-register-full-name" required>
                                                </div><!-- /.form-group -->
                                                <div class="form-group">
                                                    <label for="form-register-email">Email:</label>
                                                    <input type="email" class="form-control"  name="email" id="form-register-email" required>
                                                </div><!-- /.form-group -->
                                                <div class="form-group">
                                                    <label for="form-register-password">Password:</label>
                                                    <input type="password" class="form-control" name="password"  id="form-register-password" required>
                                                </div><!-- /.form-group -->
                                                <div class="form-group">
                                                    <label for="form-register-confirm-password">Confirm Password:</label>
                                                    <input type="password" class="form-control" name="password2"  id="form-register-confirm-password" required>
                                                </div><!-- /.form-group --> 
                                                <div class="form-group">
                                                    <label for="form-register-full-name">Business Access:</label>
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