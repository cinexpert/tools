<?php

namespace Cinexpert\Tools\Queue\Adapter;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class SqsAdapterFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $adapter = new \Cinexpert\Tools\Queue\Adapter\SqsAdapter();
        $adapter->setAwsConfig($container->get('aws_config'));

        return $adapter;
    }
}
