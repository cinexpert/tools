<?php

/**
 * SnsAdapter.php
 *
 * @date      27.02.2018
 * @author    Pascal Paulis <pascal.paulis@cinexpert.net>
 * @file      SnsAdapter.php
 * @copyright Copyright (c) CineXpert - All rights reserved
 * @license   Unauthorized copying of this source code, via any medium is strictly
 *            prohibited, proprietary and confidential.
 */

namespace Cinexpert\Tools\Notification\Adapter;

use Aws\Sns\SnsClient;

/**
 * SnsAdapter
 *
 * @package    Tools
 * @subpackage Service
 * @author     Pascal Paulis <pascal.paulis@cinexpert.net>
 * @copyright  Copyright (c) CineXpert - All rights reserved
 * @license    Unauthorized copying of this source code, via any medium is strictly
 *             prohibited, proprietary and confidential.
 */
class SnsAdapter implements AdapterInterface
{
    /** @var SnsClient */
    protected $snsClient;

    /**
     * @return SnsClient
     */
    public function getSnsClient(): SnsClient
    {
        return $this->snsClient;
    }

    /**
     * @param SnsClient $snsClient
     * @return SnsAdapter
     */
    public function setSnsClient(SnsClient $snsClient): SnsAdapter
    {
        $this->snsClient = $snsClient;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function sendNotification(string $topic, string $message): AdapterInterface
    {
        $this->getSnsClient()->publish([
            'TopicArn' => $topic,
            'Message'  => $message
        ]);

        return $this;
    }
}
