<?php
/**
 * @date        20.05.2018
 * @author      Pascal Paulis <pascal.paulis@cinexpert.net>
 * @file        PubNubAdapter.php
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Cinexpert\Tools\PubSub\Adapter;

/**
 * PubNubAdapter
 *
 * @package     Cinexpert\Tools\PubSub\Adapter  
 * @author      Pascal Paulis <pascal.paulis@cinexpert.net>
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class PubNubAdapter implements AdapterInterface
{
    /** @var \PubNub\PubNub */
    protected $pubNub;

    /**
     * @return \PubNub\PubNub
     */
    public function getPubNub(): \PubNub\PubNub
    {
        return $this->pubNub;
    }

    /**
     * @param \PubNub\PubNub $pubNub
     * @return PubNubAdapter
     */
    public function setPubNub(\PubNub\PubNub $pubNub): PubNubAdapter
    {
        $this->pubNub = $pubNub;
        return $this;
    }

    public function publish(string $channel, $message)
    {
        $this->getPubNub()
            ->publish()
            ->channel($channel)
            ->message($message)
            ->usePost(true)
            ->sync();
    }
}