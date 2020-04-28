<?php
include 'connect.php';
include 'BeginNav.php';
session_start();

//check to make sure all required data is there
if ( ($_POST['post_title']=="") || ($_POST['post_subject'] =="") || ($_POST['post_user'] =="") || ($_POST['post_string']) ==""){
  header("Location: editpost.php");
  exit;
}

//connect to database;
doDB();


//create clean versions of input strings
$safe_post_title = mysqli_real_escape_string($mysqli, $_POST['post_title']);
$safe_post_subject = mysqli_real_escape_string($mysqli, $_POST['post_subject']);
$safe_post_user = mysqli_real_escape_string($mysqli, $_POST['post_user']);
$safe_post_string = mysqli_real_escape_string($mysqli, $_POST['post_string']);


//take the values stored in the session variables. see if they have changed. if so update the database. If not then don't worry about updating that piece of information.

if (($safe_post_title !== $_SESSION["post_title"])){

  //find the title in the database and the update it. 
  $update_post_title_sql = "UPDATE forum_posts SET post_title ='".$safe_post_title."'WHERE post_id ='". $_SESSION['id']."'";
  mysqli_query($mysqli, $update_post_title_sql) or die(mysqli_error($mysqli));
  
}

if (($safe_post_user !== $_SESSION["post_user"])){
  //see if the topic owner exists
  
  $user_check_sql = "SELECT user_id FROM users WHERE  user_name ='".$safe_post_user."' ";

  $result = $mysqli->query($user_check_sql);
  $row = $result ->fetch_assoc();
  //If he does exist then find his id and create a variabel to hold that value

  if ($result -> num_rows > 0){
    
    $GLOBALS['userId'] = (int)$row["user_id"];
    
  } else {
    
    //If he does not exist then add his email as his user name as a user. 
    //Then get his user id and then add his id to the topic before sending it to the posts table

    $user_add_sql = "INSERT INTO users (user_name) VALUES ('".$safe_post_user."')";

      if ($mysqli->query($user_add_sql) === TRUE){
        $user_check_sql = "SELECT user_id FROM users WHERE  user_name ='".$safe_post_user."' ";

        $result = $mysqli->query($user_check_sql);
        $row = $result -> fetch_assoc();
        $GLOBALS['userId'] = (int)$row["user_id"];
        
      }
  }

  //now we need to update the post with the correct user id
  $post_update_user_sql = "UPDATE forum_posts SET user_id = '".$GLOBALS['userId']."' WHERE post_id = '".$_SESSION['id']."'";
  
  mysqli_query($mysqli, $post_update_user_sql) or die(mysqli_error($mysqli));
  
  
  
  header("Location: showpost.php?post_id=".$_SESSION['id']);
}

$post_update_text = "UPDATE forum_posts SET post_string = '".$safe_post_string."' WHERE post_id = '".$_SESSION['id']."'";
mysqli_query($mysqli, $post_update_text) or die(mysqli_error($mysqli));
header("Location: showpost.php?post_id=".$_SESSION['id']);
