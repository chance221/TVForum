<?php
include 'BeginNav.php';
include 'connect.php';

doDB();

//get the input and clean it. Store it in a variable.
if (!$_POST['post_id']){

  $display_block= "We could not locate that user. <a href='postlist.php'><h4>Back To Posts</h4></a>";

	// header("Location: deleteuser.php");
	// exit;
} else {
  //check to make sure the user exists.
  $clean_id = mysqli_real_escape_string($mysqli, $_POST['post_id']);

  $post_check_sql = "SELECT post_title FROM forum_posts WHERE post_id ='".$_POST['post_id']."' ";

  $result = $mysqli->query($post_check_sql);
  $row = $result ->fetch_assoc();

  if($result -> num_rows > 0) {
    
      $post_delete_sql = "DELETE FROM forum_posts WHERE post_id = '".$clean_id."'";

      $delete_user_res = mysqli_query($mysqli, $post_delete_sql) or die(mysqli_error($mysqli));

      $display_block = "<p>The post <strong>".$_POST["post_title"]."</strong> has been deleted.</p>";
    
    

  } else {
  
  $display_block = "It looks like we cannot locate an account with that email and password. Please try again.";
  $display_block .= "<a href='deleteuser.php'><h6>Try Again</h6></a>";
  }


}

echo '<section style="color:white;">' . $display_block. '</section>';

include 'EndNav.php';
 //If he does confirm that they would like to continue and then move forward with deletion

//if they do not exist inform the user and snd them back to the deletion page


?>