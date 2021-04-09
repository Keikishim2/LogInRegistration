<?php

$username = escape_this_string($_POST['username']);
$email = escape_this_string($_POST['email']);
$password = escape_this_string($_POST['password']);
$salt = bin2hex(openssl_random_pseudo_bytes(22));
$encrypted_password = md5($password . '' . $salt);
$query = "INSERT INTO users (username, email, password, salt, created_at, updated_at)
    VALUES ('{$username}', '{$email}', '{$encrypted_password}', '{$salt}', NOW(), NOW());
run_mysql_query($query);


?>