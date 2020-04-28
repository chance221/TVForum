<?php
    class myArray {
        public $title = "";
        public $content = "";
        public $numberOfAttendees = "";
        public $happy = "";
    }
$myNewInstance = new myArray();
$myNewInstance ->title = "New Title";
$myNewInstance ->content = "Lots of data";
$myNewInstance ->numberOfAttendees = "6";
$myNewInstance->happy="true";

echo json_encode($myNewInstance);
?>