<?php
    include('../vendor/autoload.php');
    use Libs\Database\MySQL;
    use Libs\Database\UsersTable;
    use Helpers\HTTP;

    $data = [
        "name" => $_POST['name'] ?? 'Unknown',
        "email" => $_POST['email'] ?? 'Unknown',
        "phone" => $_POST['phone'] ?? 'Unknown',
        "password" =>  md5($_POST['password']),
    ];
    $table = new UsersTable(new MySQL());

    if($table){
        $table->insert($data);
        HTTP::redirect("/signIn.php", "registered = true");
    }
    else{
        HTTP::redirect("/signUp.php", "error = ture");
    }