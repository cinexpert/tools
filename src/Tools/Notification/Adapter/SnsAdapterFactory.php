<?php
/**
 * SqsAdapterFactory.php
 *
 * @date        03.06.2018
 * @author      Pascal Paulis <pascal.paulis@cinexpert.net>
 * @file        SqsAdapterFactory.php
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Cinexpert\Tools\Notification\Adapter;

use Aws\Sns\SnsClient;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class SqsAdapterFactory
 *
 * @package     Cinexpert  
 * @subpackage  Tools
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 *
 * @codeCoverageIgnore
 */
class SnsAdapterFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
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
