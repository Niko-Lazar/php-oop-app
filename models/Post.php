<?php

namespace Models;

class Post extends \Helpers\CRUD
{
    public string $id = '';
    public string $title = '';
    public string $description = '';
    public string $date = '';
    public string $userID = '';


    public function __construct(string $postID = null)
    {
        if($postID != null) {

            $data = self::readRow('posts', 'id', $postID, 's');

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

    public function getAllPosts(string $userID) : array {

        $result = self::readAll("posts", 'userID', $userID, 's');

        if(empty($result)) {
            return [];
        }
        
        $objectArray = [];

        foreach($result as $rez) {
            $objectArray[] = \Helpers\Helper::arrToObj($rez);
        }

        return $objectArray;
    }

    public function createPost(string $title, string $description, string $userID) : bool {

        $result = self::create('posts', ['title', 'description', 'userID'], [$title, $description, $userID], 'sss');

        return $result;
    }

    public function deletePost() : bool {
        if($this->id == ''){
            return false;
        }

        $result = self::delete('posts', $this->id);
        return $result;
    }
}

?>
