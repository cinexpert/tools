<?php
/**
 * AdapterInterface.php
 *
 * @date        20.05.2018
 * @author      Pascal Paulis <pascal.paulis@cinexpert.net>
 * @file        AdapterInterface.php
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Cinexpert\Tools\PubSub\Adapter;

/**
 * AdapterInterface
 *
 * @package     Application  
 * @subpackage  Service
 * @author      Pascal Paulis <pascal.paulis@cinexpert.net>
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
interface AdapterInterface
{
    /**
     * @param string $channel
     * @param $message
     * @return mixed
     */
    public function publish(string $channel, $message);

    /**
     * Get a list of everyone in every channel, grouped by channel.
     *
     * @return array A list of everyone in every channel, grouped by channel
     */
    public function hereNow(): array;
}
