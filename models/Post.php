<?php

namespace Models;

use \Helpers\Model;
use \Helpers\Helper;

class Post extends Model
{
    public string $id = '';
    public string $title = '';
    public string $description = '';
    public string $date = '';
    public string $userID = '';
    public array $comments = [];

    public function __construct(string $postID = null)
    {
        $this->tableName = 'posts';
        
        if($postID != null) {

            $data = self::readRow('id', $postID, 's');

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
}