<?php

namespace Models;

class User extends \Helpers\CRUD
{
    public string $id = '';
    public string $name = '';
    public string $lastName = '';
    public string $date = '';
    public string $token = '';

    public function __construct(string $token)
    {

        $data = self::readRow('users', 'token', $token, 's');
        $this->id = $data->id;
        $this->name = $data->name;
        $this->lastName = $data->lastName;
        $this->date = $data->date;
        $this->$token = $data->token;
    }

    public function createUser(string $name, string $lastName, string $token) : bool {
  
        $result = self::update('users', ['name', 'lastName'], [$name, $lastName, $token], 'token', 'sss');

        return $result;
    }

}


?>