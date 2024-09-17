<?php

namespace Smart\Resale\Controller\Brand;

use Nyholm\Psr7\MessageTrait;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Smart\Resale\Entity\Brand;
use Smart\Resale\Repository\BrandRepository;

readonly class AddBrandController implements RequestHandlerInterface
{
    //use MessageTrait;

    public function __construct(
        private BrandRepository $brandRepository,
    )
    {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $parsedBody = $request->getParsedBody();

        $brandName = filter_var($parsedBody['name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $description = filter_var($parsedBody['description'], FILTER_SANITIZE_SPECIAL_CHARS);

        $brand = new Brand(
            $_SESSION['user_id'],
            $brandName,
            $description
        );

        if (!($this->brandRepository->addBrand($brand))) {
            return new Response('302', ['Location' => '/brands?error=1']);
        }

        return new Response('302', ['Location' => '/brands']);
    }
}
