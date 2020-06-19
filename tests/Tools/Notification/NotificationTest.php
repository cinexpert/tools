<?php
/**
 * NotificationTest.php
 *
 * @date        03.07.2018
 * @author      Pascal Paulis <pascal.paulis@cinexpert.net>
 * @file        NotificationTest.php
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Cinexpert\Test\Tools\Notification;

use Cinexpert\Tools\Notification\Notification;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class NotificationTest
 * 
 * @package     Cinexpert
 * @subpackage  Test
 * @author      Pascal Paulis <pascal.paulis@cinexpert.net>
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class NotificationTest extends TestCase
{
    /** @var  Notification */
    protected $instance;

    /** @var MockObject */
    protected $adapterMock;

    public function setUp()
    {
        $this->instance = new Notification();

        $adapterMock = $this->createMock('\Cinexpert\Tools\Notification\Adapter\AdapterInterface');
        $this->instance->setAdapter($adapterMock);
        $this->adapterMock = $adapterMock;

        $console = $this->createMock('Laminas\Console\Adapter\AdapterInterface');
        $this->instance->setConsole($console);
    }

    public function testSendMessage()
    {
        $topic   = 'my-topic';
        $message = 'gzegezbzrbrzbzrgagaebrzbnrzb';

        $this->adapterMock
            ->expects($this->once())
            ->method('sendNotification')
            ->with($topic, $message);

        $this->instance->sendNotification($topic, $message);
    }
}
