<?php

namespace Cinexpert\Tools\Test;

use Cinexpert\Tools\AwsConfig;
use PHPUnit\Framework\TestCase;

class AwsConfigTest extends TestCase
{
    /** @var AwsConfig */
    protected $instance;

    public function setUp()
    {
        $this->instance = new AwsConfig();
    }

    public function testSetGetAwsRegion()
    {
        $var = 'eu-west-1';

        $this->assertSame($this->instance, $this->instance->setAwsRegion($var));
        $this->assertEquals($var, $this->instance->getAwsRegion());
    }

    public function testSetGetAwsKey()
    {
        $var = 'AVKHVKLJVMVMLIVLVLV';

        $this->assertSame($this->instance, $this->instance->setAwsKey($var));
        $this->assertEquals($var, $this->instance->getAwsKey());
    }

    public function testSetGetAwsSecret()
    {
        $var = 'ge4zg56e4zbgezbg!#654gezg5ez4gez';

        $this->assertSame($this->instance, $this->instance->setAwsSecret($var));
        $this->assertEquals($var, $this->instance->getAwsSecret());
    }

    public function testToArray_AllFieldsFilled()
    {
        $this->instance
            ->setAwsRegion('eu-west-1')
            ->setAwsKey('AZERTY1234')
            ->setAwsSecret('azerty1234!');

        $arrayCopy = $this->instance->toArray();

        $this->assertEquals(
            [
                'region' => 'eu-west-1',
                'credentials' =>
                    [
                        'key' => 'AZERTY1234',
                        'secret' => 'azerty1234!'
                    ]
            ],
            $arrayCopy
        );
    }

    public function testToArray_WithoutCredentials()
    {
        $this->instance->setAwsRegion('eu-west-1');

        $arrayCopy = $this->instance->toArray();

        $this->assertEquals(
            [
                'region' => 'eu-west-1'
            ],
            $arrayCopy
        );
    }
}