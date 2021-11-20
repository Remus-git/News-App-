<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DailyUpdate</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&family=Noto+Serif&family=Oswald&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/5af73e67ac.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php include('vendor/autoload.php');
        use Libs\Database\MySQL;
        use Libs\Database\postsTable;
        $table = new postsTable(new MySQL());
        $postData = $table->getAll();
        session_start();
    ?>
    <div class="mainContainer">
        <?php include('navBar.php')  ?>
        <div class="overViewContainer">
            <div class="categoryContainer">
                <div class="searchAndNoti">
                    <div class="search">
                        <img src="/icons/search.svg" alt="">
                        <input type="text" placeholder="Search">
                    </div>
                    <div class="noti">
                        <?php 
                            if(!isset($_SESSION['user'])) :
                        ?>
                            <a href="/signUp.php">
                                <div class="signUpBtn">
                                    SignUp
                                </div>
                            </a>
                            <a href="/signIn.php">
                                <div class="signInBtn">
                                    Login
                                </div>
                            </a>
                        <?php endif ?>
                        <img src="/icons/bell.svg" alt="">
                    </div>
                </div>
                <div class="category">
                    <div class="categoryTitles">
                        <a href=""><h3>All</h3></a>
                        <a href=""><h3>Finance</h3></a>
                        <a href=""><h3>Technology</h3></a>
                        <a href=""><h3>Politics</h3></a>
                        <a href=""><h3>Science</h3></a>
                        <a href=""><h3>Health</h3></a>
                        <a href=""><h3>Sports</h3></a>
                    </div>
                    <div class="chevronDown">
                        <img src="/icons/chevron-down.svg" alt="" id="chevronDown">
                        <img src="/icons/chevron-up.svg" alt="" id="chevronUp">
                    </div>
                </div>
            </div>    
            <div class="featuredNewsTitle">
                <h1>All Topics</h1>
                    <div class="addNewArticle">
                        <a href="/addNewArticle.php">
                            <img src="/icons/plus.svg" alt="">
                            <h2>Add New Article</h2>
                        </a>    
                    </div>
            </div>
            <?php if(isset($_SESSION['user'])) : ?>
                <div class="postContainer">
                    <?php foreach($postData as $post) :?>
                        <div class="post">
                            <?php if($post->post_photo) :?>
                                <div class="contentImage">
                                    <img src="/_actions/post_images/<?= $post->post_photo ?>" alt="">
                                </div>
                            <?php endif ?>
                            <div class="authorProfile">
                                <img src="/_actions/photos/<?= $post->photo?>" alt="">
                                <h3><?=$post->name?></h3>
                            </div>
                            <div class="postTitle">
                                <h1><?= $post->title ?></h1>
                            </div>
                            <div class="postContent">
                                <span><?= $post->content?></span>
                            </div>
                            <div class="postLikeAndComment">
                                <div class="postLike">
                                    <img src="/icons/heart.svg" alt="">
                                </div>
                                <div class="postComment">
                                    <img src="/icons/message-square.svg" alt="">
                                </div>
                            </div>
                            <div class="comment">
                                <form action="/_actions/addComment.php?id=<?=$post->id?>" method="post">
                                    <input type="text" name="comment" id="comment" placeholder="Add Comment">
                                    <button type="submit">Add</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            <?php endif ?>
            <?php if(!(isset($_SESSION['user']))) : ?>
                <div class="registerReminder">
                    <h1>Please Sign In First To Use All The Functions</h1>
                </div>
            <?php endif ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="/script.js"></script>
</body>
</html>