<?php
    //connect to server

    include 'connect.php';

    include 'BeginNav.php';
    doDB();
    if (mysqli_connect_errno()){
        printf("Connection failed %s/n", mysqli_connect_error());

        exit();
    }


    $get_post_name_SQL = "SELECT fp.post_title, u.f_name, u.l_name FROM forum_posts AS fp LEFT JOIN auth_users AS u ON fp.user_id = u.id";

    $get_master_res = mysqli_query($mysqli, $get_post_name_SQL) or die(mysqli_error($mysqli));
        $xml = "<postList>";
    while($r = mysqli_fetch_array($get_master_res)){
        $xml .= "<post>";
        $xml .= "<title>"; 
        $xml .= $r['post_title'];
        $xml .= "</title>";
        $xml .= "<firstName>"; 
        $xml .= $r['f_name'];
        $xml .= "</firstName>";
        $xml .= "<lastName>"; 
        $xml .= $r['l_name'];
        $xml .= "</lastName>";
        $xml .= "</post>";
    }
    
    
    
    $xml .= "</postList>";
    $sxe = new SimpleXMLElement($xml);
    $sxe-> asXML("myPost.xml");
    echo "<h2>List of Post Created</h2>";
    echo "<p><a href='viewPostList.php'>View Post As XML</a></p>";
?>









<?php



Include 'EndNav.php';



?>