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
            echo "<h2>Erro ao se conectar no banco de dados</h2>";
            exit();

            // throw new RuntimeException("Erro ao se conectar no banco de dados: " . $e->getMessage());
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
