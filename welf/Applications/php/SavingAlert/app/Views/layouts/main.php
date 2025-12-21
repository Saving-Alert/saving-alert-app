<!DOCTYPE html>
<html lang="en">
<head>
    <?= view('header_links') ?>
</head>
<body>

<?= view('header') ?>

<?= $this->renderSection('content') ?>

<?= view('footer') ?>

<?= $this->renderSection('scripts') ?>

</body>
</html>
