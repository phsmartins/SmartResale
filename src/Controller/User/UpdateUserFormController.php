<?php

namespace Smart\Resale\Controller\User;

use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Smart\Resale\Repository\UserRepository;

readonly class UpdateUserFormController implements RequestHandlerInterface
{
    public function __construct(
        private Engine $engine,
        private UserRepository $userRepository
    )
    {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $userData = $this->userRepository->findUserData($_SESSION['user_id']);

        return new Response(
            200,
            body: $this->engine->render(
                'user/update-user',
                ['user' => $userData]
            )
        );
    }
}
