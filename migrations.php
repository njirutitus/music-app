<?php

require_once './core/Database.php';

echo "Applying Migrations\n";

$sql = 'CREATE TABLE IF NOT EXISTS user(id SERIAL,first_name TINYTEXT NOT NULL,last_name TINYTEXT NOT NULL,email TINYTEXT NOT NULL,password TINYTEXT NOT NULL, is_staff BOOLEAN NOT NULL DEFAULT 0,last_updated TIMESTAMP);';
// To prevent SQL INJECTION prepare first
$command = $db->prepare($sql);
$command->execute();

echo "Applied Migrations\n";


echo "Applying Migrations\n";

$sql = 'CREATE TABLE IF NOT EXISTS `album`(
    `id` bigint(20) UNSIGNED NOT NULL,
    `album_name` tinytext NOT NULL,
    `artist` tinytext NOT NULL,
    `genre` tinytext NOT NULL,
    `album_logo` tinytext NOT NULL,
    `is_favorite` tinyint(1) NOT NULL DEFAULT 0,
    `user` bigint(20) UNSIGNED NOT NULL,
    `added_on` timestamp);';
// To prevent SQL INJECTION prepare first
$command = $db->prepare($sql);
$command->execute();

echo "Applied Migrations\n";

echo "Applying Migrations\n";

$sql = 'CREATE TABLE IF NOT EXISTS `song` (
    `id` bigint(20) UNSIGNED NOT NULL,
    `song_title` tinytext NOT NULL,
    `audio_file` tinytext NOT NULL,
    `is_favorite` tinyint(1) NOT NULL DEFAULT 0,
    `album` bigint(20) UNSIGNED NOT NULL,
    `added_on` timestamp);';
// To prevent SQL INJECTION prepare first
$command = $db->prepare($sql);
$command->execute();

echo "Applied Migrations\n";

echo "Applying Migrations\n";

$sql = 'ALTER TABLE user DROP is_super_admin;';
// To prevent SQL INJECTION prepare first
$command = $db->prepare($sql);
$command->execute();

echo "Applied Migrations\n";



?>