<?php
include 'connect.php';
session_start();

doDB();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Discussion Forum</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <link href="discussion.css" type="text/css" rel="stylesheet" />
  <style>
    .home-img{
      width:30vw;
      margin:3vh;
    }
  
    h2{
      font-size: 1.2em;
    }
    .main-img{
      width:10vw;
      padding: 2vh;
      min-width: 6vw;
    }
    .nav-link:hover{
      text-decoration: none;
      background-color: darkgray;
    }
    .mp{
      color:black;
      text-decoration:none;
    }
    .ctr{
      margin-left:auto;
      margin-right:auto;
    }
    
  </style>
</head>
<body>
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
    <section class="container-fluid rows">
      <div class="text-center">
        <img class="home-img" src="./media/Flat-Icons.com-Flat-Flat-TV.svg" 
         class="rounded "/>
      </div>
      <div>
        <div class="text-center"><h2 class="text-light bg-dark col-md-12 text-center">All TV's. All The Time. Welcome to the TV Forum.</h2></div>
        
      </div>
      <div class ="row">
        <div class="col-md-3">
          <div><a href="postlist.php" ><h2 h2 class="text-center mp"> See All Posts</h2> </a></div>
          <div class="text-center">
            <img src="./media/blogImg1.svg" class="main-img" alt="blog image"> 
          </div>
        </div>
        <div class="col-md-3">
          <div><a href="topiclist.php" ><h2 h2 class="text-center mp"> See All Subjects</h2></a></div>
          <div class="text-center">
            <img src="./media/subject.svg" class="main-img" alt="blog image"> 
          </div>
        </div>
        <div class="col-md-3">
          <div><a href="addtopic.html" ><h2 class="text-center mp"> Add A Post</h2></a></div>
          <div class="text-center">
            <img src="./media/blog.svg" class="main-img" alt="blog image"> 
          </div>
        </div>
        <div class="col-md-3">
          <div><a href="addsubject.php" ><h2 class="text-center mp"> Add A Subject</h2></a></div>
          <div class="text-center">
            <img src="./media/smart-tv.svg" class="main-img" alt="blog image"> 
          </div>
          
        </div>
      </div>
    </section>
</body>
</html>
