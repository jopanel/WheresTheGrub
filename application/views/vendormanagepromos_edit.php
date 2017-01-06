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


                                            <header>
                                                <h1 class="page-title">Create User Account</h1>
                                            </header> 
                                            <?php  
                                            if ($problem == 3) { echo "<p>Please fill out email field.";}
                                            if ($problem == 4) { echo "<p>Please fill out the contact persons full name.</p>"; }
                                            if ($problem == 5) { echo "<p>Internal server error. We apologise for this problem, if it persists please contact support."; }
                                            if ($problem == 6) { echo "<p>This email already exists in our database. Please use another."; }
                                            if ($problem == 7) { echo "<p>Passwords do not match.</p>"; }
                                            if ($problem == 8) { echo "<p>Please add a phone number for us to keep in contact with your company or the person."; }
                                            if ($problem == 9) { echo "<p>Active account not specified.</p>"; }
                                            if ($problem == 1) { echo "<p>Passwords do not match</p>"; }
                                            ?>
                                            <form role="form" id="form-register" method="post" action="">
                                                <input type="hidden" name="action" value="postclaim"> 
                                                <div class="form-group">
                                                    <label for="form-register-full-name">Contact Full Name:</label>
                                                    <input type="text" class="form-control" name="fullname" value="<?=$userinfo[0]["fullname"];?>"  id="form-register-full-name" required>
                                                </div><!-- /.form-group -->
                                                <div class="form-group">
                                                    <label for="form-register-full-name">Contact Phone:</label>
                                                    <input type="text" class="form-control" name="phone"  id="form-register-full-name" value="<?=$userinfo[0]["phone"];?>" required>
                                                </div><!-- /.form-group -->
                                                <div class="form-group">
                                                    <label for="form-register-email">Email:</label>
                                                    <input type="email" class="form-control"  name="email" value="<?=$userinfo[0]["email"];?>" id="form-register-email" required>
                                                </div><!-- /.form-group -->
                                                <div class="form-group">
                                                    <label for="form-register-password">New Password:</label>
                                                    <input type="password" class="form-control" name="password"  id="form-register-password">
                                                </div><!-- /.form-group -->
                                                <div class="form-group">
                                                    <label for="form-register-confirm-password">Confirm New Password:</label>
                                                    <input type="password" class="form-control" name="password2"  id="form-register-confirm-password">
                                                </div><!-- /.form-group --> 
                                                <div class="form-group">
                                                    <label for="form-register-full-name">Business Access:</label>
                                                    <hr>
                                                    <?php
                                                        foreach ($res as $v) {
                                                            $add = "";
                                                            foreach ($userperm as $vv) {
                                                                if ($vv["rid"] == $v["rid"]) {
                                                                    if ($vv["master"] == 1) {
                                                                        $add = '<option selected value="'.$v["rid"].'-1">Access With Master Account</option>';
                                                                    } else {
                                                                        $add = '<option selected value="'.$v["rid"].'-0">Access No Master Account</option>';
                                                                    }
                                                                }
                                                            }
                                                            echo $v["name"].'<br><select name="master[]">'.$add.'<option value="'.$v["rid"].'-0">Access No Master Account</option><option value="'.$v["rid"].'-1">Access With Master Account</option><option value="'.$v["rid"].'-00">No Access</select><hr>';
                                                        }
                                                    ?>
                                                    
                                                </div>
                                                <br><br>
                                                <div class="form-group clearfix">
                                                    <button type="submit" class="btn btn-default" id="account-submit">Update User Information</button>
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