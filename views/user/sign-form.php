<?php $this->layout('layout-login'); ?>
<form method="post">
    <h2>Olá, bem-vindo!</h2>
    <p>Informe seus dados para criar uma conta</p>

    <?php if (array_key_exists('error_message', $_SESSION)): ?>
        <p class="error-message-login">
            <?= $_SESSION['error_message'] ?>

            <?php unset($_SESSION['error_message']); ?>
        </p>
    <?php endif; ?>

    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">

    <label for="name">Nome completo:</label>
    <input
            type="text"
            name="name"
            id="name"
            value="<?= isset($_SESSION['user_name_sign']) ? htmlspecialchars($_SESSION['user_name_sign']) : ''; ?>"
            placeholder="Informe seu nome completo"
            required
    />
    <?php unset($_SESSION['user_name_sign']); ?>

    <label for="email">E-mail:</label>
    <input
        type="text"
        name="email"
        id="email"
        value="<?= isset($_SESSION['user_email_sign']) ? htmlspecialchars($_SESSION['user_email_sign']) : ''; ?>"
        placeholder="Informe seu e-mail"
    />
    <?php unset($_SESSION['user_email_sign']); ?>

    <label for="confirmEmail">Confirme seu e-mail:</label>
    <input type="text" name="confirm_email" id="confirmEmail" placeholder="Confirme seu e-mail" />

    <label for="password">Senha:</label>
    <input type="password" name="password" id="password" placeholder="Informe sua senha" required />

    <button type="submit">Cadastrar</button>

    <a href="/login" class="other-form">Já tem conta? Entre</a>
</form>

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
