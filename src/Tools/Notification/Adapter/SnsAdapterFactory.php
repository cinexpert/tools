<?php

/**
 * SqsAdapterFactory.php
 *
 * @date      03.06.2018
 * @author    Pascal Paulis <pascal.paulis@cinexpert.net>
 * @file      SqsAdapterFactory.php
 * @copyright Copyright (c) CineXpert - All rights reserved
 * @license   Unauthorized copying of this source code, via any medium is strictly
 *            prohibited, proprietary and confidential.
 */

namespace Cinexpert\Tools\Notification\Adapter;

use Aws\Sns\SnsClient;
use Psr\Container\ContainerInterface;

/**
 * Class SqsAdapterFactory
 *
 * @package     Cinexpert
 * @subpackage  Tools
 * @author      Pascal Paulis <pascal.paulis@cinexpert.net>
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 *
 * @codeCoverageIgnore
 */
class SnsAdapterFactory
{
    public function __invoke(ContainerInterface $container, string $requestedName, ?array $options = null)
    {
        $parameters = array_merge(
            ['version' => '2010-03-31'],
            $container->get('aws_config')->toArray()
        );

        $adapter = new SnsAdapter();
        $adapter->setSnsClient(new SnsClient($parameters));

        return $adapter;
    }
}
