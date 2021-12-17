<?php
session_start();
require "./config.php";
require "./models/db.php";
require "./models/admin.php";
require "./models/user.php";
$user = new user;
$admin = new admin;
$url = $_SERVER['PHP_SELF'];
if(isset($_GET['forgotpassword'])){
    echo '<html><script>alert("Soạn cú pháp: resetpassword + _ + Registered phone number gỡi 1234");</script></html>'; 
    header("Refresh:0; $url");
}
if (isset($_POST['submit'])) {
    $accountname = $_POST['accountname'];
    $password = $_POST['password'];
    if ($admin->checkLogin($accountname, $password)) {
        $_SESSION['admin'] = $accountname;
        header('location:./Admin/index.php');
    } else {
        if ($user->checkLogin($accountname, $password)) {
            $_SESSION['user'] = $accountname;
            header('location:index.php'); 
        } else {
            echo '<html><script>alert("Tk/MK sai");</script></html>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="css/style1.css">
</head>

<body>
    <div class="page">
        <div class="container">
            <div class="left">
                <div class="login">Login</div>
                <div class="eula">By logging in you agree to the ridiculously long terms that you didn't bother to read</div>
            </div>
            <div class="right">
                <svg viewBox="0 0 320 300">
                    <defs>
                        <linearGradient inkscape:collect="always" id="linearGradient" x1="13" y1="193.49992" x2="307" y2="193.49992" gradientUnits="userSpaceOnUse">
                            <stop style="stop-color:#ff00ff;" offset="0" id="stop876" />
                            <stop style="stop-color:#ff0000;" offset="1" id="stop878" />
                        </linearGradient>
                    </defs>
                    <path d="m 40,120.00016 239.99984,-3.2e-4 c 0,0 24.99263,0.79932 25.00016,35.00016 0.008,34.20084 -25.00016,35 -25.00016,35 h -239.99984 c 0,-0.0205 -25,4.01348 -25,38.5 0,34.48652 25,38.5 25,38.5 h 215 c 0,0 20,-0.99604 20,-25 0,-24.00396 -20,-25 -20,-25 h -190 c 0,0 -20,1.71033 -20,25 0,24.00396 20,25 20,25 h 168.57143" />
                </svg>
                <div class="form">
                    <form action="#" method="post">
                        <label for="username">Username</label>
                        <input name="accountname" type="text" id="">
                        <label for="password">Password</label>
                        <input name="password" type="password" id="password">
                        <input style="color: white;margin-top: 20px;" name="submit" type="submit" id="submit" value="Submit">
                        <div style="margin-top: 20px;">
                            <a style="color: white;text-decoration: none;" href="regisgter.php">Regisgter</a>
                        </div>
                        <div style="float: right; margin-top: -20px;">
                            <a style="color: white;text-decoration: none;" href="login.php?forgotpassword=true">Forgot password</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        var current = null;
        document.querySelector('#email').addEventListener('focus', function(e) {
            if (current) current.pause();
            current = anime({
                targets: 'path',
                strokeDashoffset: {
                    value: 0,
                    duration: 700,
                    easing: 'easeOutQuart'
                },
                strokeDasharray: {
                    value: '240 1386',
                    duration: 700,
                    easing: 'easeOutQuart'
                }
            });
        });
        document.querySelector('#password').addEventListener('focus', function(e) {
            if (current) current.pause();
            current = anime({
                targets: 'path',
                strokeDashoffset: {
                    value: -336,
                    duration: 700,
                    easing: 'easeOutQuart'
                },
                strokeDasharray: {
                    value: '240 1386',
                    duration: 700,
                    easing: 'easeOutQuart'
                }
            });
        });
        document.querySelector('#submit').addEventListener('focus', function(e) {
            if (current) current.pause();
            current = anime({
                targets: 'path',
                strokeDashoffset: {
                    value: -730,
                    duration: 700,
                    easing: 'easeOutQuart'
                },
                strokeDasharray: {
                    value: '530 1386',
                    duration: 700,
                    easing: 'easeOutQuart'
                }
            });
        });
    </script>
</body>

</html>