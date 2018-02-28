<?php

return [
    'service_manager' =>
        [
            'invokables' =>
                [
                ],
            'factories' =>
                [
                    'queue'             => \Cinexpert\Tools\Queue\QueueFactory::class,
                    'queue.adapter.sqs' => \Cinexpert\Tools\Queue\Adapter\SqsAdapterFactory::class,
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