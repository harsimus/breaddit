<?php
	session_start();

	include ('connect.php');

	$cid = $_GET['cid'];
	$scid = $_GET['scid'];
	$tid = $_GET['tid'];
	$rid = $_GET['rid'];

	$delete = mysqli_query($db, "DELETE FROM replies WHERE reply_id = ".$rid."");

	if ($delete) {
		header("Location: /xampp/breaddit/readtopic.php?cid=".$cid."&scid=".$scid."&tid=".$tid."");
	}
?>
