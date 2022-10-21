<?php

namespace models\classes;

class Posts
{
    public string $id = '';
    public string $title = '';
    public string $description = '';
    public string $date = '';
    public array $posts= [];

    public function __construct($userID)
    {
        $stmt = \models\classes\Database::$mysqli->prepare("SELECT * FROM posts WHERE userID=?");
        $stmt->bind_param("s", $userID);
        $stmt->execute();

        $result = $stmt->get_result();

        $this->posts = $result->fetch_all(MYSQLI_ASSOC);
    }

    public function renderPosts(object $user) : void {

        foreach($this->posts as $post) {
            echo <<<POST
            <form action="views/view-post.php?id={$post['id']}" method="POST">
                <div class="card text-center mt-5">
                    <div class="card-header">
                    By: {$user->name} {$user->lastName}
                    </div>
                    <div class="card-body">
                    <h5 class="card-title">{$post['title']}</h5>
                    <p class="card-text">{$post['description']}</p>
                    </div>
                    <div class="card-footer text-muted">
                    posted: {$post['date']}
                    <a href="#" class="text-lnik">comments</a>
                    <button type="submit" name="submit">View post</button>
                    </div>
                </div>
            </form>
        POST;
        }
    }

    public function renderPost(string $postID, object $user) : void {
        $stmt = \models\classes\Database::$mysqli->prepare("SELECT * FROM posts WHERE id=?");
        $stmt->bind_param("s", $postID);
        $stmt->execute();

        $result = $stmt->get_result();

        $post = $result->fetch_object();

        $comments = new \models\classes\Comments($postID);

        $stringComments = '';

        foreach($comments->comments as $comment) {
            $stringComments .= "<p>" . $comment['comment'] . "</p>";
        }

        echo <<<POST
            <div class="container">
            <div class="row">
                <div class="col-6">
                    <div class="card text-center mt-5">
                        <div class="card-header">
                        By: {$user->name} {$user->lastName}
                        </div>
                        <div class="card-body">
                        <h5 class="card-title">{$post->title}</h5>
                        <p class="card-text">{$post->description}</p>
                        </div>
                        <div class="card-footer text-muted">
                        posted: {$post->date}
                        </div>
                    </div>
                </div>
                <div class="col-6">
                <div class="card text-center mt-5">
                        <div class="card-header">
                            comment
                        </div>
                        <div class="card-body">
                            {$stringComments}
                        </div>
                    </div>
                </div>
            </div>
        POST;
    }
}

?>
