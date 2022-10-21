<?php require_once 'includes/header.php' ?>

<?php

require_once '../vendor/autoload.php';

\Models\Database::startConn();

$postID = $_GET['id'];

$token = \Models\Helper::firstVisit();

$user = new \Models\User($token);

$posts = new \Models\Posts($user->id);

$post = $posts->getPost($postID);

$comments = new \Models\Comments($postID);

if(isset($_POST['deleteComment'])) {
    $commentID = $_POST['commentID'];

    $result = $comments->deleteComment($commentID);

    header("Location: $_SERVER[PHP_SELF]?id={$postID}");
}


\Models\Database::closeConn();
?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $post->title; ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        By: <?php echo $user->name . " " . $user->lastName; ?>
                        <br>
                        posted: <?php echo $post->date; ?>
                    </h6>
                    <p class="card-text"> <?php echo $post->description; ?> </p>
                    <hr>
                    <p class="card-text">
                        <?php foreach($comments->comments as $comment): ?>

                            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                <?php echo $comment['comment']; ?>
                                <input type="hidden" name="commentID" value="<?php echo $comment['id']; ?>">
                                <input type="submit" name="deleteComment" value="delete">
                            </form>
                            <br>
                            <?php echo $comment['date']; ?>
                            <br>

                        <?php endforeach; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require_once 'includes/footer.php' ?>