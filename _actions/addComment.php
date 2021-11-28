<?php
    include('../vendor/autoload.php');
    use Libs\Database\MySQL;
    use Libs\Database\commentsTable;
    use Helpers\Auth;
    use Helpers\HTTP;

    $auth = Auth::check();

    $data=[
        ':userId' => $auth[0]->id,
        ':postId' => $_GET['id'],
        ':content' => $_POST['comment']
    ];
    $post_id = $_GET['id'];
    $table = new commentsTable(new MySQL());
    $table->insert($data);
    header("location: ../index.php?id=".$post_id);