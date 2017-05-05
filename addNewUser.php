<?php

  include('connect.php');

  $newUser = $_POST['usernameinput'];
  $newPassword = $_POST['passwordinput'];

  $insert = mysqli_query($db, "INSERT INTO users (`username`, `password`) VALUES ('".$newUser."','".$newPassword."');");

  if($insert) {
    header("Location: /xampp/breaddit/index.php?status=reg_success");
  }

?>
