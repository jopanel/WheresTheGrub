<?php

/////security must be updated!!!!!!!!!!!!!!!!!
$count="red";
$db="off";
$status=0;
$included_files = get_included_files();

foreach ($included_files as $filename) {
$arrcook[] = $filename;
} 

    if (in_array("/home/wheresthegrub/public_html/admin/_settings.php", $arrcook)) {
    $db="on";
    $status+=1;
} else {
	echo "There was an error! Possible malicious activity detected. This has been reported.<br>";
}
    if (in_array("/home/wheresthegrub/public_html/admin/index.php", $arrcook)) {
    	$status+=1;
} else {
	echo "There was a problem executing our configuration.";
	if ($db=="off") {} else {
		$ip=getRealIpAddr(); 
		echo "There was an error! Possible malicious activity detected. This has been reported.<br>";
exit();
	}
}
    if (in_array("/home/wheresthegrub/public_html/admin/_inc.php", $arrcook)) {
    	$status+=1;
} else {
	echo "There was a problem executing our configuration.";
	if ($db=="off") {} else {
		$ip=getRealIpAddr(); 
		echo "There was an error! Possible malicious activity detected. This has been reported.<br>";
exit();
	}
}
if ($status==3) {
	$count="green";
}
if ($count=="green") {
	///fuck yea!
} else {
exit();
}

if (!isset($_GET['z']) || empty($_GET['z'])) { $page = "dashboard"; } else {$page = $_GET['z'];}
if ($page=="") {

}

if ($page=="dashboard") {
  $leads = 0;
  $sql = "SELECT * FROM `leads`";
  $result = mysql_query($sql) or die(mysql_error());
  while ($row = mysql_fetch_array($result)) {
$leads += 1;
  }

  $contactedleads=0;
$sql222 = "select * from `vendors`";
    $result222 = mysql_query($sql222) or die(mysql_error());
    while($row222 = mysql_fetch_array($result222)){ 
    $contactedleads+=1; 
  }

  $activevendors = 0;
  $sql2 = "SELECT * FROM `vendors` WHERE `active` = '1'";
  $result2 = mysql_query($sql2) or die(mysql_error());
  while ($row2 = mysql_fetch_array($result2)) {
    $activevendors += 1;
  }
   $badleads = 0;
  $sql3 = "SELECT * FROM `leads` WHERE `dnc` = '1'";
  $result3 = mysql_query($sql3) or die(mysql_error());
  while ($row3 = mysql_fetch_array($result3)) {
    $badleads += 1;
  }
  $orders=0;
  $sql4 = "SELECT * FROM `invoices`";
  $result4 = mysql_query($sql4) or die(mysql_error());
  while ($row4 = mysql_fetch_array($result4)) {
$orders+=1;
  }
  $itemssold = 0;
  $sql5 = "SELECT * FROM `invoice_items`";
  $result5 = mysql_query($sql5) or die(mysql_error());
  while ($row5 = mysql_fetch_array($result5)) {
    $itemssold += 1;
  }
$potentialleads = $leads - $contactedleads;
$ptleads1 = $contactedleads / $leads;
$percentpotentialleads = $ptleads1 * 100;
	?>
	<section class="panel panel-default">
                <header class="panel-heading font-bold">PSV Performance</header>
                <footer class="panel-footer bg-white">
                  <div class="row text-center no-gutter">
                    <div class="col-xs-3 b-r b-light">
                      <p class="h3 font-bold m-t"><?php echo $leads; ?></p>
                      <p class="text-muted">Leads</p>
                    </div>
                    <div class="col-xs-3 b-r b-light">
                      <p class="h3 font-bold m-t"><?php echo $contactedleads; ?></p>
                      <p class="text-muted">Contacted Leads</p>
                    </div>
                    <div class="col-xs-3 b-r b-light">
                      <p class="h3 font-bold m-t"><?php echo $activevendors; ?></p>
                      <p class="text-muted">Active Vendors</p>
                    </div>
                    <div class="col-xs-3">
                      <p class="h3 font-bold m-t"><?php echo $badleads; ?></p>
                      <p class="text-muted">Bad Leads</p>                        
                    </div>
                  </div>
                </footer>
              </section>
              	<section class="panel panel-default">
                <header class="panel-heading font-bold">PSV Sales</header>
                <footer class="panel-footer bg-white">
                  <div class="row text-center no-gutter">
                    <div class="col-xs-3 b-r b-light">
                      <p class="h3 font-bold m-t"><?php echo $orders; ?></p>
                      <p class="text-muted">Orders</p>
                    </div>
                    <div class="col-xs-3 b-r b-light">
                      <p class="h3 font-bold m-t"><?php echo $itemssold; ?></p>
                      <p class="text-muted">Items Sold</p>
                    </div>
                    <div class="col-xs-3 b-r b-light">
                      <p class="h3 font-bold m-t">X</p>
                      <p class="text-muted">Profit</p>
                    </div>
                    <div class="col-xs-3">
                      <p class="h3 font-bold m-t">X</p>
                      <p class="text-muted">Overhead</p>                        
                    </div>
                  </div>
                </footer>
              </section>

                <div class="col-lg-3">
                  <section class="panel panel-default">
                    <header class="panel-heading">
                    Sales to Total Leads
                    </header>
                    <div class="panel-body text-center">
                      <h4><?php echo $potentialleads; ?></h4>
                      <small class="text-muted block">all potential leads</small>
                      <div class="inline">
                        <div class="easypiechart" data-percent="<?php echo $percentpotentialleads; ?>" data-line-width="30" data-track-color="#eee" data-bar-color="#afcf6f" data-scale-color="#fff" data-size="188" data-line-cap='butt'>
                          <span class="h2 step"><?php echo $percentpotentialleads; ?></span>%
                          <div class="easypie-text">sales to leads</div>
                        </div>
                      </div>                      
                    </div>
                    <div class="panel-footer"><small>% total sales to potential leads</small></div>
                  </section>
                </div>
                <div class="col-lg-3">
                  <section class="panel panel-default">
                    <header class="panel-heading">
                    Sales to Total Vendors
                    </header>
                    <div class="panel-body text-center">
                      <h4>3,450</h4>
                      <small class="text-muted block">all contacted leads</small>
                      <div class="inline">
                        <div class="easypiechart" data-percent="<?php echo $percentpotentialleads; ?>" data-line-width="30" data-track-color="#eee" data-bar-color="#afcf6f" data-scale-color="#fff" data-size="188" data-line-cap='butt'>
                          <span class="h2 step"></span>%
                          <div class="easypie-text">sales to vendors</div>
                        </div>
                      </div>                      
                    </div>
                    <div class="panel-footer"><small>% of sales to contacted vendors</small></div>
                  </section>
                </div>
                <div class="col-sm-3">                  
                      <section class="panel panel-default">
                      	<ul class="list-group no-radius">
                          <li class="list-group-item">
                            <span class="pull-right"><?php echo $leads; ?></span>
                            <span class="label bg-primary">1</span>
                            leads
                          </li>
                          <li class="list-group-item">
                            <span class="pull-right"><?php echo $activevendors; ?></span>
                            <span class="label bg-dark">2</span>
                            active vendors
                          </li>
                          <li class="list-group-item">
                            <span class="pull-right"><?php echo $orders; ?></span>
                            <span class="label bg-light">3</span>
                            sales
                          </li>
                        </ul>
                        <div class="text-center wrapper bg-light lt">
                          <div class="sparkline inline" data-type="pie" data-height="165" data-slice-colors="['#77c587','#41586e','#f2f2f2']"><?php echo $leads; ?>,<?php echo $activevendors; ?>,<?php echo $orders; ?></div>
                        </div>
                    <div class="panel-footer"><small>all leads, all vendors, all sales</small></div>
                      </section>
                    </div>
	<?php
}
if ($page == "vendors") {
  if (!isset($_GET['id']) || empty($_GET['id'])) {
    $num_per_page = 500;
  if (isset($_GET['i'])) {$i = $_GET['i']; } else {$i = 1; }
    if (!isset($_GET['kid']) || empty($_GET['kid'])) {$add = ""; $add2=""; } else {$add = " WHERE `kid`='".$_GET['kid']."'"; $add2= "&kid=".$_GET['kid']."";}
  if (!isset($_POST['keyword']) || empty($_POST['keyword'])) {$add = ""; $add2=""; } else {$add = " WHERE `kid`='".$_POST['keyword']."'"; $add2= "&kid=".$_POST['keyword']."";}
  $start_from = ($i-1) * $num_per_page;
  $vendors = [];
$totalvendors = 0;
  $sql = "SELECT * FROM `vendors`$add ORDER BY `id` ASC LIMIT $start_from, $num_per_page";
  $result = mysql_query($sql) or die(mysql_error());
  while ($row = mysql_fetch_array($result)) {
    $totalvendors += 1;
    $vid = $row['id'];
    $lid = $row['lid'];
    $accManager = $row['accManager'];
    $status = $row['status'];
    $active = $row['active'];
    // get vendor info
    $sql2 = "SELECT * FROM `vendors_info` WHERE `vid`='$vid'";
    $result2 = mysql_query($sql2) or die(mysql_error());
    while ($row2 = mysql_fetch_array($result2)) {
      $name = $row2['name'];
      $address = $row2['address'];
      $phone = $row2['phone'];
    }
    // get acc manager info
    $sql3 = "SELECT * FROM `users` WHERE `id`='$accManager'";
    $result3 = mysql_query($sql3) or die(mysql_error());
    while ($row3 = mysql_fetch_array($result3)) {
      $creator = $row3['username'];
    }
    // define what status means
    if ($status == "") {}
      //
$vendors[] = array($vid,$lid,$name,$phone,$address,$creator,$active,$status);
  } // end vendors queruy
  ?>
  <section class="panel panel-default">
                <header class="panel-heading">
                  Vendors
                </header>
                <div class="row text-sm wrapper">
                  <div class="col-sm-5 m-b-xs">
                    <select class="input-sm form-control input-s-sm inline">
                      <option value="0">Bulk action</option>
                      <option value="1">Delete selected</option>
                      <option value="2">Bulk edit</option>
                      <option value="3">Export</option>
                    </select>
                    <button class="btn btn-sm btn-default">Apply</button>                
                  </div>
                  <div class="col-sm-3">
                    <div class="input-group">
                      <input type="text" class="input-sm form-control" placeholder="Search">
                      <span class="input-group-btn">
                        <button class="btn btn-sm btn-default" type="button">Go!</button>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table table-striped b-t b-light text-sm">
                    <thead>
                      <tr>
                        <th width="20"><input type="checkbox"></th>
                        <th class="th-sortable" data-toggle="class">ID
                          <span class="th-sort">
                            <i class="fa fa-sort-down text"></i>
                            <i class="fa fa-sort-up text-active"></i>
                            <i class="fa fa-sort"></i>
                          </span>
                        </th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Account Manager</th>
                        <th>Status</th>
                        <th>Active</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($vendors as $value) {
                        ?>
                        <tr>
                        <td><input type="checkbox" name="post[]" value="<?php echo $value[0]; ?>"></td>
                        <td><?php echo $value[0]; ?></td>
                        <td><?php echo $value[2]; ?></td>
                        <td><?php echo $value[3]; ?></td>
                        <td><?php echo $value[4]; ?></td>
                        <td><?php echo $value[5]; ?></td>
                        <td><?php echo $value[7]; ?></td>
                        <td><?php echo $value[6]; ?></td>
                        <td>
                          <a href="?page=accountmanager&z=vendors&id=<?php echo $value[0]; ?>">Open Vendor</a>
                        </td>
                      </tr>
                        <?php
                      }
                      ?>
                      
                     
                    </tbody>
                  </table>
                </div>
                <footer class="panel-footer">
                  <div class="row">
                    <?php 
            $sqr = "SELECT * FROM `vendors`";
                        $rs_result = mysql_query($sqr);
                        $total_records = mysql_num_rows($rs_result);
                        $total_pages = ceil($total_records / $num_per_page);
                    ?>
                    <div class="col-sm-4 text-center">
                      <small class="text-muted inline m-t-sm m-b-sm">showing <?php echo $totalvendors; ?>-<?php echo $total_records; ?> of <?php echo $total_records; ?> vendors</small>
                    </div>
                    <div class="col-sm-4 text-right text-center-xs">                
                      <ul class="pagination pagination-sm m-t-none m-b-none">
                        <?php 
                        
                        if ($total_pages > 0) {
                        echo "<li><a href='?page=accountmanager&z=vendors&i=1'><i class='fa fa-chevron-left'></i></a></li>";
                      }
                       for ($r=1; $r<=$total_pages; $r++) {
                        echo "<li><a href='?page=accountmanager&z=vendors&i=".$r."'>".$r."</a></li>";
                       }
                      if ($total_pages > 0) {
                        echo "<li><a href='?page=accountmanager&z=vendors&i=".$total_pages."'><i class='fa fa-chevron-right'></i></a></li>";
                    }
                        ?>
                      </ul>
                    </div>
                  </div>
                </footer>
              </section>
  <?php
} else {
// start profile of vendor
$id = $_GET['id'];
  if (!isset($_GET['action']) || empty($_GET['action'])) {$action = "nothing";} else {$action = $_GET['action'];}
// if there is no "Action" then the ID is the vendor id and not the Lead ID
if ($action == "nothing") {
  echo "Okay";
} // end of nothing page


// start page comes after leads page so the ID is actually a LEAD id not a vendor id. it should allow user to:
// write an call log, allow a follwup to be added, make a didnt answer check, also a do not call.
// it should be presented from top to bottom: Write call log, with options, didnt answer, do not call.
if ($action == "initialsetup") {
  if (!isset($_POST['code']) || empty ($_POST['code'])) { echo "There was a strange error."; exit();}
    if (!isset($_POST['name']) || empty($_POST['name'])) {$name="";} else {$name=$_POST['name']; $name=mysql_real_escape_string($name);}
    if (!isset($_POST['address']) || empty($_POST['address'])) {$address="";} else {$address=$_POST['address']; $address=mysql_real_escape_string($address);}
    if (!isset($_POST['phone']) || empty($_POST['phone'])) {$phone="";} else {$phone=$_POST['phone']; $phone=mysql_real_escape_string($phone);}
    if (!isset($_POST['openhours']) || empty($_POST['openhours'])) {$openhours="";} else {$openhours=$_POST['openhours']; $openhours=mysql_real_escape_string($openhours);}
    if (!isset($_POST['contactdetails']) || empty($_POST['contactdetails'])) {$contactdetails="";} else {$contactdetails=$_POST['contactdetails']; $contactdetails=mysql_real_escape_string($contactdetails);}
    if (!isset($_POST['followupdate']) || empty($_POST['followupdate'])) {$followupdate="";} else {$followupdate=$_POST['followupdate']; $followupdate=mysql_real_escape_string($followupdate);}


}
if ($action == "start") {
  $sql = "SELECT * FROM `leads` where `id`='$id'";
  $result = mysql_query($sql) or die(mysql_error());
  while ($row = mysql_fetch_array($result)) {
$name = $row['name'];
$address = $row['address'];
$phone = $row['phone'];
$urlsource = $row['urlsource'];
$openhours = $row['openhours'];
  }
?>
<h1>Making First Contact</h1><br>
<form action="?page=callcenter&z=calllog" method="POST">
  <input type="hidden" name="code" value="1">
<div class="row">
                <div class="col-sm-6">
                    <section class="panel panel-default">
                      <header class="panel-heading">
                        <span class="h4">Confirm Contact Information</span>
                      </header>
                      <div class="panel-body">
                        <p class="text-muted">Please confirm with the lead that their contact information is correct. </p>
                        <div class="form-group">
                          <label>Name</label>
                          <input value="<?php echo $name; ?>" name="name" type="text" class="form-control" data-required="true">                        
                        </div>
                        <div class="form-group">
                          <label>Address</label>
                          <input value="<?php echo $address; ?>" name="address" type="text" class="form-control" data-required="true">                        
                        </div>
                        <div class="form-group">
                          <label>Phone</label>
                          <input name="phone" value="<?php echo $phone; ?>" type="text" class="form-control" data-type="phone" placeholder="(XXX) XXXX XXX" data-required="true">
                        </div>
                        <div class="form-group">
                          <label>Open Hours</label>
                          <input type="text" value="<?php echo $openhours; ?>" name="openhours" class="form-control" data-required="true">                        
                        </div>
                      </div>
                    </section>

                    <section class="panel panel-default">
                      <header class="panel-heading">
                        <span class="h4">Other Actions</span>
                      </header>
                      <div class="panel-body">
                        <table width="100%">
                          <tr>
                            <td>
                        <form method="post" action="?page=callcenter&z=leads&id=<?php echo $id; ?>">
                        <input type="submit" name="noanswer" value="Did Not Answer" class="btn btn-s-md btn-warning">
                      </form></td>
                      <td>
                      <form method="post" action="?page=callcenter&z=leads&id=<?php echo $id; ?>">
                        <input type="submit" name="dnc" value="DO NOT CALL" class="btn btn-s-md btn-danger">
                      </form>
                    </td>
                  </tr>
                </table>
                      </div>
                    </section>
                  
                </div>
                <div class="col-sm-6">
                    <section class="panel panel-default">
                      <header class="panel-heading">
                        <span class="h4">First Contact</span>
                      </header>
                      <div class="panel-body">          
                            <span class="h4">Follow-up Information:</span>             
                          <div class="form-group pull-in clearfix">
                            <div class="col-sm-6">
                              <label>Their Contact Details</label>
                              <input type="text" name="contactdetails" class="form-control" placeholder="Their contact name, phone, anything for follow up" data-required="true">
                            </div>
                            <div class="col-sm-6">
                              <label>Follow-up Date</label>
                             <input class="input-sm input-s datepicker-input form-control" size="16" type="text" name="followupdate" data-date-format="dd-mm-yyyy" >
                            </div>
                          </div>
                          <span class="h4">Vendor Information</span>
                          <div class="form-group">
                            <label>Status</label>
                            <select data-required="true" class="form-control" name="status">
                              <option disabled selected="true"></option>
                              <option value="1">Needs follow up at later date/time</option>
                              <option value="2">Needs closing, interested in buying</option>
                              <option value="3">Not interested at this time call again later</option>
                              <option value="4">In purchasing progress</option>
                              <option value="5">Active Vendor</option>
                              <option value="6">Needs resubscribing</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Assign Account Manager</label>
                            <select name="accManager" data-required="true" class="form-control">
                              <?php
                              $sqlz = "SELECT * FROM `users`";
                              $resultz = mysql_query($sqlz) or die(mysql_error());
                              while ($rowz = mysql_fetch_array($resultz)) {
                                echo "<option value='".$rowz['id']."'>".$rowz['username']."</option>";
                              }
                              ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Call Log Details</label>
                            <textarea class="form-control" rows="6" data-minwords="6" data-required="true" placeholder="Be thorough as to how the call went, what was said, for record purposes."></textarea>
                          </div>
                      </div>
                      <footer class="panel-footer text-right bg-light lter">
                        <button type="submit" class="btn btn-success btn-s-xs">Submit</button>
                      </footer>
                    </section>
                </div>
              </div>
</form>
<div class="row">
        

  </div>

<?php


} // end of start

} // end if has id
} // end page
if ($page == "activityreport") {
  ?>
  <section class="panel panel-default">
                <header class="panel-heading">
                  Activity Report
                </header>
                <div class="row text-sm wrapper">
                  <div class="col-sm-5 m-b-xs">
                    <select class="input-sm form-control input-s-sm inline">
                      <option value="0">Bulk action</option>
                      <option value="1">Delete selected</option>
                      <option value="2">Bulk edit</option>
                      <option value="3">Export</option>
                    </select>
                    <button class="btn btn-sm btn-default">Apply</button>                
                  </div>
                  <div class="col-sm-4 m-b-xs">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-sm btn-default active">
                        <input type="radio" name="options" id="option1"> Day
                      </label>
                      <label class="btn btn-sm btn-default">
                        <input type="radio" name="options" id="option2"> Week
                      </label>
                      <label class="btn btn-sm btn-default">
                        <input type="radio" name="options" id="option2"> Month
                      </label>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="input-group">
                      <input type="text" class="input-sm form-control" placeholder="Search">
                      <span class="input-group-btn">
                        <button class="btn btn-sm btn-default" type="button">Go!</button>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table table-striped b-t b-light text-sm">
                    <thead>
                      <tr>
                        <th width="20"><input type="checkbox"></th>
                        <th class="th-sortable" data-toggle="class">Project
                          <span class="th-sort">
                            <i class="fa fa-sort-down text"></i>
                            <i class="fa fa-sort-up text-active"></i>
                            <i class="fa fa-sort"></i>
                          </span>
                        </th>
                        <th>Task</th>
                        <th>Date</th>
                        <th width="30"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><input type="checkbox" name="post[]" value="2"></td>
                        <td>Idrawfast</td>
                        <td>4c</td>
                        <td>Jul 25, 2013</td>
                        <td>
                          <a href="#" class="active" data-toggle="class"><i class="fa fa-check text-success text-active"></i><i class="fa fa-times text-danger text"></i></a>
                        </td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="post[]" value="3"></td>
                        <td>Formasa</td>
                        <td>8c</td>
                        <td>Jul 22, 2013</td>
                        <td>
                          <a href="#" data-toggle="class"><i class="fa fa-check text-success text-active"></i><i class="fa fa-times text-danger text"></i></a>
                        </td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="post[]" value="4"></td>
                        <td>Avatar system</td>
                        <td>15c</td>
                        <td>Jul 15, 2013</td>
                        <td>
                          <a href="#" class="active" data-toggle="class"><i class="fa fa-check text-success text-active"></i><i class="fa fa-times text-danger text"></i></a>
                        </td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="post[]" value="4"></td>
                        <td>Throwdown</td>
                        <td>4c</td>
                        <td>Jul 11, 2013</td>
                        <td>
                          <a href="#" class="active" data-toggle="class"><i class="fa fa-check text-success text-active"></i><i class="fa fa-times text-danger text"></i></a>
                        </td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="post[]" value="5"></td>
                        <td>Idrawfast</td>
                        <td>4c</td>
                        <td>Jul 7, 2013</td>
                        <td>
                          <a href="#" class="active" data-toggle="class"><i class="fa fa-check text-success text-active"></i><i class="fa fa-times text-danger text"></i></a>
                        </td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="post[]" value="6"></td>
                        <td>Formasa</td>
                        <td>8c</td>
                        <td>Jul 3, 2013</td>
                        <td>
                          <a href="#" class="active" data-toggle="class"><i class="fa fa-check text-success text-active"></i><i class="fa fa-times text-danger text"></i></a>
                        </td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="post[]" value="7"></td>
                        <td>Avatar system </b></td>
                        <td>15c</td>
                        <td>Jul 2, 2013</td>
                        <td>
                          <a href="#" class="active" data-toggle="class"><i class="fa fa-check text-success text-active"></i><i class="fa fa-times text-danger text"></i></a>
                        </td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="post[]" value="8"></td>
                        <td>Videodown</td>
                        <td>4c</td>
                        <td>Jul 1, 2013</td>
                        <td>
                          <a href="#" class="active" data-toggle="class"><i class="fa fa-check text-success text-active"></i><i class="fa fa-times text-danger text"></i></a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <footer class="panel-footer">
                  <div class="row">
                    <div class="col-sm-4 hidden-xs">
                      <select class="input-sm form-control input-s-sm inline">
                        <option value="0">Bulk action</option>
                        <option value="1">Delete selected</option>
                        <option value="2">Bulk edit</option>
                        <option value="3">Export</option>
                      </select>
                      <button class="btn btn-sm btn-default">Apply</button>                  
                    </div>
                    <div class="col-sm-4 text-center">
                      <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                    </div>
                    <div class="col-sm-4 text-right text-center-xs">                
                      <ul class="pagination pagination-sm m-t-none m-b-none">
                        <li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#"><i class="fa fa-chevron-right"></i></a></li>
                      </ul>
                    </div>
                  </div>
                </footer>
              </section>
  <?php
}
if ($page == "sales") {
  ?>
  <section class="panel panel-default">
                <header class="panel-heading">
                  Sales
                </header>
                <div class="row text-sm wrapper">
                  <div class="col-sm-5 m-b-xs">
                    <select class="input-sm form-control input-s-sm inline">
                      <option value="0">Bulk action</option>
                      <option value="1">Delete selected</option>
                      <option value="2">Bulk edit</option>
                      <option value="3">Export</option>
                    </select>
                    <button class="btn btn-sm btn-default">Apply</button>                
                  </div>
                  <div class="col-sm-4 m-b-xs">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-sm btn-default active">
                        <input type="radio" name="options" id="option1"> Day
                      </label>
                      <label class="btn btn-sm btn-default">
                        <input type="radio" name="options" id="option2"> Week
                      </label>
                      <label class="btn btn-sm btn-default">
                        <input type="radio" name="options" id="option2"> Month
                      </label>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="input-group">
                      <input type="text" class="input-sm form-control" placeholder="Search">
                      <span class="input-group-btn">
                        <button class="btn btn-sm btn-default" type="button">Go!</button>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table table-striped b-t b-light text-sm">
                    <thead>
                      <tr>
                        <th width="20"><input type="checkbox"></th>
                        <th class="th-sortable" data-toggle="class">Project
                          <span class="th-sort">
                            <i class="fa fa-sort-down text"></i>
                            <i class="fa fa-sort-up text-active"></i>
                            <i class="fa fa-sort"></i>
                          </span>
                        </th>
                        <th>Task</th>
                        <th>Date</th>
                        <th width="30"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><input type="checkbox" name="post[]" value="2"></td>
                        <td>Idrawfast</td>
                        <td>4c</td>
                        <td>Jul 25, 2013</td>
                        <td>
                          <a href="#" class="active" data-toggle="class"><i class="fa fa-check text-success text-active"></i><i class="fa fa-times text-danger text"></i></a>
                        </td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="post[]" value="3"></td>
                        <td>Formasa</td>
                        <td>8c</td>
                        <td>Jul 22, 2013</td>
                        <td>
                          <a href="#" data-toggle="class"><i class="fa fa-check text-success text-active"></i><i class="fa fa-times text-danger text"></i></a>
                        </td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="post[]" value="4"></td>
                        <td>Avatar system</td>
                        <td>15c</td>
                        <td>Jul 15, 2013</td>
                        <td>
                          <a href="#" class="active" data-toggle="class"><i class="fa fa-check text-success text-active"></i><i class="fa fa-times text-danger text"></i></a>
                        </td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="post[]" value="4"></td>
                        <td>Throwdown</td>
                        <td>4c</td>
                        <td>Jul 11, 2013</td>
                        <td>
                          <a href="#" class="active" data-toggle="class"><i class="fa fa-check text-success text-active"></i><i class="fa fa-times text-danger text"></i></a>
                        </td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="post[]" value="5"></td>
                        <td>Idrawfast</td>
                        <td>4c</td>
                        <td>Jul 7, 2013</td>
                        <td>
                          <a href="#" class="active" data-toggle="class"><i class="fa fa-check text-success text-active"></i><i class="fa fa-times text-danger text"></i></a>
                        </td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="post[]" value="6"></td>
                        <td>Formasa</td>
                        <td>8c</td>
                        <td>Jul 3, 2013</td>
                        <td>
                          <a href="#" class="active" data-toggle="class"><i class="fa fa-check text-success text-active"></i><i class="fa fa-times text-danger text"></i></a>
                        </td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="post[]" value="7"></td>
                        <td>Avatar system </b></td>
                        <td>15c</td>
                        <td>Jul 2, 2013</td>
                        <td>
                          <a href="#" class="active" data-toggle="class"><i class="fa fa-check text-success text-active"></i><i class="fa fa-times text-danger text"></i></a>
                        </td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="post[]" value="8"></td>
                        <td>Videodown</td>
                        <td>4c</td>
                        <td>Jul 1, 2013</td>
                        <td>
                          <a href="#" class="active" data-toggle="class"><i class="fa fa-check text-success text-active"></i><i class="fa fa-times text-danger text"></i></a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <footer class="panel-footer">
                  <div class="row">
                    <div class="col-sm-4 hidden-xs">
                      <select class="input-sm form-control input-s-sm inline">
                        <option value="0">Bulk action</option>
                        <option value="1">Delete selected</option>
                        <option value="2">Bulk edit</option>
                        <option value="3">Export</option>
                      </select>
                      <button class="btn btn-sm btn-default">Apply</button>                  
                    </div>
                    <div class="col-sm-4 text-center">
                      <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                    </div>
                    <div class="col-sm-4 text-right text-center-xs">                
                      <ul class="pagination pagination-sm m-t-none m-b-none">
                        <li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#"><i class="fa fa-chevron-right"></i></a></li>
                      </ul>
                    </div>
                  </div>
                </footer>
              </section>
  <?php
}
?>


