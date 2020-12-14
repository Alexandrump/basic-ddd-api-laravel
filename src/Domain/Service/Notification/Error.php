<?php


namespace Api\Domain\Service\Notification;


class Error
{
    /**
     * Error constructor.
     * @param string $message
     */
    private function __construct(string $message)
    {
        $this->message = $message;
    }

    /**
     * @param string $message
     * @return static
     */
    public static function create(string $message)
    {
        return new static($message);
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }


}
