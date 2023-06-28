<?php

// $mysql = new mysqli('localhost', 'c92648n6_textile', 'Z7F-ef7JnciNQGa', 'c92648n6_textile');

// $login = filter_var(trim($_POST['login']),
// FILTER_SANITIZE_STRING);
// $pass = filter_var(trim($_POST['pass']),
// FILTER_SANITIZE_STRING);

// $pass = md5($pass);

// $result = $mysql->query("SELECT * FROM `auth` WHERE `login` =  '$login' AND `pass` = '$pass'");
// $user = $result->fetch_assoc();
// if(count($user) === 0){
//     header('location: login.php');
//     exit();
// }

// setcookie('user', $login);
setcookie('user', "Textile");

// $mysql->close();

header('location: /');