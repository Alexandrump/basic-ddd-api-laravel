<?php


namespace Api\Application\Command\Ping;


use Api\Application\Contracts\CommandInterface;

final class PingCommand implements CommandInterface
{
    /**
     * @var string
     */
    private $message;

    /**
     * PingCommand constructor.
     * @param string $message
     */
    private function __construct(string $message)
    {
        $this->message = $message;
    }

    /**
     * @param $message
     * @return static
     */
    public static function create($message) : self {
        return new static ($message);
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}

