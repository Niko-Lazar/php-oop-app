<?php

require_once '../vendor/autoload.php';

use \Models\Database;
use \Helpers\Helper;
use \Models\User;
use \Models\Post;

Database::startConn();

$token = Helper::firstVisit();

$user = new User($token);
$post = new Post();

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $lastName = $_POST['lastName'];
    $title = $_POST['title'];
    $description = $_POST['description'];


    $user->update(['name', 'lastName'], [$name, $lastName, $token], 'token', 'sss');
    $post->create(['title', 'description', 'userID'], [$title, $description, $user->id], 'sss');

    header("Location: /index.php");
}