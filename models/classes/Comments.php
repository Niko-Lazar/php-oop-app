<?php

namespace models\classes;

class Comments
{
    public array $comments = [];
    
    public function __construct($postID)
    {
        $stmt = \models\classes\Database::$mysqli->prepare("SELECT * FROM comments WHERE postID=?");
        $stmt->bind_param("s", $postID);
        $stmt->execute();

        $result = $stmt->get_result();

        $this->comments = $result->fetch_all(MYSQLI_ASSOC);
    }


}


?>