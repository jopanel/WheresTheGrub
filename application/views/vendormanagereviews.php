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
                                    <li>
                                        <a href="<?=base_url()?>vendor/managepromos/<?=$rid?>">
                                            <i class="fa fa-bolt"></i>
                                            <span>Promotions</span>
                                        </a>
                                    </li>
                                    <li class="active">
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
                                <h1 class="page-title">Manage Reviews</h1>
                            </header>
                            <p>
                            You can delete or respond to reviews. Reviews with a <i class="fa fa-user"></i> you may delete anytime. Reviews with a <i class="fa fa-check"></i> that does not have a green ribbon you can only delete <strong>once a month</strong>. After 30 days they become a request to delete. Reviews with a green ribbon you may request to delete.
                            </p>
                            <section id="items">
                            <?php foreach ($reviews as $k => $v) {
                                
                                if (!isset($v["level"]) || empty($v["level"])) { $q="in-queue";  $qi="user"; $v["level"] = "anon"; $lvl = 0; }
                                if (!isset($v["fullname"]) || empty($v["fullname"])) { $fullname = "Anonymous"; } else { $fullname = $v["fullname"]; }
                                if (!isset($v["avatar"]) || empty($v["avatar"])) { $v["avatar"] = "../../resources/img/default-avatar.png";}
                                if (isset($v["level"]) && $v["level"] == "notactive") { $q="in-queue"; $qi="check"; $lvl = 1;}
                                if (isset($v["level"]) && $v["level"] == "active") { $q="approved"; $qi="check"; $lvl = 2;}
                                $createdate = date("M j y\' \@ g:i a", strtotime($v["created"]));
                                if ($v["responded"] == 1) { $responded = "<li>YOU RESPONDED</li>"; $extracomm = "edit"; } else {$responded = ""; $extracomm = "comment"; }
                             ?>
                                <div class="item list admin-view" id="r-<?=$v["id"]?>">
                                    <div class="image"> 
                                            <img src="<?=$v["avatar"]?>" alt=""> 
                                    </div>
                                    <div class="wrapper">
                                        <a href="item-detail.html"><h3><?=$fullname?></h3></a>
                                        <figure><?=$v["review"]?></figure>
                                        <figure><?=$createdate?></figure>
                                        <div class="info"> 
                                            <div class="rating" data-rating="<?=$v["rating"]?>"></div>
                                        </div>
                                    </div>
                                    <div class="description">
                                        <ul class="list-unstyled actions">
                                            <?=$responded?>
                                            <li><a href="#" onClick="comment(<?=$v["id"]?>)"><i class="fa fa-<?=$extracomm?>"></i></a></li>
                                            <li><a href="#" onClick="request(<?=$v["id"]?>, <?=$lvl?>);"><i class="fa fa-trash"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="ribbon <?=$q?>">
                                        <i class="fa fa-<?=$qi?>"></i>
                                    </div>
                                </div>
                            <?php }  ?>
                            </section>




                        </div>
                    </div>
                </section>
            </div>
            <script>
            function remove(id) {
                var elem = document.getElementById(id);
                return elem.parentNode.removeChild(elem);
            }
            function comment(reviewd) {
                var ri = <?=$rid?>;
             $.ajax({
                    type: 'POST',
                    url: '<?=base_url()?>vendor/reviewresponse',
                    data: {rid:ri,reviewid:reviewd},
                    success: function (data) {
                        // Create HTML element with loaded data
                        $('body').append(data);
                    }
                });
            }

            function request(reviewid, action) { 
               if (action == 0) { action = "deleteReview"; }
               if (action == 1) { action = "deleteReview"; }
               if (action == 2) { action = "requestReviewDelete"; }
               var postData = { "reviewid": reviewid, "action": action };
                $.ajax({
                    type: 'POST',
                    url: '<?=base_url()?>vendor/managereviews/<?=$rid?>/'+action,
                    data: postData,
                    cache: false,
                    success: function (data) { 
                       if (data == true) { remove("r-"+reviewid); }
                    }
                });
            }
            
            function getXmlHttpObject() {
                var xmlHttp;
                try {
                    // Firefox, Opera 8.0+, Safari
                    xmlHttp = new XMLHttpRequest();
                } catch (e) {
                    // Internet Explorer
                    try {
                        xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
                    } catch (e) {
                        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                }
                if (!xmlHttp) {
                    showprompt("Your browser does not support AJAX!", "Hold Up");
                }
                return xmlHttp;
            }


            function ajax(url, postdata, onSuccess, onError) {
            
                var xmlHttp = getXmlHttpObject();
                
                xmlHttp.onreadystatechange = function() {
                    if (this.readyState === 4) {
                        
                        // onSuccess
                        if (this.status === 200 && typeof onSuccess == 'function') {
                            onSuccess(this.responseText);
                            
                        }
                        
                        // onError
                        else if(typeof onError == 'function') {
                            onError();
                        }
                        
                    }
                };
                xmlHttp.open("POST", url, true);
                xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlHttp.send(postdata);
                return xmlHttp;
            }

            </script>