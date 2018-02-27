<?php

return [
    'service_manager' =>
        [
            'invokables' =>
                [
                ],
            'factories' =>
                [
                    'tools.queue'             => \Cinexpert\Tools\Queue\QueueFactory::class,
                    'tools.queue.adapter.sqs' => \Cinexpert\Tools\Queue\Adapter\SqsAdapterFactory::class,
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