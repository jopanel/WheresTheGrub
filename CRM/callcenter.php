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

if (!isset($_GET['z']) || empty($_GET['z'])) {$page = "dashboard";} else {$page = $_GET['z'];}

if ($page=="dashboard") {

} // end of dashboard page
if ($page=="leads") {
		$num_per_page = 500;
    if (!isset($_POST['dnc']) || empty($_POST['dnc'])) {} else {

      ?>
      <div class="alert alert-success">
<button class="close" data-dismiss="alert" type="button">×</button>
<i class="fa fa-ok-sign"></i>
<strong>Phew!</strong>
We will never call those shmucks again 
<a class="alert-link" href="#">they don't know what they are missing</a>
.
</div>
      <?php
    }
      if (!isset($_POST['noanswer']) || empty($_POST['noanswer'])) {} else {

        ?>
        <div class="alert alert-success">
<button class="close" data-dismiss="alert" type="button">×</button>
<i class="fa fa-ok-sign"></i>
<strong>Thanks for the call!</strong>
Good job making the call
<a class="alert-link" href="#"> too bad they didn't answer. This is going in the log</a>
.
</div>
        <?php
      }
	if (isset($_GET['i'])) {$i = $_GET['i']; } else {$i = 1; }
		if (!isset($_GET['kid']) || empty($_GET['kid'])) {$add = ""; $add2=""; } else {$add = " WHERE `kid`='".$_GET['kid']."'"; $add2= "&kid=".$_GET['kid']."";}
	if (!isset($_POST['keyword']) || empty($_POST['keyword'])) {$add = ""; $add2=""; } else {$add = " WHERE `kid`='".$_POST['keyword']."'"; $add2= "&kid=".$_POST['keyword']."";}
	$start_from = ($i-1) * $num_per_page;
	$leads = [];
$totalleads = 0;
	$sql = "SELECT * FROM `leads`$add ORDER BY `id` ASC LIMIT $start_from, $num_per_page";
	$result = mysql_query($sql) or die(mysql_error());
	while ($row = mysql_fetch_array($result)) {
		$totalleads+=1;
		$lid = $row['id'];
		$kid = $row['kid'];
		$name = $row['name'];
		$address = $row['address'];
		$phone = $row['phone'];
		$sql2 = "SELECT * FROM `keywords` WHERE `id`='".$kid."'";
		$result2 = mysql_query($sql2) or die(mysql_error());
		while ($row2 = mysql_fetch_array($result2)) {
			$keyword = $row2['name'];
		}
		$leads[] = array($lid,$name,$address,$phone,$keyword);
	}
	?>
	<section class="panel panel-default">
                <header class="panel-heading">
                  Leads
                </header>
                <form action="?page=callcenter&z=leads" method="POST">
                <div class="row text-sm wrapper">
                  <div class="col-sm-5 m-b-xs">
                    <select name="keyword" class="input-sm form-control input-s-sm inline">
                    	<?php 
                    	$sql3 = "SELECT * FROM `keywords`";
                    	$result3 = mysql_query($sql3) or die(mysql_error());
                    	while ($row3 = mysql_fetch_array($result3)) {
                    		echo "<option value='".$row3['id']."'>".$row3['name']."</option>";
                    	}
                    	?>
                    </select>
                    <input type="submit" class="btn btn-sm btn-default" value="Apply">                
                  </div> 
                </div>
            </form>
                <div class="table-responsive">
                  <table class="table table-striped b-t b-light text-sm">
                    <thead>
                      <tr>
                        <th width="20"><input type="checkbox"></th>
                        <th class="th-sortable" data-toggle="class">Name
                          <span class="th-sort">
                            <i class="fa fa-sort-down text"></i>
                            <i class="fa fa-sort-up text-active"></i>
                            <i class="fa fa-sort"></i>
                          </span>
                        </th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Keyword</th>
                        <th width="30"></th>
                      </tr>
                    </thead>
                    <tbody>
                    	<?php
                    	
                    	foreach ($leads as $value) {
                    		?>
                    		<tr>
                    			<td><?php echo $value[0]; ?></td>
                    			<td><?php echo $value[1]; ?></td>
                    			<td><?php echo $value[2]; ?></td>
                    			<td><?php echo $value[3]; ?></td>
                    			<td><?php echo $value[4]; ?></td>
                    			<td><a href="?page=accountmanager&z=vendors&action=start&id=<?php echo $value[0]; ?>">Contact</a></td>

                    		
                    		</tr>
                    		<?php
                    	}
                    	?>
                    </tbody>
                  </table>
                </div>
                <?php 
						$sqr = "SELECT * FROM `leads`$add";
                      	$rs_result = mysql_query($sqr);
                      	$total_records = mysql_num_rows($rs_result);
                      	$total_pages = ceil($total_records / $num_per_page);
                    ?>
                <footer class="panel-footer">
                  <div class="row">
                    <div class="col-sm-4 text-center">
                      <small class="text-muted inline m-t-sm m-b-sm">showing <?php echo $totalleads; ?>-<?php echo $total_records; ?> of <?php echo $total_records; ?> leads</small>
                    </div>
                    <div class="col-sm-4 text-right text-center-xs">                
                      <ul class="pagination pagination-sm m-t-none m-b-none">
                        <?php 
                      	
                      	if ($total_pages > 0) {
                      	echo "<li><a href='?page=callcenter&z=leads".$add2."&i=1'><i class='fa fa-chevron-left'></i></a></li>";
                      }
                       for ($r=1; $r<=$total_pages; $r++) {
                       	echo "<li><a href='?page=callcenter&z=leads".$add2."&i=".$r."'>".$r."</a></li>";
                       }
                      if ($total_pages > 0) {
                        echo "<li><a href='?page=callcenter&z=leads".$add2."&i=".$total_pages."'><i class='fa fa-chevron-right'></i></a></li>";
                    }
                        ?>
                      </ul>
                    </div>
                  </div>
                </footer>
              </section>
	<?php

} // end of leads page
if ($page=="followups") {
	?>
	<section class="panel panel-default">
                <header class="panel-heading">
                  Follow Ups
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

} // end of follow ups page 
if ($page=="calllog") {
	$num_per_page = 20;
	if (isset($_GET['i'])) {$i = $_GET['i']; } else {$i = 1; }
	if (!isset($_POST['username']) || empty($_POST['username'])) {$add = "";} else {$add = "WHERE `uid` = '".$_POST['username']."' ";}
	$start_from = ($i-1) * $num_per_page;
	$calls = [];
$totalcalls = 0;
	$sql = "SELECT * FROM `calls`$add ORDER BY `created` DESC LIMIT $start_from, $num_per_page";
	$result = mysql_query($sql) or die(mysql_error());
	while ($row = mysql_fetch_array($result)) {
		$totalcalls+=1;
		$cid = ['id'];
$lid = $row['lid'];
$vid = $row['vid'];
$uid = $row['uid'];
$created = $row['created'];
	$sql2 = "SELECT * FROM `users` WHERE `id`='$uid'";
	$result2 = mysql_query($sql2) or die(mysql_error());
	while ($row2 = mysql_fetch_array($result2)) {
		$username = $row2['username'];
	} // end of users query
	$vid = 0;
	if (!isset($vid) || empty($vid)) {} else {
		$sql3 = "SELECT * FROM `vendor_info` WHERE `vid`='$vid'";
		$result3 = mysql_query($sql3) or die(mysql_error());
		while ($row3 = mysql_fetch_array($result3)) {
			$companyname = $row3['name'];
			$vid = 1;
		}
	} // end of vid
	if (!isset($lid) || empty($lid)) {} else {
		$sql4 = "SELECT * FROM `leads` where `id`='$lid'";
		$result4 = mysql_query($sql4) or die(mysql_error());
		while ($row4 = mysql_fetch_array($result4)) {
			$companyname = $row4['name'];
		}
		// username, companyname, created, vid
		}
	
if ($totalcalls > 0) {
	$calls[] = array($username,$companyname,$created,$vid,$cid);
} else {$calls[] = array("","","","","");}
	} // end of calls query
	
	?>
<section class="panel panel-default">
                <header class="panel-heading">
                  Call Log
                </header>
                <div class="row text-sm wrapper">
                	<form action="?page=callcenter&z=calllog" method="POST">
                  <div class="col-sm-5 m-b-xs">Sort By Username:
                    <select name="username" class="input-sm form-control input-s-sm inline">
                    	<?php 
                    	$sql5 = "SELECT * FROM `users` ORDER BY `username` ASC";
                    	$result5 = mysql_query($sql5) or die(mysql_error());
                    	while ($row5 = mysql_fetch_array($result5)) {
                    		echo "<option value='".$row5['id']."'>".$row5['username']."</option>";
                    	}
                    	?>
                    </select>
                    <input type="submit" class="btn btn-sm btn-default" value="Apply">  
                    </form>            
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table table-striped b-t b-light text-sm">
                    <thead>
                      <tr>
                        <th width="20"><input type="checkbox"></th>
                        <th class="th-sortable" data-toggle="class">Call Date
                          <span class="th-sort">
                            <i class="fa fa-sort-down text"></i>
                            <i class="fa fa-sort-up text-active"></i>
                            <i class="fa fa-sort"></i>
                          </span>
                        </th>
                        <th>Username</th>
                        <th>Vendor</th>
                        <th width="30"></th>
                      </tr>
                    </thead>
                    <tbody>
                    	<?php
                    	
                    	foreach ($calls as $value) {
                    		?>
                    		<tr>
                    			<td><?php echo $value[4]; ?></td>
                    			<td><?php echo $value[2]; ?></td>
                    			<td><?php echo $value[0]; ?></td>
                    			<td><?php echo $value[1]; ?></td>
                    			<?php if (!isset($value[3]) || empty($value[3])) {echo "<td></td>"; } else {echo "<td><a href='accountmanager&z=vendors&action=start&id=".$value[3]."'><i class='fa fa-check text-success text-active'></i></a></td>";}
                    			?>
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
						$sqr = "SELECT * FROM `calls`";
                      	$rs_result = mysql_query($sqr);
                      	$total_records = mysql_num_rows($rs_result);
                      	$total_pages = ceil($total_records / $num_per_page);
                    ?>
                    <div class="col-sm-4 text-center">
                      <small class="text-muted inline m-t-sm m-b-sm">showing <?php echo $totalcalls; ?>-<?php echo $total_records; ?> of <?php echo $total_records; ?> calls</small>
                    </div>
                    <div class="col-sm-4 text-right text-center-xs">                
                      <ul class="pagination pagination-sm m-t-none m-b-none">
                      	<?php 
                      	
                      	if ($total_pages > 0) {
                      	echo "<li><a href='?page=callcenter&z=calllog&i=1'><i class='fa fa-chevron-left'></i></a></li>";
                      }
                       for ($r=1; $r<=$total_pages; $r++) {
                       	echo "<li><a href='?page=callcenter&z=calllog&i=".$r."'>".$r."</a></li>";
                       }
                      if ($total_pages > 0) {
                        echo "<li><a href='?page=callcenter&z=calllog&i=".$total_pages."'><i class='fa fa-chevron-right'></i></a></li>";
                    }
                        ?>
                      </ul>
                    </div>
                  </div>
                </footer>
              </section>
              <?php
} // end of call log
?>


