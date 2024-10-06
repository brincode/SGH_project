<?php

    include '../dbconn.php';
    $username=htmlentities($_GET['q']);
    $deleter=htmlentities($_GET['r']);

    $sql="select `member_type` from `user` where `username`='$deleter';";
    $result=$conn->query($sql);
    $row=$result->fetch_assoc();

    if(isset($row['member_type']))
        if($row['member_type']=="Admin"){
            $sql="delete from `user` where `username`='$username';";
            if($conn->query($sql)){
                echo "Deleted $username successfully.";
            }else{
                echo "Unsuccessful delete. Please contact your developer.";
            }
        }else{
            echo "You do not have the permission to delete this user. Please contact your admin.";
        }
    else
        echo "You do not have the permission to delete this user. Please contact your admin.";
?>