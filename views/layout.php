<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/style/main.css">
    <link rel="stylesheet" href="/style/layout.css">

    <link rel="icon" href="/images/icon-smartResale.png" type="image/x-icon">

    <script src="https://kit.fontawesome.com/545cb6747b.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script defer src="/javascript/menuHeader.js"></script>
    <script src="/javascript/alertFunctions.js"></script>

    <title>SmartResale</title>
</head>
<body>
    <header>
        <div class="header__logo">
            <i id="headerMenu" class="fa-solid fa-bars"></i>

            <a class="header__dashboard" href="/">
                <img src="/images/logo/logo-branca-SmartResale.png" alt="Logotipo da SmartResale" />
            </a>
        </div>

        <a style="text-decoration: none" href="/logout"><div id="logout" class="header__logout">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            <p class="logout__text">Sair</p>
        </div></a>
    </header>

    <main>
        <aside id="mainMenu" class="menu">
            <div class="menu__option">
                <a href="/"><i class="fa-solid fa-house"></i> Dashboard</a>
            </div>

            <div class="menu__option">
                <a href="/"><i class="fa-solid fa-plus"></i> Nova venda</a>
            </div>

            <div class="menu__option">
                <a href="/"><i class="fa-solid fa-money-bill-transfer"></i> Nova entrada</a>
            </div>

            <div class="menu__option">
                <a href="/brands"><i class="fa-solid fa-tag"></i> Marcas</a>
            </div>

            <div class="menu__option">
                <a href="/"><i class="fa-solid fa-gift"></i> Produtos</a>
            </div>

            <div class="menu__option">
                <a href="/"><i class="fa-solid fa-users"></i> Clientes</a>
            </div>

            <div class="menu__option">
                <a href="/"><i class="fa-solid fa-book"></i> Vendas</a>
            </div>

            <div class="menu__option">
                <a href="/config/user"><i class="fa-solid fa-gear"></i> Configurações</a>
            </div>
        </aside>

        <section>
            <?= $this->section('content'); ?>
        </section>
    </main>

    <?php if (
        array_key_exists('success_title_message', $_SESSION) &&
        array_key_exists('success_text_message', $_SESSION)
    ): ?>
        <script>
            successMessage(
                "<?= $_SESSION['success_title_message'] ?>",
                "<?= $_SESSION['success_text_message'] ?>"
            );
        </script>
    <?php endif; ?>

    <?php
        unset($_SESSION['success_title_message']);
        unset($_SESSION['success_text_message']);
    ?>

    <?php if (
        array_key_exists('error_title_message', $_SESSION) &&
        array_key_exists('error_text_message', $_SESSION)
    ): ?>
        <script>
            errorMessage(
                "<?= $_SESSION['error_title_message'] ?>",
                "<?= $_SESSION['error_text_message'] ?>"
            );
        </script>
    <?php endif; ?>

    <?php
        unset($_SESSION['error_title_message']);
        unset($_SESSION['error_text_message']);
    ?>
</body>
