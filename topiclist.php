<?php

include 'BeginNav.php';
include 'connect.php';

doDB();

//gather the topics
$get_topics_sql = "SELECT fs.subject_id, fs.subject_title, DATE_FORMAT(fs.subject_create_time,  '%b %e %Y at %r') 
                   as fmt_topic_create_time, u.user_name FROM forum_subjects AS fs LEFT JOIN users AS u ON fs.user_id = u.user_id ORDER BY subject_create_time DESC";

$get_topics_res = mysqli_query($mysqli, $get_topics_sql) or die(mysqli_error($mysqli));

if (mysqli_num_rows($get_topics_res) < 1) {
	//there are no topics, so say so
	$display_block = "<p><em>No subjects currently exist.</em></p>";
} else {
	//create the display string
		$display_block = <<<END_OF_TEXT
		<div>
    <table class="table table-striped col-md-10">
    <thead class="thead-dark">
    <tr>
    <th>POST TITLE</th>
    <th># of POSTS</th>
    </tr>
    </thead>
END_OF_TEXT;

	while ($topic_info = mysqli_fetch_array($get_topics_res)) {
		$topic_id = $topic_info['subject_id'];
		$topic_title = stripslashes($topic_info['subject_title']);
		$topic_create_time = $topic_info['fmt_topic_create_time'];
		$topic_owner = stripslashes($topic_info['user_name']);

		//get number of posts
		$get_num_posts_sql = "SELECT COUNT(post_id) AS post_count FROM forum_posts WHERE subject_id = '".(int)$topic_id."'";
		$get_num_posts_res = mysqli_query($mysqli, $get_num_posts_sql) or die(mysqli_error($mysqli));

		while ($posts_info = mysqli_fetch_array($get_num_posts_res)) {
			$num_posts = $posts_info['post_count'];
		}

		//add to display
		$display_block .= <<<END_OF_TEXT
		<tr>
		<td><a href="showtopic.php?topic_id=$topic_id"><strong>$topic_title</strong></a><br/>
		Created on $topic_create_time by $topic_owner</td>
		<td class="num_posts_col">$num_posts</td>
		</tr>
END_OF_TEXT;
	}
	//free results
	mysqli_free_result($get_topics_res);
	mysqli_free_result($get_num_posts_res);

	//close connection to MySQL
	mysqli_close($mysqli);

	//close up the table
	$display_block .= "</table></div> ";
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Topics in My Forum</title>
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
	}
	.num_posts_col { text-align: center; }
</style>
</head>
<body>
<h1 class="text-center">TV Forum Subjects</h1>
<?php echo $display_block; ?>
<p>Would you like to <a href="addsubject.php">add a subject</a>?</p>
<p>Would you like to <a href="addtopic.html">add a posts</a>?</p>

<p>Would you like to <a href="discussionMenu.php">return to main</a>?</p>
</body>
</html>
