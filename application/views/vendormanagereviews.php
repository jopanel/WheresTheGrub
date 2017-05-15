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
                                    <li>
                                        <a href="http://<?=$_SERVER["SERVER_NAME"]?>/vendor/managepromos/<?=$rid?>">
                                            <i class="fa fa-bolt"></i>
                                            <span>Promotions</span>
                                        </a>
                                    </li>
                                    <li class="active">
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

                            <section id="items">
                            <?php foreach ($reviews as $k => $v) {

                                if (!isset($v["avatar"]) || empty($v["avatar"])) { $v["avatar"] = "../../resources/img/default-avatar.png";}

                             ?>
                                <div class="item list admin-view">
                                    <div class="image"> 
                                            <img src="<?=$v["avatar"]?>" alt=""> 
                                    </div>
                                    <div class="wrapper">
                                        <a href="item-detail.html"><h3><?=$v["fullname"]?></h3></a>
                                        <figure><?=$v["review"]?></figure>
                                        <div class="info"> 
                                            <div class="rating" data-rating="<?=$v["rating"]?>"></div>
                                        </div>
                                    </div>
                                    <div class="description">
                                        <ul class="list-unstyled actions"> 
                                            <li><a href="#" class="hide-item"><i class="fa fa-eye"></i></a></li>
                                            <li><a href="#"><i class="fa fa-trash"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="ribbon in-queue">
                                        <i class="fa fa-check"></i>
                                    </div>
                                </div>
                            <?php }  ?>
                            </section>




                        </div>
                    </div>
                </section>
            </div>