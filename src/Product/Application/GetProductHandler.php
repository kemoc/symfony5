<?php
declare(strict_types=1);

namespace Product\Application;

use Product\Domain\GetProductEndpointInterface;
use Product\Domain\ProductRepositoryInterface;
use Product\Dto\ProductGetDto;
use Product\Domain\Exception\NotFoundException;

class GetProductHandler
{
    public function __construct(
        private ProductRepositoryInterface $productRepository,
        private GetProductEndpointInterface $productEndpoint,
    ) {}

    public function handle(GetProductCommand $command): ProductGetDto
    {
    	$entity = $this->productRepository->findById($command->id);
    	if(!$entity){
            throw new NotFoundException(sprintf('Not found product of id = %s', (string)$command->id));
        }

    	return $this->productEndpoint->toDto($entity);
    }
}
