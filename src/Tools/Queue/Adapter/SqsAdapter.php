<?php
/**
 * SqsAdapter.php
 *
 * @date        27.02.2018
 * @author      Pascal Paulis <pascal.paulis@cinexpert.net>
 * @file        SqsAdapter.php
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Cinexpert\Tools\Queue\Adapter;

use Aws\Sqs\SqsClient;
use Cinexpert\Tools\Queue\Message;

/**
 * SqsAdapter
 *
 * @package     Tools  
 * @subpackage  Service
 * @author      Pascal Paulis <pascal.paulis@cinexpert.net>
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class SqsAdapter implements AdapterInterface
{
    /** @var SqsClient */
    protected $sqsClient;

    /**
     * @return SqsClient
     */
    public function getSqsClient(): SqsClient
    {
        return $this->sqsClient;
    }

    /**
     * @param SqsClient $sqsClient
     * @return SqsAdapter
     */
    public function setSqsClient(SqsClient $sqsClient): SqsAdapter
    {
        $this->sqsClient = $sqsClient;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function sendMessage(string $queueUrl, string $messageBody): AdapterInterface
    {
        $this->getSqsClient()->sendMessage([
            'QueueUrl'    => $queueUrl,
            'MessageBody' => $messageBody,
        ]);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function receiveMessage(string $queueUrl): ?Message
    {
        $result = $this->getSqsClient()->receiveMessage(['QueueUrl' => $queueUrl]);

        if (!empty($result['Messages'])) {
            // By default, only one message will be returned
            foreach ($result['Messages'] as $message) {
                $newMessage = new Message();
                $newMessage
                    ->setBody($message['Body'])
                    ->setReceiptHandle($message['ReceiptHandle']);
                return $newMessage;
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function deleteMessage(string $queueUrl, Message $message): AdapterInterface
    {
        $this->getSqsClient()->deleteMessage([
            'QueueUrl'      => $queueUrl,
            'ReceiptHandle' => $message->getReceiptHandle()
        ]);

        return $this;
    }
}
