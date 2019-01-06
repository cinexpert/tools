<?php
/**
 * PubSub.php
 *
 * @date        20.05.2018
 * @author      Pascal Paulis <pascal.paulis@cinexpert.net>
 * @file        PubSub.php
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Cinexpert\Tools\PubSub;

/**
 * PubSub
 *
 * @package     Cinexpert\Tools\PubSub  
 * @author      Pascal Paulis <pascal.paulis@cinexpert.net>
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class PubSub
{
    /** @var \Cinexpert\Tools\PubSub\Adapter\AdapterInterface $adapter */
    protected $adapter;

    /**
     * Set the adapter.
     *
     * @param \Cinexpert\Tools\PubSub\Adapter\AdapterInterface $adapter The adapter.
     * @return $this Provides a fluent interface.
     */
    public function setAdapter(\Cinexpert\Tools\PubSub\Adapter\AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
        return $this;
    }

    /**
     * Return the adapter.
     *
     * @return \Cinexpert\Tools\PubSub\Adapter\AdapterInterface The adapter.
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    public function publish(string $channel, $message)
    {
        return $this->getAdapter()->publish($channel, $message);
    }

    /**
     * Get a list of everyone in every channel, grouped by channel.
     *
     * @return array A list of everyone in every channel, grouped by channel
     */
    public function hereNow(): array
    {
        return $this->getAdapter()->hereNow();
    }
}