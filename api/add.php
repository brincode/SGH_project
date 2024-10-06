<?php
include('../dbconn.php');

 
$moist1 = $_POST["s1"];
$temp1=$_POST["t1"];
$hum1=$_POST["h1"];
$ec1=$_POST["e1"];
$day=$_POST["d"];
$hour=$_POST["hour"];


$date = date("Y-m-d H:i:s");
    
$query = "INSERT INTO `data` (`time`, `moisture`, `temperature`, `humidity`, `ecsensor`, `day`, `hour`) VALUES ('$date', $moist1, $temp1, $hum1, $ec1, $day, $hour)";
   
$conn->query($query);

?>