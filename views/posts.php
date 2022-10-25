<?php require_once 'includes/header.php' ?>

<?php

$token = \Helpers\Helper::firstVisit();

$user = new \Models\User($token);

$post = new \Models\Post();

$posts = $post->getAllPosts($user->id);

if(isset($_POST['deletePost'])) {
    $postID = $_POST['postID'];
    $postToDelete = new \Models\Post($postID);
    $postToDelete->deletePost();

    header("Location: $_SERVER[PHP_SELF]");
}

if(isset($_POST['postComment'])) {
    $commentContent = $_POST['commentContent'];
    $postID = $_POST['postID'];

    $createComment = new \Models\Comment();
    $createComment->comment = $commentContent;
    $createComment->postID = $postID;
    $createComment->userID = $user->id;

    $createComment->createComment();
}

?>

<div class="container">
    <div class="row">

        <?php foreach($posts as $post): ?>

            <div class="col-12 mt-3">
                <div class="card" style="width: 24rem;">
                    <div class="card-body">
                        <h5 class="card-title">
                            <span class="text-muted">title: </span>
                            <?php echo $post->title; ?>
                        </h5>
                        <h6 class="card-subtitle mb-2 text-muted">
                            By: <?php echo $user->name . " " . $user->lastName; ?>
                            <br>
                            posted: <?php echo $post->date; ?>
                        </h6>
                        <hr>
                        <p class="card-text"><?php echo $post->description; ?></p>
                        <hr>
                        <br>
                        <a href="view-post.php?id=<?php echo $post->id ?>" class="card-link">comments</a>
                        <div>
                            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                <textarea name="commentContent"cols="40" rows="2">your comment</textarea>
                                <input type="hidden" name="postID" value="<?php echo $post->id; ?>">
                                <br>
                                <input type="submit" name="postComment" value="comment">
                            </form>
                        </div>
                        <br><br>
                        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                            <input type="hidden" name="postID" value="<?php echo $post->id; ?>">
                            <input type="submit" name="deletePost" value="delete post">
                        </form>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>

    </div>
</div>

<?php require_once 'includes/footer.php' ?>