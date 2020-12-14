<?php


namespace Api\Infrastructure\Bus;


use Api\Application\Bus\Contracts\ContainerInterface;
use Api\Application\Contracts\CommandInterface;
use Api\Infrastructure\Bus\Contracts\CommandBusInterface;

class SimpleCommandBus implements CommandBusInterface
{
    private const COMMAND_PREFIX = 'Command';
    private const COMMAND_HANDLER_PREFIX = 'CommandHandler';

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * SimpleCommandBus constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param $command
     * @return mixed
     */
    public function execute($command)
    {
        return $this->resolveHandler($command)->handle($command);
    }

    /**
     * @param CommandInterface $command
     * @return mixed
     */
    private function resolveHandler(CommandInterface $command)
    {
        return $this->container->make($this->getHandlerClass($command));
    }

    /**
     * @param CommandInterface $command
     * @return string
     */
    private function getHandlerClass(CommandInterface $command): string
    {
        return str_replace(
            self:: COMMAND_PREFIX,
            self::COMMAND_HANDLER_PREFIX,
            get_class($command)
        );
    }
}
