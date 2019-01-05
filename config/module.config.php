<?php

return [
    'service_manager' =>
        [
            'invokables' =>
                [
                ],
            'factories' =>
                [
                    'queue'                    => \Cinexpert\Tools\Queue\QueueFactory::class,
                    'queue.adapter.sqs'        => \Cinexpert\Tools\Queue\Adapter\SqsAdapterFactory::class,
                    'notification'             => \Cinexpert\Tools\Notification\NotificationFactory::class,
                    'notification.adapter.sns' => \Cinexpert\Tools\Notification\Adapter\SnsAdapterFactory::class,
                    'pubsub'                   => \Cinexpert\Tools\PubSub\PubSubFactory::class,
                    'pubsub.adapter.pubnub'    => \Cinexpert\Tools\PubSub\Adapter\PubNubAdapterFactory::class,
                ],
            'abstract_factories' =>
                [
                ],
            'initializers' =>
                [
                ],
            'shared' =>
                [
                ]
        ]
];