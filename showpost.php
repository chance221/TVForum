<?php
include 'connect.php';
include  'BeginNav.php';
doDB();

//check for required info from the query string
if (!isset($_GET['post_id'])) {
  echo '<script>alert("Cant find that post at this time please select another post or try again later")</script>';
	header("Location: topiclist.php");
	exit;
}

//create safe values for use
$safe_topic_id = mysqli_real_escape_string($mysqli, $_GET['post_id']);

//verify the topic exists
$verify_topic_sql = "SELECT post_title FROM forum_posts WHERE post_id = '".$safe_topic_id."'";
$verify_topic_res =  mysqli_query($mysqli, $verify_topic_sql) or die(mysqli_error($mysqli));

if (mysqli_num_rows($verify_topic_res) < 1) {
  //this topic does not exist
  
	$display_block = "<p><em>No Posts currently exist. Add one by clicking the button below.<br/>
	Or please <a href=\"postlist.php\">try again</a>.</em></p>";
} else {

	//get the post title
	while ($topic_info = mysqli_fetch_array($verify_topic_res)) {
		$topic_title = stripslashes($topic_info['post_title']);
  }
  
 

	//gather the posts
	$get_posts_sql = "SELECT fp.post_id, fp.post_string, fp.subject_id, fp.post_title, DATE_FORMAT(fp.post_create_time, '%b %e %Y<br/>%r') AS fmt_post_create_time, fs.subject_title, u.user_name FROM forum_posts AS fp LEFT JOIN users AS u ON fp.user_id = u.user_id LEFT JOIN forum_subjects AS fs  ON fp.subject_id = fs.subject_id WHERE fp.post_id = '".$safe_topic_id."' ORDER BY fp.post_create_time ASC";
	$get_posts_res = mysqli_query($mysqli, $get_posts_sql) or die(mysqli_error($mysqli));

	//create the display string
	$display_block = <<<END_OF_TEXT
	<table class="table table-striped col-md-10">
	
	<thead class="thead-dark">
		<tr>
			<th scope="col">Details</th>
			<th>Post</th>
		</tr>
	</thead>
	
	
END_OF_TEXT;

	while ($posts_info = mysqli_fetch_array($get_posts_res)) {
		$post_id = $posts_info['post_id'];
		$post_text = nl2br(stripslashes($posts_info['post_string']));
		$post_create_time = $posts_info['fmt_post_create_time'];
		$post_owner = stripslashes($posts_info['user_name']);
    $post_subject_id = $posts_info['subject_id'];
    $post_subject_title = $posts_info['subject_title'];
    $post_title = $posts_info['post_title'];
    //add to display
    
	 	$display_block .= <<<END_OF_TEXT
		<tr>
    <td>
      <p>Author: $post_owner</p>
      <p>Subject: $post_subject_title</p>
      <p>Title: $post_title</p>
      <p>Post Date:<p class='col'>$post_create_time</p> </p>
    </td>
    <td>
      <p>$post_text<p><br/><br/>
      <a href="editpost.php?post_id=$post_id"><button class='btn btn-warning'>Edit</button></a>
      <a href="deletepost.php?post_id=$post_id"><button class='btn btn-danger'>Delete</button></a>

    </td>
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

<?php 
echo "<h1>".$topic_title."</h1>";
echo $display_block; 
?>
<a href="replytopost.php?post_id=<?php echo $post_id; ?>"><button type="button" class="btn btn-secondary btn-lg btn-block">Add A Post for This Subject</button></a>
</body>
</html>
