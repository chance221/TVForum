<?php
session_start();
include 'connect.php';
include 'BeginNav.php';
doDB();

echo'
<h1 style="color:white;">Delete User Form</h1>
  <form method="post" action="do_deleteuser.php">

    <p>
      <label for="user_email">Email Address:</label><br/>
      <input class="form-control col col-md-3" type="email" id="user_email" name="user_email" size="40" maxlength="150" required="required"/> 
    </p>

    <p>
      <label for="password">Password:</label><br/>
      <input class="form-control col col-md-2" id="password" name="password" minlength="8" required="required"></textarea>
    </p>

    <div>
    <button style="margin:30px;margin-left:0px;" class="btn btn-danger" type="submit" name="submit" value="submit">Delete My Account</button>
    <small style="color:white;">This action cannot be undone</small>
    </div>

    <input class="btn btn-success" type="button" name="menu" id="menu" value="Return to Menu"onclick="location.href=\'discussionMenu.php\'">
    
  </form>';
    
  include 'EndNav.php';
?>