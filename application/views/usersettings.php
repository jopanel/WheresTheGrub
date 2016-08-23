<!--Page Content-->
            <div id="page-content">
                <section class="container">
                    <header>
                        <ul class="nav nav-pills">
                            <li><a href="<?=$_SERVER['SERVER_NAME']?>/user/feed"><h1 class="page-title">My Feed</h1></a></li>
                            <li><a href="<?=$_SERVER['SERVER_NAME']?>/user/following"><h1 class="page-title">Following</h1></a></li>
                            <li><a href="<?=$_SERVER['SERVER_NAME']?>/user/reviews"><h1 class="page-title">My Reviews</h1></a></li>
                            <li><a href="<?=$_SERVER['SERVER_NAME']?>/user/"><h1 class="page-title">My Profile</h1></a></li>
                            <li class="active"><a href="<?=$_SERVER['SERVER_NAME']?>/user/profile"><h1 class="page-title">Settings</h1></a></li>
                        </ul>
                    </header>
                    <div class="row">
                        <div class="col-md-9">
                            <form id="form-profile" role="form" method="post" action="?" enctype="multipart/form-data">
                                <div class="row">
                                    <!--Profile Picture-->
                                    <div class="col-md-3 col-sm-3">
                                        <section>
                                            <h3><i class="fa fa-image"></i>Profile Picture</h3>
                                            <div id="profile-picture" class="profile-picture dropzone">
                                                <input name="file" type="file">
                                                <div class="dz-default dz-message"><span>Click or drop picture here</span></div>
                                                <img src="assets/img/member-2.jpg" alt="">
                                            </div>
                                        </section>
                                    </div>
                                    <!--/.col-md-3-->

                                    <!--Contact Info-->
                                    <div class="col-md-9 col-sm-9">
                                        <section>
                                            <h3><i class="fa fa-user"></i>Personal Info</h3>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" class="form-control" id="name" name="name" value="John Doe">
                                                    </div>
                                                    <!--/.form-group-->
                                                </div>
                                                <!--/.col-md-3-->
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email" class="form-control" id="email" name="email" value="johndoe@example.com">
                                                    </div>
                                                    <!--/.form-group-->
                                                </div>
                                                <!--/.col-md-3-->
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="mobile">Mobile</label>
                                                        <input type="text" class="form-control" id="mobile" name="mobile" pattern="\d*" value="903-675-5323">
                                                    </div>
                                                    <!--/.form-group-->
                                                </div>
                                                <!--/.col-md-3-->
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="phone">Phone</label>
                                                        <input type="text" class="form-control" id="phone" name="phone" pattern="\d*" value="(0)123 456 7890">
                                                    </div>
                                                    <!--/.form-group-->
                                                </div>
                                                <!--/.col-md-3-->
                                            </div>
                                        </section>
                                        <section>
                                            <h3><i class="fa fa-map-marker"></i>Address</h3>
                                            <div class="form-group">
                                                <label for="state">State</label>
                                                <input type="text" class="form-control" id="state" name="state" value="Ohio">
                                            </div>
                                            <!--/.form-group-->
                                            <div class="form-group">
                                                <label for="city">City</label>
                                                <input type="text" class="form-control" id="city" name="city" value="Georgetown">
                                            </div>
                                            <!--/.form-group-->
                                            <div class="row">
                                                <div class="col-md-8 col-sm-8">
                                                    <div class="form-group">
                                                        <label for="street">Street</label>
                                                        <input type="text" class="form-control" id="street" name="street" value="2050 Sampson Street">
                                                    </div>
                                                    <!--/.form-group-->
                                                </div>
                                                <!--/.col-md-8-->
                                                <div class="col-md-4 col-sm-4">
                                                    <div class="form-group">
                                                        <label for="zip">ZIP</label>
                                                        <input type="text" class="form-control" id="zip" name="zip" pattern="\d*" value="80444">
                                                    </div>
                                                    <!--/.form-group-->
                                                </div>
                                            </div>
                                            <!--/.col-md-3-->
                                            <div class="form-group">
                                                <label for="additional-address">Additional Address Line</label>
                                                <input type="text" class="form-control" id="additional-address" name="additional-address">
                                            </div>
                                            <!--/.form-group-->
                                        </section>
                                        <section>
                                            <h3><i class="fa fa-info-circle"></i>About Me</h3>
                                            <div class="form-group">
                                                <label for="about-me">Some Words About Me</label>
                                                <div class="form-group">
                                                    <textarea class="form-control" id="about-me" rows="3" name="about-me" required></textarea>
                                                </div>
                                                <!--/.form-group-->
                                            </div>
                                            <!--/.form-group-->
                                        </section>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-large btn-default" id="submit">Save Changes</button>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!--/.col-md-6-->
                                </div>
                            </form>
                        </div>
                        <!--Password-->
                        <div class="col-md-3 col-sm-9">
                            <h3><i class="fa fa-asterisk"></i>Password Change</h3>
                            <form class="framed" id="form-password" role="form" method="post" action="?" >
                                <div class="form-group">
                                    <label for="current-password">Current Password</label>
                                    <input type="password" class="form-control" id="current-password" name="current-password">
                                </div>
                                <!--/.form-group-->
                                <div class="form-group">
                                    <label for="new-password">New Password</label>
                                    <input type="password" class="form-control" id="new-password" name="new-password">
                                </div>
                                <!--/.form-group-->
                                <div class="form-group">
                                    <label for="confirm-new-password">Confirm New Password</label>
                                    <input type="password" class="form-control" id="confirm-new-password" name="confirm-new-password">
                                </div>
                                <!--/.form-group-->
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default">Change Password</button>
                                </div>
                                <!-- /.form-group -->
                            </form>
                        </div>
                        <!-- /.col-md-3-->
                    </div>
                </section>
            </div>
            <!-- end Page Content-->