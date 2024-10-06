<?php
    include 'dbconn.php';
    $username=htmlentities($_POST['username']);
    $pass=htmlentities($_POST['pass']);
    $email=htmlentities($_POST['email']);
    $member=htmlentities($_POST['member_type']);

    $sql="insert into `user` values ('$username','$pass','$email','$member');";
    $conn->query($sql);
    header("Location: admin.php");
?>