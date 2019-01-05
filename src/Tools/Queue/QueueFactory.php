<?php
/**
 * QueueFactory.php
 *
 * @date        26.02.2018
 * @author      Pascal Paulis <pascal.paulis@cinexpert.net>
 * @file        QueueFactory.php
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Cinexpert\Tools\Queue;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class QueueFactory
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
class QueueFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $queue = new \Cinexpert\Tools\Queue\Queue();
        $queue->setAdapter($container->get('queue.adapter.sqs'));

        return $queue;
    }
}
