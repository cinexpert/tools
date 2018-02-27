<?php
/**
 * SqsAdapter.php
 *
 * @date        27.02.2018
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @file        SqsAdapter.php
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Cinexpert\Tools\Queue\Adapter;

use Aws\Sqs\SqsClient;
use Cinexpert\Tools\AwsConfigAwareInterface;
use Cinexpert\Tools\AwsConfigAwareTrait;
use Cinexpert\Tools\Queue\Message;

/**
 * SqsAdapter
 *
 * @package     Tools  
 * @subpackage  Service
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class SqsAdapter implements AdapterInterface, AwsConfigAwareInterface
{
    use AwsConfigAwareTrait;

    /**
     * @inheritdoc
     */
    protected function getClient()
    {
        $parameters = ['version' => '2012-11-05'];

        if ($this->getAwsConfig()) {
            $parameters = array_merge($parameters, $this->getAwsConfig()->toArray());
        }

        return new SqsClient($parameters);
    }

    /**
     * @inheritdoc
     */
    public function sendMessage(string $queueUrl, string $messageBody): AdapterInterface
    {
        $this->getClient()->sendMessage([
            'QueueUrl'    => $queueUrl,
            'MessageBody' => $messageBody,
        ]);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function receiveMessage(string $queueUrl): Message
    {
        $result = $this->getClient()->receiveMessage(['QueueUrl' => $queueUrl]);

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
        $this->getClient()->deleteMessage([
            'QueueUrl'      => $queueUrl,
            'ReceiptHandle' => $message->getReceiptHandle()
        ]);

        return null;
    }
}
