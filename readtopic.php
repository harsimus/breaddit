<?php
  include ('layout_manager.php');
  include ('content_function.php');
  addview($_GET['cid'], $_GET['scid'], $_GET['tid']);
?>
<html>
  <head>
    <title>breaddit</title>
    <link href="/xampp/breaddit/css/main.css" type="text/css" rel="stylesheet" />
  </head>
  <body>
    <div>
      <h1>breaddit</h1>
    </div>
    <div>
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
    <div>
      <?php
        replylink($_GET['cid'], $_GET['scid'], $_GET['tid']);
       ?>
    </div>
    <div  class="content">
      <?php
        disptopic($_GET['cid'], $_GET['scid'], $_GET['tid']);
        echo "<div class='content'><p>All Replies (".countReplies($_GET['cid'], $_GET['scid'], $_GET['tid']).")</p></div>";
        dispreplies($_GET['cid'], $_GET['scid'], $_GET['tid']);
       ?>
    </div>
  </body>
</html>
