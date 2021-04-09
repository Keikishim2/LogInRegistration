<?php
    session_start();
    require('new-connection.php');

    if(isset($_POST['action']) && $_POST['action'] == 'register'){
        register_user($_POST);
    }
    elseif(isset($_POST['action']) && $_POST['action'] == 'login'){
        login_user($_POST);
    }
    else{
        session_destroy();
        header('location: index3.php');
        die();
    }
    $password = md5($password);
    $password = 'password';
    function register_user($post){
        $_SESSION['errors'] = array();

        if(strlen($post['first_name']) <= 2 ){
            $_SESSION['errors'][] =  "First name must be at least 2 letters or more!";
        }
        if(strlen($post['last_name']) <= 2){
        $_SESSION['errors'][] =  "Last name must be at least 2 letters or more!";
        }
        if(count($post['password']) >= 8){
            $_SESSION['errors'][] =  "Password must be 8 characters!";
        }
        if(!preg_match('[a-zA-Z]/', $post['first_name'] OR $post['last_name'])){
            $_SESSION['errors'][] = "Please use letters only!";
        }
        if($post['password'] !== $post['confirm_password']){
            $_SESSION['errors'][] =  "Passwords did not match!";
        }
        if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)){
            $_SESSION['errors'][] = "Please use a valid email!";
        }
        if(count($_SESSION['errors']) > 0){
            header('location: index3.php');
            die();
        }
        else{
            $query = "INSERT INTO users (first_name, last_name, password, email, created_at, updated_at) VALUES ('{$post['first_name']}', '{$post['last_name']}', '{$post['password']}', '{$post['email']}', NOW(), NOW())";
            
            run_mysql_query($query);
            $_SESSION['message'] = 'User successfully created!';
            header('location: index3.php');
            die();
        }
    }
    function login_user($post){
        $query = "SELECT * FROM users WHERE users.password = '{$post['password']}' 
                AND users.email = '{$post['email']}'";

        $user = fetch_all($query);
        if(count($user) > 0){
            $_SESSION['user_id'] = $user[0]['id'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['logged_in'] = TRUE;
            header('location: success.php');
        }
        else{
            $_SESSION['errors'][] = 'Cannot find user with the same credentials!';
            header('location: index3.php');
            die();
        }
    }


?>

