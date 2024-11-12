<?php

namespace Smart\Resale\Controller\Brand;

use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Smart\Resale\Repository\BrandRepository;

readonly class BrandController implements RequestHandlerInterface
{
    public function __construct(
        private Engine $engine,
        private BrandRepository $brandRepository,
    )
    {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $queryParams = $request->getQueryParams();

        $brandId = filter_var($queryParams['brand'], FILTER_SANITIZE_NUMBER_INT);

        $brand = $this->brandRepository->findBrandById($brandId);

        return new Response(
            200,
            body: $this->engine->render(
                'brand/brand',
                ["brand" => $brand]
            ));
    }
}
