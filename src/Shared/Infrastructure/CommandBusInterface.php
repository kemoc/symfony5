<?php
declare(strict_types=1);

namespace Shared\Infrastructure;


use Shared\Application\CommandInterface;

interface CommandBusInterface
{

    public function handle(CommandInterface $command): void;
}
