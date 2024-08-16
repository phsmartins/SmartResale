<?php
    $this->layout('layout');

    /** @var $user */
?>

<link rel="stylesheet" href="/style/config.css">

<div class="container">
    <h1>Configurações</h1>

    <form method="post">
        <h2>Alterar dados cadastrados</h2>

        <label for="name">Nome completo:</label>
        <input
            value="<?= $user['name']; ?>"
            type="text" id="name" name="name"
            placeholder="Digite seu nome completo"
        />

        <label for="email">E-mail:</label>
        <input
            value="<?= $user['email']; ?>"
            type="text" id="email" name="email"
            placeholder="Digite seu e-mail"
        />

        <div class="password_box">
            <button type="submit">Atualizar</button>
        </div>
    </form>

    <form method="post">
        <h2>Alterar senha</h2>

        <input type="password" style="display: none" />

        <div class="input_box">
            <div>
                <label for="password">Senha atual:</label>
                <input type="password" id="password" name="old_password" placeholder="Digite sua senha atual" />
            </div>

            <div>
                <label for="newPassword">Nova senha:</label>
                <input type="password" id="newPassword" name="new_password" placeholder="Digite sua nova senha" />
            </div>
        </div>

        <div class="password_box">
            <button type="submit">Atualizar</button>
        </div>
    </form>
</div>
