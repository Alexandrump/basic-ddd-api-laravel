<?php


namespace Api\Infrastructure\Service\ApiConnector\Exception;


class InternalServiceDownException extends \Exception
{

    /**
     * InternalServiceDownException constructor.
     * @param string $string
     */
    public function __construct(string $string)
    {
        parent::__construct($string);
    }

    /**
     * @param string $string
     * @return static
     */
    public static function create(string $string = "It was not possible to connect with the internal service. Please contact with administrators.") : self
    {
        return new static($string);
    }
}
