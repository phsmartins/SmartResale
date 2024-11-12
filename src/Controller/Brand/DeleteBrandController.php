<?php

namespace Smart\Resale\Controller\Brand;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Smart\Resale\Repository\BrandRepository;
use Smart\Resale\Traits\FlashMessageTrait;

class DeleteBrandController implements RequestHandlerInterface
{
    use FlashMessageTrait;

    public function __construct(
        private BrandRepository $brandRepository,
    )
    {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $parsedBody = $request->getParsedBody();
        $brandId = filter_var($parsedBody['brand_id'], FILTER_SANITIZE_NUMBER_INT);

        if (!($this->brandRepository->removeBrand($brandId, $_SESSION['user_id']))) {
            $this->addErrorMessageAlert("Erro inesperado :(", "Tente novamente!");
            return new Response('302', ['Location' => '/brands']);
        }

        $this->addSuccessMessageAlert("Marca deletada com sucesso");

        return new Response(302, ['Location' => '/brands']);
    }
}
