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
}