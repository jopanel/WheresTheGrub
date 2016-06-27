<!--Page Content-->
         
                <!--Hero Image-->
                <section class="hero-image search-filter-middle height-500">
                    <div class="inner">
                        <div class="container">
                            <h1>Type in your location and we will help you find food.</h1>
                            <div class="search-bar horizontal">
                                <form class="main-search border-less-inputs background-dark narrow" role="form" method="post" action="?">
                                    <div class="input-row">
                                        <div class="form-group">
                                            <label for="keyword">Food</label>
                                            <input type="text" class="form-control" id="keyword" placeholder="Maybe Pizza? BBQ? Sushi? more">
                                        </div>
                                        <div class="form-group">
                                            <label for="location">Location</label>
                                            <div class="input-group location">
                                                <input type="text" class="form-control" id="location" value="<?=$this->session->userdata("userdata_city")?>, <?=$this->session->userdata("userdata_state_name")?> <?=$this->session->userdata("zipcode")?>" placeholder="Enter Location">
                                            </div>
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>

                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                </form>
                                <!-- /.main-search -->
                            </div>
                            <!-- /.search-bar -->
                        </div>
                    </div>
                    <div class="background">
                        <img src="http://<?=$_SERVER['SERVER_NAME']?>/resources/img/restaurant-bg.jpg" alt="">
                    </div>
                </section>
                <!--end Hero Image-->
