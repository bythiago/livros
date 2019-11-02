<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'vendor/autoload.php';


use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;
use \Doctrine\DBAL\Configuration;
use \Doctrine\DBAL\DriverManager;
use App\Livros\Util;

$em = DriverManager::getConnection(['url' => 'sqlite:///livros.sqlite'], new Configuration());
$livros = $em->createQueryBuilder()
    ->select("l.id, upper(l.titulo) titulo")
    ->from("livro", "l")
    ->orderBy('id', 'ASC')
    ->execute();

require_once 'conteudo.php';