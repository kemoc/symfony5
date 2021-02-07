<?php
declare(strict_types=1);

namespace Product\Application;

use Shared\Application\CommandInterface;

final class GetProductCommand implements CommandInterface
{
    public function __construct(
        public int $id,
    )
    {}
}
