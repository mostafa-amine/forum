<?php require('partials/head.view.php'); ?>

<?php require('partials/nav.view.php') ?>

<main class="container">
    <form method="POST" action="/questions/create">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title">
            <p class="text-danger"><?= $errors['title'] ?? null ?></p>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content"></textarea>
            <p class="text-danger"><?= $errors['content'] ?? null ?></p>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</main>

<?php require('partials/footer.view.php') ?>