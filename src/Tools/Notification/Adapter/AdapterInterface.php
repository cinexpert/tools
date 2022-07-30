<?php

/**
 * AdapterInterface.php
 *
 * @date      27.02.2018
 * @author    Pascal Paulis <pascal.paulis@cinexpert.net>
 * @file      AdapterInterface.php
 * @copyright Copyright (c) CineXpert - All rights reserved
 * @license   Unauthorized copying of this source code, via any medium is strictly
 *            prohibited, proprietary and confidential.
 */

namespace Cinexpert\Tools\Notification\Adapter;

/**
 * AdapterInterface
 *
 * @package     Cinexpert
 * @subpackage  Tools
 * @author      Pascal Paulis <pascal.paulis@cinexpert.net>
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
interface AdapterInterface
{
    /**
     * Send a notification.
     *
     * @param string $topic
     * @param string $message
     * @return AdapterInterface
     */
    public function sendNotification(string $topic, string $message): AdapterInterface;
}
