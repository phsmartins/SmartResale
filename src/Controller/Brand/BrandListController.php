<?php

namespace Smart\Resale\Controller\Brand;

use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Smart\Resale\Repository\BrandRepository;

readonly class BrandListController implements RequestHandlerInterface
{
    public function __construct(
        private Engine $engine,
        private BrandRepository $brandRepository,
    )
    {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $queryParams = $request->getQueryParams();

        $page = filter_var($queryParams['page'], FILTER_VALIDATE_INT);
        $brandList = $this->brandRepository->findBrandsByUserId($_SESSION['user_id'], $page);

        return new Response(
            200,
            body: $this->engine->render(
                'brand/brand-list',
                [
                    'brandList' => $brandList,
                    'page' => $page,
                ]
            ));
    }
}
