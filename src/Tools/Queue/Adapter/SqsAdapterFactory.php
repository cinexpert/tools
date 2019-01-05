<?php
/**
 * SqsAdapterFactory.php
 *
 * @date        26.02.2018
 * @author      Pascal Paulis <pascal.paulis@cinexpert.net>
 * @file        SqsAdapterFactory.php
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Cinexpert\Tools\Queue\Adapter;

use Aws\Sqs\SqsClient;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

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
class SqsAdapterFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $parameters = array_merge(
            ['version' => '2012-11-05'],
            $container->get('aws_config')->toArray()
        );

        $adapter = new \Cinexpert\Tools\Queue\Adapter\SqsAdapter();
        $adapter->setSqsClient(new SqsClient($parameters));

        return $adapter;
    }
}
