<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>Log in and Registration</title>
</head>
<style>
body{
    background: #121212;
    color: #00ffd5;
    align-items: center;
    text-align: center;
}
input{
    display: block;
    margin: 0px auto;
    border-radius: 20px;
    border-style: ridge;
    border-color: #00ffd5;
    box-shadow: 1px 1px #00ffd5;
}
.wrapper{
    border-radius: 70px;
    background: #121212;
    box-shadow:  32px 32px 64px #070707,
            -32px -32px 64px #1d1d1d;
    width: 500px;
    height: 520px;
    margin: 0px auto;
    border-top-right-radius: 20px;
    border-bottom-left-radius: 20px;
}
.error{
    color: red;
}
.message{
    color: green;
}

</style>
<body>
<?php

    if(isset($_SESSION['errors'])){
        
        foreach ($_SESSION['errors'] as $error){
            echo "<p class='error'>{$error}</p>";
        }
        unset($_SESSION['errors']);
    }
    if(isset($_SESSION['message'])){
        echo "<p class='success'>{$_SESSION['message']}</p>";
        unset($_SESSION['message']);
    }

?>
<div class='wrapper'>
<h2>Register</h2>
<form action='process.php' method='post'>
    <input type='hidden' name='action' value='register'>
    First Name: <input type='text' name='first_name'><br>
    Last Name: <input type='text' name='last_name'><br>
    Email: <input type='text' name='email'><br>
    Password: <input type='password' name='password'><br>
    Confirm Password: <input type='password' name='confirm_password'><br>
    <input type='submit' value='register'>
</form>

<h2>Login</h2>
<form action='process.php' method='post'>
    <input type='hidden' name='action' value='login'>
    Email Addrress: <input type='text' name='email'><br>
    Password: <input type='password' name='password'><br>
    <input type='submit' value='login'>
</form>
</div>
</body>
</html>