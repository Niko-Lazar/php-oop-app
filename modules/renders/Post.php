<?php

namespace modules\renders;

class Post
{
    function __construct(
        public string $byWho = '',
        public string $title = '',
        public string $description = '',
        public string $date = '',
    ) { }

    public function renderPost() {
        echo <<<POST
            <div class="container">
            <div class="row">
                <div class="card text-center mt-5">
                <div class="card-header">
                    By: {$this->byWho}
                </div>
                <div class="card-body">
                    <h5 class="card-title">{$this->title}</h5>
                    <p class="card-text">{$this->description}</p>
                </div>
                <div class="card-footer text-muted">
                    Posted: {$this->date}
                    <a href="#" class="btn-link">comments</a>
                </div>
                </div>
            </div>
        </div>
        POST;
    }
}

?>