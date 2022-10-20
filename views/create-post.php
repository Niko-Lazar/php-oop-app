<?php require_once 'includes/header.php' ?>

<div class="container">
    <div class="row">
        <form action="../modules/logic/CreatePost.php" method="POST">
            <div class="form-box mt-5">
                <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="name">
                </div>
                <div class="mb-3">
                <label for="lastName" class="form-label">last name</label>
                <input type="text" name="lastName" class="form-control" id="lastName" placeholder="last name">
                </div>
                <div class="mb-3">
                <label for="title" class="form-label">title</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="post title">
                </div>
                <div class="mb-3">
                <label for="postContent" class="form-label">Post content</label>
                <textarea name="description" class="form-control" id="postContent" rows="3"></textarea>
                </div>
                <input class="btn btn-secondary" type="submit" name="submit" value="Post">
            </div>
        </form>
    </div>
</div>

<?php require_once 'includes/footer.php' ?>