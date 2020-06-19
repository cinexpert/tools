<?php

namespace Cinexpert\Tools\PubSub\Adapter;

use PubNub\PNConfiguration;
use PubNub\PubNub;
use Laminas\ServiceManager\Factory\FactoryInterface;

class PubNubAdapterFactory implements FactoryInterface
{
    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = null)
    {
        $pubNubConfig = $container->get('pubsub_config');

        $pnConfiguration = new PNConfiguration();
        $pnConfiguration
            ->setPublishKey($pubNubConfig['publisherKey'])
            ->setSubscribeKey($pubNubConfig['subscriberKey'])
            ->setSecure(true);

        $pubNubClient = new PubNub($pnConfiguration);

        $pubNubAdapter = new \Cinexpert\Tools\PubSub\Adapter\PubNubAdapter();
        $pubNubAdapter->setPubNub($pubNubClient);

        return $pubNubAdapter;
    }
}