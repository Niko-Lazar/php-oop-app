<?php

require_once 'vendor/autoload.php';

\models\classes\Database::startConn();

$token = \models\classes\Database::firstVisit();

$user = new \models\classes\User($token);

$posts = new \models\classes\Posts($user->id);

\models\classes\Database::closeConn();

?>
<?php require_once 'includes/header.php' ?>

<div class="container">
    <div class="row">

        <?php foreach($posts->posts as $post): ?>

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
                        <a href="views/view-post.php?id=<?php echo $post['id']; ?>" class="card-link">view post</a>
                        <a href="#" class="card-link">comments</a>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>

    </div>
</div>



<?php require_once 'includes/footer.php' ?>