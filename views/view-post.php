<?php require_once 'includes/header.php' ?>

<?php

require_once '../vendor/autoload.php';

\models\classes\Database::startConn();


$postID = $_GET['id'];
$token = \models\classes\Database::firstVisit();

$user = new \models\classes\User($token);
$posts = new \models\classes\Posts($user->id);

$posts->renderPost($postID, $user);



\models\classes\Database::closeConn();
?>
<?php require_once 'includes/footer.php' ?>