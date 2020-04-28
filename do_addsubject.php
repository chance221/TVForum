
<?php
include 'connect.php';
doDB();
$con = $mysqli;
global $userId;
$display_block = "This is not working";
//check for required fields from the form
if ((!$_POST['topic_owner']) || (!$_POST['topic_title'])) {
	header("Location: addsubject.php");
	exit;
}

//create safe values for input into the database
$clean_topic_owner = mysqli_real_escape_string($mysqli, $_POST['topic_owner']);
$clean_topic_title = mysqli_real_escape_string($mysqli, $_POST['topic_title']);


//see if the topic owner exists

$user_check_sql = "SELECT id FROM auth_users WHERE  username ='".$clean_topic_owner."' ";

$result = $con->query($user_check_sql);
$row = $result ->fetch_assoc();
//If he does exist then find his id and create a variabel to hold that value


if ($result -> num_rows > 0){
	
	$userId = (int)$row["id"];
	
	$add_topic_sql = "INSERT INTO forum_subjects (subject_title, subject_create_time, user_id) VALUES ('".$clean_topic_title ."', now(), '". $userId."')";

		$add_topic_res = mysqli_query($mysqli, $add_topic_sql) or die(mysqli_error($mysqli));

		//get the id of the last query
		$topic_id = mysqli_insert_id($mysqli);

		//create and issue the second query


		//close connection to MySQL
		mysqli_close($mysqli);

		//create nice message for user
		$display_block = "<p>The <strong>".$_POST["topic_title"]."</strong> topic has been created.</p>";
   
} else if($result -> num_rows == 0) {
	
	//If he does not exist REROUTE. 
	//Then get his user id and then add his id to the topic before sending it to the posts table
	
	$display_block= "<h3>No valid user found with that username. Please <a href='addsubject.php'>try again</a></h3>";
		
	//$user_add_sql = "INSERT INTO users (user_name) VALUES ('".$clean_topic_owner."')";

		// if ($con->query($user_add_sql) === TRUE){
    //   $user_check_sql = "SELECT user_id FROM users WHERE  user_name ='".$clean_topic_owner."' ";

    //   $result = $con->query($user_check_sql);
    //   $row = $result -> fetch_assoc();
		// 	$GLOBALS['userId'] = (int)$row["user_id"];
			
		// }
}


?>
<?php include 'BeginNav.php'?>
<!DOCTYPE html>
<html>
<head>
<title>New Subject Added</title>
<link href="discussion.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>New Subject Added</h1>

<?php echo $display_block;
 include 'EndNav.php'?>
