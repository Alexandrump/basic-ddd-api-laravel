<?php


namespace Api\Domain\Entity\Ping;


use Api\Domain\Service\Notification\Notification;

final class InvalidPing extends Ping
{
    /**
     * @var Notification
     */
    private Notification $notification;

    /**
     * InvalidPing constructor.
     * @param Notification $notification
     */
    public function __construct(Notification $notification)
    {
        parent::__construct();
        $this->notification = $notification;
    }

    /**
     * @return Notification
     */
    public function getNotification(): Notification
    {
        return $this->notification;
    }

}
