<?php

namespace Smart\Resale\Controller\Brand;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Smart\Resale\Entity\Brand;
use Smart\Resale\Repository\BrandRepository;
use Smart\Resale\Traits\FlashMessageTrait;

readonly class EditBrandController implements RequestHandlerInterface
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
        $brandName = filter_var($parsedBody['name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $brandDescription = filter_var($parsedBody['description'], FILTER_SANITIZE_SPECIAL_CHARS);

        if (empty($brandName)) {
            $_SESSION['brand_id_edit'] = $brandId;
            $this->addErrorMessage("O campo 'Marca' não pode ser vazio");

            return new Response(302, ['Location' => '/brands']);
        }

        $brand = new Brand(
            $_SESSION['user_id'],
            $brandName,
            $brandDescription,
        );
        $brand->setId($brandId);

        if (!($this->brandRepository->updateBrand($brand))) {
            $this->addErrorMessageAlert("Erro inesperado :(", "Tente novamente!");
            return new Response('302', ['Location' => '/brands']);
        }

        $this->addSuccessMessageAlert("Marca editada com sucesso", "Bom trabalho!");

        return new Response(302, ['Location' => '/brands']);
    }
}
