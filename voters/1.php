<?php

$place_holderx="PlaceHolder";
$user_input=$_GET['id'];
if (empty($user_input))
	$user_input = '""';

die('<input type="text" class="form-control" id="address" name="address" value=' .$user_input. ' placeholder='.$place_holderx.'  minlength="15" required >');


?>

