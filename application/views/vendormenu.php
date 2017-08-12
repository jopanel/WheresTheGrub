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
                                    <li class="active">
                                        <a href="<?=base_url()?>vendor/managemenu/<?=$rid?>">
                                            <i class="fa fa-align-justify"></i>
                                            <span>Menu</span>
                                        </a>
                                    </li>
                                    <li>
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
                            <header class="no-border"><a href="<?=base_url()?>vendor/managemenu/<?=$rid?>/add"><h3>Add Menu Item</h3></a></header>

                            <?php
                            
                            //echo "<pre>";
                            //var_dump($getmenu);
                            //echo "</pre>";
                            
                            //echo (count($getmenu));
                            foreach ($getmenu as $v) {

                                if (count($v["items"]) > 0) {
                                    ?>
                                            <article class="block">
                                                    <header><h2><?=$v["name"]?></h2></header>
                                                        <div class="slide">
                                    <?php

                                    foreach ($v["items"] as $vv) {
                                        if ((float)$vv["cost"] < 0) { $vv["cost"] = ""; } else { $vv["cost"] = "$".$vv["cost"];}
                                        ?>
                                                <div class="list-item">
                                                    <div class="left">
                                                        <h4><?=$vv["name"]?> <?=$vv["cost"]?></h4>
                                                        <figure><?=$vv["description"]?></figure>
                                                    </div>
                                                    <div class="right">

                                                        <a href="<?=base_url()?>vendor/managemenu/<?=$rid?>/edit/<?=$vv["id"]?>"><button class="btn btn-default">Modify</button></a> 

                                                        <form role="form" method="post" action="" style="display: inline;">
                                                            <input type="hidden" name="action" value="delete"> 
                                                            <input type="hidden" name="type" value="item">
                                                            <input type="hidden" name="id" value="<?=$vv["id"]?>">
                                                            <button class="btn btn-default">X</button></a></div>
                                                        </form>
                                                    </div>
                                                    <hr>
                                                </div>
                                                        
                                        <?php
                                    }

                                    echo "</div></article>";

                                } else {
                                    // insert ability to delete item group
                                    ?>
                                            <article class="block">
                                                    <header><h2>
                                                        <form role="form" method="post" action="">
                                                            <input type="hidden" name="action" value="delete"> 
                                                            <input type="hidden" name="type" value="group">
                                                            <input type="hidden" name="id" value="<?=$v["id"]?>">
                                                            <?=$v["name"]?>
                                                            <button class="btn btn-default">X</button></a>
                                                        </form>
                                                    </h2> </header>
                                            </article>
                                    <?php
                                }
                            }
                            ?>

                        </div>
                    </div>
                </section>
            </div>