<?php

use \Helpers\Helper;
use \Models\User;
use \Models\Post;
use \Models\Comment;

$token = Helper::firstVisit();

$user = new User($token);

$post = new Post();

$posts = $post->getAllPosts($user->id);

if(isset($_POST['deletePost'])) {
    $postID = $_POST['postID'];
    $postToDelete = new Post($postID);
    $postToDelete->deletePost();

    header("Location: $_SERVER[PHP_SELF]");
}

if(isset($_POST['postComment'])) {
    $commentContent = $_POST['commentContent'];
    $postID = $_POST['postID'];

    $createComment = new Comment();
    $createComment->comment = $commentContent;
    $createComment->postID = $postID;
    $createComment->userID = $user->id;

    $createComment->createComment();
}

?>