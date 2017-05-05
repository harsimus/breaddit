<?php

  include('connect.php');

  $comment = nl2br(addslashes($_POST['comment']));

  $cid = $_GET['cid'];
  $scid = $_GET['scid'];
  $tid = $_GET['tid'];

  $insert = mysqli_query($db, "INSERT INTO replies (`category_id`, `subcategory_id`, `topic_id`, `author`, `comment`, `date_posted`)
                               VALUES ('".$cid."', '".$scid."', '".$tid."', '".$_SESSION['username']."', '".$comment."', NOW());");

  if($insert) {
    header("Location: /xampp/breaddit/readtopic.php?cid=".$cid."&scid=".$scid."&tid=".$tid."");
  }

?>
