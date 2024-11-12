<?php

namespace Smart\Resale\Controller\Brand;

use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Smart\Resale\Repository\BrandRepository;
use Smart\Resale\Traits\FlashMessageTrait;

readonly class BrandController implements RequestHandlerInterface
{
    use FlashMessageTrait;

    public function __construct(
        private Engine $engine,
        private BrandRepository $brandRepository,
    )
    {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $queryParams = $request->getQueryParams();

        if (!(array_key_exists('brand', $queryParams))) {
            $this->addErrorMessageAlert(
                "A marca selecionada não existe",
                "Se você acha que isso é um erro, entre em contato com o suporte"
            );

            return new Response(302, ['Location' => '/brands']);
        }

        $brandId = filter_var($queryParams['brand'], FILTER_SANITIZE_NUMBER_INT);

        $brand = $this->brandRepository->findBrandById($brandId);

        if ($brand === null) {
            $this->addErrorMessageAlert(
                "A marca selecionada não existe",
                "Se você acha que isso é um erro, entre em contato com o suporte"
            );

            return new Response(302, ['Location' => '/brands']);
        }

        return new Response(
            200,
            body: $this->engine->render(
                'brand/brand',
                ["brand" => $brand]
            ));
    }
}
