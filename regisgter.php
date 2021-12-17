<?php
session_start();
require "./config.php";
require "./models/db.php";
require "./models/user.php";
$user = new user;
if (isset($_POST['submit_create'])) {
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($user->checkregisgter($username)) {
        $user->createuser($fullname, $phone, $username, $password);
        header('location:login.php');
    } else {
        echo '<html><script>alert("username đã tồn tại");</script></html>';
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
                <div class="login">Sign up</div>
                <div class="eula">Register now for our award-winning service and get a 14 day free trial.</div>
            </div>
            <div class="right">
                <svg viewBox="0 0 320 300">
                    <defs>
                        <linearGradient inkscape:collect="always" id="linearGradient" x1="13" y1="193.49992" x2="307" y2="193.49992" gradientUnits="userSpaceOnUse">
                            <stop style="stop-color:#ff00ff;" offset="0" id="stop876" />
                            <stop style="stop-color:#ff0000;" offset="1" id="stop878" />
                        </linearGradient>
                    </defs>
                </svg>
                <div class="form" style="margin-top: 10px;">
                    <form action="#" method="post">
                        <label style="margin-top: 10px;" for="username">Username</label>
                        <input name="username" type="text" id="" required>
                        <label style="margin-top:2px;" for="username">Full Name</label>
                        <input name="fullname" type="text" id="" required>
                        <label style="margin-top:2px;" for="username">Phone</label>
                        <input name="phone" type="text" id="" required>
                        <label style="margin-top:2px;" for="password">Password</label>
                        <input name="password" type="password" id="password" required>
                        <input style="color: white;margin-top: 20px;" name="submit_create" type="submit" id="submit" value="Sign up">
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