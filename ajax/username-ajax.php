<?php
    include '../dbconn.php';

    $username=htmlentities($_GET['q']);

    $sql="select * from `user` where username='$username';";
    $result=$conn->query($sql);
    $row=$result->fetch_assoc();
    if($row)
        echo "Fail";
    else
        echo "Valid";
?>