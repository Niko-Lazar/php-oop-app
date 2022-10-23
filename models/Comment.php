<?php

namespace Models;

class Comment
{
    public string $id = '';
    public string $comment = '';
    public string $date = '';
    public string $userID = '';
    public string $postID = '';

    public function __construct(string $commentID = null)
    {
        if($commentID != null) {
            $stmt = \Models\Database::$mysqli->prepare("SELECT * FROM comments WHERE id=?");
            $stmt->bind_param("s", $commentID);
            $stmt->execute();

            $result = $stmt->get_result();

            $data = $result->fetch_object();

            if(!$data) {
                return var_dump($data);
            }

            $this->id = $data->id;
            $this->comment = $data->comment;
            $this->date = $data->date;
            $this->userID = $data->userID;
            $this->postID = $data->postID;
        }
    }

    public function getAllComments(string $postID) : array {
        $stmt = \Models\Database::$mysqli->prepare("SELECT * FROM comments WHERE postID=?");
        $stmt->bind_param("s", $postID);
        $stmt->execute();

        $result = $stmt->get_result();

        if(!$result) {
            return [];
        }

        $comments = $result->fetch_all(MYSQLI_ASSOC);

        return $comments;
    }


    public function deleteComment(string $commentID) : bool {
        $stmt = \Models\Database::$mysqli->prepare("DELETE FROM comments WHERE id=?");
        $stmt->bind_param("s", $commentID);
        $result = $stmt->execute();

        return $result;
    }

    public function createComment() : bool {
        $stmt = \Models\Database::$mysqli->prepare("INSERT INTO comments (comment, userID, postID) VALUES(?,?,?)");
        $stmt->bind_param("sss", $this->comment, $this->userID, $this->postID);
        $result = $stmt->execute();

        return $result;
    }
}


?>