<?php
declare(strict_types=1);

namespace Product\Infrastructure\Controller\RestApi\V1;

use Doctrine\ORM\EntityManagerInterface;
use Product\Application\CreateProductCommand;
use Product\Domain\Exception\NotFoundException;
use Product\Domain\Product;
use Shared\Infrastructure\CommandBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/restapi/v1/product')]
class ProductController extends AbstractController
{
    #[Route('/{id}', name: 'restapi_product_get', requirements: ['id' => '\d+'], methods: [Request::METHOD_GET])]
    public function getProduct(
        Request $request,
        CommandBusInterface $commandBus,
        SerializerInterface $serializer,
        int $id,
    )
    {
        try{
            $command = new GetProductCommand($id);

            $result = $commandBus->execute($command);
        } catch (NotFoundException $e) {
            return new JsonResponse(null, Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($serializer->serialize($result, 'json'), Response::HTTP_OK);
    }

    #[Route('', name: 'restapi_product_create', methods: [Request::METHOD_POST])]
    public function create(
        Request $request,
        CommandBusInterface $commandBus,
        EntityManagerInterface $em,
    ): JsonResponse
    {
        try {
            $id = (int)$em->getConnection()->lastInsertId(Product::class);
            $id++;
            $command = new CreateProductCommand($id, $request->get('name'));
            $commandBus->handle($command);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse(['id' => $id], Response::HTTP_CREATED);
    }

    #[Route('/{id}', name: 'restapi_product_update', requirements: ['id' => '\d+'], methods: [Request::METHOD_PUT])]
    public function update(
        Request $request,
        CommandBusInterface $commandBus,
        int $id,
    ): JsonResponse
    {
        try {
            $command = new UpdateProductCommand($id, $request->get('name'));

            $commandBus->execute($command);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
