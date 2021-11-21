<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&family=Noto+Serif&family=Oswald&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/5af73e67ac.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php include('vendor/autoload.php');
         use Libs\Database\postsTable;
         use Libs\Database\MySQL;
         use Libs\Database\commentsTable;
         use Helpers\Auth;
         use Helpers\HTTP;
     
         $post_id = $_GET['id'];
         $table = new postsTable(new MySQL());
         $post=$table->individualPost($post_id);
        session_start();
    ?>
    <div class="mainContainer">
        <?php include('navBar.php') ?>
        <div class="indiPostContainer">
            <div class="indiPost">
                <?php if(   $post->post_photo) : ?>
                    <div class="indiPostImage">
                        <img src="/_actions/post_images/<?= $post->post_photo ?>" alt="">
                    </div>
                <?php endif ?>    
                <div class="indiPostInfo">
                    <div class="indiPostAuthor">
                        <img src="/_actions/photos/<?= $post->photo?>" alt="">
                        <h3><?=$post->name?></h3>
                    </div>
                    <div class="indiPostTitle">
                        <h1><?= $post->title ?></h1>
                    </div>
                    <div class="indiPostContent">
                        <h3><?= $post->content?></h3>
                    </div>
                    <div class="postLikeAndComment">
                                <div class="postLike">
                                    <img src="/icons/heart.svg" alt="">
                                </div>
                                <div class="postComment">
                                    <a href="individualPost.php?id=<?=$post->id?>"><img src="/icons/message-square.svg" alt=""></a>
                                </div>
                    </div>
                    <div class="comment">
                                <form action="/_actions/addComment.php?id=<?=$post->id?>" method="post">
                                    <input type="text" name="comment" id="comment" placeholder="Add Comment">
                                    <button type="submit">Add</button>
                                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="/script.js"></script>
</body>
</html>