

<?php
include 'BeginNav.php';
include 'connect.php';
doDB();
$con = $mysqli;
global $userId;



//check for required fields from the form
if ((!$_POST['topic_owner']) || (!$_POST['topic_title']) || (!$_POST['post_text']) || (!$_POST['post_title']))  {
	header("Location: addtopic.php");
	exit;
}

//create safe values for input into the database
$clean_topic_owner = mysqli_real_escape_string($mysqli, $_POST['topic_owner']);
$clean_topic_title = mysqli_real_escape_string($mysqli, $_POST['topic_title']);
$clean_post_text = mysqli_real_escape_string($mysqli, $_POST['post_text']);
$clean_post_title = mysqli_real_escape_string($mysqli, $_POST['post_title']);

//see if the user exists
//now we need to find the user ID and add it to the topic

$find_user_sql = "SELECT id FROM auth_users WHERE username = '".$clean_topic_owner."' ";

$userResult = mysqli_query($mysqli, $find_user_sql);

if(!$userResult){

	die ("unable to access database" . mysqli_error($mysqli));

}
if(mysqli_num_rows($userResult)){

	$userRow = $userResult->fetch_assoc();

	$userId = $userRow['id'];
} else {
	
	$display_block = "<H3>It Doesn't look like we found you as a user. Please enter a valid user name <a href='addtopic.php'>Try Again</a></H3>";

}

//see if the topic exists
$user_check_sql = "SELECT subject_title, subject_id FROM forum_subjects WHERE subject_title ='".$clean_topic_title."' ";

$result = $con->query($user_check_sql);

$row = $result ->fetch_assoc();
//If he does exist then find his id and create a variabel to hold that value

if ($result -> num_rows > 0){
	
	//get the existing subject id if it is in the database.

	$topic_id = $row['subject_id'];
  
} else if($userId){
		//if it doesnt exist add the subject to the database but first we need to find the ID	
	

		$add_topic_sql = "INSERT INTO forum_subjects (subject_title, subject_create_time, user_id) VALUES ('".$clean_topic_title ."', now(), '". $userId."')";

		$add_topic_res = mysqli_query($mysqli, $add_topic_sql) or die(mysqli_error($mysqli));

		//get the id of the last query
		$topic_id = mysqli_insert_id($mysqli);
	
}

if(($userId)&&($topic_id)){

//Now we have the user and topic id we can add them to the posts
$add_post_sql = "INSERT INTO forum_posts (subject_id, post_string, post_create_time, user_id, post_title) VALUES ('".$topic_id."', '".$clean_post_text."',  now(), '".$userId."', '". $clean_post_title ."')";

//send the topic to the database
$add_post_res = mysqli_query($mysqli, $add_post_sql) or die(mysqli_error($mysqli));

//close connection to MySQL
mysqli_close($mysqli);

//create nice message for user
$display_block = "<title>New Post Added</title><br><h1>New Post Added</h1><p>The post <strong>".$_POST["post_title"]."</strong> has been created.</p>";

}

?>
<!DOCTYPE html>
<html>
<head>

<link href="discussion.css" rel="stylesheet" type="text/css" />
</head>
<body>

<?php
	
?>

<?php
	
	echo $display_block; 

?>

<?php include 'EndNav.php'; ?>
</body>
</html>
