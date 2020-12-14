<?php


namespace Api\Domain\Service\Notification;


interface NotificationInterface
{

    function addError(string $message): self;

    function getErrors () : array;

    function hasErrors(): bool;

}
