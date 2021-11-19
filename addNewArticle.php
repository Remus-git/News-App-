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
    <div class="mainContainer">
        <?php include ('navBar.php') ?>
        <div class="addArticleContainer">
            <form action="/_actions/addArticle.php" method="post" enctype="multipart/form-data">
                <h1>Add New Article</h1>
                <label>Choose a category for Your article:
                        <input list="categories" name="category"></label>
                        <datalist id="categories">
                        <option value="Finance">
                        <option value="Technology">
                        <option value="Politics">
                        <option value="Science">
                        <option value="Health">
                        <option value="Sports">
                    </datalist>
                <label for="title">Title Of Article</label>
                <input type="text" name="title" id="title" placeholder="Title Here">
                <label for="content">Content</label>
                <textarea name="content" id="content" cols="30" rows="15" placeholder="Content Here"></textarea>
                <label for="photo">Photo</label>
                <input type="file" name="photo" id="photo">
                <button type="submit">Upload</button>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="/script.js"></script>
</body>
</html>