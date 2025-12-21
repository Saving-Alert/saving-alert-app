<?php

function is_user_logged(): bool
{
    return session()->get('front_logged_in') === true;
}

function is_back_user_logged(): bool
{
    return session()->get('logged_in') === true;
}

function front_user_id(): ?int
{
    return session()->get('front_id');
}

function user_phone_verified(): bool
{
    if (!front_user_id()) return false;

    $db = \Config\Database::connect();
    $row = $db->table('front_users')
              ->select('phone_verified')
              ->where('id', front_user_id())
              ->get()
              ->getRow();

    return $row && $row->phone_verified === 'Y';
}
