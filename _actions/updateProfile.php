<?php
    include('../vendor/autoload.php');

    use Libs\Database\MySQL;
    use Libs\Database\UsersTable;
    use Helpers\HTTP;
    use Helpers\Auth;
    $auth = Auth::check();
    $matchUserId = $auth[0]->id;
    $updateName = $_POST['name'];
    $updateAbout = $_POST['about'];
    $updatePhone = $_POST['phone'];
    $updateEmail = $_POST['email'];

    $updatePhoto = $_FILES['photo']['name'];
    $error = $_FILES['photo']['error'];
    $tmp = $_FILES['photo']['tmp_name'];
    $type = $_FILES['photo']['type'];

    $table = new UsersTable(new MySQL());
    $updatedProfile = $table->updateUserProfile($updateName,$updateAbout,$updatePhone,$updateEmail,$matchUserId,$updatePhoto);
    move_uploaded_file($tmp,"photos/$updatePhoto");
    $auth[0]->photo = $updatePhoto;
    if($updatedProfile){
        $_SESSION['user'] = $updatedProfile;
        HTTP::redirect("/profile.php");
    }else{
        HTTP::redirect("_actions/updateProfile.php", "updatedFail = 1");
    }
