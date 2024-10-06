<?php
    include '../dbconn.php';

    $util=$_GET['utility'];
    $status=$_GET['status'];

    $sql="update `utility` set `status`='$status' where `equipment_name`='$util';";
    $conn->query($sql);
?>