<?php require_once 'includes/header.php' ?>

<?php

require_once '../vendor/autoload.php';

\Models\Database::startConn();

$postID = $_GET['id'];

$token = \Models\Helper::firstVisit();

$user = new \Models\User($token);

$post = new \Models\Post($postID);

$comment = new \Models\Comment();

$comments = $comment->getAllComments($postID);

if(isset($_POST['deleteComment'])) {
    $commentID = $_POST['commentID'];

    $result = $comment->deleteComment($commentID);

    header("Location: $_SERVER[PHP_SELF]?id={$postID}");
}


\Models\Database::closeConn();
?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">
                        <span class="text-muted">title: </span>
                        <?php echo $post->title; ?>
                    </h5>
                    <hr>
                    <h6 class="card-subtitle mb-2 text-muted">
                        By: <?php echo $user->name . " " . $user->lastName; ?>
                        <br>
                        posted: <?php echo $post->date; ?>
                    </h6>
                    <hr>
                    <p class="card-text"> <?php echo $post->description; ?> </p>
                    <hr>
                    <p class="card-text">
                        <?php foreach($comments as $comment): ?>

                            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                <?php echo $comment->comment; ?>
                                <input type="hidden" name="commentID" value="<?php echo $comment->id; ?>">
                                -><input type="submit" name="deleteComment" value="delete">
                            </form>
                            <br>
                            <hr>
                            commented: <?php echo $comment->date; ?>
                            <br>
                            <hr>
                        <?php endforeach; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require_once 'includes/footer.php' ?>