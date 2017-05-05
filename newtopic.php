<?php
  include ('layout_manager.php');
  include ('content_function.php');
?>
<html>
  <head>
    <title>breaddit</title>
    <link href="/xampp/breaddit/css/main.css" type="text/css" rel="stylesheet" />
  </head>
  <body>
    <div class="header">
      <div class="title">
        <h1><a href="/xampp/breaddit/">breaddit</a></h1>
      </div>
      <p><i></i></p>
      <div class="login">
        <?php
          session_start();
          if(isset($_SESSION['username'])) {
            logout();
          }
          else {
            if(isset($_GET['status'])) {
              if($_GET['status'] == 'reg_success') {
                echo "<h1 style='color:green;'>New user registered successfully!</h1>";
              }
              else if ($_GET['status'] == 'login_fail') {
                echo "<h1 style='color:red;'>Invalid username and/or password</h1>";
              }
            }
            loginform();
          }
         ?>
      </div>
    </div>
    <!-- <div>
      <h3>Write a new topic!</h3>
    </div> -->
    <div  class="content">
      <?php
        if (isset($_SESSION['username'])) {
          echo "<form action='/xampp/breaddit/addnewtopic.php?cid=".$_GET['cid']."&scid=".$_GET['scid']."' method='POST'>
						  <p><b>Title: </b></p>
						  <input type='text' id='topic' name='topic' size='100' />
						  <p><b>Content: </b></p>
						  <textarea id='content' name='content' rows='20' cols='98'></textarea><br />
						  <input type='submit' value='Post' /></form>";
				} else {
					echo "<p>Please login first or <a href='/xampp/breaddit/register.html'>click here</a> to register.</p>";
				}
       ?>
    </div>
  </body>
</html>
