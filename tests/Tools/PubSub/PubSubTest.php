<?php
/**
 * PubSubTest.php
 *
 * @date        05.01.2019
 * @author      Pascal Paulis <pascal.paulis@cinexpert.net>
 * @file        PubSubTest.php
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Cinexpert\Test\Tools\PubSub;

use Cinexpert\Tools\PubSub\PubSub;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class PubSubTest
 *
 * @package     Cinexpert
 * @subpackage  Test
 * @author      Pascal Paulis <pascal.paulis@cinexpert.net>
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class PubSubTest extends TestCase
{
    /** @var  PubSub */
    protected $instance;

    /** @var MockObject */
    protected $adapterMock;

    public function setUp(): void
    {
        $this->instance = new PubSub();

        $adapterMock = $this->createMock('\Cinexpert\Tools\PubSub\Adapter\AdapterInterface');
        $this->instance->setAdapter($adapterMock);
        $this->adapterMock = $adapterMock;
    }

    public function testPublish()
    {
        $channel = 'my-channel';
        $message = 'gzegezbzrbrzbzrgagaebrzbnrzb';

        $this->adapterMock
            ->expects($this->once())
            ->method('publish')
            ->with($channel, $message);

        $this->instance->publish($channel, $message);
    }
}
