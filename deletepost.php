<?php
session_start();
include 'connect.php';
include 'BeginNav.php';
doDB();

if (!isset($_GET['post_id'])) {
  echo '<script type="text/javascript">alert("Cant find that post at this time please select another post or try again later")</script>';
	header("Location: postlist.php");
	exit;
}

$clean_post_id = mysqli_real_escape_string($mysqli, $_GET['post_id']);

$post_sql = "SELECT post_title, post_string FROM forum_posts WHERE post_id = '".$clean_post_id."'  ";

$result = mysqli_query($mysqli, $post_sql) or die(mysqli_error($mysqli));

$result_info = mysqli_fetch_array($result);

$title = $result_info['post_title'];
$text = $result_info['post_string'];


echo'
<h1 style="color:white;">Delete Post</h1>
  <form method="post" action="do_delete_post.php">
    <p>
      <label for="user_email">Post Title:</label><br/>
      <input class="form-control col col-md-3" type="text" id="post_title" value="'.$title.'" name="post_title" size="40" maxlength="150" readonly/> 
    </p>
      <input type="text" id="post_id" name="post_id" value="'.$_GET['post_id'].'" hidden/>
    <p>
      <label for="password">Post Text:</label><br/>
      <textarea type="text" class="form-control col col-md-6" rows="8" cols="40" id="post_text" name="post_text" readonly>"'.$text.'"</textarea>
    </p>

    <div>
    <button style="margin:30px;margin-left:0px;" class="btn btn-danger" type="submit" name="submit" value="submit">Delete My Post</button>
    <small style="color:white;">This action cannot be undone</small>
    </div>

    <input class="btn btn-success" type="button" name="menu" id="menu" value="Return to Menu"onclick="location.href=\'discussionMenu.php\'">
    
  </form>';
    
  include 'EndNav.php';
?>