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

?>


