<?php
/**
 * QueueAwareTrait.php
 *
 * @date        03.07.2018
 * @author      Pascal Paulis <pascal.paulis@cinexpert.net>
 * @file        QueueAwareTrait.php
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Cinexpert\Tools\Queue;

/**
 * @codeCoverageIgnore
 */
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
