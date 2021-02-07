<?php
declare(strict_types=1);

namespace Product\Domain;

use Product\Dto\ProductGetDto;
use Product\Domain\Product;

interface GetProductEndpointInterface
{
    public function toDto(Product $product): ProductGetDto;
}
