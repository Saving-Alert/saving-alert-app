<?php

function get_user_info(int $user_id)
{
    $db = \Config\Database::connect();

    return $db->table('front_users')
              ->where('id', $user_id)
              ->get()
              ->getRow();
}

function is_user_dynamic(int $user_id): bool
{
    $user = get_user_info($user_id);
    return $user && $user->dynamic_login === 'Y';
}

function get_phone_number(): ?string
{
    if (!front_user_id()) return null;

    $db = \Config\Database::connect();

    $row = $db->table('front_users')
              ->select('phone_number')
              ->where('id', front_user_id())
              ->get()
              ->getRow();

    return $row?->phone_number;
}

function ami_reciver(): bool
{
    $user = get_user_info(front_user_id());
    return $user && $user->reciver === 'Y';
}
