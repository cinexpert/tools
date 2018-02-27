<?php

namespace Cinexpert\Tools\Queue\Adapter;

use Cinexpert\Tools\AwsConfig;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class SqsAdapterFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $awsConfig = $container->get('aws_config');

        $awsConfigObject = new AwsConfig();
        $awsConfigObject
            ->setAwsRegion($awsConfig['region'])
            ->setAwsKey($awsConfig['key'])
            ->setAwsSecret($awsConfig['secret']);

        $adapter = new \Cinexpert\Tools\Queue\Adapter\SqsAdapter();
        $adapter->setAwsConfig($awsConfigObject);

        return $adapter;
    }
}
