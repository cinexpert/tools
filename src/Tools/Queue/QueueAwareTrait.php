<?php

namespace Cinexpert\Tools\Queue;

trait QueueAwareTrait
{
    /** @var Queue */
    protected $queue;

    /**
     * @param Queue $queue
     * @return $this
     */
    public function setQueue(Queue $queue)
    {
        $this->queue = $queue;
        return $this;
    }

    /**
     * @return Queue
     */
    public function getQueue(): Queue
    {
        return $this->queue;
    }
}
