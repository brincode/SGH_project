<?php
    include 'dbconn.php';
    if(isset($_POST['submit'])){
        //check username and pass validity
        $username=$_POST['username'];
        $pass=$_POST['pass'];
        $username=htmlentities($username);
        $pass=htmlentities($pass);

        $sql="select `username`, `password`, `member_type` from `user` where `username`='$username';";
        $result=$conn->query($sql);
        if($row=$result->fetch_assoc()){
            //Username exists
            if($row['password']==$pass){
                //password correct
                setcookie("username",$username,0,'/',false);
                if($row['member_type']=="Admin")
                    header("Location: admin.php");
                else
                    header("Location: index.php");
            }else{
                //password incorrect
                $string="Password incorrect";
            }
        }else{
            //username does not exist
            $string="Username does not exist";
        }
    }
?>


<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="asset/main.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:bold" rel="stylesheet"> 
        
        <script src="asset/main.js"></script>
        <title>Smart Greenhouse Application</title>

    </head>


    <body class="login-page">
        <form action="" method="POST">
            <div class="login-box">
                <div class="logo">
                    <img src="asset/logo.jpeg"/>
                </div>
                <table>
                    <tbody>
                        <?php if(isset($string)):?>
                            <tr>
                                <td colspan=2><span style="color:red;"><?=$string?></span></td>
                            </tr>
                        <?php endif;?>
                        <tr>
                            <td>USERNAME:</td>
                            <td><input name="username" type="text" placeholder="Username"/></td>
                        </tr>
                        <tr>
                            <td>PASSWORD:</td>
                            <td><input name="pass" type="password" placeholder="Password"/></td>
                        </tr>
                        <tr>
                            <td colspan=2 style="text-align:center;"><button type="submit" name="submit" value="submit">SUBMIT</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </body>


</html>

