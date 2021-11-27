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
    
    $data =[
        ':userId'=>$auth[0]->id,
        ':title' =>$_POST['title'],
        ':content' => $_POST['content'],
        ':category'=> $_POST['category'],
    ];
    $table = new postsTable(new MySQL());
    $tableData =$table->insert($data);

    $photo = $_FILES['photo'];
    
    $photo_count = count($photo['name']);

    for($i= 0;$i < $photo_count; $i++){
        $photo_name = $photo['name'][$i];
        $photo_tmp = $photo['tmp_name'][$i];
        $photo_error = $photo['error'][$i];

        if($photo_error === 0){
          $photo_path = pathinfo($photo_name,PATHINFO_EXTENSION);
          $photo_path_lower = strtolower($photo_path);

          $photo_type = array('jpg','jpeg','png');

          if(in_array($photo_path_lower,$photo_type)){
              $photo_name;
              $photo_storage_path ='post_images/'.$photo_name;

              $photoData=[
                ':photo'=>$photo_name,
                ':post_id'=>$tableData
            ];
           $uploadSuccess = $table->upload($photoData);
            move_uploaded_file($photo_tmp,$photo_storage_path);
          }
          else{
              HTTP::redirect('index.php','error= please choose a valid file type');
          }
        }
    }
    
    if($uploadSuccess){
        HTTP::redirect('index.php');
    }else{
        HTTP::redirect('index.php','uploadFail = 1');
    }

    