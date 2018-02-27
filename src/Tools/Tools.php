<?php
/**
 * Tools.php
 *
 * @date        26.02.2018
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @file        Tools.php
 * @copyright   Copyright (c) CineXpert - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Cinexpert\Tools;

use Zend\ServiceManager\ServiceManager;

/**
 * Class Tools
 *
 * Entry-point to use the tool-set
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
class Tools extends ServiceManager
{
    public function __construct(ToolsConfig $config)
    {
        $services = require __DIR__ . '/../../config/module.config.php';
        parent::__construct($services['service_manager']);

        $this->setService(
            'aws_config',
            [
                'region' => $config->getAwsRegion(),
                'key'    => $config->getAwsKey(),
                'secret' => $config->getAwsSecret()
            ]
        );
    }
}
