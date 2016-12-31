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
                            
                            <div class="container">
                        <header class="no-border"><a href="#"><h3>Add New User</h3></a></header>
                        <div class="row">
                            <div class="col-md-3 col-sm-3">
                                <div class="member">
                                    <h4>Jane Daubert</h4> 
                                    <br>
                                    <div class="social">
                                        <a href="#" >Edit</a> 
                                        - 
                                        <a href="#" >Delete</a>
                                    </div>
                                </div>
                                <!--/.member-->
                            </div>
                            
                        </div>
                        <!--/.row-->
                    </div>

                        </div>
                    </div>
                </section>
            </div>