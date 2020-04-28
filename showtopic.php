<?php
include 'connect.php';
include  'BeginNav.php';
doDB();

//check for required info from the query string
if (!isset($_GET['topic_id'])) {
	header("Location: topiclist.php");
	exit;
}

//create safe values for use
$safe_topic_id = mysqli_real_escape_string($mysqli, $_GET['topic_id']);

//verify the topic exists
$verify_topic_sql = "SELECT subject_title FROM forum_subjects WHERE subject_id = '".$safe_topic_id."'";
$verify_topic_res =  mysqli_query($mysqli, $verify_topic_sql) or die(mysqli_error($mysqli));

if (mysqli_num_rows($verify_topic_res) < 1) {
	//this topic does not exist
	$display_block = "<p><em>No Posts currently for this subject Add one by clicking the button below.<br/>
	Or please <a href=\"topiclist.php\">try again</a>.</em></p>";
} else {
	//get the topic title
	while ($topic_info = mysqli_fetch_array($verify_topic_res)) {
		$topic_title = stripslashes($topic_info['subject_title']);
  }
  
  //need to get the user_name from the users table. 

	//gather the posts
	$get_posts_sql = "SELECT fp.post_id, fp.post_string, fp.subject_id, DATE_FORMAT(fp.post_create_time, '%b %e %Y<br/>%r') AS fmt_post_create_time, u.user_name FROM forum_posts AS fp LEFT JOIN users AS u ON fp.user_id = u.user_id WHERE fp.subject_id = '".$safe_topic_id."' ORDER BY fp.post_create_time ASC";
	$get_posts_res = mysqli_query($mysqli, $get_posts_sql) or die(mysqli_error($mysqli));

	//create the display string
	$display_block = <<<END_OF_TEXT
	<p>Showing posts for the <strong>$topic_title</strong> topic:</p>
	<table class="table table-striped col-md-8">
	
	<thead class="thead-dark">
		<tr>
			<th scope="col">Author</th>
			<th>Post</th>
		</tr>
	</thead>
	
	
END_OF_TEXT;

	while ($posts_info = mysqli_fetch_array($get_posts_res)) {
		$post_id = $posts_info['post_id'];
		$post_text = nl2br(stripslashes($posts_info['post_string']));
		$post_create_time = $posts_info['fmt_post_create_time'];
		$post_owner = stripslashes($posts_info['user_name']);
		$post_subject = $posts_info['subject_id'];
		//add to display
	 	$display_block .= <<<END_OF_TEXT
		<tr>
		<td>$post_owner<br/><br/>created on:<br/>$post_create_time</td>
		<td>$post_text<br/><br/>
		<a href="replytopost.php?post_id=$post_subject"><strong>Add to the conversation</strong></a></td>
		</tr>
END_OF_TEXT;
	}

	//free results
	mysqli_free_result($get_posts_res);
	mysqli_free_result($verify_topic_res);

	//close connection to MySQL
	mysqli_close($mysqli);

	//close up the table
	$display_block .= "</table>";
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Posts in Topic</title>
<link href="discussion.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	table {
		border: 1px solid black;
		border-collapse: collapse;
	}
	th {
		border: 1px solid black;
		padding: 6px;
		font-weight: bold;
		background: #ccc;
	}
	td {
		border: 1px solid black;
		padding: 6px;
		vertical-align: top;
	}
	.num_posts_col { text-align: center; }
</style>
</head>
<body>
<h1 style='color:white;'>Posts in Topic</h1>
<?php echo $display_block; ?>
<a href="replytopost.php?post_id=<?php$post_id?>"><button type="button" class="btn btn-secondary btn-lg btn-block">Add A Post To This Subject</button></a>
</body>
</html>
