<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Document</title>
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UserProfile</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&family=Noto+Serif&family=Oswald&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/5af73e67ac.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php 
        include ('vendor/autoload.php');
        use Helpers\Auth;
        use Libs\Database\postsTable;
        use Libs\Database\MySQL;
        $auth = Auth::check();
        $table = new postsTable(new MySQL());
        $auth_id = $auth[0]->id;
        $postData = $table->getPost($auth_id);
    ?>
    <div class="mainContainer">
        <?php include('navBar.php')?>
        <div class="userProfileContainer">
            <div class="userProfile">
                <div class="welcomeUser">
                    <h1>Welcome<?=$auth[0]->name?></h1>
                    <div class="editIcon">
                        <img src="/icons/edit.svg" alt="" id="editProfileIcon">
                        <img src="/icons/x.svg" alt="" id="cancelEditProfileIcon">
                    </div>
                </div>
                <div class="profileInfoContainer">
                    <div class="profilePic">
                        <?php if($auth[0]->photo): ?>
                            <img
                            src="_actions/photos/<?= $auth[0]->photo ?>"
                            alt="Profile Photo">
                        <?php endif ?>
                    </div>
                    <div class="profileUserName">
                        <h1><?=$auth[0]->name?></h1>
                    </div>
                    <div class="profileUserDescription">
                        <h2>About</h2>
                        <h3>
                            <?php if(!(isset($auth[0]->about))): ?>
                                Write Something About You here
                            <?php endif ?>
                            <?= $auth[0]->about ?>
                        </h3>
                    </div>
                    <div class="profilePhone">
                        <h2>Phone</h2>
                        <h3><?=$auth[0]->phone?></h3>
                    </div>
                    <div class="profileEmail">
                        <h2>Email</h2>
                        <h3><?=$auth[0]->email?></h3>
                    </div>
                </div>
            </div>
            <div class="editUserProfile">
                <form action="/_actions/updateProfile.php" method="post" enctype="multipart/form-data">
                    <div class="welcomeUser">
                        <h1>Edit Your Info</h1>
                        <div class="editIcon">
                            <img src="/icons/edit.svg" alt="" id="editProfileIcon">
                            <img src="/icons/x.svg" alt="" id="cancelEditProfileIcon">
                        </div>
                    </div>
                    <div class="profilePic">
                            <input type="file" name="photo" id="profile" value="/_actions/photos/<?=$auth[0]->photo?>">
                            <img src="/_actions/photos/<?= $auth[0]->photo?>" alt="">
                    </div>
                    <div class="editUserName">
                        <input type="text" name="name" id="name" value="<?= $auth[0]->name?>">
                    </div>
                    <div class="editAbout">
                        <label for="about">About</label>
                        <textarea name="about" id="about" cols="30" rows="10"><?=$auth[0]->about?></textarea>
                    </div>
                    <div class="editPhone">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" value="<?=$auth[0]->phone?>">
                    </div>
                    <div class="editEmail">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="<?=$auth[0]->email?>">
                    </div>
                    <div class="confirmUserEdit">
                        <button type="submit">Save Changes</button>
                    </div>
                </form>    
            </div>
        </div>    
        <div class="userPostsContainer">
            <div class="userPosts">
                <div class="userPostsTitle">
                    <h1>Articles</h1>
                </div>
                <div class="articleContainer">
                    <?php foreach($postData as $post) : ?>
                        <?php if($post->post_photo) : ?>
                            <div class="article">
                                <div class="articleTitle">
                                    <?=$post->title?>
                                </div>
                                <div class="articleContent">
                                    <span><?= $post->content ?></span>
                                </div>
                                <img src="/_actions/post_images/<?= $post->post_photo ?>" alt="">
                            </div>
                        <?php endif ?>    
                    <?php endforeach ?>    
                </div>
            </div>
        </div>    
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="/script.js"></script>
</body>
</html>