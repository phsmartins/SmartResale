<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/style/main.css">
    <link rel="stylesheet" href="/style/login.css">

    <title>SmartResale | Entre ou Cadastre-se</title>
</head>
<body>

<main>
    <div class="welcome__box">
        <img class="welcome__logo" src="/images/logo/logo-branca-SmartResale.png" alt="Logo da SmartResale" />

        <img class="welcome__image-login" src="/images/image-login.png" alt="Imagem para representar gestão em relação ao sistema" />
        <h1>Controle suas vendas do começo ao fim</h1>
    </div>

    <div class="form__box">
        <?= $this->section('content'); ?>

        <div class="developed">
            <p>Desenvolvido por <a target="_blank" href="https://github.com/phsmartins">Pedro Martins</a> | 2024 - v0.1.0-alpha</p>
        </div>
    </div>
</main>
</body>
