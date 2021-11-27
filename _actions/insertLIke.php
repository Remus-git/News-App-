<?php
  include('../vendor/autoload.php');
  use Libs\Database\MySQL;
  use Libs\Database\likesTable;
  use Helpers\HTTP;
  use Helpers\Auth;
  $auth = Auth::check();
  $table = new likesTable(new MySQL());
  $postId = $_GET['postId'];
  $userId = $auth[0]->id;
  $table->insert($postId,$userId);
  if($table){
      HTTP::redirect('../index.php');
  }else{
      HTTP::redirect('../index.php','reaction failed');
  }