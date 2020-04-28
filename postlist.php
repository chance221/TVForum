<style>
  table.center{
    margin-left: auto;
    margin-right:auto;
    color:white;
  }
  td{
    color:white;
  }
</style>
<?php
include 'connect.php';
include 'BeginNav.php';

doDB();

//gather the topics
$get_topics_sql = "SELECT fp.post_id, fp.post_title, fs.subject_title, DATE_FORMAT(fp.post_create_time,  '%b %e %Y at %r') 
                    as fmt_post_create_time, u.user_name FROM forum_posts AS fp LEFT JOIN users AS u ON fp.user_id = u.user_id LEFT JOIN forum_subjects AS fs ON fp.subject_id = fs.subject_id ORDER BY post_create_time DESC";
$get_topics_res = mysqli_query($mysqli, $get_topics_sql) or die(mysqli_error($mysqli));

if (mysqli_num_rows($get_topics_res) < 1) {
	//there are no topics, so say so
	$display_block = "<p><em>No posts currently exist.</em></p>";
} else {
	
	//create the display string
		$display_block = <<<END_OF_TEXT
		<div>
    <table class="table-striped col-md-10 center">
    <thead class="thead-dark">
    <tr>
    <th>Post Info</th>
    <th># of Posts/Replies</th>
    </tr>
		</thead>
		
END_OF_TEXT;

	while ($topic_info = mysqli_fetch_array($get_topics_res)) {
		$topic_id = $topic_info['post_id'];
		$topic_title = stripslashes($topic_info['subject_title']);
		$topic_create_time = $topic_info['fmt_post_create_time'];
    $topic_owner = stripslashes($topic_info['user_name']);
    $post_title = stripslashes($topic_info['post_title']);

		//get number of posts
		$get_num_posts_sql = "SELECT COUNT(post_id) AS post_count FROM forum_posts WHERE post_id = '".(int)$topic_id."'";
		$get_num_posts_res = mysqli_query($mysqli, $get_num_posts_sql) or die(mysqli_error($mysqli));

		while ($posts_info = mysqli_fetch_array($get_num_posts_res)) {
			$num_posts = $posts_info['post_count'];
		}

		//add to display
		$display_block .= <<<END_OF_TEXT
		<tr>
    <td><div><a href="showpost.php?post_id=$topic_id"><strong>$post_title</strong></a></div>
    <div>Subject: $topic_title</div>
    <div>Created on: $topic_create_time </div>
    <div>By: $topic_owner</td> </div>
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
		border-collapse: collapse;'
    
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

  button{
    margin:3vw;
  }


</style>
</head>
<body>
<h1 class="text-center">TV Forum Post</h1>
<?php echo $display_block; ?>
<div class="col-md-12 text-center">
  <a href="addsubject.php"><button type="button" class="btn btn-secondary">Add a Subject</button></a>
  <a href="addtopic.php"><button type="button" class="btn btn-secondary">Add a Topic</button></a>
  <a href="discussionMenu.php"><button type="button" class="btn btn-secondary">Main Page</button></a>
</div>


</body>
</html>

