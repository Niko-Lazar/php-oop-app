<?php

namespace Models;

class Comment extends \Helpers\CRUD
{
    public string $id = '';
    public string $comment = '';
    public string $date = '';
    public string $userID = '';
    public string $postID = '';

    public function __construct(string $commentID = null)
    {
        if($commentID != null) {

            $data = self::readRow('comments', 'id', $commentID, 's');

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

        $comments = self::readAll('comments', 'postID', $postID, 's');

        $objectArray = [];

        foreach($comments as $comment){
            $objectArray[] = \Helpers\Helper::arrToObj($comment);
        }

        return $objectArray;
    }


    public function deleteComment(string $commentID) : bool {

        $result = self::delete('comments', $commentID);

        return $result;
    }

    public function createComment() : bool {

        $result = self::create('comments', ['comment', 'userID', 'postID'], [$this->comment, $this->userID, $this->postID], 'sss');

        return $result;
    }
}


?>