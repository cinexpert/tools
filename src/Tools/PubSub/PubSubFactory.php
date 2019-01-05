<?php

namespace Cinexpert\Tools\PubSub;

use Zend\ServiceManager\Factory\FactoryInterface;

class PubSubFactory implements FactoryInterface
{
    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = null)
    {
        $pubSub = new PubSub();
        $pubSub->setAdapter($container->get('pubsub.adapter.pubnub'));

        return $pubSub;
    }
}