<?php
const REDDIT_USERNAME = 'seu nome de usuário aqui';
const REDDIT_PASSWORD = 'sua senha no Redddit aqui';

const REDDIT_CSECRET = "SECRET aqui";
const REDDIT_CID = "SEU CLIENTE ID AQUI";
const REDDIT_USER_AGENT ='MyAgent'.REDDIT_USERNAME;

const PRODUCTION = false;

#DATABASE CONFIG
const DB_CONFIG = [
    "driver" => "mysql",
    "host" => "localhost",
    "port" => "3306",
    "dbname" => 'reddit',
    "username" => 'admin',
    "password" => 'love',
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
];


if(!PRODUCTION){
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
}