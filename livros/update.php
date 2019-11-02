<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'vendor/autoload.php';

use \Symfony\Component\HttpFoundation\Request;
use \Doctrine\DBAL\Configuration;
use \Doctrine\DBAL\DriverManager;

header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $em = DriverManager::getConnection(['url' => 'sqlite:///livros.sqlite'], new Configuration());
    $em->beginTransaction();

    try {
        $livros = $em->createQueryBuilder()
            ->update('livro')
            ->set('titulo', ':titulo')
            ->setParameter('titulo', mb_strtoupper(filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS)))
            ->where('id = :id')
            ->setParameter('id', filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS))
            ->execute();

        $em->commit();

        print json_encode(['message' => 'Livro atualizado com sucesso'], 200);


    } catch (Exception $e){
        $em->rollBack();
        throw $e;
    }
}
