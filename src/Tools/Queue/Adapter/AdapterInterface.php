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

namespace Cinexpert\Tools\Queue\Adapter;

use Cinexpert\Tools\Queue\Message;

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
     * Send a message.
     *
     * @param string $queueUrl
     * @param string $messageBody
     * @param string|null $messageGroupId In case of a FIFO queue, messages can be grouped
     * @param string|null $messageDeduplicationId In case of a FIFO queue, a deduplication ID can be provided
     * @return $this
     */
    public function sendMessage(
        string $queueUrl,
        string $messageBody,
        string $messageGroupId = null,
        string $messageDeduplicationId = null
    ): AdapterInterface;

    /**
     * Receive a message.
     *
     * @param string $queueUrl
     * @return Message
     */
    public function receiveMessage(string $queueUrl): ?Message;

    /**
     * @param string $queueUrl
     * @param Message $message
     * @return $this
     */
    public function deleteMessage(string $queueUrl, Message $message): AdapterInterface;
}
