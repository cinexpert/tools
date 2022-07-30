<?php

/**
 * AwsConfigAwareTrait.php
 *
 * @date      26.03.2017
 * @author    Pascal Paulis <pascal.paulis@cinexpert.net>
 * @file      AwsConfigAwareTrait.php
 * @copyright Copyright (c) CineXpert - All rights reserved
 * @license   Unauthorized copying of this source code, via any medium is strictly
 *            prohibited, proprietary and confidential.
 */

namespace Cinexpert\Tools;

/**
 * AwsConfigAwareTrait
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
trait AwsConfigAwareTrait
{
    protected $awsConfig;

    /**
     * Get the AWS config.
     *
     * @return AwsConfig
     */
    public function getAwsConfig()
    {
        return $this->awsConfig;
    }

    /**
     * Set the AWS config.
     *
     * @param AwsConfig $awsConfig
     * @return $this
     */
    public function setAwsConfig(AwsConfig $awsConfig)
    {
        $this->awsConfig = $awsConfig;
        return $this;
    }
}
