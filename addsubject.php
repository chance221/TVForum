<?php

include 'BeginNav.php';
include 'connect.php';

doDB();

//need to write code to get the user information and create a dropdown for it

//need to create a script that lists the individual subjects and puts them in a dropdown

echo'

  <form method="post" action="do_addsubject.php"> 

  <div class="form-group">
    <label for="topic_owner">User Name:</label><br/>
    <input type="text" id="topic_owner" name="topic_owner" size="40" maxlength="150" required="required"/> 
  </div>
  <div class="form-group">
    <label for="topic_title">Topic Title:</label><br/>
    <input type="text" id="topic_title" name="topic_title" size="40"maxlength="150" required="required" />
    <small id="emailHelp" class="form-text text-muted">Start a new conversation by creating a subject here </small>
  </div>  

    <button type="submit" name="submit" value="submit">Add Topic</button>

    <input type="button" name="menu" id="menu" value="Return to Menu"onclick="location.href=\'discussionMenu.php\'">
    
  </form>';
    
  include 'EndNav.php';
  
?>