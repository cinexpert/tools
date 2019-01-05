<?php
/**
 * PubNubAdapterTest.php
 *
 * @date        03.07.2018
 * @author      Pascal Paulis <pascal.paulis@cinexpert.net>
 * @file        PubNubAdapterTest.php
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Cinexpert\Test\Tools\PubSub\Adapter;

use Cinexpert\Tools\PubSub\Adapter\PubNubAdapter;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class PubNubAdapterTest
 * 
 * @package     ToolsTest
 * @subpackage  Service
 * @author      Pascal Paulis <pascal.paulis@cinexpert.net>
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class PubNubAdapterTest extends TestCase
{
    /** @var PubNubAdapter */
    protected $instance;

    /** @var MockObject */
    protected $pubnubMock;

    public function setUp()
    {
        $this->instance = new PubNubAdapter();

        $this->pubnubMock = $this->getMockBuilder('PubNub\PubNub')
            ->setMethods(['publish', 'channel', 'message', 'usePost', 'sync'])
            ->disableOriginalConstructor()
            ->getMock();

        $this->instance->setPubNub($this->pubnubMock);
    }

    public function testPublish()
    {
        $channel     = 'my-channel';
        $messageBody = 'message 123';

        $this->pubnubMock
            ->expects($this->once())
            ->method('publish')
            ->will($this->returnSelf());
        $this->pubnubMock
            ->expects($this->once())
            ->method('channel')
            ->with($channel)
            ->will($this->returnSelf());
        $this->pubnubMock
            ->expects($this->once())
            ->method('message')
            ->with($messageBody)
            ->will($this->returnSelf());
        $this->pubnubMock
            ->expects($this->once())
            ->method('usePost')
            ->with(true)
            ->will($this->returnSelf());
        $this->pubnubMock
            ->expects($this->once())
            ->method('sync');

        $this->instance->publish($channel, $messageBody);
    }
}