<?php
include 'BeginNav.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>User Login Form</title>
<link href="discussion.css" rel="stylesheet" type="text/css">
</head>
<body class="html1">
<div class="center">
<h1 style="color:white;">Login Form</h1>
<form method="post" action="userlogin1.php">
<p><label for="username">username:</label><br/>
<input type="text" id="username" name="username" autofocus required/></p>
<p><label for="password">password:</label><br/>
<input type="password" id="password" name="password" required/></p>
<button class="btn btn-danger" type="submit" name="submit" id="login" value="submit">Login</button>
</form>
</div>

<?php
include 'EndNav.php'
?>