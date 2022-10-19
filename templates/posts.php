<?php require_once 'includes/header.php' ?>

<?php

require_once 'modules/renders/Post.php';

use modules\renders\Post;

$post = new Post(
    "Lazar Nikolic",
    "my first post",
    "There should be a lot of text here but I don't know what to write so I am writing my thought right now.",
    "19/10/222",
);

$post->renderPost();


?>

<?php require_once 'includes/footer.php' ?>