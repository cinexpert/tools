<?php

namespace Cinexpert\Tools\Notification;

interface NotificationAwareInterface
{
    /**
     * @param Notification $notification
     * @return $this
     */
    public function setNotification(Notification $notification);

    /**
     * @return Notification
     */
    public function getNotification(): Notification;
}
