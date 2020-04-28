   <!-- Need help understanding why this wont work. -->
   <?php
      include 'connect.php';
      include 'BeginNav.php';

      doDB();

      //check to see if we're showing the form or adding the post
      if (!$_POST) {
         // showing the form; check for required item in query string
         if (!isset($_GET['post_id'])) {
            header("Location: topiclist.php");
            exit;
         }
         
         //create safe values for use
         $safe_post_id = mysqli_real_escape_string($mysqli, $_GET['post_id']);

         $verify_sql = "SELECT fp.subject_id, fs.subject_title FROM forum_posts
         AS fp LEFT JOIN forum_subjects AS fs ON fp.subject_id =
         fs.subject_id WHERE fp.post_id = '".$safe_post_id."'";
         $verify_res = mysqli_query($mysqli, $verify_sql)
                     or die(mysqli_error($mysqli));

         if (mysqli_num_rows($verify_res) < 1) {
            //this post or topic does not exist
            header("Location: topiclist.php");
            exit;
         } else {
            //get the topic id and title
            while($topic_info = mysqli_fetch_array($verify_res)) {
               $topic_id = $topic_info['subject_id'];
               $topic_title = stripslashes($topic_info['subject_title']);

            }
         
      
   ?>

   <!DOCTYPE html>
   <html>
   <head>
   <title>Post Your Reply for Subject: <?php echo $topic_title; ?></title>
   <link href="discussion.css" rel="stylesheet" type="text/css" />
   </head>
   <body>
   <h1>Post Your Reply for subject: <?php echo $topic_title; ?></h1>
   <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
   <p><label for="user_name">Your Email Address:</label><br/>
   <input type="email" id="user_name" name="user_name" size="40"
      maxlength="150" required="required"></p>
   <p><label for="post_string">Post Text:</label><br/>
   <textarea id="post_string" name="post_string" rows="8" cols="40"
      required="required"></textarea></p>
   <input  name="subject_id" hidden value="<?php echo $topic_id; ?>">
   <button type="submit" name="submit" value="submit">Add Post</button>
   </form>
   </body>
   </html>
      
   <?php

      //free result
      mysqli_free_result($verify_res);

      //close connection to MySQL
      mysqli_close($mysqli);
   }

   } else if ($_POST) {
      //check for required items from form
      echo '<script type="text/javascript">alert("this is the alert");</script>';

         if ((!$_POST['subject_id']) || (!$_POST['post_string']) || (!$_POST['user_id'])) {
            header('Location: replytopost.php?post_id='.$_GET['post_id'].'"'); 
            exit;
         }

         $con = $mysqli;
         global $userId;

         //create safe values for use
         $safe_topic_id = mysqli_real_escape_string($mysqli, $_POST['subject_id']);
         $safe_post_text = mysqli_real_escape_string($mysqli, $_POST['post_string']);
         $safe_post_owner = mysqli_real_escape_string($mysqli, $_POST['user_name']);

         //see if there is a user in the database with that email if not then create one

         $user_check_sql = "SELECT user_id FROM users WHERE  user_name ='".$safe_post_owner."' ";

         $result = $con->query($user_check_sql);
         $row = $result ->fetch_assoc();

         if($result -> num_rows > 0) {
            $GLOBALS['userID'] = (int)$row['user_id'];
         } else {
            //creating user if one is not found
            $user_add_sql = "INSERT INTO users (user_name) VALUES ('".$safe_post_owner."')";
            
            if ($con->query($user_add_sql) === TRUE){
               $user_check_sql = "SELECT user_id FROM users WHERE  user_name ='".$safe_post_owner."' ";
               $result = $con->query($user_check_sql);
               $row = $result -> fetch_assoc();
               $GLOBALS['userID'] = (int)$row["user_id"];
            }
         }
         //add the post
         $add_post_sql = "INSERT INTO forum_posts (subject_id, post_text,
                        post_create_time, user_id) VALUES
                        ('".$safe_topic_id."', '".$safe_post_text."',
                        now(),'".$GLOBALS['userID']."')";
         $add_post_res = mysqli_query($mysqli, $add_post_sql)
                        or die(mysqli_error($mysqli));

         //close connection to MySQL
         mysqli_close($mysqli);

         //redirect user to topic
         header("Location: showtopic.php?topic_id=".$_POST['subject_id'].'"');
         exit;
         
      }
      ?>

