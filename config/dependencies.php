<?php

$builder = new \DI\ContainerBuilder();
$builder->addDefinitions([
    PDO::class => function (): PDO {
        $dbPath = __DIR__ . '/../database.sqlite';

        try {
            $pdo = new PDO("sqlite:{$dbPath}");
            $pdo->exec("PRAGMA foreign_keys = ON;");

            return $pdo;
        } catch (PDOException $e) {
            echo "<h1>Erro ao conectar ao banco de dados</h1>";
            exit();

            // throw new RuntimeException('Erro ao conectar ao banco de dados: ' . $e->getMessage());
        }
    },
    \League\Plates\Engine::class => function () {
        $templatePath = __DIR__ . '/../views';
        return new \League\Plates\Engine($templatePath);
    }
]);

/** @var \Psr\Container\ContainerInterface $container */
$container = $builder->build();

return $container;
