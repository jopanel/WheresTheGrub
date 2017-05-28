<?php 
$allnum = array("00","0",1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36);
$fourfiddy = array(5,8,11,14,17,20,23,26,29,32);
$twotwofive = array(6,9,4,7,18,21,16,19,30,33,28,31);
$totaltimestorun = 5;
$totaltimesplay = 5;
$timesnegative = 0;
$timespositive = 0;
$totalbalance = 0;
for ($ii = 1; $ii <= $totaltimestorun; $ii++) {
	$balance = 20;
	for ($i = 1; $i <= $totaltimesplay; $i++) {
	(float)$balance -= 2; // pay the $2 to play
	$randnum = $allnum[array_rand($allnum, 1)];
	if (in_array($randnum, $fourfiddy)) {
		(float)$balance += 4.50;
	} elseif (in_array($randnum, $twotwofive)) {
		(float)$balance += 3.25;
	} else {
		(float)$balance -= 2;
	}
}
$balance -= 20; // remove original starting balance to get only profits/losses
if ($balance > 0) { $timespositive += 1; }
if ($balance < 0) { $timesnegative += 1; }
$totalbalance += $balance;

}
echo "<center>Playing the same setup <strong>".$totaltimesplay."</strong> times on average the outcome was <strong style='color :red'> negative ".$timesnegative." times </strong> and was <strong style='color:green;'>positive ".$timespositive." times </strong>. Ending $".$totalbalance;
echo "<br><br><img src='board.JPG' style='width:800px; height:600px'>";
?>