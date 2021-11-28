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
        error_reporting(E_ERROR | E_PARSE);
        
        use Libs\Database\MySQL;
        use Libs\Database\postsTable;
        use Libs\Database\commentsTable;
        use Libs\Database\likesTable;
        use Helpers\Auth;

        $table = new postsTable(new MySQL());
        $category_id = $_GET['category_id'];
        if($category_id){
            $postData = $table->getAll($category_id);
        }
        else{
            $postData = $table->allTopics();
        }

        $likeTable = new likesTable(new MySQL());

        $commentTable = new commentsTable(new MySQL());
        $commentData = $commentTable->getComment();
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
                        <a href="/index.php"><h3>All</h3></a>
                        <a href="/index.php?category_id=1"><h3>Finance</h3></a>
                        <a href="/index.php?category_id=2"><h3>Technology</h3></a>
                        <a href="/index.php?category_id=3"><h3>Politics</h3></a>
                        <a href="/index.php?category_id=4"><h3>Science</h3></a>
                        <a href="/index.php?category_id=5"><h3>Health</h3></a>
                        <a href="/index.php?category_id=6"><h3>Sports</h3></a>
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
            <?php if(isset($_SESSION['user'])) : 
                $auth = Auth::check();    
            ?>
                <div class="postContainer">
                    <?php foreach($postData as $post) :?>
                            <div class="indiPostContainer">
                                <div class="indiPost">
                                        <div class="indiPostImage">
                                            <?php 
                                                $post_id = $post->id;
                                                $postPhoto = $table->getPhoto($post_id);
                                            ?>
                                            <?php foreach($postPhoto as $photo) : ?>
                                                <img src="/_actions/post_images/<?= $photo->post_photo ?>" alt="">
                                            <?php endforeach ?>    
                                        </div>
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
                                                    <?php $likesInfo = $likeTable->getLikeCounts($post_id);
                                                         $likesCount = COUNT($likesInfo);
                                                    ?>
                                                    
                                                    <?php $likes=$likeTable->getLikes($post->id,$auth[0]->id);
                                                          if(!($likes)) :
                                                    ?>
                                                            <div class="postLike">
                                                                <a href="/_actions/insertLIke.php?postId=<?=$post->id?>">
                                                                    <img src="/icons/heart.svg" alt="">
                                                                </a>
                                                                <span><?= $likesCount?></span>  
                                                            </div>
                                                    <?php else : ?>
                                                            <div class="postLike">
                                                                <a href="">
                                                                    <img src="/icons/heartFilled.svg" alt="">
                                                                </a>
                                                                <span><?= $likesCount?></span>  
                                                            </div>
                                                    <?php endif ?>
                                                    <div class="postComment">
                                                        <a href="individualPost.php?id=<?=$post->id?>"><img src="/icons/message-square.svg" alt=""></a>
                                                    </div>
                                        </div>
                                        <div class="comment">
                                                    <form action="/_actions/addComment.php?id=<?=$post->id?>" method="post">
                                                        <input type="text" name="comment" id="comment" placeholder="Add Comment" required>
                                                        <button type="submit" id="addComment">Add</button>
                                                    </form>
                                        </div>
                                        <div class="commentDisplayContainer">
                                            <?php foreach($commentData as $comment) :?>
                                                <?php if($post->id == $comment->post_id) :?>
                                                        <div class="commentDisplay">
                                                            <div class="commentAuthor">
                                                                <img src="/_actions/photos/<?= $comment->photo?>" alt="">
                                                            </div>
                                                            <div class="commentContent">
                                                                <h3><?= $comment->name ?></h3>
                                                                <span><?= $comment->content?></span>
                                                            </div>
                                                        </div>
                                                <?php endif ?>
                                            <?php endforeach ?> 
                                        </div>    
                                    </div>
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
