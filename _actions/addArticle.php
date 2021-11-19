<?php
    include('../vendor/autoload.php');
    use Libs\Database\MySQL;
    use Libs\Database\postsTable;
    use Helpers\Auth;
    use Helpers\HTTP;

    $auth = Auth::check();
    $userId = $auth[0]->id;
    $title = $_POST['title'];
    $content = $_POST['content'];
    
    $photo = $_FILES['photo']['name'];
    $error = $_FILES['photo']['error'];
    $tmp = $_FILES['photo']['tmp_name'];
    $type = $_FILES['photo']['type'];

    $data =[
        ':userId'=>$auth[0]->id,
        ':title' =>$_POST['title'],
        ':content' => $_POST['content'],
        ':category'=> $_POST['category'],
        ':photo' => $photo
    ];
    move_uploaded_file($tmp,"post_images/$photo");
    
    $table = new postsTable(new MySQL());
    $addNewPost =$table->insert($data);
    if($addNewPost){
        HTTP::redirect('index.php');
    }else{
        HTTP::redirect('index.php','uploadFail = 1');
    }

    