<?php
set_time_limit(0);
ini_set('max_execution_time', 0);
include('_settings.php');

$ip=getRealIpAddr(); 
$sql = "select * from `bans` where `ip`='$ip'";
$result = mysql_query($sql) or die(mysql_error());
$count = 0;
while($row = mysql_fetch_array($result)){
	$count +=1;
}
if ($count!=0){
echo "Sorry but you've been banned temporarily.";
	exit();
}
$sql = "select * from `locksite`";
$result = mysql_query($sql) or die(mysql_error());
while($row = mysql_fetch_array($result)){
	$password = $row['combo'];
	$islocked = $row['active'];
}
if (!isset($islocked) || empty($islocked)) { 
} else { 
if ($islocked==1){
if (!isset($_SESSION['accesskey'])){
	header("location: locked.php?page=form");}}}

if (!isset($_GET["page"]) || empty($_GET["page"])) { 
    header("Location: ?page=home"); 
} else { 
    $page = $_GET["page"]; 

}

if (!isset($_SESSION["loggedin"]) || empty($_SESSION["loggedin"])) { 


if ($page=="query"){
  $action=$_POST['action'];
  $action = strtolower($action);
    if ($action=='login'){
    $username=$_POST['username'];   
  $password=$_POST['password'];
  $username = mysql_real_escape_string($username);
  $password = mysql_real_escape_string($password);
  $password=md5("$password");
  $count=0;
    $sql = "SELECT * FROM `users` WHERE `username`='$username' and `password`='$password'";
    $result = mysql_query($sql) or die(mysql_error());
    while($row = mysql_fetch_array($result)){
      $count+=1;
    $level = $row['level'];

    }
    if ($count==1){
    if ($level == "callcenter") {
      $_SESSION['loggedin']=1;
      $_SESSION['userlevel']=1;
      $username = strtolower("$username");
      $_SESSION['username']=$username;
      //onLogin("$username");
      header("Location: index.php?page=callcenter");
    }
    if ($level == "management") {
$_SESSION['loggedin']=1;
      $_SESSION['userlevel']=3;
      $username = strtolower("$username");
      $_SESSION['username']=$username;
      $_SESSION['adminloggedin']=1;
      //onLogin("$username");
      header("Location: index.php?page=admin&z=main");
    }
    if ($level == "accountmanager") {
$_SESSION['loggedin']=1;
      $_SESSION['userlevel']=2;
      $username = strtolower("$username");
      $_SESSION['username']=$username;
      //onLogin("$username");
      header("Location: index.php?page=accountmanager");
    }
    
      
        
    }else{
      echo "<br><br><center> <font color='#00000' > Login failed, please try again.</center></font>";
      
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en" class="bg-dark">
<head>
  <meta charset="utf-8" />
  <title>PSV POS</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="css/animate.css" type="text/css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="css/font.css" type="text/css" cache="false" />
    <link rel="stylesheet" href="css/app.css" type="text/css" />
  <!--[if lt IE 9]>
    <script src="js/ie/html5shiv.js" cache="false"></script>
    <script src="js/ie/respond.min.js" cache="false"></script>
    <script src="js/ie/excanvas.js" cache="false"></script>
  <![endif]-->
</head>
<body>
  <section id="content" class="m-t-lg wrapper-md animated fadeInUp">    
    <div class="container aside-xxl">
      <a class="navbar-brand block" href="index.html">Wheres Grub Team</a>
      <section class="panel panel-default bg-white m-t-lg">
        <header class="panel-heading text-center">
          <strong>Sign in</strong>
        </header>
        <form action="?page=query" method="post" accept-charset="utf-8" class="panel-body wrapper-lg">
          <input type="hidden" name="action" value="login">
          <div class="form-group">
            <label class="control-label">Username</label>
            <input name="username" placeholder="" class="form-control input-lg">
          </div>
          <div class="form-group">
            <label class="control-label">Password</label>
            <input type="password" name="password" id="inputPassword" placeholder="Password" class="form-control input-lg">
          </div>
          <button type="submit" class="btn btn-primary">Sign in</button>
          <div class="line line-dashed"></div>
        </form>
      </section>
    </div>
  </section>
  <!-- footer -->
  <footer id="footer">
    <div class="text-center padder">
      <p>
        <small>WheresTheGrub.com Management Systems</small>
      </p>
    </div>
  </footer>
  <!-- / footer -->
  <script src="js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="js/bootstrap.js"></script>
  <!-- App -->
  <script src="js/app.js"></script>
  <script src="js/app.plugin.js"></script>
  <script src="js/slimscroll/jquery.slimscroll.min.js"></script>
  
</body>
</html>
                <?php

} else { 
	include('main.php'); 
}









?>