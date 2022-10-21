<?php

namespace models\classes;

class Posts
{
    public string $id = '';
    public string $title = '';
    public string $description = '';
    public string $date = '';
    public array $posts = [];

    public function __construct($userID)
    {
        $stmt = \models\classes\Database::$mysqli->prepare("SELECT * FROM posts WHERE userID=?");
        $stmt->bind_param("s", $userID);
        $stmt->execute();

        $result = $stmt->get_result();

        $this->posts = $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPost($postID) {
        $stmt = \models\classes\Database::$mysqli->prepare("SELECT * FROM posts WHERE id=?");
        $stmt->bind_param("s", $postID);
        $stmt->execute();

        $result = $stmt->get_result();

        $post = $result->fetch_object();

        return $post;
    }
}

?>
