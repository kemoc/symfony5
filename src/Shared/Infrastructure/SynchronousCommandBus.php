<?php
declare(strict_types=1);

namespace Shared\Infrastructure;

use Shared\Application\CommandInterface;

class SynchronousCommandBus implements CommandBusInterface
{
    private array $handlers = [];

    public function map(string $command, callable $handler): void
    {
    	$this->handlers[$command] = $handler;
    }

    public function handle(CommandInterface $command): void
    {
    	$fqcn = \get_class($command);
    	$handlerNotFound = false === isset($this->handlers[$fqcn]);

    	call_user_func($this->handlers[$fqcn], $command);
    }
}
