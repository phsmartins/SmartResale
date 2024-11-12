<?php

namespace Smart\Resale\Controller\Brand;

use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

readonly class DeleteBrandModalController implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $queryParams = $request->getQueryParams();
        $_SESSION['brand_id_delete'] = filter_var($queryParams['brand'], FILTER_VALIDATE_INT);

        return new Response(302, ['Location' => '/brands']);
    }
}
