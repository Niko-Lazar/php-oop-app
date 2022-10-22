<?php

namespace Models;

class Post
{
    public string $id = '';
    public string $title = '';
    public string $description = '';
    public string $date = '';
    public string $userID = '';


    public function __construct($postID = null)
    {
        if($postID != null) {
            $stmt = \Models\Database::$mysqli->prepare("SELECT * FROM posts WHERE id=?");
            $stmt->bind_param("s", $postID);
            $stmt->execute();

            $result = $stmt->get_result();

            $data = $result->fetch_object();

            if(!$data) {
                return var_dump($data);
            }

            $this->id = $data->id;
            $this->title = $data->title;
            $this->description = $data->description;
            $this->date = $data->date;
            $this->userID = $data->userID;
        }
    }

    public function getAllPosts($userID) : array {
        $stmt = \Models\Database::$mysqli->prepare("SELECT * FROM posts WHERE userID=?");
        $stmt->bind_param("s", $userID);
        $stmt->execute();

        $result = $stmt->get_result();

        if(!$result) {
            return [];
        }

        $posts = $result->fetch_all(MYSQLI_ASSOC);

        return $posts;
    }

    public function createPost($title, $description, $userID) : bool {
        $stmt = Database::$mysqli->prepare("INSERT INTO posts (title, description, userID) VALUES (?,?,?)");
        $stmt->bind_param("sss", $title, $description, $userID);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result;
    }

    public function deletePost() : bool {
        if($this->id == ''){
            return false;
        }
        
        $stmt = Database::$mysqli->prepare("DELETE FROM posts WHERE id=?");
        $stmt->bind_param("s", $this->id);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result;
    }
}

?>
