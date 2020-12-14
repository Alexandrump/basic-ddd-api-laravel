<?php


namespace Api\Domain\Entity\Ping;


use Api\Domain\Service\Notification\Notification;

class Ping
{

    /**
     * @var string
     */
    private string $message;

    /**
     * Ping constructor.
     */
    protected function __construct()
    {
    }

    /**
     * @param $message
     * @return static
     */
    public static function create($message)
    {
        $ping = new static();

        $notification = $ping->validate(
            $message
        );

        if ($notification->hasErrors()) {
            return new InvalidPing($notification);
        }

        $ping->message = $message;
        return $ping;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return Notification
     */
    private function validate(string $message): Notification
    {
        $notification = Notification::createEmpty();

        //Pile of validations
        if (!$this->isMessageOfExactLength($message)) {
            $notification->addError(PingErrors::UNEXPECTED_LENGTH_MESSAGE);
        }

        // ...

        return $notification;
    }

    /**
     * @param string $message
     * @return bool
     */
    private function isMessageOfExactLength(string $message): bool
    {
        return strlen($message) === 4;
    }

}
