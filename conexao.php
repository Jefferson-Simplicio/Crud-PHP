<?php

$host = 'localhost';
$usuario = 'root';
$senha = '';
$database = 'crud-php';


$mysqli = new mysqli($host,$usuario,$senha,$database);

if ($mysqli->error){
    die("Falha ao conectar ao banco de dados: " . $mysqli->error);
}