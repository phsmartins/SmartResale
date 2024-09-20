<?php

namespace Smart\Resale\Controller\Brand;

use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Smart\Resale\Repository\BrandRepository;


readonly class BrandsController implements RequestHandlerInterface
{
    public function __construct(
        private Engine $engine,
        private BrandRepository $brandRepository,
    )
    {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $brand = null;

        if (array_key_exists('brand_id_edit', $_SESSION)) {
            $brand = $this->brandRepository->findBrandById($_SESSION['brand_id_edit']);
        }

        return new Response(
            200,
            body: $this->engine->render(
                'brand/brands',
                ["brand" => $brand]
            ));
    }
}
