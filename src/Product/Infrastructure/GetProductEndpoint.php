<?php
declare(strict_types=1);

namespace Product\Infrastructure;

use Product\Domain\GetProductEndpointInterface;
use Product\Dto\ProductGetDto;
use Product\Domain\Product;

class GetProductEndpoint implements GetProductEndpointInterface
{

    public function toDto(Product $product): ProductGetDto
    {
    	$dto = new ProductGetDto();
    	$dto->id = $product->getId();
    	$dto->name = $product->getName();

    	return $dto;
    }
}
