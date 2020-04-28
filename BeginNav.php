<?php
echo '<!DOCTYPE html>
<html lang="en">
<head>
  <title>TV Forum</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link href="discussion.css" type="text/css" rel="stylesheet" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	
	<style>
	.nav-link:hover{
		text-decoration: none;
		background-color: darkgray;
	}
	label{
		color:white;
	}
	td{
		color:white;
	}
	</style>
</head>
<body class=html1>
		<header  class="container-fluid">
		<nav class="navbar navbar-expand-md navbar-dark bg-dark">
			<a class="navbar-brand" href="#">
				<img src="./media/Flat-Icons.com-Flat-Flat-TV.svg" class="rounded myLogo" width="30" height="30" alt="logo"/>
			</a> 
			<a class="navbar-brand text-light" href="discussionMenu.php">TV Forum Menu</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav ctr">
        <li class="">
          <a class="nav-link badge-dark" href="addtopic.php">Add A Post</a>
        </li>
        <li>
          <a class="nav-link badge-dark" href="postlist.php">View All Posts</a>
        </li>
        <li>
          <a class="nav-link badge-dark" href="addsubject.php">Add A Subject</a>
        </li>
        <li class="">
          <a class="nav-link badge-dark" href="topiclist.php">View All Subjects</a>
        </li>
        <li class="">
          <a class="nav-link badge-dark" href="editpost.php">Edit Posts</a>
        </li>
        <li class="">
          <a class="nav-link badge-dark" href="adduser.php">Create Account</a>
        </li>
          <a class="nav-link badge-dark" href="userlogin.php">Login</a>
        </li>
        <li class="">
          <a class="nav-link badge-dark" href="deleteuser.php">Delete Account</a>
        </li>
        <li class="">
          <a class="nav-link badge-dark" href="create_post_list.php">XML I/O</a>
        </li>
				<li class="">
          <a class="nav-link badge-dark" href="userlogin.php">Login</a>
        </li>
				<li class="">
          <a class="nav-link badge-dark" href="logout.php">Log Out</a>
        </li>
      </ul>
      </div>
		</nav>
	</header>
	<section style="margin-top:25px;" class="container-fluid rows">';
    ?>