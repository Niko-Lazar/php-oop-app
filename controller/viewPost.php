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

$post->comments = Helper::objectsArray($comment->readAll('postID', $post->id, 's'));

if(isset($_POST['deleteComment'])) {
    $commentID = $_POST['commentID'];

    $result = $comment->delete($commentID);

    if(!$result) {
        return;
    }

    header("Location: $_SERVER[PHP_SELF]?id={$post->id}");
}

?>