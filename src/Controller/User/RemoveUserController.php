<?php

namespace Smart\Resale\Controller\User;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Smart\Resale\Repository\UserRepository;
use Smart\Resale\Traits\FlashMessageTrait;

readonly class RemoveUserController implements RequestHandlerInterface
{
    use FlashMessageTrait;

    public function __construct(
        private UserRepository $userRepository,
    )
    {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $parsedBody = $request->getParsedBody();
        $password = $parsedBody['password_delete'];

        if (empty($password)) {
            $this->addErrorMessageAlert("O campo 'Senha' não pode ser vazio");
            return new Response(302, ['Location' => '/config/user']);
        }

        $userData = $this->userRepository->findUserData($_SESSION['user_id']);

        if (!password_verify($password, $userData['password'])) {
            $this->addErrorMessageAlert("Senha incorreta", "Tente novamente");
            return new Response(302, ['Location' => '/config/user']);
        }

        if (!$this->userRepository->removerUser($_SESSION['user_id'])) {
            $this->addErrorMessageAlert("Whoops... Erro inesperado", "Tente novamente mais tarde");
            return new Response(302, ['Location' => '/config/user']);
        }

        $this->addSuccessMessageAlert("Conta deletada com sucesso");
        unset($_SESSION['logged_in']);
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email_login']);
        return new Response(302, ['Location' => '/login']);
    }
}
