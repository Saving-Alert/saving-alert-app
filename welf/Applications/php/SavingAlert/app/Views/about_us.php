<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <h1>About Us</h1>
    <!-- your about page content -->
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
    <?= view('scripts/login_jax') ?>
<?= $this->endSection() ?>
