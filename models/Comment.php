<?php

namespace Models;

use \Helpers\Helper;
use \Helpers\Model;

class Comment extends Model
{
    public string $id = '';
    public string $comment = '';
    public string $date = '';
    public string $userID = '';
    public string $postID = '';

    public function __construct(string $commentID = null)
    {
        $this->tableName = 'comments';
        
        if($commentID != null) {

            $data = self::readRow('id', $commentID, 's');

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

        $comments = self::readAll('postID', $postID, 's');

        $objectArray = [];

        foreach($comments as $comment){
            $objectArray[] = Helper::arrToObj($comment);
        }

        return $objectArray;
    }

    public function deleteComment(string $commentID) : bool {

        $result = self::delete($commentID);

        return $result;
    }

    public function createComment() : bool {

        $result = self::create(['comment', 'userID', 'postID'], [$this->comment, $this->userID, $this->postID], 'sss');

        return $result;
    }
}