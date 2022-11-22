<?php

$host = 'localhost:3307';
$usuario = 'root';
$senha = '';
$database = 'crud-php';


$mysqli = new mysqli($host,$usuario,$senha,$database);

if ($mysqli->error){
    die("Falha ao conectar ao banco de dados: " . $mysqli->error);
}

function formatar_data($data){
    return implode('/', array_reverse(explode('-',$data)));
}

function formatar_telefone($telefone){
    $ddd = substr($telefone,0,2);
    $parte1 = substr($telefone,2,5); 
    $parte2 = substr($telefone,7);
    return "($ddd) $parte1-$parte2";
}