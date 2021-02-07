<?php
declare(strict_types=1);

namespace Product\Infrastructure;


use Doctrine\ORM\EntityManagerInterface;
use Product\Domain\Product;
use Product\Domain\ProductRepositoryInterface;

class DoctrineOrmProductRepository implements ProductRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $em,
    )
    {}

    public function findById(int $id): Product
    {
    	return $this->em->find(Product::class, $id);
    }

    public function add(Product $product): self
    {
    	$this->em->persist($product);
    	$this->em->flush();

        return $this;
    }
    public function save(Product $product): self
    {

        return $this->add($product);
    }
}
