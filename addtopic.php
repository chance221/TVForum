<?php
  include 'BeginNav.php';
      
  echo'

  <form method="post" action="do_addtopic.php">
       
    
  <p>
    <label for="topic_owner">User Name:</label><br/>
    <input type="text" id="topic_owner" name="topic_owner" size="40"maxlength="150" required="required"/>
  </p>

    <p>
      <label for="topic_title">Subject Title:</label><br/>
      <input type="text" id="topic_title" name="topic_title" size="40"maxlength="150" required="required" />
    </p>
    
    <p>
      <label for="post_title">Post Title:</label><br/>
      <input type="text" id="post_title" name="post_title" size="40" maxlength="150" required="required" />
    </p>

    <p>
      <label for="post_text">Post Text:</label><br/>
      <textarea id="post_text" name="post_text" rows="8"cols="40" required="required"></textarea>
    </p>
    
    <button type="submit" name="submit" value="submit">Add Topic</button>

    <input type="button" name="menu" id="menu" value="Return to Menu"onclick="location.href=\'discussionMenu.php\'">
    
  </form>';
  
  
  
      
  include 'EndNav.php';
  
?>

 
   