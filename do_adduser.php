<?php
session_start();
?>

<?php
include 'connect.php';
include 'BeginNav.php';
doDB();


//check for required fields from the form
if ((!$_POST['new_user_email']) || 
(!$_POST['f_name']) || 
(!$_POST['l_name']) ||
(!$_POST['username'])  || 
(!$_POST['password'])) {
	header("Location: adduser.php");
	exit;
}

$clean_email = mysqli_real_escape_string($mysqli, $_POST['new_user_email']);
$clean_f_name = mysqli_real_escape_string($mysqli, $_POST['f_name']);
$clean_l_name = mysqli_real_escape_string($mysqli, $_POST['l_name']);
$clean_username = mysqli_real_escape_string($mysqli, $_POST['username']);
$clean_password = mysqli_real_escape_string($mysqli, $_POST['password']);

$user_check_sql = "SELECT email FROM auth_users WHERE email ='".$clean_email."' ";

$result = $mysqli->query($user_check_sql);
$row = $result ->fetch_assoc();

if($result -> num_rows > 0) {
  $display_block = "It looks like you already have an account with that email. Please log in.";
} else {
  $user_add_sql = "INSERT INTO auth_users (f_name, l_name, email, username, password) 
  VALUES ('".$clean_f_name."', '".$clean_l_name."', '".$clean_email."', '".$clean_username."', '".$clean_password."'  ) " ;

  $add_user_res = mysqli_query($mysqli, $user_add_sql) or die(mysqli_error($mysqli));

  $display_block = "<p>The user <strong>".$_POST["username"]."</strong> has been created.</p>";
}

echo '<section>' . $display_block. '</section>';

include 'EndNav.php';

