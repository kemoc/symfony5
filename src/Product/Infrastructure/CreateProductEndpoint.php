<?php
declare(strict_types=1);

namespace Product\Infrastructure;


use Product\Domain\CreateProductEndpointInterface;
use Product\Dto\ProductCreateDto;
use Product\Entity\Product;

class CreateProductEndpoint implements CreateProductEndpointInterface
{

    public function toDto(Product $product): ProductCreateDto
    {
    	$dto = new ProductCreateDto();
    	$dto->id = $product->id;

    	return $dto;
    }
}
