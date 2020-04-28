
<?php

include 'BeginNav.php';

include 'connect.php';

doDB();

if (!$_POST && !isset($_GET['post_id']))  {
    //haven't seen the selection form, so show it
    $display_block = "<h1 style='color:white;'>Select a Post to Update</h1>";

    //get parts of records
    $get_list_sql = "SELECT fp.post_id,
                     CONCAT_WS(' By: ', fp.post_title, u.user_name) AS display_name, fp.post_create_time 
                     FROM forum_posts AS fp LEFT JOIN users AS u ON fp.user_id = u.user_id ORDER BY fp.post_create_time";
    $get_list_res = mysqli_query($mysqli, $get_list_sql) or die(mysqli_error($mysqli));

    if (mysqli_num_rows($get_list_res) < 1) {
        //no records
        $display_block .= "<p><em>Sorry, no records to select!</em></p>";

    } else {
        //has records, so get results and print in a form
        $display_block .= "
        <form method=\"post\" action=\"".$_SERVER['PHP_SELF']."\">
        <p><label for=\"change_id\">Select a Record to Update:</label><br/>
        <select id=\"change_id\" name=\"change_id\" required=\"required\">
        <option value=\"\">-- Select One --</option>";
        
        while ($recs = mysqli_fetch_array($get_list_res)) {
            $id = $recs['post_id'];
            $display_name = stripslashes($recs['display_name']);
            $display_block .= "<option value=\"".$id."\">".$display_name."</option>";
        }
        

        $display_block .= "
        </select></p>
        <button class='btn-success' type='submit' name='submit'>Change Selected Entry</button>
        </form>";
    }
} else if(($_POST) || (isset($_GET['post_id'])) ){

  //check to be sure that the post exist

  
  $safe_id;
  //check for required fields
  
  if(isset($_GET['post_id'])){
    $post_check_sql = "SELECT post_id FROM forum_posts WHERE  post_id='".$_GET['post_id']."' ";

    $result = $mysqli->query($post_check_sql);
    $row = $result ->fetch_assoc();
    //If he does exist then find their id and create a variabel to hold that value

    if ($result -> num_rows > 0){
      
      $safe_id = mysqli_real_escape_string($mysqli,$_GET['post_id']); 
    }
  
  } else{

    if ($_POST['change_id'] =="") {
   
      header("Location: editpost.php");
      exit;
    } else {
      $safe_id = mysqli_real_escape_string($mysqli, $_POST['change_id']);
    }
    
  }

    
  //create session variable for use;
  
  $_SESSION["id"] = $safe_id;

  //get the post info

  $get_post_sql = "SELECT fp.post_title, fp.post_string, fs.subject_title, u.user_name, u.user_id 
                  FROM forum_posts AS fp 
                  LEFT JOIN users AS u ON fp.user_id = u.user_id 
                  LEFT JOIN forum_subjects AS fs ON fp.subject_id = fs.subject_id 
                  WHERE post_id = '".$safe_id."'";
  
  $get_post_res = mysqli_query($mysqli, $get_post_sql) or die(mysqli_error($mysqli));

  //clean master_post_info
  
  while($post_info = mysqli_fetch_array($get_post_res)){

    
    $display_post_title = stripslashes($post_info['post_title']);
    $display_post_subject = stripslashes($post_info['subject_title']);
    $display_post_user_name = stripslashes($post_info['user_name']);
    $display_post_string = stripslashes($post_info['post_string']);
    $display_user_id = stripslashes($post_info['user_id']);
  }

  //save the data into a session variable to check to see if it changed
  $_SESSION["post_string"] = $display_post_string;
  $_SESSION["post_subject"] = $display_post_subject;
  $_SESSION["post_user"] = $display_post_user_name;
  $_SESSION["post_title"] = $display_post_title;
  $_SESSION["user_id"] = $display_user_id;

  

  $display_block = "<h1> Post Update</h1>";
  $display_block .= "<form method='post' action='changepost.php'>";
  $display_block .= "<div class='form-group'>";
  $display_block .= "<label for='post_title'> Post Title:</label>";
  $display_block .= "<input type='text' class='form-control' name='post_title' size = '30' maxlength='50' required='required' value='".$display_post_title."' />";
  $display_block .= "</div>";
  $display_block .= "<div class = 'form-group'>";
  $display_block .= "<label for='subject_title'> Subject: </label>";
  $display_block .= "<input type='text' for='post_subject' name='post_subject' class='form-control' value='".$display_post_subject."' readonly />";
  $display_block .= "<small id='subject_help' class='form-text text-muted'> Cannot change the subject after it is posted. You can always start another post</small>";
  $display_block .= "</div>";
  $display_block .= "<div class='form-group'>";
  $display_block .= "<label for='user_name'> User Name: </label>";
  $display_block .= "<input type='text' for='post_user' class='form-control' name ='post_user' size ='30' maxlength='20' required value='".$display_post_user_name."'/>";
  $display_block .= "</div>";
  $display_block .= "<div class = 'form-group'>";
  $display_block .= "<label for='post_string'> Post:</label>";
  $display_block .= "<textarea class='form-control' name='post_string'>'". $display_post_string . "'</textarea>";
  $display_block .= "</div>";
  $display_block .= "<div class='form-group'>"; 
  $display_block .= "<button type='submit' name='submit_change' value='submitChange'>Change My Post</button>";

}


mysqli_close($mysqli);

?>

<?php echo $display_block; 


include 'EndNav.php' ?>


