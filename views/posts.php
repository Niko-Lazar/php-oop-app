<?php

use models\classes\Database;
use models\classes\Users;

 require_once 'includes/header.php' ?>
 
<?php

require_once 'vendor/autoload.php';

\models\classes\Database::startConn();

$token = \models\classes\Database::firstVisit();

$user = new \models\classes\User($token);

$post = new \models\classes\Post($user->id);

$post->renderPost($user);


?>

<?php require_once 'includes/footer.php' ?>