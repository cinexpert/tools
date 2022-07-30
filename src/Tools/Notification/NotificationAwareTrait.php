<?php

/**
 * NotificationAwareTrait.php
 *
 * @date      03.07.2018
 * @author    Pascal Paulis <pascal.paulis@cinexpert.net>
 * @file      NotificationAwareTrait.php
 * @copyright Copyright (c) CineXpert - All rights reserved
 * @license   Unauthorized copying of this source code, via any medium is strictly
 *            prohibited, proprietary and confidential.
 */

namespace Cinexpert\Tools\Notification;

/**
 * @codeCoverageIgnore
 */
trait NotificationAwareTrait
{
    /** @var Notification */
    protected $notification;

    /**
     * @param Notification $notification
     * @return $this
     */
    public function setNotification(Notification $notification)
    {
        $this->notification = $notification;
        return $this;
    }

    /**
     * @return Notification
     */
    public function getNotification(): Notification
    {
        return $this->notification;
    }
}
