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

use Cinexpert\Tools\PubSub\PubSubConnectionException;
use PubNub\Exceptions\PubNubConnectionException;

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

    /**
     * @inheritdoc
     */
    public function publish(string $channel, $message)
    {
        $this->getPubNub()
            ->publish()
            ->channel($channel)
            ->message($message)
            ->usePost(true)
            ->sync();
    }

    /**
     * @inheritdoc
     */
    public function hereNow(): array
    {
        try {
            $result = $this->getPubNub()
                ->hereNow()
                ->includeState(true)
                ->includeUuids(true)
                ->sync();
        } catch (PubNubConnectionException $e) {
            throw new PubSubConnectionException();
        }

        $hereNow = [];

        foreach ($result->getChannels() as $channel) {
            $uuids = [];

            foreach ($channel->getOccupants() as $occupant) {
                $uuids[] = $occupant->getUuid();
            }

            $hereNow[$channel->getChannelName()] =
                [
                    'uuids'     => $uuids,
                    'occupancy' => $channel->getOccupancy(),
                ];
        }

        return $hereNow;
    }

    /**
     * @inheritdoc
     */
    public function subscribe(array $channels): void
    {
        $this
            ->getPubNub()
            ->subscribe()
            ->channels($channels);
    }
}
