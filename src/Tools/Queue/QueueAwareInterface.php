<?php

namespace Cinexpert\Tools\Queue;

interface QueueAwareInterface
{
    /**
     * @param Queue $queue
     * @return $this
     */
    public function setQueue(Queue $queue);

    /**
     * @return Queue
     */
    public function getQueue(): Queue;
}
