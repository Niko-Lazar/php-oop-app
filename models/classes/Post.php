<?php

namespace models\classes;

class Post
{
    public string $id = '';
    public string $title = '';
    public string $description = '';
    public string $date = '';

    public function __construct($userID)
    {
        $stmt = \models\classes\Database::$mysqli->prepare("SELECT * FROM posts WHERE userID=?");
        $stmt->bind_param("s", $userID);
        $stmt->execute();

        $result = $stmt->get_result();

        $data = $result->fetch_array(MYSQLI_ASSOC);

        $this->id = $data['id'];
        $this->title = $data['title'];
        $this->description = $data['description'];
        $this->date = $data['date'];
    }

    public function renderPost(object $user) {

        echo <<<POST
            <div class="card text-center mt-5">
            <div class="card-header">
            By: {$user->name} {$user->lastName}
            </div>
            <div class="card-body">
            <h5 class="card-title">{$this->title}</h5>
            <p class="card-text">{$this->description}</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
            <div class="card-footer text-muted">
            posted: {$this->date}
            </div>
        </div>
        POST;
    }
}

?>
