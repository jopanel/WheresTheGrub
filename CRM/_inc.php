<?php
set_time_limit(0);
ini_set('max_execution_time', 0);
error_reporting(E_ALL ^ E_DEPRECATED);

//MYSQL data MODIFY TO FIT YOUR DATABASE
$mysql_host = "mysql.wheresthegrub.com";
$mysql_database = "wheresgrub";
$mysql_user = "wtg_mysql";
$mysql_password = "Gingerbread1$";
//Connect to Database
ini_set('display_errors', '1');
$con = mysql_connect($mysql_host, $mysql_user, $mysql_password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
$con2 = mysql_select_db($mysql_database, $con);
if (!$con2)
  {
  die('Could not connect: ' . mysql_error());
  }
if (!isset($_SESSION['loggedin']) || empty($_SESSION['loggedin'])) { 
	$_SESSION['loggedin']=0;
}

function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
function whatsthedate(){
		$today = getdate();
		$year = $today['year'];
		$mday = $today['mday'];
		$mon = $today['mon'];
		$date = "$year-$mon-$mday";
		return $date;
}
function file_get_contents_curl($url) {
                        
    $options = array(
      CURLOPT_RETURNTRANSFER  => true,          // return web page
      CURLOPT_HEADER          => false,         // don't return headers
      //CURLOPT_PROXY       => $random_proxy,         // the HTTP proxy to tunnel request through
      //CURLOPT_HTTPPROXYTUNNEL => 1,           // tunnel through a given HTTP proxy      
      CURLOPT_FOLLOWLOCATION  => true,          // follow redirects
      CURLOPT_ENCODING        => "",            // handle compressed
      CURLOPT_USERAGENT       => 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.0',   // who am i
      CURLOPT_AUTOREFERER     => true,          // set referer on redirect
      CURLOPT_SSL_VERIFYPEER  => false,
      CURLOPT_CONNECTTIMEOUT  => 20,            // timeout on connect
      CURLOPT_TIMEOUT         => 20,            // timeout on response
      CURLOPT_MAXREDIRS       => 10,            // stop after 10 redirects
    );
  
    $ch      = curl_init( $url );
    curl_setopt_array( $ch, $options );
    $content = curl_exec( $ch );
    curl_close( $ch );
    
    return $content;
}
function _GET($QS , $defaultValue, $addslashes = false)
{
  if(isset($_GET[$QS])){
    if($addslashes)
      return  mysql_escape_string($_GET[$QS]);
    else
      return  $_GET[$QS];
  }else
    return  $defaultValue;
}

function _POST($QS , $defaultValue, $addslashes = false)
{
  if(isset($_POST[$QS])){
    if($addslashes)
      return  mysql_escape_string($_POST[$QS]);
    else
      return  $_POST[$QS];
  }else
    return  $defaultValue;
}
function _REQUEST($QS , $defaultValue, $addslashes = false)
{
  if(isset($_REQUEST[$QS])){
    if($addslashes)
      return  mysql_escape_string($_REQUEST[$QS]);
    else
      return  $_REQUEST[$QS];
  }else
    return  $defaultValue;
}


function get_web_page( $url )
  {
    
    $proxies_array  = array(
                '173.208.91.117:3128',
                '173.208.39.106:3128',
                '173.234.57.8:3128',
                '173.234.250.161:3128',
                '173.234.181.127:3128',
                '173.208.91.201:3128',
                '173.234.57.249:3128'
              );
              
    $random_key     = array_rand($proxies_array);
    $random_proxy     = $proxies_array[$random_key];          
              
    $useragents_array = array(
                'Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.0.11) Gecko Kazehakase/0.5.4 Debian/0.5.4-2.1ubuntu3',
                'Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.8.1.13) Gecko/20080311 (Debian-1.8.1.13+nobinonly-0ubuntu1) Kazehakase/0.5.2',
                'Mozilla/5.0 (X11; Linux x86_64; U;) Gecko/20060207 Kazehakase/0.3.5 Debian/0.3.5-1',
                'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; KKman2.0)',
                'Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.8.1.4) Gecko/20070511 K-Meleon/1.1',
                'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9) Gecko/2008052906 K-MeleonCCFME 0.09',
                'Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.8.0.7) Gecko/20060917 K-Meleon/1.02',
                'Mozilla/5.0 (Windows; U; Win 9x 4.90; en-US; rv:1.7.5) Gecko/20041220 K-Meleon/0.9',
                'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.5) Gecko/20031016 K-Meleon/0.8.2',
                'Mozilla/5.0 (Windows; U; Win98; en-US; rv:1.5) Gecko/20031016 K-Meleon/0.8.2',
                'Mozilla/5.0 (Windows; U; WinNT4.0; en-US; rv:1.5) Gecko/20031016 K-Meleon/0.8',
                'Mozilla/5.0 (Windows; U; WinNT4.0; en-US; rv:1.2b) Gecko/20021016 K-Meleon 0.7',
                'Mozilla/5.0 (Windows; U; WinNT4.0; en-US; rv:0.9.5) Gecko/20011011',
                'Mozilla/5.0(Windows;N;Win98;m18)Gecko/20010124',
                'Mozilla/5.0 (compatible; Konqueror/4.0; Linux) KHTML/4.0.5 (like Gecko)',
                'Mozilla/5.0 (compatible; Konqueror/4.0; Microsoft Windows) KHTML/4.0.80 (like Gecko)',
                'Mozilla/5.0 (compatible; Konqueror/3.92; Microsoft Windows) KHTML/3.92.0 (like Gecko)',
                'Mozilla/5.0 (compatible; Konqueror/3.5; GNU/kFreeBSD) KHTML/3.5.9 (like Gecko) (Debian)',
                'Mozilla/5.0 (compatible; Konqueror/3.5; Darwin) KHTML/3.5.6 (like Gecko)'
              );
              
    $random_key     = array_rand($useragents_array);
    $random_useragent   = $useragents_array[$random_key];             

                          
    $options = array(
      CURLOPT_RETURNTRANSFER  => true,          // return web page
      CURLOPT_HEADER          => false,         // don't return headers
      //CURLOPT_PROXY       => $random_proxy,         // the HTTP proxy to tunnel request through
      //CURLOPT_HTTPPROXYTUNNEL => 1,           // tunnel through a given HTTP proxy      
      CURLOPT_FOLLOWLOCATION  => true,          // follow redirects
      CURLOPT_ENCODING        => "",            // handle compressed
      CURLOPT_USERAGENT       => "Googlebot/2.1 (+http://www.google.com/bot.html)",   // who am i
      CURLOPT_AUTOREFERER     => true,          // set referer on redirect
      CURLOPT_CONNECTTIMEOUT  => 120,           // timeout on connect
      CURLOPT_TIMEOUT         => 20,            // timeout on response
      CURLOPT_MAXREDIRS       => 10,            // stop after 10 redirects
    );
  
    $ch      = curl_init( $url );
    curl_setopt_array( $ch, $options );
    $content = curl_exec( $ch );
    curl_close( $ch );
    
    return $content;
}

function check_int_val($val){
  if(preg_match("/^\d{1,2}$/", stripslashes(trim($val)))) {
    return $val;
  }else{
  return 1;
  }
}

function scanyelp($kw) {
  $start_seconds = 3;
$end_seconds = 8;

$tld = ".com";

$keywords = trim(strip_tags(strtolower(_POST('keywords', '', true))));
$location = trim(strip_tags(strtolower(_POST('location', '', true))));
$distance = trim(strip_tags(strtolower(_POST('distance', '', true))));
$how_many     = trim(_POST("how_many", "1", true));
$how_many     =   check_int_val($how_many);
}

function scanyellowpages($kw) {
  

$your_yp_key = "b0z4gb3zsf";
$totalinserted = 0;
$mile = "20";
$max = "100";
$keyword =  strtolower(trim(strip_tags($kw)));
  $location="90713";
  $count = 1;
  $data = "";
  $xlsData  = array();
  $xlsData[] = "Name  Address Phone  Open Hours  Payment Methods Categories  Claimed YP URL"."\n";
$haskid = 0;
  $sql2 = "SELECT * FROM `keywords` WHERE `name`='$kw'";
  $result2 = mysql_query($sql2) or die (mysql_error());
  while($row2 = mysql_fetch_array($result2)) {
    $haskid = 1;
    $kid = $row2['id'];
  }
  if ($haskid == 0) {
    $todaysdate = whatsthedate();
$sql2="INSERT INTO `keywords` (`name`,`scan`) VALUES ('$kw','$todaysdate')";
  mysql_query($sql2) or die(mysql_error());
  $sql3 = "SELECT * FROM `keywords` WHERE `name`='$kw'";
  $result3 = mysql_query($sql3) or die (mysql_error());
  while ($row3 = mysql_fetch_array($result3)) {
$kid = $row3['id'];
  }
  } // end has kid
  if (!isset($kid) || empty($kid)) {$kid = 0;} // just in case
  $duplicatesarr = [];
$getaddy = "SELECT * FROM `leads`";
$resultaddy = mysql_query($getaddy) or die(mysql_error());
while ($addy = mysql_fetch_array($resultaddy)) {
$duplicatesarr[] = $addy['address']." ".$addy['name'];
}
$sql10 = "SELECT * FROM `zip_code`";
$result10 = mysql_query($sql10) or die(mysql_error());
while($row0 = mysql_fetch_array($result10)){
$location = $row0['zip_code'];
  for($i=1;$i<=$max;$i++){  
  $content = @file_get_contents_curl("http://pubapi.yp.com/search-api/search/devapi/search?searchloc=".urlencode($location)."&term=".urlencode($keyword)."&format=json&sort=distance&radius=".$mile."&listingcount=50&key=$your_yp_key&pagenum=$i");
  $json = json_decode($content,true);
  if (!isset($content) || empty($content)) {} else {
  $listingcount = $json['searchResult']['metaProperties']['listingCount'];
  //if (!isset($json['searchResult']['searchListings']['searchListing']) || empty($json['searchResult']['searchListings']['searchListing'])) {} else {
  foreach ($json['searchResult']['searchListings']['searchListing'] as $value) {
    $listingid = $value['listingId'];
    //$details =  file_get_contents_curl("http://pubapi.yp.com/search-api/search/devapi/details?listingid=$listingid&format=json&key=$your_yp_key");
    //$djson = json_decode($details,true);
    
    $name = $value['businessName'];
    $url = $value['businessNameURL'];
    $address = $value['street'].", ".$value['city']." ".$value['state'].", ".$value['zip'];
    $weburl   = isset($djson['listingsDetailsResult']['listingsDetails']['listingDetail'][0]['extraWebsiteURLs']['extraWebsiteURL'][0]) ? $djson['listingsDetailsResult']['listingsDetails']['listingDetail'][0]['extraWebsiteURLs']['extraWebsiteURL'][0] : "";
    $weburlarray = explode("dest=",$weburl);
   if (!isset($weburlarray[1]) || empty($weburlarray[1])) {$website = ""; } else { $website = urldecode($weburlarray[1]); }
    $phone   = $value['phone'];
    //$email   = isset($djson['listingsDetailsResult']['listingsDetails']['listingDetail'][0]['extraEmails']['extraEmail'][0]) ? $djson['listingsDetailsResult']['listingsDetails']['listingDetail'][0]['extraEmails']['extraEmail'][0] : "";
    $openhours = $value['openHours'];
    //$rating = $value['averageRating'];
    if (!isset($value['categories']) || empty($value['categories'])) { $nocats = 1; $categories = ""; } else {
    $categories = $value['categories'];
    $categories = mysql_real_escape_string($categories);
    $catarray = explode("|",$categories);
    $nocats = 0;
  }

    $paymentmethods = $value['paymentMethods'];
    $cla = $value['claimedStatus'];
    if($cla == "1"){
      $claimed = "Yes";
    }else{
      $claimed = "No";
    } 
      $name = mysql_real_escape_string($name);
      $address = mysql_real_escape_string($address);
    $isshopthere = 0;
    if (in_array($address." ".$name, $duplicatesarr)){
      $isshopthere = 1;
    }
//sleep(1);
    if ($isshopthere == 0) {
      $phone = mysql_real_escape_string($phone);
      $openhours = mysql_real_escape_string($openhours);
      $url = mysql_real_escape_string($url);
      $sql5 = "INSERT INTO `leads` (`kid`,`name`,`address`,`phone`,`openhours`,`urlsource`,`categories`, `website`) VALUES ('$kid','$name','$address','$phone','$openhours','$url','$categories','$website')";
      mysql_query($sql5) or die(mysql_error());
      $sql6 = "SELECT id FROM leads WHERE `name`='$name' ORDER BY id DESC LIMIT 1";
      $result2 = mysql_query($sql6) or die(mysql_error());
      while ($row = mysql_fetch_array($result2)) {
        if ($nocats == 0) {
        foreach ($catarray as $catvalue) {
          $sql7 = "INSERT INTO `categories` (`lid`,`name`) VALUES ('".$row['id']."', '".$catvalue."')";
          mysql_query($sql7) or die(mysql_error());
        }
      }
      }
      $totalinserted += 1;
    }

  
//} // end if search listing empty
$count++;
}
  }

 } // end of finding zip codes
 

}
echo "There is a grand total of ".$totalinserted." inserted into the database.";
}

?>