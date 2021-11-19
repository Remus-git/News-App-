<?php

    session_start();
    include("../vendor/autoload.php");

    use Libs\Database\MySQL;
    use Libs\Database\UsersTable;
    use Helpers\HTTP;

    $email = $_POST['email'];
    $password =  md5($_POST['password']);

    $table= new UsersTable(new MySQL());

    $user = $table->findEmailAndPassword($email,$password);
    if($user){
        $_SESSION['user'] = $user;
        HTTP::redirect("/index.php");
    }else{
        HTTP::redirect("/signIn.php", "incorrect = 1");
    }