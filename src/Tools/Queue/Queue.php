<?php
/**
 * Queue.php
 *
 * @date        26.02.2018
 * @author      Pascal Paulis <pascal.paulis@cinexpert.net>
 * @file        Queue.php
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Cinexpert\Tools\Queue;

use Cinexpert\Tools\ConsoleAwareInterface;
use Cinexpert\Tools\ConsoleAwareTrait;
use Cinexpert\Tools\Queue\Adapter\AdapterInterface;
use Laminas\Console\ColorInterface;

/**
 * Class Queue
 *
 * @package     Cinexpert  
 * @subpackage  Tools
 * @author      Pascal Paulis <pascal.paulis@cinexpert.net>
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class Queue implements ConsoleAwareInterface
{
    use ConsoleAwareTrait;

    const QUEUE_ADAPTER_SQS = 'sqs';

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
     * @param string $queueUrl
     * @param string $messageBody
     * @param string|null $messageGroupId In case of a FIFO queue, messages can be grouped
     * @param string|null $messageDeduplicationId In case of a FIFO queue, a deduplication ID can be provided
     * @return Queue Fluent interface
     */
    public function sendMessage(
        string $queueUrl,
        string $messageBody,
        string $messageGroupId = null,
        string $messageDeduplicationId = null
    ) {
        // Check first if we are running in a console
        if ($this->getConsole()) {
            $this->getConsole()->writeLine(
                date_create()->format('[c] ') . "Sending a message on $queueUrl ...",
                ColorInterface::LIGHT_GREEN
            );
        }

        $this->getAdapter()->sendMessage($queueUrl, $messageBody, $messageGroupId, $messageDeduplicationId);

        return $this;
    }

    /**
     * Receive a message from the given queue.
     *
     * @param string $queueUrl
     * @return Message|null
     */
    public function receiveMessage(string $queueUrl)
    {
        // Check first if we are running in a console
        if ($this->getConsole()) {
            $this->getConsole()->writeLine(
                date_create()->format('[c] ') . "Checking queue for messages on $queueUrl ...",
                ColorInterface::WHITE
            );
        }

        return $this->getAdapter()->receiveMessage($queueUrl);
    }

    /**
     * Delete the given message.
     *
     * @param string $queueUrl
     * @param Message $message
     * @return Queue Fluent interface
     */
    public function deleteMessage(string $queueUrl, Message $message)
    {
        // Check first if we are running in a console
        if ($this->getConsole()) {
            $this->getConsole()->writeLine(
                sprintf(
                    "[%s] Deleting message %s on queue %s ...",
                    date_create()->format('c'),
                    $message->getReceiptHandle(),
                    $queueUrl
                ),
                ColorInterface::LIGHT_GREEN
            );
        }

        $this->getAdapter()->deleteMessage($queueUrl, $message);

        return $this;
    }
}
