<?php
include 'BeginNav.php';
include 'connect.php';

doDB();

//get the input and clean it. Store it in a variable.
if ((!$_POST['user_email']) || (!$_POST['password'])){

  $display_block= "We could not locate that user. <a href='deleteuser.php'><h4>Try Again</h4></a>";

	// header("Location: deleteuser.php");
	// exit;
} else {
  //check to make sure the user exists.
  $clean_email = mysqli_real_escape_string($mysqli, $_POST['user_email']);
  $clean_password = mysqli_real_escape_string($mysqli, $_POST['password']);

  $user_check_sql = "SELECT email, password FROM auth_users WHERE email ='".$clean_email."' ";

  $result = $mysqli->query($user_check_sql);
  $row = $result ->fetch_assoc();

if($result -> num_rows > 0) {
  if ($row['password'] == $clean_password){
    $user_delete_sql = "DELETE FROM auth_users WHERE email = '".$clean_email."'";

    $delete_user_res = mysqli_query($mysqli, $user_delete_sql) or die(mysqli_error($mysqli));

    $display_block = "<p>The user <strong>".$_POST["username"]."</strong> has been deleted.</p>";
  } else {
    
    $display_block = "It looks like we cannot locate an account with that email and password. Please try again.";
  
  }

} else {
  
  $display_block = "It looks like we cannot locate an account with that email and password. Please try again.";

}

$display_block .= "<a href='deleteuser.php'><h6>Try Again</h6></a>";

echo '<section style="color:white;">' . $display_block. '</section>';

include 'EndNav.php';
}
 //If he does confirm that they would like to continue and then move forward with deletion

//if they do not exist inform the user and snd them back to the deletion page


?>