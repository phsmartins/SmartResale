<?php

namespace Smart\Resale\Controller\User;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Smart\Resale\Entity\User;
use Smart\Resale\Repository\UserRepository;
use Smart\Resale\Traits\FlashMessageTrait;

readonly class SignUpController implements RequestHandlerInterface
{
    use FlashMessageTrait;

    public function __construct(
        private UserRepository $userRepository,
    )
    {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die('CSRF token inválido.');
        }

        $parsedBody = $request->getParsedBody();

        $name = filter_var($parsedBody['name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($parsedBody['email'], FILTER_VALIDATE_EMAIL);
        $confirmEmail = filter_var($parsedBody['confirm_email'], FILTER_VALIDATE_EMAIL);
        $password = filter_var($parsedBody['password']);

        $_SESSION['user_name_sign'] = $name;
        $_SESSION['user_email_sign'] = $email;

        if (empty($name)) {
            $this->addErrorMessage("O campo 'Nome completo' não pode ser vazio");
            return new Response(302, ['Location' => '/signup']);
        }

        if ($email === false || $email === null) {
            $this->addErrorMessage("Digite um e-mail válido");
            return new Response(302, ['Location' => '/signup']);
        }

        if ($email != $confirmEmail) {
            $this->addErrorMessage("Os e-mails informados não são iguais");
            return new Response(302, ['Location' => '/signup']);
        }

        $newUser = new User(
            $name,
            $email,
            $password
        );

        if (!$this->userRepository->addUser($newUser)) {
            $this->addErrorMessageAlert("Whoops... Erro inesperado", "Tente novamente mais tarde");
            return new Response(302, ['Location' => '/signup']);
        }

        $this->addSuccessMessageAlert("Conta criada com sucesso!", "Pronto para acessar o sistema");
        return new Response(302, ['Location' => '/login']);
    }
}
