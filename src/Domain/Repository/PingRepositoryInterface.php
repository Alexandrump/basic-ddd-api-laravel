<?php


namespace Api\Domain\Repository;


use Api\Domain\Entity\Ping\Ping;

interface PingRepositoryInterface
{
    function findById(int $id) : Ping;

    function findAll() : array;

    function save(Ping $ping) : bool;
}
