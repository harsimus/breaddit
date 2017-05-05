<?php
  function dispcategories() {
    include('connect.php');

    $select = mysqli_query($db, "SELECT * FROM categories");

    while ($row = mysqli_fetch_assoc($select)) {
      echo "<table class='category-table'>";
      echo "<tr><td class='main-category' colspan='2'><h2>".$row['category_title']."<h2></td></tr>";
      dispsubcategories($row['cat_id']);
      echo "</table>";
    }
  }

  function dispsubcategories($parent_id) {
    include('connect.php');

    $select = mysqli_query($db, "SELECT cat_id, subcat_id, subcategory_title, subcategory_desc FROM categories, subcategories
                            WHERE ($parent_id = categories.cat_id) AND ($parent_id = subcategories.parent_id)");
    echo "<tr><th width='90%'>Categories</th><th width='10%'>Topics</th></tr>";
    while ($row = mysqli_fetch_assoc($select)) {
      echo "<tr><td class='category_title'><a href='/xampp/breaddit/topics.php?cid=".$row['cat_id']."&scid=".$row['subcat_id']."'>
            </h2><h3>".$row['subcategory_title']."</h3><br />";
      echo $row['subcategory_desc']."</a></td>";
      echo "<td class='num-topics' >".getnumtopics($parent_id, $row['subcat_id'])."</td></tr></br>";
    }
  }

  function getnumtopics($cat_id, $subcat_id) {
    include('connect.php');
    $select = mysqli_query($db, "SELECT category_id, subcategory_id FROM topics WHERE ".$cat_id." = category_id
									  AND ".$subcat_id." = subcategory_id");

    return mysqli_num_rows($select);
  }

  function disptopics($cid, $scid) {
    include('connect.php');

    $select = mysqli_query($db, "SELECT topic_id, author, title, date_posted, views, replies FROM categories, subcategories, topics
									  WHERE ($cid = topics.category_id) AND ($scid = topics.subcategory_id) AND ($cid = categories.cat_id)
									  AND ($scid = subcategories.subcat_id) ORDER BY topic_id DESC");

    if (mysqli_num_rows($select) != 0) {
      echo "<table class='topic-table'>";
			echo "<tr><th>Title</th><th>Posted By</th><th>Date Posted</th><th>Views</th><th>Replies</th></tr>";
			while ($row = mysqli_fetch_assoc($select)) {
				echo "<tr><td><a href='/xampp/breaddit/readtopic.php?cid=".$cid."&scid=".$scid."&tid=".$row['topic_id']."'>
					 ".$row['title']."</a></td><td>".$row['author']."</td><td>".$row['date_posted']."</td><td>".$row['views']."</td>
					 <td>".$row['replies']."</td></tr>";
			}
			echo "</table>";
    }
    else {
      echo "<p>This category has no topics yet. <a href='/xampp/breaddit/newtopic.php?cid=".$cid."&scid=".$scid."'> Be the first to post!</a></p>";
    }
  }

  function disptopic($cid, $scid, $tid) {
    include('connect.php');

    $select = mysqli_query($db, "SELECT cat_id, subcat_id, topic_id, author, title, content, date_posted FROM categories, subcategories, topics
									  WHERE ($cid = categories.cat_id) AND ($scid = subcategories.subcat_id) AND ($tid = topics.topic_id) ORDER BY topic_id DESC");

    $row = mysqli_fetch_assoc($select);
    echo nl2br("<div class='content'><h2 class='title'>".$row['title']."</h2><p><b>".$row['author']."</b>\n<i>".$row['date_posted']."</i></p></div>");
    echo "<div class='content'><p>".$row['content']."</p></div></br>";
  }

  function addview($cid, $scid, $tid) {
    include('connect.php');

    $update = mysqli_query($db, "UPDATE topics SET views = views + 1 WHERE category_id = ".$cid." AND subcategory_id = ".$scid." AND topic_id = ".$tid."");
  }

  function replylink($cid, $scid, $tid) {
    echo "<div class='button'><p><a href='/xampp/breaddit/replyto.php?cid=".$cid."&scid=".$scid."&tid=".$tid."'> Reply to this post</a></p></div>";
  }

  function replytopost($cid, $scid, $tid) {
    echo "<div class='content'><form action='/xampp/breaddit/addreply.php?cid=".$cid."&scid=".$scid."&tid=".$tid."' method='POST'>
          <p>Comment</p>
          <textarea cols='80' rows='5' name='comment' id='comment'></textarea><br />
          <input type='submit' value='Comment' />
          </form></div>";
  }

  function dispreplies($cid, $scid, $tid) {
    include('connect.php');

    $select = mysqli_query($db, "SELECT replies.author, replies.comment, replies.date_posted FROM categories, subcategories, topics, replies
									  WHERE ($cid = replies.category_id) AND ($scid = replies.subcategory_id) AND ($tid = replies.topic_id)
                    AND ($cid = categories.cat_id) AND ($scid = subcategories.subcat_id) AND ($tid = topics.topic_id) ORDER BY reply_id DESC");

    if (mysqli_num_rows($select) != 0) {
      echo "<div class='content'><table class='reply-table'>";
      while ($row = mysqli_fetch_assoc($select)) {
        echo nl2br("<tr><th width='15%'>".$row['author']."</th><td>".$row['date_posted']."\n".$row['comment']."\n\n</td></tr>");
      }
      echo "</table></div>";
      }
  }

  function countReplies($cid, $scid, $tid) {
    include('connect.php');

    $select = mysqli_query($db, "SELECT category_id, subcategory_id, topic_id FROM replies
									  WHERE ".$cid." = category_id AND ".$scid." = subcategory_id AND ".$tid." = replies.topic_id");

    return mysqli_num_rows($select);
  }

 ?>
