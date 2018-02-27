<?php

namespace Cinexpert\Tools\Queue;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class QueueFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $queue = new \Cinexpert\Tools\Queue\Queue();
        $queue->setAdapter($container->get('tools.queue.adapter.sqs'));

        return $queue;
    }
}
