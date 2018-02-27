<?php
/**
 * SqsAdapterTest.php
 *
 * @date        05.02.2016
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @file        SqsAdapterTest.php
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Cinexpert\Test\Tools\Queue\Adapter;

use Cinexpert\Tools\Queue\Adapter\SqsAdapter;
use Cinexpert\Tools\Queue\Message;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class SqsAdapterTest
 * 
 * @package     ToolsTest
 * @subpackage  Service
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class SqsAdapterTest extends TestCase
{
    /** @var SqsAdapter */
    protected $instance;

    /** @var MockObject */
    protected $sqsMock;

    public function setUp()
    {
        $this->instance = new SqsAdapter();

        $this->sqsMock = $this->getMockBuilder('\Aws\Sqs\SqsClient')
            ->setMethods(['sendMessage', 'receiveMessage', 'deleteMessage'])
            ->disableOriginalConstructor()
            ->getMock();

        $this->instance->setSqsClient($this->sqsMock);
    }

    public function testSendMessage()
    {
        $queueUrl = 'my-queue';
        $messageBody = 'gzegezbzrbrzbzrgagaebrzbnrzb';

        $this->sqsMock
            ->expects($this->once())
            ->method('sendMessage')
            ->with([
                'QueueUrl'    => $queueUrl,
                'MessageBody' => $messageBody,
            ]);

        $this->instance->sendMessage($queueUrl, $messageBody);
    }

    public function testReceiveMessage()
    {
        $queueUrl = 'my-queue';

        $message1 = [
            'Body' => 'message-body',
            'ReceiptHandle' => 'receipt-handle'
        ];
        $message2 = [
            'Body' => 'message-body2',
            'ReceiptHandle' => 'receipt-handle2'
        ];

        $response =
            [
                'Messages' =>
                    [
                        $message1,
                        $message2
                    ]
            ];

        $this->sqsMock
            ->expects($this->once())
            ->method('receiveMessage')
            ->with(['QueueUrl' => $queueUrl])
            ->will($this->returnValue($response));

        $response = $this->instance->receiveMessage($queueUrl);

        $this->assertEquals('message-body', $response->getBody());
        $this->assertEquals('receipt-handle', $response->getReceiptHandle());
    }

    public function testReceiveMessage_NoMessageAvailable()
    {
        $queueUrl = 'my-queue';

        $response =
            [
                'Messages' => []
            ];

        $this->sqsMock
            ->expects($this->once())
            ->method('receiveMessage')
            ->with(['QueueUrl' => $queueUrl])
            ->will($this->returnValue($response));

        $this->assertNull($this->instance->receiveMessage($queueUrl));
    }

    public function testDeleteMessage()
    {
        $queueUrl = 'my-queue';
        $receiptHandle = 'receipt-handle';

        $messageToDelete = new Message();
        $messageToDelete
            ->setBody('message-body')
            ->setReceiptHandle($receiptHandle);

        $this->sqsMock
            ->expects($this->once())
            ->method('deleteMessage')
            ->with(['QueueUrl' => $queueUrl, 'ReceiptHandle' => $receiptHandle]);

        $this->instance->deleteMessage($queueUrl, $messageToDelete);
    }
}