<?php

$metodo = $_SERVER['REQUEST_METHOD'];
$url = $_SERVER['REQUEST_URI'];


if($metodo === 'GET' && preg_match('/^\/games\/?$/i', $url)){

}