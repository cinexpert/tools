<?php
/**
 * QueueTest.php
 *
 * @date        27.02.2018
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @file        QueueTest.php
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Cinexpert\Test\Tools\Queue;

use Cinexpert\Tools\Queue\Message;
use Cinexpert\Tools\Queue\Queue;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class QueueTest
 * 
 * @package     Cinexpert
 * @subpackage  Test
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class QueueTest extends TestCase
{
    /** @var  Queue */
    protected $instance;

    /** @var MockObject */
    protected $adapterMock;

    public function setUp()
    {
        $this->instance = new Queue();

        $adapterMock = $this->createMock('\Cinexpert\Tools\Queue\Adapter\AdapterInterface');
        $this->instance->setAdapter($adapterMock);
        $this->adapterMock = $adapterMock;

        $console = $this->createMock('Zend\Console\Adapter\AdapterInterface');
        $this->instance->setConsole($console);
    }

    public function testSendMessage()
    {
        $queueUrl = 'my-queue';
        $messageBody = 'gzegezbzrbrzbzrgagaebrzbnrzb';

        $this->adapterMock
            ->expects($this->once())
            ->method('sendMessage')
            ->with($queueUrl, $messageBody);

        $this->instance->sendMessage($queueUrl, $messageBody);
    }

    public function testReceiveMessage()
    {
        $queueUrl = 'my-queue';
        $message = new Message();
        $message
            ->setBody('message')
            ->setReceiptHandle('receipt-handle');

        $this->adapterMock
            ->expects($this->once())
            ->method('receiveMessage')
            ->with($queueUrl)
            ->will($this->returnValue($message));

        $response = $this->instance->receiveMessage($queueUrl);

        $this->assertSame($message, $response);
    }

    public function testDeleteMessage()
    {
        $queueUrl = 'my-queue';
        $message = new Message();
        $message
            ->setBody('message')
            ->setReceiptHandle('receipt-handle');

        $this->adapterMock
            ->expects($this->once())
            ->method('deleteMessage')
            ->with($queueUrl, $message);

        $this->instance->deleteMessage($queueUrl, $message);
    }
}
