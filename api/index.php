<?php
error_reporting(error_reporting() & ~E_NOTICE);
$data = $_GET['data'];
$type = $_GET['range'];
$miner = $_GET['dtx'];
$worker = $_GET['wrk'];
$lol = $_GET['rr'];


function mysql_fix_escape_string($text){
    if(is_array($text)) 
        return array_map(__METHOD__, $text); 
    if(!empty($text) && is_string($text)) { 
        return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), 
                           array('', '', '', '', "", '', ''),$text); 
    } 
    $text = str_replace("'","",$text);
    $text = str_replace('"',"",$text);
    return $text;
}

$data = mysql_fix_escape_string($data);
$type = mysql_fix_escape_string($type);
$miner = mysql_fix_escape_string($miner);
$worker = mysql_fix_escape_string($worker);
$lol = mysql_fix_escape_string($lol);


if ($data == 'hashrate_beta' || $type == '123') {
$configs = include('../../config.php');
$mysqli=mysqli_connect($config['host'], $config['username'], $config['password'], $config['bdd']) or die("Database Error");
$existQuery = "SELECT votepower,val_timestamp FROM stats ORDER BY id ASC";
$existResult = mysqli_query($mysqli,$existQuery)or die("Database Error");
$count = mysqli_num_rows($existResult);
$x++;
$miner_payouts = array();
echo '[';
while ($row=mysqli_fetch_row($existResult)){
	$stamp = $row[1]*1000;
	if (!isset($miner_payouts["'$stamp'"])) {
		$real = $row[1]/1000000;
    	$miner_payouts["'$stamp'"] = $real;
    } else {
    	$miner_hashrate_fix = $miner_payouts["'$stamp'"] + $real;
    	$miner_payouts["'$stamp'"] = $miner_hashrate_fix;
    }
}
$miner_payout2 = array();
$count = count($miner_payouts);
foreach ($miner_payouts as $key => $value) {
	$stamp = str_replace('"', '', $key);
	$stamp = str_replace("'", '', $stamp);
	$x++;
	if ($x == 61) {
		$x = 0;
		$hashrateMinute = $hashrateMinute/60;
		$miner_payout2["'$stamp'"] = $hashrateMinute;
		$hashrateMinute = 0;
	} else {
		$hashrateMinute = $hashrateMinute + $value;
	}
}

$x = 0;
$count = count($miner_payout2);
foreach ($miner_payout2 as $key => $value) {
	$stamp = str_replace('"', '', $key);
	$stamp = str_replace("'", '', $stamp);
	$x++;
	    echo '['.$stamp.','.$value.']';
    if ($x != $count) {
    	echo ',';	
    }
}



echo ']';



} else if ($data == 'hashrate' && !$miner) {




$config = include('../../config.php');
$mysqli=mysqli_connect($config['host'], $config['username'], $config['password'], $config['bdd']) or die("Database Error");
$existQuery = "SELECT votepower,val_timestamp FROM pool_votepower ORDER BY id ASC";
$existResult = mysqli_query($mysqli,$existQuery)or die("Database Error");
$count = mysqli_num_rows($existResult);
$x++;
$miner_payouts = array();
echo '[';
while ($row=mysqli_fetch_row($existResult)){
	$stamp = $row[1]*1000;
	$real = $row[0];///(1000*1000);
	$x++;
	    echo '['.$stamp.','.$real.']';
    if ($x-1 != $count) {
    	echo ',';
    }
}
echo ']';



} else if ($data == 'miner_hashrate' || $type == 'max' && $miner && !$worker && !$lol) {
$x=0;
$config = include('../../config.php');
$mysqli=mysqli_connect($config['host'], $config['username'], $config['password'], $config['bdd']) or die("Database Error");
	$existQuery = "SELECT votepower,val_timestamp FROM miner_votepower WHERE miner='$miner' ORDER BY id ASC";
	$existResult = mysqli_query($mysqli,$existQuery)or die("Database Error");
	$count = mysqli_num_rows($existResult);
	while ($row=mysqli_fetch_row($existResult)){
		$stamp = $row[1]*1000;
		$real = $row[0]/1000000;

		if (!$previous) {
			$previous = $real;
		}

		$miner_payouts["'$stamp'"] = $real;
		$previous = $real;
	}	



echo '[';

$count = count($miner_payouts);
foreach ($miner_payouts as $key => $value) {
	$stamp = str_replace('"', '', $key);
	$stamp = str_replace("'", '', $stamp);
	$x++;
	    echo '['.$stamp.','.$value.']';
    if ($x != $count) {
    	echo ',';
    }
}
echo ']';



} else if ($data == 'pool_balance' && !$miner) {



$config = include('../../config.php');
$mysqli=mysqli_connect($config['host'], $config['username'], $config['password'], $config['bdd']) or die("Database Error");
$existQuery = "SELECT value,var_timestamp FROM pool_balance ORDER BY id ASC";
$existResult = mysqli_query($mysqli,$existQuery)or die("Database Error");
$count = mysqli_num_rows($existResult);
$x++;
$miner_payouts = array();
echo '[';
while ($row=mysqli_fetch_row($existResult)){
	$stamp = $row[1]*1000;
	$real = $row[0];
	$x++;
	    echo '['.$stamp.','.$real.']';
    if ($x-1 != $count) {
    	echo ',';
    }
}
echo ']';



} else if ($data == 'pool_miners' && !$miner) {




$config = include('../../config.php');
$mysqli=mysqli_connect($config['host'], $config['username'], $config['password'], $config['bdd']) or die("Database Error");
$existQuery = "SELECT value,var_timestamp FROM pool_voters ORDER BY id ASC";
$existResult = mysqli_query($mysqli,$existQuery)or die("Database Error");
$count = mysqli_num_rows($existResult);
$x++;
$miner_payouts = array();
echo '[';
while ($row=mysqli_fetch_row($existResult)){
	$stamp = $row[1]*1000;
	$real = $row[0];
	$x++;
	    echo '['.$stamp.','.$real.']';
    if ($x-1 != $count) {
    	echo ',';
    }
}
echo ']';



} else if ($data == '_miner_balance' && $miner && $lol) {


$config = include('../../config.php');
$mysqli=mysqli_connect($config['host'], $config['username'], $config['password'], $config['bdd']) or die("Database Error");
$existQuery = "SELECT value,var_timestamp FROM miner_balance WHERE miner='$miner' ORDER BY id ASC";
$existResult = mysqli_query($mysqli,$existQuery)or die("Database Error");
$count = mysqli_num_rows($existResult);
$x++;
$miner_payouts = array();
echo '[';
while ($row=mysqli_fetch_row($existResult)){
	$stamp = $row[1]*1000;
	$real = $row[0];
	$x++;
	    echo '['.$stamp.','.$real.']';
    if ($x-1 != $count) {
    	echo ',';
    }
}
echo ']';



}

?>
