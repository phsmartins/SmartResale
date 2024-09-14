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
        $userId = $_SESSION['user_id'];

        $queryParams = $request->getQueryParams();

        $page = filter_var($queryParams['page'], FILTER_VALIDATE_INT);
        $limit = filter_var($queryParams['limit'], FILTER_VALIDATE_INT);
        $filter = filter_var($queryParams['filter'], FILTER_SANITIZE_SPECIAL_CHARS);

        $brandList = $this->brandRepository->findBrandsByUserId($userId, $page, $limit, $filter);

        $brandCount = $this->brandRepository->countAllBrands($userId);
        $numberOfPages = ceil($brandCount['result_brands_count'] / $limit);

        $numberOfButtonsOnPagination = 2;

        return new Response(
            200,
            body: $this->engine->render(
                'brand/brand-list',
                [
                    'brandList' => $brandList,
                    'page' => $page,
                    'limit' => $limit,
                    'filter' => $filter,
                    'numberOfPages' => $numberOfPages,
                    'numberOfButtonsOnPagination' => $numberOfButtonsOnPagination,
                    'brandCount' => $brandCount['result_brands_count'],
                ]
            ));
    }
}
