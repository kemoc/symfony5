<?php
declare(strict_types=1);

namespace Product\Application;


use Shared\Application\CommandInterface;

final class UpdateProductCommand implements CommandInterface
{
    public function __construct(
        public int $id,
        public string $name,
    )
    {}
}
