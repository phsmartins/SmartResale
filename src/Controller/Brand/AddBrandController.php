<?php

namespace Smart\Resale\Controller\Brand;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Smart\Resale\Entity\Brand;
use Smart\Resale\Repository\BrandRepository;
use Smart\Resale\Traits\FlashMessageTrait;

readonly class AddBrandController implements RequestHandlerInterface
{
    use FlashMessageTrait;

    public function __construct(
        private BrandRepository $brandRepository,
    )
    {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $_SESSION['modal_brand_error'] = 0;

        $parsedBody = $request->getParsedBody();

        $brandName = filter_var($parsedBody['name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $description = filter_var($parsedBody['description'], FILTER_SANITIZE_SPECIAL_CHARS);

        if (empty($brandName)) {
            $_SESSION['description_brand'] = $description;
            $_SESSION['modal_brand_error'] = 1;

            $this->addErrorMessage("O campo 'Marca' não pode ser vazio");

            return new Response(302, ['Location' => '/brands']);
        }

        $brand = new Brand(
            $_SESSION['user_id'],
            $brandName,
            $description
        );

        if (!($this->brandRepository->addBrand($brand))) {
            $this->addErrorMessageAlert("Erro inesperado :(", "Tente novamente!");
            return new Response('302', ['Location' => '/brands']);
        }

        $this->addSuccessMessageAlert("Marca adiciona com sucesso", "Bom trabalho!");

        return new Response('302', ['Location' => '/brands']);
    }
}
