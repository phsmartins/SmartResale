<?php

namespace Smart\Resale\Controller\User;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Smart\Resale\Repository\UserRepository;
use Smart\Resale\Traits\FlashMessageTrait;

readonly class UpdateUserController implements RequestHandlerInterface
{
    use FlashMessageTrait;

    public function __construct(
        private UserRepository $userRepository,
    )
    {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $parsedBody = $request->getParsedBody();

        if (array_key_exists("old_password", $parsedBody) && array_key_exists("new_password", $parsedBody)) {
            $oldPassword = $parsedBody['old_password'];
            $newPassword = $parsedBody['new_password'];

            if (empty($oldPassword) || empty($newPassword)) {
                $this->addErrorMessageAlert("Preencha todos os campos");
                return new Response(302, ['Location' => '/config/user']);
            }

            $userData = $this->userRepository->findUserData($_SESSION['user_id']);

            if (!password_verify($oldPassword, $userData['password'])) {
                $this->addErrorMessageAlert("A senha informada não é igual a sua senha atual");
                return new Response(302, ['Location' => '/config/user']);
            }

            if (!$this->userRepository->updatePassword($newPassword, $_SESSION['user_id'])) {
                $this->addErrorMessageAlert("Whoops... Erro inesperado", "Tente novamente mais tarde");
                return new Response(302, ['Location' => '/config/user']);
            }

            $this->addSuccessMessageAlert("Senha atualizada com sucesso", "Lembre-se de gravar muito bem");
            return new Response(302, ['Location' => '/config/user']);
        }

        $name = filter_var($parsedBody['name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($parsedBody['email'], FILTER_VALIDATE_EMAIL);

        if ($email === false || $email === null) {
            $this->addErrorMessageAlert("Digite um e-mail válido");
            return new Response(302, ['Location' => '/config/user']);
        }

        if (empty($name)) {
            $this->addErrorMessageAlert("O campo 'Nome completo' não pode ser vazio");
            return new Response(302, ['Location' => '/config/user']);
        }

        if (!$this->userRepository->updateUser($name, $email, $_SESSION['user_id'])) {
            $this->addErrorMessageAlert("Whoops... Erro inesperado", "Tente novamente mais tarde");
            return new Response(302, ['Location' => '/config/user']);
        }

        $this->addSuccessMessageAlert("Dados atualizado com sucesso");
        return new Response(302, ['Location' => '/config/user']);
    }
}
