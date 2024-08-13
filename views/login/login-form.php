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
            <form method="post">
                <h2>Olá, bem-vindo!</h2>
                <p>Digite as credênciais para acessar o sistema</p>

                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" placeholder="Informe seu e-mail" />

                <label for="password">Senha:</label>
                <input type="password" name="password" id="password" placeholder="Informe sua senha" />

                <button type="submit">Acessar</button>

                <span>Não tem conta? Cadastre-se</span>
            </form>

            <div class="developed">
                <p>Desenvolvido por <a href="https://github.com/phsmartins">Pedro Martins</a> | 2024 - v1.0.0</p>
            </div>
        </div>
    </main>

</body>
