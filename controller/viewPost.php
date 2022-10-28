<?php

use \Helpers\Helper;
use \Models\User;
use \Models\Post;
use \Models\Comment;

$postID = $_GET['id'];

$token = Helper::firstVisit();

$user = new User($token);

$post = new Post($postID);

$comment = new Comment();

$post->comments = $comment->getAllComments($post->id);

if(isset($_POST['deleteComment'])) {
    $commentID = $_POST['commentID'];

    $result = $comment->deleteComment($commentID);

    header("Location: $_SERVER[PHP_SELF]?id={$post->id}");
}

?>