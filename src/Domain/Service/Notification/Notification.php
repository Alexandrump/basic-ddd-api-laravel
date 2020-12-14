<?php


namespace Api\Domain\Service\Notification;


class Notification implements NotificationInterface
{
    /**
     * @var Error[]
     */
    private array $errors;

    /**
     * Notification constructor
     */
    private function __construct()
    {
    }

    /**
     * @return static
     */
    public static function createEmpty()
    {
        $notification = new static();
        $notification->errors = [];
        return $notification;
    }

    /**
     * @param string $message
     * @return $this
     */
    function addError(string $message): self
    {
        $this->errors[] = Error::create($message);
        return $this;
    }

    /**
     * @return array
     */
    function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @return bool
     */
    function hasErrors(): bool
    {
        return count($this->errors) > 0;
    }
}
