<div id="page-content">
                <section class="container">
                    <header>
                        <ul class="nav nav-pills">
                            <li><a href="http://<?=$_SERVER['SERVER_NAME']?>/vendor/"><h1 class="page-title">Manage Businesses</h1></a></li>
                            <li class="active"><a href="http://<?=$_SERVER['SERVER_NAME']?>/vendor/manageusers/"><h1 class="page-title">Add/Edit Vendor Users</h1></a></li>
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




                            <section class="container" >
                                <div class="block">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3" style="background-color: white;">
                                            <header>
                                                <h1 class="page-title">Claim Business</h1>
                                            </header>
                                            <hr>
                                            <?php 
                                            if ($problem == 7) { echo "<p>Please fill out all the forms.</p>"; }
                                            if ($problem == 6) { echo "<p>Your passwords did not match.</p>"; }
                                            ?>
                                            <form role="form" id="form-register" method="post" action="">
                                                <input type="hidden" name="action" value="postclaim">
                                                <input type="hidden" name="rid" value="<?=$rid?>">
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
                                                <div class="form-group clearfix">
                                                    <div class="g-recaptcha" data-sitekey="6Lc9jCcTAAAAABHgxi_WTPsP0UkHAdd0MM5QpBgG"></div>
                                                </div><!-- /.form-group -->
                                                <br><br>
                                                <div class="form-group clearfix">
                                                    <button type="submit" class="btn btn-default" id="account-submit">Claim Business</button>
                                                </div><!-- /.form-group -->
                                            </form>
                                            <hr>
                                            <div class="center">
                                                <figure class="note">By clicking the “Create an Account” button you agree with our Terms and conditions. You will not automatically be authorized to modify your listing until we confirm your identity. You may receive emails, a phone call to you and/or your business, and we may further request items to prove your identity. If you received an email to claim your listing you may automatically be confirmed.</figure>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>





                        
                        </div>
                    </div>
                </section>
            </div>