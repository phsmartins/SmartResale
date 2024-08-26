<?php

namespace Smart\Resale\Controller\Brand;

use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Smart\Resale\Repository\BrandRepository;

class BrandListController implements RequestHandlerInterface
{
    public function __construct(
        private Engine $engine,
        private BrandRepository $brandRepository,
    )
    {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $brandList = $this->brandRepository->findAllBrandsByUserId($_SESSION['user_id']);

        return new Response(
            200,
            body: $this->engine->render(
                'brand/brand-list',
                ['brandList' => $brandList]
            ));
    }
}
