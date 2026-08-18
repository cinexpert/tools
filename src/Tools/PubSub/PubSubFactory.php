<?php

namespace Cinexpert\Tools\PubSub;

use Psr\Container\ContainerInterface;

class PubSubFactory
{
    public function __invoke(ContainerInterface $container, string $requestedName, ?array $options = null)
    {
        $pubSub = new PubSub();
        $pubSub->setAdapter($container->get('pubsub.adapter.pubnub'));

        return $pubSub;
    }
}
