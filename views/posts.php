<?php

require_once 'vendor/autoload.php';

\Models\Database::startConn();

$token = \Models\Helper::firstVisit();

$user = new \Models\User($token);

$post = new \Models\Post();

$posts = $post->getAllPosts($user->id);


if(isset($_POST['deletePost'])) {
    $postID = $_POST['postID'];
    $postToDelete = new \Models\Post($postID);
    $postToDelete->deletePost();

    header("Location: $_SERVER[PHP_SELF]");
}

\Models\Database::closeConn();

?>
<?php require_once 'includes/header.php' ?>

<div class="container">
    <div class="row">

        <?php foreach($posts as $post): ?>

            <div class="col-12">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $post['title']; ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted">
                            By: <?php echo $user->name . " " . $user->lastName; ?>
                            <br>
                            posted: <?php echo $post['date']; ?>
                        </h6>
                        <p class="card-text"><?php echo $post['description']; ?></p>
                        <a href="views/view-post.php?id=<?php echo $post['id'] ?>" class="card-link">view post</a>
                        <a href="#" class="card-link">comments</a>
                        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                            <input type="hidden" name="postID" value="<?php echo $post['id']; ?>">
                            <input type="submit" name="deletePost" value="delete post">
                        </form>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>

    </div>
</div>



<?php require_once 'includes/footer.php' ?>