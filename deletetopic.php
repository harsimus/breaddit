<?php
  session_start();
  include('connect.php');

	$cid = $_GET['cid'];
	$scid = $_GET['scid'];
  $tid = $_GET['tid'];

  $delete = mysqli_query($db, "DELETE FROM topics WHERE topic_id = ".$tid."");

	if ($delete) {
		header("Location: /xampp/breaddit/topics.php?cid=".$cid."&scid=".$scid."");
	}

?>
