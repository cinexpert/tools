<?php

namespace Cinexpert\Tools\Test;

use Cinexpert\Tools\ToolsConfig;
use PHPUnit\Framework\TestCase;

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