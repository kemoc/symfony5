<?php
declare(strict_types=1);

namespace Product\Application;

use Product\Domain\ProductRepositoryInterface;
use Product\Domain\Product;

final class CreateProductHandler
{
    public function __construct(
        private ProductRepositoryInterface $productRepository,
    ) {}

    public function __invoke(CreateProductCommand $command)
    {
        $entity = new Product(
            $command->id,
            $command->name,
        );

        $this->productRepository->add($entity);
    }
}
