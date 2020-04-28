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

$myArrayJSONencoded = json_encode($myNewInstance);

echo "The array has been created and converted to json </br>";


//writing or appending to json file

$newFilePath = fopen(".newFileCreate.json", "a+") or die ("Unable to open file");

fwrite($newFilePath, $myArrayJSONencoded);

echo "added newly created array to the JSON file.</br>";

fclose($newFilePath);

echo "closed down the json file";

?>