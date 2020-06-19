<?php
/**
 * Notification.php
 *
 * @date        26.02.2018
 * @author      Pascal Paulis <pascal.paulis@cinexpert.net>
 * @file        Queue.php
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Cinexpert\Tools\Notification;

use Cinexpert\Tools\ConsoleAwareInterface;
use Cinexpert\Tools\ConsoleAwareTrait;
use Cinexpert\Tools\Notification\Adapter\AdapterInterface;
use Laminas\Console\ColorInterface;

/**
 * Class Notification
 *
 * @package     Cinexpert  
 * @subpackage  Tools
 * @author      Pascal Paulis <pascal.paulis@cinexpert.net>
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class Notification implements ConsoleAwareInterface
{
    use ConsoleAwareTrait;

    const NOTIFICATION_ADAPTER_SNS = 'sns';

    /** @var AdapterInterface $adapter */
    protected $adapter;

    /**
     * Set the adapter.
     *
     * @param AdapterInterface $adapter The adapter.
     * @return $this Provides a fluent interface.
     */
    public function setAdapter(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
        return $this;
    }

    /**
     * Return the adapter.
     *
     * @return AdapterInterface The adapter.
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * Send a message.
     *
     * @param string $topic
     * @param string $message
     * @return Notification Fluent interface
     */
    public function sendNotification(string $topic, string $message)
    {
        // Check first if we are running in a console
        if ($this->getConsole()) {
            $this->getConsole()->writeLine(
                date_create()->format('[c] ') . "Sending a notification on $topic ...",
                ColorInterface::LIGHT_GREEN
            );
        }

        $this->getAdapter()->sendNotification($topic, $message);

        return $this;
    }
}
