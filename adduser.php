<?php
include 'BeginNav.php';
include 'connect.php';

doDB();

echo'
<h1 style="color:white;">New User Form</h1>
  <form method="post" action="do_adduser.php">

    <p>
      <label for="new_user_email">Email Address:</label><br/>
      <input class="form-control col col-md-3" type="email" id="new_user_email" name="new_user_email" size="40"maxlength="150" required="required"/> 
    </p>

    <p>
      <label for="f_name">First Name:</label><br/>
      <input class="form-control col col-md-4" type="text" id="f_name" name="f_name" size="40"maxlength="50" required="required" />
    </p>
    
    <p>
      <label for="l_name">Last Name:</label><br/>
      <input class="form-control col col-md-4" type="text" id="l_name" name="l_name" size="40" maxlength="50" required="required" />
    </p>

    <p>
      <label for="username">Username:</label><br/>
      <input class="form-control col col-md-2" id="username" name="username" required="required"></textarea>
    </p>

    <p>
      <label for="password">Password:</label><br/>
      <input class="form-control col col-md-2" id="password" name="password" minlength="8" required="required"></textarea>
    </p>

    <button style="margin:30px;margin-left:0px;" class="btn btn-success" type="submit" name="submit" value="submit">Sign Me Up!</button>

    <input class="btn btn-danger" type="button" name="menu" id="menu" value="Return to Menu"onclick="location.href=\'discussionMenu.php\'">
    
  </form>';
    
  include 'EndNav.php';
  

?>