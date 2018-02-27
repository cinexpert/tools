<?php
/**
 * MessageTest.php
 *
 * @date        27.02.2018
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @file        MessageTest.php
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Cinexpert\Test\Tools\Queue;

use Cinexpert\Tools\Queue\Message;
use PHPUnit\Framework\TestCase;

/**
 * Class MessageTest
 * 
 * @package     Cinexpert
 * @subpackage  Test
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class MessageTest extends TestCase
{
    /** @var  Message */
    protected $instance;

    public function setUp()
    {
        $this->instance = new Message();
    }

    public function testSetGetBody()
    {
        $var = 'body';

        $this->assertSame($this->instance, $this->instance->setBody($var));
        $this->assertEquals($var, $this->instance->getBody());
    }

    public function testSetGetReceiptHandle()
    {
        $var = 'receipt handle';

        $this->assertSame($this->instance, $this->instance->setReceiptHandle($var));
        $this->assertEquals($var, $this->instance->getReceiptHandle());
    }
}
