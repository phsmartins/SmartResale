<?php $this->layout('layout-login'); ?>
<form method="post">
    <h2>Olá, bem-vindo!</h2>
    <p>Informe seu dados para criar uma conta</p>

    <?php if (array_key_exists('error_message_login', $_SESSION)): ?>
        <p class="error-message-login">
            <?= $_SESSION['error_message_login'] ?>

            <?php unset($_SESSION['error_message_login']); ?>
        </p>
    <?php endif; ?>

    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">

    <label for="name">Nome completo:</label>
    <input type="text" name="name" id="name" placeholder="Informe seu nome completo" required />

    <label for="email">E-mail:</label>
    <input
        type="text"
        name="email"
        id="email"
        value="<?= isset($_SESSION['user_email_login']) ? htmlspecialchars($_SESSION['user_email_login']) : ''; ?>"
        placeholder="Informe seu e-mail"
    />
    <?php unset($_SESSION['user_email_login']); ?>

    <label for="confirmEmail">Confirme seu e-mail:</label>
    <input type="text" name="confirm_email" id="confirmEmail" placeholder="Confirme seu e-mail" />

    <label for="password">Senha:</label>
    <input type="password" name="password" id="password" placeholder="Informe sua senha" required />

    <button type="submit">Cadastrar</button>

    <a href="/login" class="other-form">Já tem conta? Entre</a>
</form>
