<?php

namespace Models;

use \Helpers\CRUD;

class User extends CRUD
{
    public string $id = '';
    public string $name = '';
    public string $lastName = '';
    public string $date = '';
    public string $token = '';

    public function __construct(string $token)
    {
        $this->tableName = 'users';

        $data = self::readRow('token', $token, 's');
        $this->id = $data->id;
        $this->name = $data->name;
        $this->lastName = $data->lastName;
        $this->date = $data->date;
        $this->$token = $data->token;
    }

    public function createUser(string $name, string $lastName, string $token) : bool {
  
        $result = self::update(['name', 'lastName'], [$name, $lastName, $token], 'token', 'sss');

        return $result;
    }

}


?>