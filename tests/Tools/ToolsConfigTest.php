<?php
/**
 * ToolsConfigTest.php
 *
 * @date        27.02.2018
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @file        ToolsConfigTest.php
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Cinexpert\Test\Tools;

use Cinexpert\Tools\ToolsConfig;
use PHPUnit\Framework\TestCase;

/**
 * Class ToolsConfigTest
 *
 * @package     Cinexpert
 * @subpackage  Test
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class ToolsConfigTest extends TestCase
{
    /** @var ToolsConfig */
    protected $instance;

    public function setUp()
    {
        $this->instance = new ToolsConfig();
    }

    public function testSetGetAwsRegion()
    {
        $this->assertSame($this->instance, $this->instance->setAwsRegion('eu-west-1'));
        $this->assertEquals('eu-west-1', $this->instance->getAwsRegion());
    }

    public function testSetGetAwsKey()
    {
        $this->assertSame($this->instance, $this->instance->setAwsKey('KBGVKGHKCVGHK6546546546'));
        $this->assertEquals('KBGVKGHKCVGHK6546546546', $this->instance->getAwsKey());
    }

    public function testSetGetAwsSecret()
    {
        $data = 'fez65g4ezgezgh4rezg6ez54gezg54ezg654/56g4ezg';
        $this->assertSame($this->instance, $this->instance->setAwsSecret($data));
        $this->assertEquals($data, $this->instance->getAwsSecret());
    }
}