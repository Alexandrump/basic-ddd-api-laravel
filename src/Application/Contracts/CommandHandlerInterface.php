<?php


namespace Api\Application\Contracts;


interface CommandHandlerInterface
{
    /**
     * @param CommandInterface $command
     * @return mixed
     */
    public function handle(CommandInterface $command);

}
