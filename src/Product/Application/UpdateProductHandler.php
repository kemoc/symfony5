<?php
declare(strict_types=1);

namespace Product\Application;

use Product\Domain\ProductRepositoryInterface;

class UpdateProductHandler
{
    public function __construct(
        private ProductRepositoryInterface $productRepository,
    ) {}

    public function handle(UpdateProductCommand $command): self
    {
        $entity = $this->productRepository->findById($command->id);

        $entity->setName($command->name);
        $this->productRepository->save($entity);

        return $this;
    }
}
