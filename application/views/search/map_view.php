<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Where's The Grub</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

        <!-- font awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

        <!-- custom styles -->
        <link rel="stylesheet" href="./resources/css/style.css">
        
        <!-- Lato Font -->
        <!-- <link href='https://fonts.googleapis.com/css?family=Lato:400,700,300' rel='stylesheet' type='text/css'> -->

        <!-- raleway -->
        <link href='https://fonts.googleapis.com/css?family=Raleway:400' rel='stylesheet' type='text/css'>
        <!-- montseratt -->
        <link href='https://fonts.googleapis.com/css?family=Montserrat:700' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="./resources/font-awesome/css/font-awesome.min.css" type="text/css">

        <!-- Plugin CSS -->
        <link rel="stylesheet" href="./resources/css/animate.min.css" type="text/css">

        <!-- Custom CSS -->
        <link rel="stylesheet" href="./resources/css/creative.css" type="text/css">
    </head>
    
    <body onload="initialize();">

        <nav class="navbar navbar-grub">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed navbar-right" data-toggle="collapse" data-target="#grubnav-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>    
                    <h1 class="grub-brand"><a href="#">Where's the grub</a><h1> 
                </div>

                <div class="collapse navbar-collapse" id="grubnav-collapse">
                    <ul class="grub-nav-options">
                        <li>
                            <div id="nav" class="searchbar-wrapper">
                                <i class="fa fa-search"></i>
                                <input class="searchbar-search" type="text" placeholder="Search for grub..."><input class="searchbar-search" type="text" placeholder="Your Location">
                                <input onClick="search();" class="searchbar-submit" type="submit" value="Search" style="display:inline;">
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="content-container">
            <div class="map-wrapper">
                <div id="map" class="map"></div>
            </div>
            
            <div class="results-wrapper">
                <div class="filter-wrapper"><br><br><br>
                    <h2>Filters <button id="btn-more-filters" class="btn btn-grub">More Filters</button>
                    <button id="btn-less-filters" class="btn btn-grub-alt hide">Less Filters</button></h2>

                        <div class="filter-options">
                            <select id="">
                                <option value="" disabled selected hidden>Food Cost ($$)</option>
                                <option value="$">Inexpensive</option>
                                <option value="$$">Moderate</option>
                                <option value="$$$">Pricey</option>
                                <option value="$$$$">Ultra High-End</option>
                            </select>
                        </div>
                        <div class="filter-options">
                            <label><input id="delivers" type="checkbox"> Delivers</label>
                            <label><input id="opennow" type="checkbox"> Open Now</label>
                            <label><input id="pickup" type="checkbox"> Order Pickup</label>
                        </div>
                        
                    <div class="more-filters" style="display:none">
            
                    <div class="filter-options">
                        <label><input id="wifi" type="checkbox"> Wifi</label>
                        <label><input id="vegie" type="checkbox"> Vegetarian</label>
                        <label><input id="kids" type="checkbox"> Children Friendly</label>
                        <label><input id="access" type="checkbox"> Wheelchair Access</label>
                        <label><input id="bar" type="checkbox"> Alcohol Bar</label>
                        <label><input id="reservations" type="checkbox"> Reservations</label>
                        <label><input id="24hr" type="checkbox"> Open 24 Hours</label>
                    </div><!-- second row of filters -->





                    </div> <!-- more filters -->

                    
                    <button onClick="search();" class="btn btn-grub">Search</button>
                </div>

                <div class="row2" id ="listcontainer">

                    <div class="col-sm-4 col-lg-6 col-md-4">
                        <div class="thumbnail">
                            <img src="http://placehold.it/320x150" alt="">
                            <div class="caption">
                                <h4 class="pull-right">$24.99</h4>
                                <h4><a href="#">First Product</a>
                                </h4>
                                <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
                            </div>
                            <div class="ratings">
                                <p class="pull-right">15 reviews</p>
                                <p>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-lg-6 col-md-4">
                        <div class="thumbnail">
                            <img src="http://placehold.it/320x150" alt="">
                            <div class="caption">
                                <h4 class="pull-right">$64.99</h4>
                                <h4><a href="#">Second Product</a>
                                </h4>
                                <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                            <div class="ratings">
                                <p class="pull-right">12 reviews</p>
                                <p>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star-empty"></span>
                                </p>
                            </div>
                        </div>
                    </div>

               </div><!--row -->
                
            </div>


        </div>

        


        <!-- google maps -->
        <script src="http://maps.google.com/maps/api/js?sensor=false&libraries=places" type="text/javascript"></script>
        <script>
            function initialize() {
                var mapOptions = {
                    center: new google.maps.LatLng(40.435833800555567, -78.44189453125),
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    zoom: 11
                };   
                var map = new google.maps.Map(document.getElementById("map"), mapOptions);
            };
        </script>
        <!-- jquery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="./resources/js/vendor/jquery-1.11.3.min.js"><\/script>')</script>
        <!-- bootstrap js-->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
        <!-- custom scripts -->
        <script src="./resources/js/main.js"></script>
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>

        </script>
    </body>
</html>