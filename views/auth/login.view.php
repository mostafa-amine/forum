<?php require(basePath('views/partials/head.view.php')); ?>
<?php session_start(); ?>
<div class="container mt-5">
    <form method="POST" action="/login">
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="email" required>
            <p class="text-danger"><?= $_SESSION['errors']['email'] ?? '' ?></p>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password">
            <p class="text-danger"><?= $_SESSION['errors']['password'] ?? '' ?></p>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<?php require(basePath('views/partials/footer.view.php')) ?>