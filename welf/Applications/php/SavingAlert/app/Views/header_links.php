<?php $session = session(); ?>

<ul id="respMenu" class="ace-responsive-menu text-right">

    <li><a href="<?= base_url() ?>">Home</a></li>
    <li><a href="<?= base_url('donations') ?>">Donations</a></li>
    <li><a href="<?= base_url('requests') ?>">Blood Requests List</a></li>

    <!-- Request Blood -->
    <li>
        <a href="<?= base_url('login?redirect=request-blood') ?>">
            Request Blood
        </a>
    </li>

    <li><a href="<?= base_url('contact') ?>">Contact</a></li>

    <?php if ($session->get('front_logged_in')): ?>
        <li>
            <a href="<?= base_url('account') ?>">Account</a>
            <ul>
                <li><a href="<?= base_url('logout') ?>">Logout</a></li>
            </ul>
        </li>
    <?php else: ?>
        <li>
            <a href="<?= base_url('login') ?>">Login / Register</a>
        </li>
    <?php endif; ?>

</ul>
