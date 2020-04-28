<?php

include 'BeginNav.php';
include 'connect.php';

doDB();
//check for required fields from the form
if (($_POST['username']=="") || ($_POST['password']=="")) {
    header("Location: userlogin.php");
    exit;
}
$display_block="";
//connect to server and select database


//use mysqli_real_escape_string to clean the input
$safe_username = mysqli_real_escape_string($mysqli, $_POST['username']);
$safe_password = mysqli_real_escape_string($mysqli, $_POST['password']);
	

//create and issue the query
$sql = "SELECT f_name, l_name, id FROM auth_users WHERE username = '".$safe_username."' AND password = '".$safe_password."'";

$result = $mysqli->query($sql) or die(mysqli_error($mysqli));
$row = $result ->fetch_assoc();
//get the number of rows in the result set; should be 1 if a match
if ($result -> num_rows == 1) {
  $row = $result ->fetch_assoc();

  $display_block .= "<p>You are now logged in</p>";
  $display_block .="<a href='discussionMenu.php'><h4>Go To Home Menu</h4></a>";
	//header("Location: discussionMenu.php");
	//exit;
} else {
    //redirect back to login form if not authorized
    $display_block = "<p style='text-align:center;color:red;font-size:1.5em;'>Password/Username invalid. Please try again or contact your administrator</p>";
    $display_block .= "<p style='text-align:center;font-size:2em;color:Return To Home;'><a href='userlogin.php'> Return to login</a> Or <a href='adduser.php'> Create an Account</a></p>";
}

//close connection to MySQL
mysqli_close($mysqli);
?>


</head>
<body id='loginbg'>
<?php echo $display_block; 
include 'EndNav.php' ?>
</body>
</html>
