<?php
include 'BeginNav.php';

$xmlList = simplexml_load_file("myPost.xml") or die ("Error: Cannot create object");
foreach($xmlList -> post as $post){
  $title = $post  ->title;
  $f_name = $post ->firstName;
  $l_name = $post ->lastName;

  echo"<div style='width:30%'><p style='color:white;border-bottom:4px blue solid;font-weight:400;'> Title: " . $title. "<br> " . 
  "<span style='background-color:white; color:black;'>Name: " . $f_name . " " . $l_name . "<br>  </p> </div>" ;
}


?>