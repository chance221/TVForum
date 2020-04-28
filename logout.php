<?php

include 'BeginNav.php';


echo'
<h3>Are you sure you want to log out?</h3>

<form method="post" action="do_logout.php"> 

  <div class="form-group">
    <div>
      <label for="topic_owner">Are You Sure You Want To Log Out?:</label><br/>
    </div>
  </div>
  <div class="form-group">
    <button type="submit" name="submit" value="submit">Log Out</button>

    <input type="button" name="menu" id="menu" value="Return to Menu"onclick="location.href=\'discussionMenu.php\'">
  </div>  

  </form>';

include 'EndNav.php';
?>