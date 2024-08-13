<?php

namespace Smart\Resale\Controller\User;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Smart\Resale\Repository\UserRepository;

readonly class LoginController implements RequestHandlerInterface
{
    public function __construct(
        private UserRepository $userRepository,
    )
    {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $parsedBody = $request->getParsedBody();

        $email = filter_var($parsedBody['email'], FILTER_VALIDATE_EMAIL);
        $password = filter_var($parsedBody['password']);

        if ($email === false || $email === null) {
            return new Response(302, ['Location' => '/login?error=1']);
        }

        $userData = $this->userRepository->findUserByEmail($email);

        if (password_verify($password, $userData['password'] ?? '')) {
            if (password_needs_rehash($userData['password'], PASSWORD_ARGON2ID)) {
                $this->userRepository->updatePassword($userData['password'], $userData['id']);
            }

            $_SESSION['logged_in'] = true;
            return new Response(302, ['Location' => '/']);
        }

        return new Response(302, ['Location' => '/login?error=1']);
    }
}
