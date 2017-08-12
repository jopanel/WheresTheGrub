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

                                            <header>
                                                <h1 class="page-title">Create Menu Items</h1>
                                            </header> 
                                            <form role="form" method="post" action="">
                                                <input type="hidden" name="action" value="add"> 
                                                <input type="hidden" name="type" value="group">
                                                <div class="form-group">
                                                    <label>Add Category:</label>
                                                    <input type="text" class="form-control" name="name" required>
                                                </div><!-- /.form-group -->
                                                <div class="form-group clearfix">
                                                    <button type="submit" class="btn btn-default">Create Category</button>
                                                </div><!-- /.form-group -->
                                            </form>
                                            <?php 

                                            if (count($groups) > 0) { ?>
                                            <form role="form" method="post" action="">
                                                <input type="hidden" name="action" value="add"> 
                                                <input type="hidden" name="type" value="item">
                                                <div class="form-group">
                                                    <label>Item Name:</label>
                                                    <input type="text" class="form-control" name="name" required>
                                                </div><!-- /.form-group -->
                                                <div class="form-group">    
                                                    <label>Cost <i>(-1 to hide cost)</i></label>
                                                    <input type="text" class="form-control" name="cost" value="-1" required>
                                                </div><!-- /.form-group -->
                                                <div class="form-group">
                                                    <label>Description:</label>
                                                    <textarea class="form-control" name="description"></textarea>
                                                </div><!-- /.form-group -->
                                                <div class="form-group">
                                                    <label>In Category</label>
                                                    <hr>
                                                    <select class="form-control" name="groupid" required>
                                                    <?php
                                                        foreach ($groups as $v) {
                                                            echo "<option value='".$v["id"]."'>".$v["name"]."</option>";
                                                        }
                                                    ?>
                                                    </select>
                                                </div>
                                                <br><br>
                                                <div class="form-group clearfix">
                                                    <button type="submit" class="btn btn-default">Create Item</button>
                                                </div><!-- /.form-group -->
                                            </form>
                                            <?php }
                                            ?>

                        </div>
                    </div>
                </section>
            </div>