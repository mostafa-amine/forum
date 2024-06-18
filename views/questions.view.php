<?php require('partials/head.view.php'); ?>

<?php require('partials/nav.view.php') ?>

<main class="container">
    <div>
        <a class="btn btn-primary mt-5" href="/questions/create">
            Create Question
        </a>
    </div>
    <div class="row mt-2">
        <?php foreach ($questions as $question) { ?>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-header">
                        <?= $question['title'] ?>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            <?= $question['content'] ?>
                        </p>
                        <a href="<?= '/question?id=' . $question['id'] ?>" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</main>

<?php require('partials/footer.view.php') ?>