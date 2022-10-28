<?php

use \Helpers\Helper;
use \Models\User;
use \Models\Post;
use \Models\Comment;

$token = Helper::firstVisit();

$user = new User($token);

$post = new Post();

$posts = Helper::objectsArray($post->readAll('userID', $user->id, 's'));

if(isset($_POST['deletePost'])) {
    $postID = $_POST['postID'];
    $postToDelete = new Post($postID);

    $result = $postToDelete->delete($postToDelete->id);
    if(!$result) {
        return;
    }

    header("Location: $_SERVER[PHP_SELF]");
}

if(isset($_POST['postComment'])) {
    $commentContent = $_POST['commentContent'];
    $postID = $_POST['postID'];

    $createComment = new Comment();
    $createComment->comment = $commentContent;
    $createComment->postID = $postID;
    $createComment->userID = $user->id;

    $createComment->create(['comment', 'userID', 'postID'], [$createComment->comment, $createComment->userID, $createComment->postID], 'sss');
}

?>