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
                                        <a href="<?=base_url()?>vendor/managebusiness/<?=$rid?>">
                                            <i class="fa fa-info"></i>
                                            <span>Overview</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=base_url()?>vendor/businessinformation/<?=$rid?>">
                                            <i class="fa fa-edit"></i>
                                            <span>Information</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=base_url()?>vendor/managemenu/<?=$rid?>">
                                            <i class="fa fa-align-justify"></i>
                                            <span>Menu</span>
                                        </a>
                                    </li>
                                    <li class="active">
                                        <a href="<?=base_url()?>vendor/managepromos/<?=$rid?>">
                                            <i class="fa fa-bolt"></i>
                                            <span>Promotions</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=base_url()?>vendor/managereviews/<?=$rid?>">
                                            <i class="fa fa-bullhorn"></i>
                                            <span>Reviews</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=base_url()?>vendor/ppc/<?=$rid?>">
                                            <i class="fa fa-dollar"></i>
                                            <span>Adwords</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=base_url()?>vendor/reports/<?=$rid?>">
                                            <i class="fa fa-bar-chart"></i>
                                            <span>Business Reports</span>
                                        </a>
                                    </li>
                                </ul>
                            </aside>
                        </div>
                        <div class="col-md-9 col-sm-9">



                            <div class="container">
                                <header class="no-border"><a href="<?=base_url()?>vendor/managepromos/<?=$rid?>/add"><h3>Add New Promotion/Coupon</h3></a></header>
                                <?php
                                $count = 0;
                                foreach ($promos as $k => $v) {
                                    if ($v["id"] > 0) {
                                       $count += 1;
                                        if ($count == 1) { echo '<div class="row">'; }
                                        if ($count == 4) { echo '</div><div class="row">'; $count = 1; }
                                        echo '<div class="row">
                                                <div class="col-md-3 col-sm-3">
                                                    <div class="member">
                                                        <h4>'.$v["subject"].'</h4>
                                                        <p>Starting: '.$v["starting"].' - Ending: '.$v["ending"].' 
                                                        <br>
                                                        <div class="social">
                                                            <a href="'.base_url().'vendor/managepromos/'.$rid.'/edit/'.$v["id"].'" >Edit</a> 
                                                            - 
                                                            <a href="'.base_url().'vendor/managepromos/'.$rid.'/delete/'.$v["id"].'" >Delete</a>
                                                        </div>
                                                    </div>
                                                    <!--/.member-->
                                                </div>
                                            </div>'; 
                                    }
                                    
                                }
                                if ($count > 0) { echo '</div>'; }
                                ?>
                            </div>



                        </div>
                    </div>
                </section>
            </div>