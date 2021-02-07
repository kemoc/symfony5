<?php
declare(strict_types=1);

namespace Product\Domain;

interface ProductRepositoryInterface
{

    public function findById(int $id): Product;

    public function add(Product $product): self;

    public function save(Product $product): self;

}
