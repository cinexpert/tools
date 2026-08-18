<?php

/**
 * Tools.php
 *
 * @date      26.02.2018
 * @author    Pascal Paulis <pascal.paulis@cinexpert.net>
 * @file      Tools.php
 * @copyright Copyright (c) CineXpert - All rights reserved
 * @license   Unauthorized copying of this source code, via any medium is strictly
 *            prohibited, proprietary and confidential.
 */

namespace Cinexpert\Tools;

use Cinexpert\Tools\Mail\Mail;
use Cinexpert\Tools\Notification\Adapter\SnsAdapterFactory;
use Cinexpert\Tools\Notification\NotificationFactory;
use Cinexpert\Tools\PubSub\Adapter\PubNubAdapterFactory;
use Cinexpert\Tools\PubSub\PubSubFactory;
use Cinexpert\Tools\Queue\Adapter\SqsAdapterFactory;
use Cinexpert\Tools\Queue\QueueFactory;
use Symfony\Component\DependencyInjection\ServiceLocator;

/**
 * Class Tools
 *
 * Entry-point to use the tool-set
 *
 * @package     Cinexpert
 * @subpackage  Tools
 * @author      Pascal Paulis <pascal.paulis@cinexpert.net>
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 *
 * @codeCoverageIgnore
 */
class Tools extends ServiceLocator
{
    /** @var array<string, mixed> */
    private array $sharedServices = [];

    public function __construct(ToolsConfig $config)
    {
        $awsConfig = new AwsConfig();
        $awsConfig
            ->setAwsRegion($config->getAwsRegion())
            ->setAwsKey($config->getAwsKey())
            ->setAwsSecret($config->getAwsSecret())
            ->setSqsEndpoint($config->getSqsEndpoint());

        $pubsubConfig = [
            'publisherKey'  => $config->getPublisherKey(),
            'subscriberKey' => $config->getSubscriberKey(),
        ];

        parent::__construct([
            'aws_config'    => fn () => $awsConfig,
            'pubsub_config' => fn () => $pubsubConfig,
            'mail'          => fn () => $this->shared('mail', fn () => new Mail()),
            'queue.adapter.sqs' => fn () => $this->shared(
                'queue.adapter.sqs',
                fn () => (new SqsAdapterFactory())($this, 'queue.adapter.sqs')
            ),
            'queue' => fn () => $this->shared('queue', fn () => (new QueueFactory())($this, 'queue')),
            'notification.adapter.sns' => fn () => $this->shared(
                'notification.adapter.sns',
                fn () => (new SnsAdapterFactory())($this, 'notification.adapter.sns')
            ),
            'notification' => fn () => $this->shared(
                'notification',
                fn () => (new NotificationFactory())($this, 'notification')
            ),
            'pubsub.adapter.pubnub' => fn () => $this->shared(
                'pubsub.adapter.pubnub',
                fn () => (new PubNubAdapterFactory())($this, 'pubsub.adapter.pubnub')
            ),
            'pubsub' => fn () => $this->shared('pubsub', fn () => (new PubSubFactory())($this, 'pubsub')),
        ]);
    }

    private function shared(string $id, callable $factory): mixed
    {
        return $this->sharedServices[$id] ??= $factory();
    }
}
