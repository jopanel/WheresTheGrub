<?php
 include("auth2.php");
$count="red";
$db="off";
$status=0;
$included_files = get_included_files();
// getting ready to do some file checks so people arent running the scripts in attempt to sql inject

foreach ($included_files as $filename) {
$arrcook[] = $filename;
} 
    if (in_array("/home2/ab83813/public_html/auth2.php", $arrcook)) {
    $db="on";
    $status+=1;
    // file exists move on
} else {
	echo "There was an error! Possible malicious activity detected. This has been reported.<br>";
	// doesnt exist but we dont report it because it could be a means to hack the site if it was a text file or sql that it was reported too
}
    
    if (in_array("/home2/ab83813/public_html/_inc.php", $arrcook)) {
    	$status+=1;
    	//exists move on
} else {
	echo "There was a problem executing our configuration.";
	if ($db=="off") {} else {
		$ip=getRealIpAddr(); 
		echo "There was an error! Possible malicious activity detected. This has been reported.<br>";

		// doesnt exist which is bad, so we fake report
exit();
	}
}
if ($status==2) {
	$count="green";
	// everything moved on so we gota green light
}
if ($count=="green") {
	///fuck yea! no hacks
} else {
exit();
}


$code=0;
$action="";
if (!isset($_GET['code']) || empty($_GET['code'])) {
	//somebody is trying to access this file with no code, very small security here but at least its something

} else {
	$code=$_GET['code'];
}
if ($code=="LDSHGIG63O65BR973P3NH0F5Q432SWDF6KD0ELE9J77J8OU8W42F5KHJ9FTG4JYPH8FO3L4MWFU0S8R703UTK34OFHERKTHS0EYJ6KGOVYEBTL") {
	if (!isset($_GET['action']) || empty($_GET['action'])) {
		// so they got the code right but no action??? wth
		$action="";
	} else {
$action=$_GET['action'];
	}

} 

if ($action=="changeemail") {
    $error=0;
    if (!isset($_GET['user'])) {$error=1;} else {$user=$_GET['user']; $user=mysql_real_escape_string($user);}
if ($error==1) {
    echo "noemail";
} else {
 $gothru=0;
    $sql2 = "select * from `users` where `email`='$user'";
    $result2 = mysql_query($sql2) or die(mysql_error());
    while($row2 = mysql_fetch_array($result2)){
        $theirid=$row2['id'];
        $level = $row2['level'];
        $gothru+=1;
    }
    if ($gothru==1) {

        if ($level=="notactivated") {
            echo "done";
            // this is because they can be a fake username and they need a real one
        }
        if ($level=="management") {$level = "normal";}
        if ($level=="normal") {
            // send email to confirm.
                   $randomkey = genACTKEY();
            $date = whatsthedate();
            $sql1 = "INSERT INTO `requests` (`id`,`uid`,`type`,`code`,`created`) VALUES ('NULL','$theirid','email','$randomkey','$date')";
            mysql_query($sql1) or die(mysql_error());
            $to = $email; 
            $subject = "My Epic Speech - Requested New E-Mail";
            $from = "support@myepicspeech.com"; 
            $headers  = "From: $from\r\n"; 
            $headers .= "Content-type: text/html\r\n"; 
            $message="<p>Hello,<br>Thank you for choosing to use My Epic Speech.<br><br>So we got a request to change your email. For security reasons we require to <strong>enter the code below in your My Epic Speech Application.</strong> <br><br> <div id='helpcopy'> $randomkey </div> <br><br>Thank You, <br>My Epic Speech Team";
            mail($to, $subject, $message, $headers);
            echo "done";
        }

    } // end go thru
} // end error
}

if ($action=="verifyemail") {
    $error=0;
    if (!isset($_GET['user'])) {$error=1;} else {$user=$_GET['user']; $user=mysql_real_escape_string($user);}
if ($error==1) {
    echo "noemail";
} else {
 $gothru=0;
    $sql2 = "select * from `users` where `email`='$user'";
    $result2 = mysql_query($sql2) or die(mysql_error());
    while($row2 = mysql_fetch_array($result2)){
        $theirid=$row2['id'];
        $level = $row2['level'];
        $gothru+=1;
    }
    if ($gothru==1) {

        if ($level=="normal") {
            echo "activated";
            // this is because they can be a fake username and they need a real one
        }
        if ($level=="notactivated") {
            // send email to confirm.
                   $randomkey = genACTKEY();
            $date = whatsthedate();
            $sql1 = "INSERT INTO `requests` (`id`,`uid`,`type`,`code`,`created`) VALUES ('NULL','$theirid','email','$randomkey','$date')";
            mysql_query($sql1) or die(mysql_error());
            $to = $email; 
            $subject = "My Epic Speech - Email Confirmation";
            $from = "support@myepicspeech.com"; 
            $headers  = "From: $from\r\n"; 
            $headers .= "Content-type: text/html\r\n"; 
            $message="<p>Hello,<br>Thank you for choosing to use My Epic Speech.<br><br>You must verify your email with us. For security reasons we require to <strong>enter the code below in your My Epic Speech App.</strong> <br><br> <div id='helpcopy'> $randomkey </div> <br><br>Thank You, <br>My Epic Speech Team";
            mail($to, $subject, $message, $headers);
            echo "done";
        }

    } // end go thru
} // end error
}

if ($action=="forgotpass") {
// meow (>O_o)>

    $fail=0;
if (!isset($_GET['user']) || empty($_GET['user'])) {$fail=1;} else {$email=$_GET['user']; $email=mysql_real_escape_string($email);}

if ($fail == 0) {
    $gothru=0;
    $sql2 = "select * from `users` where `email`='$email'";
    $result2 = mysql_query($sql2) or die(mysql_error());
    while($row2 = mysql_fetch_array($result2)){
        $theirid=$row2['id'];
        $gothru+=1;
    }
    if ($gothru==1) {
       $randomkey = genACTKEY();
            $date = whatsthedate();
            $sql1 = "INSERT INTO `requests` (`id`,`uid`,`type`,`code`,`created`) VALUES ('NULL','$theirid','password','$randomkey','$date')";
            mysql_query($sql1) or die(mysql_error());
            $to = $email; 
            $subject = "My Epic Speech - Requested New Password";
            $from = "support@myepicspeech.com"; 
            $headers  = "From: $from\r\n"; 
            $headers .= "Content-type: text/html\r\n"; 
            $message="<p>Hello,<br>Thank you for choosing to use MyEpicSpeech.<br><br>So we got a request to change your password. For security reasons we require to <strong>enter the code below in your My Epic Speech Application.</strong> <br><br> <div id='helpcopy'> $randomkey </div> <br><br>Thank You, <br>My Epic Speech Team";
            $message = wordwrap($message, 70, "\r\n");
            mail($to, $subject, $message, $headers);
            echo "done";
    }
    if ($gothru==0) {
        echo "exist";
    }
} else {
    // why does fail = 0...
}
}
if ($action=="login") {
	// okay so in this case it would be requests.php?code=469**********3499741&action=login
	$email = $_GET['email'];
	$pass = $_GET['pass'];
	$email=mysql_real_escape_string($email);
	$pass=mysql_real_escape_string($pass);
	$pass=md5("$pass");
	$gothru=0;
	// next we will just echo some basic stuff to basically tell the program if we are good to go or not
	    $sql2 = "select * from `users` where `email`='$email' && `password`='$pass'";
    $result2 = mysql_query($sql2) or die(mysql_error());
    while($row2 = mysql_fetch_array($result2)){
    	$gothru+=1;
    }
    if ($gothru==1) {
    $date=whatsthedate();
	$ip=getRealIpAddr();  
	$sql = "UPDATE `users` SET `last login`='$date',`ip`='$ip' where `email`='$email'";
	mysql_query($sql) or die(mysql_error());
    	echo "Good";
    } else {
    	 $sql3 = "select * from `users` where `email`='$email'";
    $result3 = mysql_query($sql3) or die(mysql_error());
    while($row3 = mysql_fetch_array($result3)){
    	$gothru+=1;
    }
    if ($gothru==1) {
    	echo "badpass";
    } else { echo "duno"; }
    }
}
if ($action=="redownloaded") {
		// okay so in this case it would be requests.php?code=469**********3499741&action=redownloaded
	$email = $_GET['email'];
	$pass = $_GET['pass'];
	$email=mysql_real_escape_string($email);
	$pass=mysql_real_escape_string($pass);
	$pass=md5("$pass");
	$gothru=0;
    $brokenverify = 0;
	// next we will just echo some basic stuff to basically tell the program if we are good to go or not
	    $sql2 = "select * from `users` where `email`='$email' && `password`='$pass'";
    $result2 = mysql_query($sql2) or die(mysql_error());
    while($row2 = mysql_fetch_array($result2)){
    	$gothru+=1;
        $uid = $row2['id'];
   if (!isset($row2['homephone']) || empty($row2['homephone'])) { $homephone=""; } else { $homephone=$row2['homephone']; }
   if (!isset($row2['cellphone']) || empty($row2['cellphone'])) { $cellphone=""; } else { $cellphone=$row2['cellphone']; }
   if (!isset($row2['address']) || empty($row2['address'])) { $address=""; } else { $address=$row2['address']; }
   if (!isset($row2['address2']) || empty($row2['address2'])) { $address2=""; } else { $address2=$row2['address2']; }
   if (!isset($row2['city']) || empty($row2['city'])) { $city=""; } else { $city=$row2['city']; }
   if (!isset($row2['state']) || empty($row2['state'])) { $state=""; } else { $state=$row2['state']; }
   if (!isset($row2['zip']) || empty($row2['zip'])) { $zip=""; } else { $zip=$row2['zip']; }
   if (!isset($row2['company']) || empty($row2['company'])) { $company=""; } else { $company=$row2['company']; }
   if (!isset($row2['firstname']) || empty($row2['firstname'])) { $firstname=""; } else { $firstname=$row2['firstname']; }
   if (!isset($row2['lastname']) || empty($row2['lastname'])) { $lastname=""; } else { $lastname=$row2['lastname']; }
   if (!isset($row2['level']) || empty($row2['level'])) {$level="notactivated"; } else { $level = $row2['level'];}
   if (!isset($row2['username']) || empty($row2['username'])) {$username="";} else {$username = $row2['username'];}
   if (!isset($row2['pkey']) || empty ($row2['pkey'])) {$brokenverify = 1; } else {$pkey = mysql_real_escape_string($row2['pkey']);}
   if ($brokenverify == 1) {
    $pkey = genACTKEY();
    $sqlz = "UPDATE `users` SET `pkey` = '$pkey' WHERE `id` = '$uid'";
    mysql_query($sqlz) or die(mysql_error());
   }
    }
    if ($gothru==1) {
    	// some kind of json bogus crap here
    	$bang = array();
    	$bang['homephone'] = $homephone;
    	$bang['cellphone'] = $cellphone;
    	$bang['address'] = $address;
    	$bang['address2'] = $address2;
    	$bang['city'] = $city;
    	$bang['state'] = $state;
    	$bang['zip'] = $zip;
    	$bang['company'] = $company;
    	$bang['firstname'] = $firstname;
    	$bang['lastname'] = $lastname;
        $bang['level'] = $level;
        $bang['username'] = $username;
        $bang['pkey'] = $pkey;
    	header('Content-Type: application/json');
    	echo json_encode($bang, JSON_PRETTY_PRINT);
    }
} // end of redownloaded

if ($action=="register") {
	//pull data if it exists or not
	//types of returns:
	// die = invalid email, they already exist
	// exist = valid email, they already exist
	// invalid = invalid email
	// pass = invalid password
	// good = registered the user
if (!isset($_GET['first']) || empty($_GET['first'])) { $first=""; } else { $first=$_GET['first']; $first=mysql_real_escape_string($first);}
if (!isset($_GET['last']) || empty($_GET['last'])) { $last=""; } else { $last=$_GET['last']; $last=mysql_real_escape_string($last);}
if (!isset($_GET['user']) || empty($_GET['user'])) { $user=""; } else { $user=$_GET['user']; $user=mysql_real_escape_string($user);}
if (!isset($_GET['pass']) || empty($_GET['pass'])) { $pass=""; } else { $pass=$_GET['pass']; $pass=mysql_real_escape_string($pass);}
if (!isset($_GET['pass2']) || empty($_GET['pass2'])) { $pass2=""; } else { $pass2=$_GET['pass2']; $pass2=mysql_real_escape_string($pass2);}
if (!isset($_GET['city']) || empty($_GET['city'])) { $city=""; } else { $city=$_GET['city']; $city=mysql_real_escape_string($city);}
if (!isset($_GET['state']) || empty($_GET['state'])) { $state=""; } else { $state=$_GET['state']; $state=mysql_real_escape_string($state);}
if (!isset($_GET['username']) || empty($_GET['username'])) {$username = "";} else {$username = mysql_real_escape_string($_GET['username']);}
// lets check if they already exist
	$gothru=0;
    $sql2 = "select * from `users` where `email`='$user' ";
    $result2 = mysql_query($sql2) or die(mysql_error());
    while($row2 = mysql_fetch_array($result2)){
    	$gothru+=1;
    	// they already exist :/ wtf now they need password reset or some bullshit. 
    	// fuck that lets just send them an email i guess
    }
    if ($gothru==1) {
    	$rq=0;
    	if (filter_var($user, FILTER_VALIDATE_EMAIL)) {
 // email is valid continuing..
} else {
  $rq=1; 
  // cannot email this user, so lets kill their soul with an echo
  echo "die";
}
if ($rq==1) { 
//we already killed their soul what more do u want
} else {

			echo "exist";
			exit();
} // end mail
} // end email exists
//so email is good, continue with action.
$checks=0; //checks should add up if it doesnt then something went wrong
if (filter_var($user, FILTER_VALIDATE_EMAIL)) {
 // email is valid continuing..
	$checks+=1; //add 1
} else {
// DOH! 
	echo "invalid";
}
if ($pass==$pass2){ 
	// pass is good but is there a pass?
	if ($pass=="") {
		//DOH
		echo "pass";
	} else {
		$checks+=1; // everything went thru
		$pass = md5("$pass"); // plain text is baaad

	}
} else {
	//DOH
	echo "pass";
}
/// okay now i think its safe to add the user

if ($checks==2) {
    $key = genACTKEY();
	$sql = "INSERT INTO `users` (`id`, `email`, `password`, `level`, `city`, `state`, `first_name`, `last_name`, `username`,`pkey`) VALUES ('NULL', '$user', '$pass', 'notactivated','$city', '$state', '$first', '$last', '$username','$key')";
			mysql_query($sql) or die(mysql_error());
			
	echo "good";
}


//                              ___                                  
//||                          .'   '.                                ||
//||                         /       \           oOoOo               ||
//||                        |         |       ,==|||||               ||
//||                         \       /       _|| |||||               ||
//||                          '.___.'    _.-'^|| |||||               ||
//||                        __/_______.-'     '==HHHHH               ||
//||                   _.-'` /                   """""               ||
//||                .-'     /   oOoOo                                ||
//||                `-._   / ,==|||||                                ||
//||                    '-/._|| |||||                                ||
//||                     /  ^|| |||||                                ||
//||                    /    '==HHHHH                                ||
//||                   /________"""""                                ||
//||                   `\       `\                                   ||
//||                     \        `\   /                             ||
//||                      \         `\/                              ||
//||                      /                                          ||
//||                     /                                           ||
//||                    /_____                                       ||
//||                                                                 ||
//'==================================================================='

} // end register action

if ($action == "getcategories") {
    $add="";
    $continue = 0;
if (!isset($_GET['email']) || empty($_GET['email'])) {$continue = 1;} else {$email = $_GET['email'];}
if ($continue==0) {$add="";}
$add .=" ORDER BY `name` ASC";
$bang = array();
       $sql2 = "select * from `category`$add";
    $result2 = mysql_query($sql2) or die(mysql_error());
    while($row2 = mysql_fetch_array($result2)){
        $cid = $row2['id'];
        $cname = $row2['name'];
$topicbang = [];
        $sql23 = "select * from `topics` where `cid`='$cid'";
    $result23 = mysql_query($sql23) or die(mysql_error());
    while($row23 = mysql_fetch_array($result23)){
        $tid=$row23['id'];
        $tname = $row23['name'];
$topicbang[] = array($tid, $tname);
    }
$bang[] = array($cid, $cname, $topicbang);
    }
        header('Content-Type: application/json');
        echo json_encode($bang, JSON_PRETTY_PRINT);
    
}

// $array = categories: names -> topics: names

if ($action == "opentopic") {
    $stop = 0;
    $postarray = [];
    $buildarray = [];
    if (!isset($_GET['id']) || empty($_GET['id'])) {$stop = 1;} else {$id = $_GET['id']; $id = mysql_real_escape_string($id);}
    $sql = "SELECT * FROM `speeches` WHERE `tid`='$id' ORDER BY `id` DESC";
    $result = mysql_query($sql) or die(mysql_error());
    while ($row = mysql_fetch_array($result)) {
        $link = $row['href'];
        $userposted = $row['uid'];
        $pid = $row['id'];
        $date = $row['created'];
    
    $sql2 = "SELECT * FROM `users` WHERE `id`='$userposted'";
    $result2 = mysql_query($sql2) or die(mysql_error());
    while ($row2 = mysql_fetch_array($result2)) {
         $username = $row['username'];
    }
    // this function below solely calculates what rating they are. $stars is the value needed at bottom
    $totalratings = 0;
    $ratings = [];
    $sql3 = "SELECT * FROM `ratings` WHERE `pid`='$pid'";
    $result3 = mysql_query($sql3) or die(mysql_error());
    while ($row3 = mysql_fetch_array($result3)) {
        $totalratings += 1;
        $ratings[$totalratings] = $row3['rating'];
    }

$max = 0;
$n = 0;
foreach ($ratings as $rate => $count) {
    $max += $rate * $count;
    $n += $count;
}
$stars = $max / $n;

$buildarray[] = array($pid,$link,$username,$stars,$date);
} // end of user foreach
        header('Content-Type: application/json');
        echo json_encode($buildarray, JSON_PRETTY_PRINT);

}

/////////

// STARTING CLASSROOM SECTION

/////////
if ($action == "classtopics"){
    $stop = 0;
    $buildarray = [];
    if (!isset($_GET['email']) || empty($_GET['email'])) {$stop = 1;} else {$email = mysql_real_escape_string($_GET['email']);}
    if (!isset($_GET['pkey']) || empty($_GET['pkey'])) {$stop = 1; } else {$pkey = mysql_real_escape_string($_GET['pkey']);}
    if (!isset($_GET['cid']) || empty($_GET['cid'])) {$stop = 1;} else {$cid = mysql_real_escape_string($_GET['cid']);}
    $canAccess = canAccess($email,$pkey);
    if ($canAccess == 0) {$stop = 1;}
    if ($stop == 1) {echo "problem"; exit();}
    $count = 0;
    $sql = "SELECT * FROM `classmates` WHERE `uid` = '$canAccess' AND `blocked` = '0' AND `cid`='$cid'";
    $result = mysql_query($sql) or die(mysql_error());
    while ($row = mysql_fetch_array($result)) {
        $sql2 = "SELECT * FROM `topics` WHERE `crid` = '".$row['cid']."'";
        $result2 = mysql_query($sql2) or die(mysql_error());
        while ($row2 = mysql_fetch_array($result2)) {
            $count = 1;
            $buildarray[] = array($row2['id'],$cid,$row2['name']);
        }
    }
    if ($count == 0) {$buildarray[] = array("nothing");}
    header('Content-Type: application/json');
    echo json_encode($buildarray, JSON_PRETTY_PRINT);
}
if ($action == "classes") {
    $stop = 0;
    $buildarray = [];
    if (!isset($_GET['email']) || empty($_GET['email'])) {$stop = 1;} else {$email = mysql_real_escape_string($_GET['email']);}
    if (!isset($_GET['pkey']) || empty($_GET['pkey'])) {$stop = 1; } else {$pkey = mysql_real_escape_string($_GET['pkey']);}
    $canAccess = canAccess($email,$pkey);
    if ($canAccess == 0) {$stop = 1;}
    if ($stop == 1) {echo "problem"; exit();}
    $count = 0;
    $sql = "SELECT * FROM `classmates` WHERE `uid` = '$canAccess' AND `blocked` = '0'";
    $result = mysql_query($sql) or die(mysql_error());
    while ($row = mysql_fetch_array($result)) {
        $sql2 = "SELECT * FROM `classrooms` WHERE `id` = '".$row['cid']."'";
        $result2 = mysql_query($sql2) or die(mysql_error());
        while ($row2 = mysql_fetch_array($result2)) {
            $count = 1;
            if ($row2['creator'] == $canAccess) { $admin = 1;} else {$admin = 0;}
            $buildarray[] = array($row2['id'],$row2['name'],$admin, $row2['password']);
        }
    }
    if ($count == 0) {$buildarray[] = array("empty");}
    header('Content-Type: application/json');
    echo json_encode($buildarray, JSON_PRETTY_PRINT);
}
if ($action == "joinclassroom") {
    $stop = 0;
    if (!isset($_GET['email']) || empty($_GET['email'])) {$stop = 1;} else {$email = mysql_real_escape_string($_GET['email']);}
    if (!isset($_GET['pkey']) || empty($_GET['pkey'])) {$stop = 1; } else {$pkey = mysql_real_escape_string($_GET['pkey']);}
    if (!isset($_GET['password']) || empty($_GET['password'])) {$stop = 1;} else {$password = mysql_real_escape_string($_GET['password']);}
    $canAccess = canAccess($email,$pkey);
    $date = whatsthedate();
    if ($canAccess == 0) {$stop = 1;}
    if ($stop == 1) {echo "problem"; exit();}
    $count = 0;
    $sql = "SELECT * FROM `classrooms` WHERE `password` = '$password'";
    $result = mysql_query($sql) or die(mysql_error());
    while ($row = mysql_fetch_array($result)) {
        $count = 1;
        $cid = $row['id'];
    }
    if ($count == 0) {echo "problem"; exit();}
    if ($count == 1) {
        $sql3 = "INSERT INTO `classmates` (`uid`,`cid`,`joindate`) VALUES ('$canAccess','$cid','$date')";
        mysql_query($sql3) or die(mysql_error());
    echo "done";
        
    } // end count
}

if ($action == "createclassroom") {
     $stop = 0;
    if (!isset($_GET['email']) || empty($_GET['email'])) {$stop = 1;} else {$email = mysql_real_escape_string($_GET['email']);}
    if (!isset($_GET['pkey']) || empty($_GET['pkey'])) {$stop = 1; } else {$pkey = mysql_real_escape_string($_GET['pkey']);}
    if (!isset($_GET['name']) || empty($_GET['name'])) {$stop = 1; } else {$name = mysql_real_escape_string($_GET['name']);}
    $date = whatsthedate();
    $classpass = genClassPass();
    $canAccess = canAccess($email,$pkey);
    if ($canAccess == 0) {$stop = 1;}
    if ($stop == 1) {echo "problem"; exit();}
    $sql = "INSERT INTO `classrooms` (`name`,`created`,`password`,`creator`) VALUES ('$name','$date','$classpass','$canAccess')";
    mysql_query($sql) or die(mysql_error());
    $sql2 = "SELECT * FROM `classrooms` WHERE `creator`='$canAccess' ORDER BY `id` DESC LIMIT 1";
    $result2 = mysql_query($sql2) or die(mysql_error());
    while ($row2 = mysql_fetch_array($result2)) {
        $cid = $row2['id'];
    $sql3 = "INSERT INTO `classmates` (`uid`,`cid`,`joindate`,`blocked`) VALUES ('$canAccess','$cid','$date','0')";
    mysql_query($sql3) or die(mysql_error());
        $buildarray[] = array($row2['id'],$classpass);
    }
    header('Content-Type: application/json');
    echo json_encode($buildarray, JSON_PRETTY_PRINT);
}

if ($action == "removefromclassroom") {
     $stop = 0;
    if (!isset($_GET['email']) || empty($_GET['email'])) {$stop = 1;} else {$email = mysql_real_escape_string($_GET['email']);}
    if (!isset($_GET['pkey']) || empty($_GET['pkey'])) {$stop = 1; } else {$pkey = mysql_real_escape_string($_GET['pkey']);}
    if (!isset($_GET['remove']) || empty($_GET['remove'])) {$stop = 1;} else {$rid = mysql_real_escape_string($_GET['remove']);}
    $canAccess = canAccess($email,$pkey);
    if ($canAccess == 0) {$stop = 1;}
    if ($stop == 1) {echo "problem"; exit();}
    $count = 0;
    $sql = "SELECT * FROM `classrooms` WHERE `creator` = '$canAccess'";
    $result = mysql_query($sql) or die(mysql_error());
    while ($row = mysql_fetch_array($result)) {
        $count = 1;
    }
    if ($count == 0) { echo "problem"; exit();}
    if ($count == 1) {
        $sql1 = "UPDATE `classmates` SET `blocked` = '1' WHERE `uid`='$canAccess'";
        mysql_query($sql1) or die(mysql_error());
        echo "done";
    } // end count
}

if ($action == "generatecode") {
     $stop = 0;
    if (!isset($_GET['email']) || empty($_GET['email'])) {$stop = 1;} else {$email = mysql_real_escape_string($_GET['email']);}
    if (!isset($_GET['pkey']) || empty($_GET['pkey'])) {$stop = 1; } else {$pkey = mysql_real_escape_string($_GET['pkey']);}
    if (!isset($_GET['cid']) || empty($_GET['cid'])) {$stop = 1;} else {$cid = mysql_real_escape_string($_GET['cid']);}
    $canAccess = canAccess($email, $pkey);
    $classpass = genClassPass();
    if ($canAccess == 0) {$stop = 1;}
    if ($stop == 1) {echo "problem"; exit();}
    $count = 0;
    $sql = "SELECT * FROM `classrooms` WHERE `creator` = '$canAccess'";
    $result = mysql_query($sql) or die(mysql_error());
    while ($row = mysql_fetch_array($result)) {
        $count = 1;
    }
    if ($count == 0) {echo "problem"; exit();}
    if ($count == 1) {
        $sql1 = "UPDATE `classrooms` SET `password` = '$classpass' WHERE `id`='$cid'";
        mysql_query($sql1) or die(mysql_error());
        $buildarray = [];
        $buildarray = array($classpass);
        header('Content-Type: application/json');
    echo json_encode($buildarray, JSON_PRETTY_PRINT);
    } // end count
}
if ($action == "deleteclasstopics") {
     $stop = 0;
    if (!isset($_GET['email']) || empty($_GET['email'])) {$stop = 1;} else {$email = mysql_real_escape_string($_GET['email']);}
    if (!isset($_GET['pkey']) || empty($_GET['pkey'])) {$stop = 1; } else {$pkey = mysql_real_escape_string($_GET['pkey']);}
    if (!isset($_GET['cid']) || empty($_GET['cid'])) {$stop = 1;} else {$cid = mysql_real_escape_string($_GET['cid']);}
    if (!isset($_GET['tid']) || empty($_GET['tid'])) {$stop = 1;} else {$tid = mysql_real_escape_string($_GET['tid']);}
    $canAccess = canAccess($email, $pkey);
    $classpass = genClassPass();
    if ($canAccess == 0) {$stop = 1;}
    if ($stop == 1) {echo "problem"; exit();}
    $count = 0;
    $sql = "SELECT * FROM `classrooms` WHERE `creator` = '$canAccess'";
    $result = mysql_query($sql) or die(mysql_error());
    while ($row = mysql_fetch_array($result)) {
        $count = 1;
    }
    if ($count == 1) {
        $sql3 = "SELECT * FROM `topics` WHERE `id`='$tid'";
        $result3 = mysql_query($sql3) or die(mysql_error());
        while ($row2 = mysql_fetch_array($result3)) {
            $tid2 = $row2['id'];
        }
        if ($tid == $tid2) {
            $sql4 = "DELETE FROM `topics` WHERE `id`= '$tid'";
            mysql_query($sql4) or die(mysql_error());
        }
    }

}
if ($action == "getclasspass") {
        $stop = 0;
    if (!isset($_GET['email']) || empty($_GET['email'])) {$stop = 1;} else {$email = mysql_real_escape_string($_GET['email']);}
    if (!isset($_GET['pkey']) || empty($_GET['pkey'])) {$stop = 1; } else {$pkey = mysql_real_escape_string($_GET['pkey']);}
    if (!isset($_GET['cid']) || empty($_GET['cid'])) {$stop = 1;} else {$cid = mysql_real_escape_string($_GET['cid']);}
    $canAccess = canAccess($email, $pkey);
    $classpass = genClassPass();
    $topics = [];
    if ($canAccess == 0) {$stop = 1;}
    if ($stop == 1) {echo "problem"; exit();}
    $count = 0;
    $sql = "SELECT * FROM `classrooms` WHERE `id` = '$cid' AND `creator` = '$canAccess'";
    $result = mysql_query($sql) or die(mysql_error());
    while ($row = mysql_fetch_array($result)) {
        $count = 1;
        $password = $row['password'];
    }
    if ($count == 1) {
        $buildarray = array($password);
        header('Content-Type: application/json');
    echo json_encode($buildarray, JSON_PRETTY_PRINT);
    }
}
if ($action == "managetopics") {
        $stop = 0;
    if (!isset($_GET['email']) || empty($_GET['email'])) {$stop = 1;} else {$email = mysql_real_escape_string($_GET['email']);}
    if (!isset($_GET['pkey']) || empty($_GET['pkey'])) {$stop = 1; } else {$pkey = mysql_real_escape_string($_GET['pkey']);}
    if (!isset($_GET['cid']) || empty($_GET['cid'])) {$stop = 1;} else {$cid = mysql_real_escape_string($_GET['cid']);}
    $canAccess = canAccess($email, $pkey);
    $classpass = genClassPass();
    $topics = [];
    if ($canAccess == 0) {$stop = 1;}
    if ($stop == 1) {echo "problem"; exit();}
    $count = 0;
    $sql = "SELECT * FROM `classrooms` WHERE `id` = '$cid' AND `creator` = '$canAccess'";
    $result = mysql_query($sql) or die(mysql_error());
    while ($row = mysql_fetch_array($result)) {
        $count = 1;
        $password = $row['password'];
    }
    if ($count == 1) {
        $totaltopics = 0;
      $sql2 = "SELECT * FROM `topics` WHERE `crid`='$cid'";
      $result2 = mysql_query($sql2) or die(mysql_error());
      while ($row2 = mysql_fetch_array($result2)) {
        $totaltopics += 1;
        $topics[] = array($row2['id'],$row2['name']);
      }
      if ($totaltopics == 0) {$topics[] = array("nothing");}
      header('Content-Type: application/json');
    echo json_encode($topics, JSON_PRETTY_PRINT);
    }
}
if ($action == "createclasstopic") {
      $stop = 0;
    if (!isset($_GET['email']) || empty($_GET['email'])) {$stop = 1;} else {$email = mysql_real_escape_string($_GET['email']);}
    if (!isset($_GET['pkey']) || empty($_GET['pkey'])) {$stop = 1; } else {$pkey = mysql_real_escape_string($_GET['pkey']);}
    if (!isset($_GET['cid']) || empty($_GET['cid'])) {$stop = 1;} else {$cid = mysql_real_escape_string($_GET['cid']);}
    if (!isset($_GET['name']) || empty($_GET['name'])) {$stop = 1;} else {$name = mysql_real_escape_string($_GET['name']);}
    $canAccess = canAccess($email, $pkey);
    $classpass = genClassPass();
    if ($canAccess == 0) {$stop = 1;}
    if ($stop == 1) {echo "problem"; exit();}
    $count = 0;
    $sql = "SELECT * FROM `classrooms` WHERE `id` = '$cid' AND `creator` = '$canAccess'";
    $result = mysql_query($sql) or die(mysql_error());
    while ($row = mysql_fetch_array($result)) {
        $count = 1;
    }
    if ($count == 1) {
        $sql2 = "INSERT INTO `topics` (`crid`,`name`) VALUES ('$cid','$name')";
        mysql_query($sql2) or die(mysql_error());
    }
}
if ($action == "openclasstopic") { 
 $stop = 0;
    if (!isset($_GET['email']) || empty($_GET['email'])) {$stop = 1;} else {$email = mysql_real_escape_string($_GET['email']);}
    if (!isset($_GET['pkey']) || empty($_GET['pkey'])) {$stop = 1; } else {$pkey = mysql_real_escape_string($_GET['pkey']);}
    if (!isset($_GET['tid']) || empty($_GET['tid'])) {$stop = 1;} else {$tid = mysql_real_escape_string($_GET['tid']);}
    if (!isset($_GET['cid']) || empty($_GET['cid'])) {$stop = 1;} else {$cid = mysql_real_escape_string($_GET['cid']);}
    $canAccess = canAccess($email,$pkey);
    $buildarray = [];
    if ($canAccess == 0) {$stop = 1;}
    if ($stop == 1) {echo "problem"; exit();}
    $cango = 0;
    $sql = "SELECT * FROM `classmates` WHERE `uid`='$canAccess' AND `blocked` = '0' AND `cid`='$cid'";
    $result = mysql_query($sql) or die(mysql_error());
    while ($row = mysql_fetch_array($result)) {
        $cango = 1;
    }
    if ($cango == 0) {exit();}
    $sql2 = "SELECT * FROM `speeches` WHERE `cid`='$cid' AND `tid`='$tid' ORDER BY `created` DESC";
    $result2 = mysql_query($sql2) or die(mysql_error()); 
    while ($row2 = mysql_fetch_array($result2)) {

        $epic = getTotalLikes($row2['id']);
        $fail = getTotalDislikes($row2['id']);
        $issafe = rottenEggs($row2['id']);
        $username = getUsername($canAccess);
        if ($issafe == 0) {
            $buildarray[] = array($row2['id'],$row2['href'],$username,$epic,$fail,$row2['created']);
        }
        
    }
    header('Content-Type: application/json');
    echo json_encode($buildarray, JSON_PRETTY_PRINT);
}
    //////////

    // END CLASSROOM

    /////////
    if ($action=="pushspeech") {

         $stop = 0;
    if (!isset($_GET['email']) || empty($_GET['email'])) {$stop = 1;} else {$email = mysql_real_escape_string($_GET['email']);}
    if (!isset($_GET['pkey']) || empty($_GET['pkey'])) {$stop = 1; } else {$pkey = mysql_real_escape_string($_GET['pkey']);}
    if (!isset($_GET['tid']) || empty($_GET['tid'])) {$stop = 1;} else {$tid = mysql_real_escape_string($_GET['tid']);}
    if (!isset($_GET['cid']) || empty($_GET['cid']) ) { 
        if ($stop !== 1) {$stop = 0;}
    } else {$cid = mysql_real_escape_string($_GET['cid']);}

    $canAccess = canAccess($email,$pkey);
    $buildarray = [];
    if ($canAccess == 0) {$stop = 1;}
    if ($stop == 1) {echo "problem"; exit();}
    $date = whatsthedate();

$allowedExts = array("3gpp", "quicktime", "mp4", "3gp", "mov");
$bits = explode(".", $_FILES["file"]["name"]);
$extension = end($bits);
echo $_FILES["file"]["type"]+"   ... "+$_FILES["file"]["name"];
if ((($_FILES["file"]["type"] == "video/3gpp")
|| ($_FILES["file"]["type"] == "video/quicktime")
|| ($_FILES["file"]["type"] == "video/mp4")
|| ($_FILES["file"]["type"] == "video/3gp")
|| ($_FILES["file"]["type"] == "video/mov"))
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {

$$_FILES["file"]["name"] = str_replace(' ', '', $_FILES["file"]["name"]);

    if (file_exists("./v/" . $_FILES["file"]["name"]))
      {
          $ar2d2=1;
      $random_digit=rand(00000000,99999999);
    $filename=$random_digit.$_FILES["file"]["name"];
          move_uploaded_file($_FILES["file"]["tmp_name"],
      "./v/" . $filename);
      }
    else
      {
          $ar2d2=2;
      @move_uploaded_file($_FILES["file"]["tmp_name"],
      "./v/" . $_FILES["file"]["name"]);
      }
    }
    if ($ar2d2==1) {
        $pic=$filename; 
    } else if ($ar2d2==2) {
        $pic=$_FILES["file"]["name"]; 
    }
    
    if ($stop == 3) {
    $cango = 0;
    $sql = "SELECT * FROM `classmates` WHERE `uid`='$canAccess' AND `blocked` = '0' AND `cid`='$cid'";
    $result = mysql_query($sql) or die(mysql_error());
    while ($row = mysql_fetch_array($result)) {
        $cango = 1;
    }
    if ($cango == 1) {


        $sql2 = "INSERT INTO `speeches` (`uid`,`tid`,`href`,`created`,`crid`) VALUES ('$canAccess','$tid','$pic','$date','$cid')";
    mysql_query($sql2) or die(mysql_error());
    } // end can go
} // end stop 3/if its a class
if ($stop == 0) {
$sql2 = "INSERT INTO `speeches` (`uid`,`tid`,`href`,`created`) VALUES ('$canAccess','$tid','$pic','$date')";
mysql_query($sql2) or die(mysql_error());
} // end stop 0/if its public



  }
else
  {
  echo "Invalid file";
  }




    }


    if ($action=="pushrating") {
    $stop = 0;
if (!isset($_GET['pid']) || empty($_GET['pid'])) {$stop= 1;} else {$pid = $_GET['pid']; $pid = mysql_real_escape_string($pid);}
if (!isset($_GET['email']) || empty($_GET['email'])) {$stop = 1;} else {$email = $_GET['email']; $email = mysql_real_escape_string($email);}
if (!isset($_GET['rating']) || empty($_GET['rating'])) {$stop = 1;} else {$rating = $_GET['rating']; $rating = mysql_real_escape_string($rating);}
$sql = "SELECT * FROM `ratings` WHERE `";
}

if ($action == "profile") {}

if ($action == "uploadvideo") {}


?>