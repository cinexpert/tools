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
    /** @var \Application\Service\PubSub\Adapter\AdapterInterface $adapter */
    protected $adapter;

    /**
     * Set the adapter.
     *
     * @param \Application\Service\PubSub\Adapter\AdapterInterface $adapter The adapter.
     * @return $this Provides a fluent interface.
     */
    public function setAdapter(\Application\Service\PubSub\Adapter\AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
        return $this;
    }

    /**
     * Return the adapter.
     *
     * @return \Application\Service\PubSub\Adapter\AdapterInterface The adapter.
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    public function publish(string $channel, $message)
    {
        return $this->getAdapter()->publish($channel, $message);
    }
}