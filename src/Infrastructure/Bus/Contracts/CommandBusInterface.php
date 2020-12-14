<?php


namespace Api\Infrastructure\Bus\Contracts;


interface CommandBusInterface
{
    public function execute($command);
}
