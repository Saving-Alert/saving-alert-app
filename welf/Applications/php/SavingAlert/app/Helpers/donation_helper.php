<?php

function get_donation_data(int $donation_id)
{
    $db = \Config\Database::connect();

    return $db->table('donation_table')
              ->where('id', $donation_id)
              ->get()
              ->getRow();
}

function get_donator_id(int $donation_id): ?int
{
    $row = get_donation_data($donation_id);
    return $row?->front_user_id;
}

function own_donation_check(int $donation_id, int $front_id): bool
{
    $db = \Config\Database::connect();

    return $db->table('donation_table')
              ->where([
                  'id' => $donation_id,
                  'front_user_id' => $front_id
              ])
              ->countAllResults() > 0;
}

function claim_check(int $requester_id, int $donation_id): bool
{
    $db = \Config\Database::connect();

    return $db->table('front_claims')
              ->where([
                  'requester_id' => $requester_id,
                  'donation_id' => $donation_id
              ])
              ->countAllResults() > 0;
}

function donation_claimed_to(int $donation_id): ?int
{
    $db = \Config\Database::connect();

    $row = $db->table('front_claims')
              ->where([
                  'donation_id' => $donation_id,
                  'approved' => 'Y'
              ])
              ->get()
              ->getRow();

    return $row?->requester_id;
}
