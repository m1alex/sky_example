<?php

//error_reporting(E_ALL);
//
//ini_set('display_errors', true);
//ini_set('html_errors', true);
//ini_set('error_reporting', E_ALL ^ E_NOTICE);

define('ROOTPATH', realpath(__DIR__ . '/../'));

require_once '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(ROOTPATH);
$dotenv->load();

session_start();

//// RUN ONCE!!!
//$db = new \SQLite3('../db/sky.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
//
//$createTableSql = <<<SQL
//CREATE TABLE IF NOT EXISTS users (
//    id       INTEGER PRIMARY KEY NOT NULL, 
//    username VARCHAR(64) NOT NULL, 
//    email    VARCHAR(64) UNIQUE NOT NULL, 
//    salt     VARCHAR(32) NOT NULL,
//    password VARCHAR(32) NOT NULL,
//    active   INTEGER DEFAULT 0
//)
//SQL;
//$db->exec($createTableSql);
//$db->exec('CREATE INDEX IF NOT EXISTS check_auth ON users (email, password)');
//
//$createTableSql = <<<SQL
//CREATE TABLE IF NOT EXISTS users_activations (
//    id         INTEGER PRIMARY KEY NOT NULL, 
//    user_id    INTEGER UNIQUE NOT NULL, 
//    hash       VARCHAR(32) NOT NULL,
//    life_until INTEGER NOT NULL
//) 
//SQL;
//$db->exec($createTableSql);
//$db->exec('CREATE INDEX IF NOT EXISTS check_activation ON users_activations (hash)');
//
//$createTableSql = <<<SQL
//CREATE TABLE IF NOT EXISTS reset_paswords (
//    id         INTEGER PRIMARY KEY NOT NULL, 
//    user_id    INTEGER UNIQUE NOT NULL, 
//    hash       VARCHAR(32) NOT NULL,
//    life_until INTEGER NOT NULL
//) 
//SQL;
//$db->exec($createTableSql);
//$db->exec('CREATE INDEX IF NOT EXISTS check_reset_pssword ON reset_paswords (hash)');
